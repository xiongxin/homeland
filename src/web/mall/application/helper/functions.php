<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xuebing <406964108@qq.com>
// +----------------------------------------------------------------------

/**
 * 系统函数库
 */

/**
 * @param $wechet
 * @param $info
 * @return mixed
 */
function get_wx_qrcode($wechet,$info){

    if(empty($info['qr_create_time'])){
        $resp = $wechet->getQRCode($info['userid'],1);
        if(!empty($resp)){
            M('t_wx_user')->update([
                'qr_ticket'=>$resp['ticket'],
                'qr_expire_seconds'=>$resp['expire_seconds']-100,
                'qr_create_time'=>time(),
            ],
                ['userid'=>$info['userid']]
            );

            $info['qr_ticket'] = $resp['ticket'];
        }else{
            return false;
        }
    }

    return $wechet->getQRUrl($info['qr_ticket']);
}

/**
 * 获取配置中的app信息
 * @return array
 */
function get_app(){
    $app = Yaf\Registry::get('config')->api->app->toArray();
    $app['nonce'] = mt_rand(100000, 999999);
    $app['timeStamp'] = time();
    $app['signature'] = md5(array_value_sort_to_str($app));

    unset($app['appKey']);

    return $app;
}
function array_value_sort_to_str(Array $array=array()){
    asort($array,SORT_STRING);
    $str = '';
    foreach ($array as $tmp){
        $str .= $tmp;
    }

    SeasLog::debug('签名明文:'.$str);
    return $str;
}
/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author xuebingwang<406964108@qq.com>
 */
function is_login(){
    $user = session('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return isset($user['unionid']) ? $user['unionid'] : 0;
    }
}

function is_not_wx(){
    static $useragent;
    if(empty($useragent)){
        $useragent = strtolower(addslashes($_SERVER['HTTP_USER_AGENT']));
    }
    return strpos($useragent, 'micromessenger') === false && strpos($useragent, 'windows phone') === false;
}
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * 裁剪正中部分，等比缩小生成缩略图
 * @param $url
 * @param int $w
 * @param int $h
 * @return string
 */
function imageView2($url,$w=100,$h=100){
    return $url.'?imageView2/1/w/'.$w.'/h/'.$h.'/interlace/1';
}
/**
 * 
 * @param string $name
 * @param string $value
 */
function session($name,$value=''){
    static $session;
    
    if(empty($session)){
        
        $session = Yaf\Session::getInstance();
    }
    
    $f = false;
    switch (true){
        
    	case '' === $value:
    	    //获取
//     	    SeasLog::debug('session get');
    	    $f = $session->get($name);
    	    break;
    	case is_null($value):
            //删除
//             SeasLog::debug('session delete');
            $f = $session->del($name);
    	    break;
    	default :
    	    //设置
//     	    SeasLog::debug('session set');
    	    $f = $session->set($name, $value);
    	    break;
    }
    
    return $f;
}
/**
 * 对所有价格入库统一乘以100，转化成单位为分的格式
 * @param float $price
 * @return number
 */
function price_dispose($price){

    return intval(floatval($price)*100);
}
/**
 * 金额格式化方法
 * @param int $price 单位为分
 * @param number $decimals 取几位小数
 * @return string
 */
function price_format($price){
    $price = number_format(intval($price)/100,2);
    return $price;
}

/**
 * CURL发送请求
 * @param $url
 * @param string $data
 * @param string $method
 * @param string $cookieFile
 * @param array $headers
 * @param int $connectTimeout
 * @param int $readTimeout
 * @return mixed|string
 */
function curlRequest($url, $data = '', $method = 'POST', $cookieFile = '', $headers = array(), $connectTimeout = 30, $readTimeout = 30) {
    $headers = array_merge ( $headers, array (
            "Content-Type:application/json;charset=UTF-8" 
    ));
    
    $method = strtoupper ( $method );
    
    $option = array (
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CONNECTTIMEOUT => $connectTimeout,
            CURLOPT_TIMEOUT => $readTimeout 
    );
    
    if ($headers) {
        $option [CURLOPT_HTTPHEADER] = $headers;
    }
    
    if ($cookieFile) {
        $option [CURLOPT_COOKIEJAR] = $cookieFile;
        $option [CURLOPT_COOKIEFILE] = $cookieFile;
    }
    
    if ($data && $method == 'POST') {
        $option [CURLOPT_POST] = 1;
        $option [CURLOPT_POSTFIELDS] = $data;
    }
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
    curl_setopt_array ( $ch, $option );
    $response = curl_exec ( $ch );
    
    if (curl_errno ( $ch ) > 0) {
        return curl_error ( $ch );
    }
    curl_close ( $ch );
    return $response;
}

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author xuebing <406964108@qq.com>
 */
function time_format($time = NULL,$format='Y-m-d H:i:s'){
    $time = $time === NULL ? time() : intval($time);
    return date($format, $time);
}

/**
 * JSON转数组，始终返回一个数组
 * @param $json
 * @return array
 */
function json_to_array($json){
    if (!is_string($json)) {
        return array();
    }
    $value = json_decode($json,TRUE);
    return $value ? $value : array();
}

/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parse_name($name=null, $type=0) {
    if(empty($name)){
        return '';
    }
    if ($type) {
        return ucfirst(preg_replace_callback('/_([a-zA-Z])/', function($match){return strtoupper($match[1]);}, $name));
    } else {
        return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
    }
}

/**
 * 实例化一个没有模型文件的Model
 * @param string $name Model名称 支持指定基础模型 例如 User
 * @return Model
 */
function M($name = '')
{
    static $_model = array();
    $class = '\Model';
    $guid = $name . '_' . $class;
    if (!isset($_model[$guid])){
        $_model[$guid] = new $class($name);
    }
    return $_model[$guid];
}