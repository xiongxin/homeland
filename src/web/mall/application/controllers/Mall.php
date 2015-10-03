<?php
/**
 * @name MallController
 * @author xuebingwang
 * @desc 商城基控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class MallController extends Yaf\Controller_Abstract {
           
    protected $config;
    protected $wechat;
    protected $layout;
    protected $user;

    protected $waitSecond = 3;

    public function init(){
        $unionId = is_login();

        $this->config = Yaf\Registry::get('config');
        $this->wechat = new Wechat($this->config->wechat->toArray());

        if(!is_not_wx() && empty($unionId)){
            //如果当前浏览器是微信浏览器,并且当前为未登录状态
            //重定向至微信,采用网页授权获取用户基本信息接口获取code

            $forward = urlencode(DOMAIN.$_SERVER['REQUEST_URI']);
            $url = DOMAIN.'/callback/spread.html?forward='.$forward;

            $this->redirect($this->wechat->getOauthRedirect($url,'','snsapi_base'));
        }

        $this->user = session('user_auth');
        if($unionId && intval($this->user['subscribe']) < 1){
            //如果该用户还未关注公众号,每次都去数据库中读取一次看看是否已经关注了
            $curl = new Curl();
            $resp = $curl->setData(['openId'=>$this->user['openid']])->send('userCenter/user/query');

            if(!empty($resp) && $resp['errcode'] == 0 && !empty($resp['result'])){

                $user_info = $resp['result']['wxInfo'];
                $user_info['isMember'] = $resp['result']['isMember'];
                if(is_array($resp['result']['userInfo'])){
                    $this->user = array_merge($user_info,$resp['result']['userInfo']);

                    session('user_auth',$this->user);
                }
            }
        }

        $js_ticket = $this->wechat->getJsTicket();
        if (!$js_ticket) {
            echo "获取js_ticket失败！<br>";
            echo '错误码：'.$this->wechat->errCode;
            echo ' 错误原因：'.ErrCode::getErrText($this->wechat->errCode);
            exit;
        }

        $this->layout = Yaf\Registry::get('layout');
        $url = DOMAIN.$_SERVER['REQUEST_URI'];

        $js_sign = $this->wechat->getJsSign($url);

        $this->layout->js_sign = $js_sign;
    }

    protected function getMCA(){
        return $this->getModule().$this->getController().$this->getAction();
    }
    /**
     * 操作错误跳转的快捷方法
     * @access protected
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function error($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,1,$jumpUrl,$ajax);
    }
    
    /**
     * 操作成功跳转的快捷方法
     * @access protected
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function success($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,0,$jumpUrl,$ajax);
    }
    
    /**
     * 默认跳转操作 支持错误导向和正确跳转
     * 调用模板显示 默认为public目录下面的success页面
     * 提示页面为可配置 支持模板标签
     * @param string $message 提示信息
     * @param Boolean $status 状态
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @access private
     * @return void
     */
    private function dispatchJump($message,$status=1,$jumpUrl='/',$ajax=false) {
        if(true === $ajax || IS_AJAX) {// AJAX提交
            $data           =   is_array($ajax)?$ajax:array();
            $data['msg']    =   $message;
            $data['status'] =   $status;
            $data['url']    =   $jumpUrl;
            $this->ajaxReturn($data);
        }
        
        //模板没有
//        exit($message);
        $this->getView()->assign('jumpUrl',$jumpUrl);
        //如果设置了关闭窗口，则提示完毕后自动关闭窗口
        $this->getView()->assign('status',$status);   // 状态
        $this->getView()->assign('message',$message);// 提示信息

        $content = '';
        //保证输出不受静态缓存影响
        if($status) { //发送成功信息
            //发生错误时候默认停留3秒
            $this->getView()->assign('waitSecond',$this->waitSecond);
            $this->getResponse()->setBody($this->getView()->render('error.php'));
        }else{
            //默认停留1秒
            $this->getView()->assign('waitSecond',$this->waitSecond-2);
            $this->getResponse()->setBody($this->getView()->render('success.php'));
        }

        $this->layout->postDispatch($this->getRequest(),$this->getResponse());
        $this->getResponse()->response();
        // 中止执行  避免出错后继续执行
        die;
    }

    public function redirect($url){
        parent::redirect($url);
        die;
    }

    public function display($action){
        parent::display($action);
        die;
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    protected function ajaxReturn($data,$type='',$json_option=0) {
        if(empty($type)) $type  =   $this->config->ajax->return;
        switch (strtoupper($type)){
        	case 'JSON' :
        	    // 返回JSON数据格式到客户端 包含状态信息
        	    header('Content-Type:application/json; charset=utf-8');
        	    exit(json_encode($data,$json_option));
        	case 'XML'  :
        	    // 返回xml格式数据
        	    header('Content-Type:text/xml; charset=utf-8');
        	    exit(xml_encode($data));
        	case 'JSONP':
        	    // 返回JSON数据格式到客户端 包含状态信息
        	    header('Content-Type:application/json; charset=utf-8');
        	    $handler  = $this->config->ajax->jsonp->handler;
        	    exit($handler.'('.json_encode($data,$json_option).');');
        	case 'EVAL' :
        	    // 返回可执行的js脚本
        	    header('Content-Type:text/html; charset=utf-8');
        	    exit($data);
        }
    }

    /**
     * 返回当前模块名
     *
     * @access protected
     * @return string
     */
    protected function getModule()
    {
        return $this->getRequest()->module;
    }
    
    /**
     * 返回当前控制器名
     *
     * @access protected
     * @return string
     */
    protected function getController()
    {
        return $this->getRequest()->controller;
    }
    
    /**
     * 返回当前动作名
     *
     * @access protected
     * @return string
     */
    protected function getAction()
    {
        return $this->getRequest()->action;
    }
}
