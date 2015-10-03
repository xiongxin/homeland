<?php
class Zsign
{
	private $_appKey;
	private $_host;
	private $_port;
	private $_appNo;
	private $_ver;


	function __construct($config){
		$this->_host    = $config['host'];
		$this->_port    = $config['port'];
		$this->_ver     = $config['ver'];
		$this->_appNo   = $config['appNo'];
		$this->_appKey  = $config['appKey'];
	}
	/*
	*自动拼接服务器的url
	*/
	private function getUrl($service,$msg){
		$sign   = $this->mkSign($msg);
		$str    = "http://{$this->_host}:{$this->_port}/zjhtplatform/{$service}/{$this->_ver}/";
		$str    .= "?appNo={$this->_appNo}&msg=".urlencode($msg)."&sign=".urlencode($sign);
		return $str;
	}

	/*
	*对要发送的内容进行签名
	*/
	function mkSign($msg){
		$str    = $this->_appKey.$msg.$this->_appKey;
		//echo  base64_encode(sha1($str,true));
		return base64_encode(sha1($str,true));
	}

	/*
	*发送请求并将回送结果进行json解码
	*/
	public function send(array $msg){
        $curl = new Curl();
        $data = $curl->setApiUrl($this->getUrl($msg['service'],json_encode($msg)))
                    ->setData3(new stdClass())//这一步不能去
                    ->send();
		return $data;
	}
}
