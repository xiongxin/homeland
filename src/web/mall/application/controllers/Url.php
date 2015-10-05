<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class UrlController extends Yaf\Controller_Abstract  {

    protected $config;
    protected $wechat;
    protected $raw_data;
    
    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
        
        $this->config = Yaf\Registry::get('config');
    
        $this->wechat = new Wechat($this->config->wechat->toArray());

        $this->raw_data = file_get_contents('php://input');

        if(isset($this->raw_data['body'])){
            $this->raw_data = $this->raw_data['body'];
        }
    }

    public function signAction(){

        $forward = urlencode(DOMAIN.'/index/scanSign.html');
        $url = DOMAIN.'/callback/spread.html?forward='.$forward;

        echo json_encode(['errcode'=>0,'errmsg'=>'成功！','url'=>$this->wechat->getShortUrl($this->wechat->getOauthRedirect($url,'','snsapi_base'))]);
    }

}
