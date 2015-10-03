<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class IndexController extends MemberController {

    /**
     * 默认动作，首页
     * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/y/index/index/index/name/yantze 的时候, 你就会发现不同
     */
    public function indexAction(){
        $curl = new Curl();
        $data = $curl->setData2(['query'=>['mobileNum'=>$this->user['unionid']]])
            ->setApiUrl($this->config->url->api->sdp)
            ->send('distribution/getInfo');

        if(empty($data) || $data['errcode'] != 0){
            $this->error('数据查询失败,请稍后再试!');
        }

        $this->getView()->assign('data',$data);
        $this->getView()->assign('user',$this->user);


        $info = M('t_wx_user')->get(
            [
                'userid',
                'unionid',
                'qr_ticket',
                'qr_expire_seconds',
                'qr_create_time',
            ],
            ['userid'=>$this->user['userid']]
        );
        $qrcode = get_wx_qrcode($this->wechat,$info);
        $this->getView()->assign('qrcode',$qrcode);
    }

    public function setupShopAction(){
        $curl = new Curl();
        $data = $curl->setData2(['query'=>['mobileNum'=>$this->user['unionid']]])
            ->setApiUrl($this->config->url->api->sdp)
            ->send('distribution/getInfo');

        if(empty($data) || $data['errcode'] != 0){
            $this->error('数据查询失败,请稍后再试!');
        }

        $this->getView()->assign('article_list',M('t_document')->select(['id','title'],['category_id'=>42]));
        $this->getView()->assign('data',$data);
        $this->getView()->assign('user',$this->user);

        $curl = new Curl();

        $resp = $curl->setData(['distributionUserId'=>$this->user['unionid']])
            ->setApiUrl($this->config->url->api->sdp)
            ->send('distribution/isShopkeeper');

        $this->getView()->assign('shopkeeper',$resp['shopkeeper']);
    }

    public function shopAction(){
        $curl = new Curl();
        $data = $curl->setData2(['query'=>['mobileNum'=>$this->user['unionid']]])
            ->setApiUrl($this->config->url->api->sdp)
            ->send('distribution/getInfo');

        if(empty($data) || $data['errcode'] != 0){
            $this->error('数据查询失败,请稍后再试!');
        }

        $this->getView()->assign('data',$data);

        $parent = M('t_wsyq_distribution_user_relation')->get(
            [
                '[>]t_wx_user(w)'=>['parentUserId'=>'unionid'],
                '[>]t_ucenter_member(u)'=>['w.userid'=>'wx_userid'],
            ],
            ['t_wsyq_distribution_user_relation.levelNo','w.headimgurl','w.nickname','u.mobile'],
            ['t_wsyq_distribution_user_relation.userId'=>$this->user['unionid']]
        );

        $default = ['mobile'=>'','nickname'=>'天天加油','headimgurl'=>'/mex/images/getheadimg.jpg'];
        if(empty($parent)){
            $parent = $default;
            $parent['levelNo'] = 0;
        }elseif(empty($parent['nickname'])){
            $parent = array_merge($parent,$default);
        }

        //待付款金额,已完成金额,已作废金额
        $total = ['wait'=>0,'completed'=>0,'cancel'=>0];
        if(!empty($parent['levelNo'])){

            $uid_list = M('t_wsyq_distribution_user_relation')->select(
                [
                    '[>]t_wx_user(w)'=>['userId'=>'unionid'],
                ],
                'w.userid',
                [
                    'LIKE'=>['t_wsyq_distribution_user_relation.levelNo%'=>$parent['levelNo']],
                    'AND'=>[
                        't_wsyq_distribution_user_relation.userId[!]'=>$this->user['unionid']
                    ]
                ]
            );

            $uid_list = array_filter($uid_list);

            if(!empty($uid_list)){
                $where = ['AND'=>['userid'=>$uid_list]];
                $where['AND']['product_id[!]'] = ['16'];
                $john = ["[>]t_order_product" =>["sn"=>"sn"]];
                $where['AND']['status'] = OrderModel::STATUS_WATI_PAY;
                $total['wait'] = M('t_orders')->sum($john,'amount',$where);

                unset($where['AND']['status']);
                $where['AND']['pay_status'] = OrderModel::PAY_STATUS_PAYD;
                $total['completed'] = M('t_orders')->sum($john,'amount',$where);

                $where['AND']['status'] = OrderModel::STATUS_CANCELLED;
                $total['cancel'] = M('t_orders')->sum($john,'amount',$where);
            }
        }

        $item['params'] = ['shop_name'=>$this->user['nickname'],'shop_title'=>''];
        $curl = new Curl();

        $resp = $curl->setData(['distributionUserId'=>$this->user['unionid']])
            ->setApiUrl($this->config->url->api->sdp)
            ->send('distribution/isShopkeeper');

        $this->getView()->assign('shopkeeper',$resp['shopkeeper']);

        $this->getView()->assign('item',$item);
        $this->getView()->assign('total',$total);
        $this->getView()->assign('user',$this->user);
        $this->getView()->assign('parent',$parent);

//        $this->getView()->display('index/index.php');
//        die;
    }

    public function chooseDisAction(){


    }

    public function distributionAction($goods_id=''){

        $item = array();
        $shopkeeper = false;

        $type = $this->getRequest()->getQuery('type','default');
        $this->getView()->assign('type',$type);
        if($goods_id){

            $curl = new Curl();
            $resp = $curl->setData(array('id'=>$goods_id))->send('mall/product/getDetail');

            if(!empty($resp) && $resp['errcode'] == 0){
                $item = $resp['info'];
            }
            $item['pic'][0] = show_pic($item['pic'][0]);
        }else{

            $discriptions = [
                'default'=>'国内唯一官方指定手机加油站：天天优惠，天天赚钱！',
                'dls'=>'天天加油诚招代理，唯一货源，必需消费，史上最靠谱的1元微商！',
                'chezhu'=>'1元现在加入天天加油，广东省百万车主9月1日等你服务！',
                'custom'=>'国内唯一官方指定手机加油站：天天优惠，天天赚钱！',
            ];
            $item = [
                        'title'=>'天天加油',
                        'meta_keyword'=>'',
                        'meta_description'=>$discriptions[$type],
                        'pic'=>[DOMAIN.'/mex/images/getheadimg.jpg?123'],
                    ];


            $curl = new Curl();

            $resp = $curl->setData(['distributionUserId'=>$this->user['unionid']])
                ->setApiUrl($this->config->url->api->sdp)
                ->send('distribution/isShopkeeper');
            $shopkeeper = $resp['shopkeeper'];
        }
        $info = M('t_wx_user')->get(
            [
                'userid',
                'unionid',
                'qr_ticket',
                'qr_expire_seconds',
                'qr_create_time',
            ],
            ['userid'=>$this->user['userid']]
        );
        $qrcode = get_wx_qrcode($this->wechat,$info);
        $this->getView()->assign('qrcode',$qrcode);

        $this->layout->title = $item['title'];
        $this->layout->keywords = $item['meta_keyword'];
        $this->layout->description = $item['meta_description'];
        $this->getView()->assign('item',$item);

        $this->getView()->assign('shopkeeper',$shopkeeper);
        $this->getView()->assign('cpsid',$this->user['userid']);
    }

    public function myCardAction(){

        if(empty($this->user['mobile'])){
            $this->redirect('/member/info/setmobile.html');
        }

        $cur_page = intval($this->getRequest()->getQuery('page',1));

        $pagenum = $this->config->application->pagenum;
        $data = [
                    'channelNo'=>$this->config->product->card->channel,
                    'mobileNum'=>$this->user['mobile'],
                    'startDate'=>'',
                    'endDate'=>'',
                    'pageSize'=>$pagenum,
                    'pageIndex'=>$cur_page,
                ];


        $status = ["END","OK#","NOP","FRZ"];
        $data['signature'] = md5(array_value_sort_to_str($data+['status'=>array_value_sort_to_str($status),'channelKey'=>$this->config->product->card->channelKey]));
        $data['status'] = $status;

        $list = [];
        $total = 0;
        $curl = new Curl();
        $resp = $curl->setData2($data,false)
            ->setApiUrl($this->config->url->api->map)
            ->send('online/listCards');
//        var_dump($resp);die;

        if(!empty($resp) && $resp['errcode'] == 0 && isset($resp['list'])){
            $list = $resp['list'];
            $total = $resp['total'];
        }

        $page = new Page($total,$pagenum,$_REQUEST);

        $this->getView()->assign('page',$page->show());

        $this->getView()->assign('total',$total);
        $this->getView()->assign('list',$list);
    }

    public function barCodeAction(){
        if(empty($this->user['mobile'])){
            $this->redirect('/member/info/setmobile.html');
        }
        
        $cur_page = intval($this->getRequest()->getQuery('page',1));

        $pagenum = $this->config->application->pagenum;

        $config = new Yaf\Config\Ini(CONF_PATH.'zjhtsign.ini');
        $sign = new Zsign($config->toArray());

        //订单列表查询
        $req = [
            'service'=>'trade.queryBarCodeList',
            'content'=>[
                'pageSize'=>$pagenum,
                'pageIndex'=>$cur_page,
                'username'=>$this->user['mobile'],
                'channel'=>'WECHAT',
                'requestType'=>'WECHAT',
            ]
        ];

        $resp = $sign->send($req);
        $list = [];
        $total = 0;
        if(!empty($resp) && isset($resp['content']) && isset($resp['content']['records'])){
            $list = $resp['content']['records'];
            $total = $resp['content']['totalRecords'];
        }

        $page = new Page($total,$pagenum,$_REQUEST);

        $this->getView()->assign('page',$page->show());

        $this->getView()->assign('total',$total);
        $this->getView()->assign('list',$list);
    }

    public function getSmsCodeAction(){

        $mobileNum = trim($this->getRequest()->getPost('mobileNum',''));
        if(empty($mobileNum)){
            $this->error('手机号码不能为空！');
        }

        $code = mt_rand(1000,9999);
        $data = $this->config->url->api->sms->toArray();
        $url    = array_shift($data);
        $data['mobileNum']  = $mobileNum;
        $data['content']    = sprintf($data['content'],$code);

        $curl = new Curl();
        $resp = $curl->setApiUrl($url)->setData2($data,false)->send('');

        if($resp['errcode'] == 0){

            //将短信验证码、手机、创建时间保存至会话中
            session('bindSmsCode',['code'=>$code,'time'=>time(),'mobile'=>$mobileNum]);
            SeasLog::debug('短信验证码:'.var_export($code,true));

            $this->success('验证码发送成功！');
        }else{
            $this->error('验证码发送失败，请重新再试！');
        }
    }
}
