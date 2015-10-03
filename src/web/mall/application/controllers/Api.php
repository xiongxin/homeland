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
                $this->_subscribe($userinfo);
                
                $this->wechat->text('欢迎关注！')->reply();

                break;
            case Wechat::EVENT_UNSUBSCRIBE:

		$openId = $this->wechat->getRevFrom();
	        $model = new Model('t_wx_user');
        	$model->update(['subscribe'=>0],['openid'=>$openId]);
                break;
        }

    }

    private function _subscribe($userinfo){

        $model = new WxUserModel();
        //用户注册
        if($model->save($userinfo)){

            SeasLog::debug('微信关注用户信息保存成功了!');
        }else{
            SeasLog::debug(M()->last_query());
            SeasLog::error('出大事了,关注完之后竟然在最后一步出错了,没保存成功!');
        }
    }
}
