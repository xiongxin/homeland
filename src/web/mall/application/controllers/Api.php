<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class ApiController extends Yaf\Controller_Abstract  {

    protected $config;
    protected $wechat;
    protected $raw_data;
    
    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
        
        $this->config = Yaf\Registry::get('config');
    
        $this->wechat = new Wechat($this->config->wechat->toArray());

    }

    /**
     * 微信接口Action
     * @return bool
     */
    public function wechatAction(){

//        $this->raw_data = $this->getRequest()->getParam('raw_data');

        $this->raw_data = file_get_contents('php://input');

        SeasLog::debug("请求内容==>".$this->raw_data);
        $this->wechat->setPostXml($this->raw_data)->getRev();

        if(!$this->wechat->valid()){
	        die;
            //return false;
        }

        $type = $this->wechat->getRevType();
        switch($type) {
                case Wechat::MSGTYPE_EVENT:
                    $this->_do_event();
                    break;
								
                case Wechat::MSGTYPE_IMAGE:
                case Wechat::MSGTYPE_TEXT:
                case Wechat::MSGTYPE_VOICE:
                case Wechat::MSGTYPE_VIDEO:
                case Wechat::MSGTYPE_LINK:
                case Wechat::MSGTYPE_SHORTVIDEO:
                    $this->wechat->transfer_customer_service()->reply();
                    
                break;

                default:
                    $this->wechat->text("help info")->reply();
        }
	    die;
    }

    /**
     * 事件方法
     */
    private function _do_event(){

        $event = $this->wechat->getRevEvent();
        switch($event['event']){
            case Wechat::EVENT_MENU_CLICK:
                if(method_exists($this,$event['key'])){
                    $this->$event['key']();
                }else{
                    $this->wechat->text('功能完善中，感谢您的关注！')->reply();
                }
                break;
            case Wechat::EVENT_LOCATION:
                //地理位置
                break;
            case Wechat::EVENT_SUBSCRIBE:
                //关注

                $openId = $this->wechat->getRevFrom();
                //首先获取微信用户的详细信息
                $userinfo = $this->wechat->getUserInfo($openId);

                if(empty($userinfo)){
                    SeasLog::debug('靠,获取用户失败,此种情况应该不会出现,除非与微信通信失败了!');
                }
                //异步更新数据库
//                $task_data = array(
//                        'index',
//                        'async',
//                        'subscribe',
//                        array('raw_data'=>$this->raw_data,'userinfo'=>$userinfo)
//                );
//                //发送异步任务
//                HttpServer::$server->task($task_data);
                
//                $this->wechat->text('欢迎您关注天天加油服务！')->reply();
                $this->_subscribe($userinfo);
                
                $this->wechat->news([
                                        [
                                            'Title'=>'抢！聚油惠 购1000送50',
                                            'Description'=>'',
                                            'PicUrl'=>'http://121.40.181.149:8089/Uploads/Picture/2015-07-25/55b3076c1c0af.png',
                                            'Url'=>DOMAIN.'/product/detail/goods_id/12.html',
                                        ],
                                        [
                                            'Title'=>'尊敬的'.$userinfo['nickname'].'，欢迎您关注天天加油，点击进入加油商城',
                                            'Description'=>'',
                                            'PicUrl'=>$userinfo['headimgurl'],
                                            'Url'=>DOMAIN,
                                        ],
                                        [
                                            'Title'=>'开店赚钱指南',
                                            'Description'=>'',
                                            'PicUrl'=>'http://mmbiz.qpic.cn/mmbiz/pzgWNvGibfdzuYQ4KATrEpRSnaynVIX7TYaI63DYLKTuJpoKibNSQKibmlZKJ55St5X8Kx5HO09qic5uKBQkib63cjw/640?wx_fmt=jpeg&wxfrom=5',
                                            'Url'=>'http://mp.weixin.qq.com/s?__biz=MzI3NjAxNzE3OA==&mid=208969664&idx=1&sn=2786b9892004f9471a2a0d7220936152&scene=5#rd',
                                        ],
                                    ])->reply();

                break;
            case Wechat::EVENT_UNSUBSCRIBE:

		$openId = $this->wechat->getRevFrom();
	        $model = new Model('t_wx_user');
        	$model->update(['subscribe'=>0],['openid'=>$openId]);
                //取消关注
                //异步更新数据库
                //$task_data = array(
                //       'index',
                //        'async',
                //        'unSubscribe',
                //        array('raw_data'=>$this->raw_data)
                //);
                //发送异步任务
                //HttpServer::$server->task($task_data);
                
                break;
        }

    }

    private function _subscribe($userinfo){

        $parent_id = $this->wechat->getRevSceneId();
        if($parent_id){
            //将此二人的关系先存起来
            $ff = M()->exec("replace into t_wx_spread (unionid,openid,cpsid,save_time) values('{$userinfo['unionid']}','{$userinfo['openid']}',$parent_id,'".time_format()."')");
            SeasLog::debug($ff.'SQL'.M()->last_query());
        }

        $model = new WxUserModel();
        //用户注册
        if($model->save($userinfo)){

            SeasLog::debug('微信关注用户信息保存成功了!');
            $this->_sdp_reg($userinfo);
        }else{
            SeasLog::debug(M()->last_query());
            SeasLog::error('出大事了,关注完之后竟然在最后一步出错了,没保存成功!');
        }
    }

    /**
     * 调用 sdp 接口 创建分销关系
     * @param $data
     * @return bool
     */
    private function _sdp_reg($data){

        //判断是否是扫描带参数的二维码过来的用户
        $parent_id = $this->wechat->getRevSceneId();
        if($parent_id){
            $item = M('t_wx_user')->get(['openid','nickname','unionid(updistribution)'],['userid'=>$parent_id]);
        }else{

            $item = M('t_wx_spread')->get(
                ['[><]t_wx_user(w)'=>['cpsid'=>'userid']],
                ['w.openid','w.nickname','w.unionid(updistribution)','t_wx_spread.unionid(distribution)'],
                ['t_wx_spread.unionid'=>$data['unionid']]
            );
        }

        if(empty($item)){
            SeasLog::debug('此用户没有分销关系!');
            return false;
        }

        $curl = new Curl();

        SeasLog::debug('开始分销关系创建!');

        //如果是扫描带参数的二维码
        if($parent_id){
            $item['distribution'] = $data['unionid'];
        }

        $resp = $curl->setData2(['relation'=>['upDistributionUserId'=>$item['updistribution'],'distributionUserId'=>$item['distribution']]])
            ->setApiUrl($this->config->url->api->sdp)
            ->send('distribution/joinDistribution');

        if(empty($resp) || $resp['errcode'] != 0) {
            return false;
        }

        $resp = $curl->setData(['distributionUserId'=>$item['distribution']])
            ->setApiUrl($this->config->url->api->sdp)
            ->send('distribution/isShopkeeper');

        $content = "尊敬的{$item['nickname']}大掌柜：恭喜您成功发展了一名店小二，您将获得店小二的销售佣金。";
        if(empty($resp) || !$resp['shopkeeper']){

            $content = "尊敬的{$item['nickname']}，恭喜您成功发展了一名会员，请立即引导好友开店赚钱，您将获得好友的销售佣金。";
        }

        //调用微信模板消息接口,发送通知给邀请者
        $msg = [
            'touser'=>$item['openid'],
            'template_id'=>'zLOwdrCbtKghRmPhx5zXo9hzc70VTTdSXD_y7SDxw9M',
            'url'=>DOMAIN.'/member/index/index.html',
            'topcolor'=>'',
            'data'=>[
                'first'=>['value'=>$content."\n",'color'=>'#333333'],
                'keyword1'=>['value'=>$data['nickname'],'color'=>'#333333'],
                'keyword2'=>['value'=>date('Y年m月d日 H:i',time()),'color'=>'#333333'],
                'remark'=>['value'=>"\n结合您对天天加油的了解和体验，引领您的朋友一起体验与分享我们的产品吧！",'color'=>'#333333'],
            ],
        ];

        $this->wechat->sendTemplateMessage($msg);
    }

    private function _signin(){
        $this->wechat->text('签到成功！')->reply();
    }
}
