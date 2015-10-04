<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class CallbackController extends Yaf\Controller_Abstract  {

    protected $config;
    protected $wechat;
    protected $raw_data;
    
    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
        
        $this->config = Yaf\Registry::get('config');
    
        $this->wechat = new Wechat($this->config->wechat->toArray());

    }

    private function _getWxuserToken(){
        $code = $this->getRequest()->getQuery('code');
        if(empty($code)){
            $this->redirect('/?status=codenull');
            die;
        }

        $user_token = $this->wechat->getOauthAccessToken($code);
        //本地调试用
//        $user_token['openid'] = 'ozCgxuFdxW5EqGeJ6OuIu10leIS0';
//        $user_token['unionid'] = 'olbkKtxWIOQDYKCQM7GBp7WTNbEU';

        if(empty($user_token) || !isset($user_token['openid'])){
            $this->redirect('/?status=get_user_token_faild');
            die;
        }

        return $user_token;
    }

    public function spreadAction(){
        $this->_wxAutoLogin();
        $forward = urldecode($this->getRequest()->getQuery('forward',''));
        if($forward){
            $this->redirect($forward);
            die;
        }
    }

    private function _wxAutoLogin(){

        $user_token = $this->_getWxuserToken();

        $model = new WxUserModel();
        $field = [
            'openid',
            'userid',
            'nickname',
            'headimgurl',
            'unionid',
            'subscribe',
            't_ucenter_member.mobile',
        ];

        $user_info = $model->get(['[>]t_ucenter_member'=>['userid'=>'wx_userid']],$field,['unionid'=>$user_token['unionid']]);

        $cpsid = null;
        //如果用户不存在,并且应用授权作用域是snsapi_userinfo,则请求微信获取用户详情信息
        if(empty($user_info) && $user_token['scope'] == 'snsapi_userinfo'){

            //先通过openid直接获取用户信息
            $user_info = $this->wechat->getUserInfo($user_token['openid']);

            //如果从微信获取用户信息失败,或者用户未关注本公众号
            if(empty($user_info) || $user_info['subscribe'] != 1){
                //通过网页授权获取用户基本信息
                $user_info = $this->wechat->getOauthUserinfo($user_token['access_token'],$user_token['openid']);
                //再拿不到用户信息,则只能退出了
                if(empty($user_info)){
                    $this->redirect('/?status=userinfonull');
                    die;
                }
                //将用户特征信息转为json格式
                $user_info['privilege'] = json_encode($user_info['privilege'],JSON_UNESCAPED_UNICODE);
                $user_info['subscribe'] = -1;
            }

            //开始自动完成用户注册
            $user_info['userid'] = $model->reg($user_info);
            if(!$user_info['userid']){
                $this->redirect('/?status=userregfail');
                die;
            }
        }elseif(empty($user_info) && $user_token['scope'] == 'snsapi_base'){
            //未关注公众号的用户,也执行注册流程,只保存openid和unionid,其他内容置为默认项
            $user_info = [
                            'openid'=>$user_token['openid'],
			                'nickname'=>'',
                            'sex'=>0,
                            'unionid'=>$user_token['unionid'],
                            'subscribe' => -1
                        ];

            //开始完成用户注册
            $user_info['userid'] = $model->reg($user_info);
            if(!$user_info['userid']){
                $this->redirect('/?status=nosub_userregfail');
                die;
            }
        }

        //将用户信息放入会话中,此功能有待完善
        session('user_auth',$user_info);

        return $user_info;
    }

    public function wxMenuAction(){

        $userinfo = $this->_wxAutoLogin();
        $state = $this->getRequest()->getQuery('state');

        //根据state的值跳转到相应的页面
        switch($state){

            default:
                $this->redirect('/?status=success');
                break;
        }
        die;
    }
}
