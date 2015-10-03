<?php
namespace Payment\Alipay;
use Payment\AbstractPayment;

/**
 * 支付方式 - 支付宝
 * 默认即时到账接口
 * @author xuebingwang2010@gmail.com
 *
 */
class Alipay extends AbstractPayment
{
	//页面跳转同步通知页面路径
    const URL_REMOTE_RETURN = '/payment/alipay/type/return.html';
	//服务器异步通知页面路径
    const URL_REMOTE_NOTIFY = '/payment/alipay/type/notify.html';
    
    var $config = array();
    
    //交易状态
    var $trade_status = null;
    
    public function _initialize(){
    	
    	$this->config['partner']		= $this->account['mer_id'];
    	
    	//安全检验码，以数字和字母组成的32位字符
    	$this->config['key']			= $this->account['mer_key'];
    	   	
    	//签名方式 不需修改
    	$this->config['sign_type']    	= strtoupper('MD5');
    	
    	//字符编码格式 目前支持 gbk 或 utf-8
    	$this->config['input_charset']	= strtolower('utf-8');
    	
    	//ca证书路径地址，用于curl中ssl校验
    	//请保证cacert.pem文件在当前文件夹目录中
    	$this->config['cacert']    		= __DIR__.'/cacert.pem';
    	
    	//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    	$this->config['transport']    	= 'http';
    }
    
    /**
     * 支付前完成基本支付信息表单
     * @return multitype:boolean unknown
     */
    public function beforePay()
    {
        require_once(__DIR__.'/alipay_submit.class.php');
		$alipaySubmit = new \AlipaySubmit($this->config);
		/**************************请求参数**************************/
		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" 		=> "create_direct_pay_by_user",
				"partner" 		=> trim($this->account['mer_id']),
				"payment_type"	=> 1,
				"notify_url"	=> 'http://'.$_SERVER['HTTP_HOST'].self::URL_REMOTE_NOTIFY,
				"return_url"	=> 'http://'.$_SERVER['HTTP_HOST'].self::URL_REMOTE_RETURN,
				"seller_email"	=> $this->account['mer_account'],
				"out_trade_no"	=> $this->order['sn'],
				"subject"		=> $this->order['desc'],
				"total_fee"		=> $this->order['amount']/100,
				"body"			=> '',
				"show_url"		=> 'http://'.$_SERVER['HTTP_HOST'].$this->order['show_url'],
				"anti_phishing_key"	=> '',
				"exter_invoke_ip"	=> '',
				"_input_charset"	=> 'utf-8'
		);
		
		$formHtml = $alipaySubmit->buildRequestForm($parameter,"post");
        return $formHtml;
    }
    
	/**
	 * 进行支付跳转到第三方支付网关
	 * (non-PHPdoc)
	 * @see AbstractPayment::doPay()
	 */
    public function doPay()
    {
        if(!$this->checkAccount()){
            throw new \Exception('非法收款账号！');
        }
        $doPayForm = $this->beforePay();
        
        return $doPayForm;
    }
    
    /**
     * 支付成功后续处理，如订单处理
     * @param $isNotify  是否后台付款通知
     */
    protected function _doCustomerAfterPay($isNotify=false)
    {
        include(__DIR__.'/alipay_notify.class.php');
        
        if($isNotify){
        	$returnMessage = $this->notify_callback();
        }else{
        	$returnMessage = $this->return_callback();
        }
        return $returnMessage;
    }
    
    protected function notify_callback(){
    	//计算得出通知验证结果
    	$alipayNotify = new \AlipayNotify($this->config);
    	$verify_result = $alipayNotify->verifyNotify();
    	
    	if($verify_result) {//验证成功
    		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    		//请在这里加上商户的业务逻辑程序代
    	
    	
    		//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    	
    		//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
    	
    		//交易状态
    		$this->trade_status = $_POST['trade_status'];
    	


    		$this->order['sn'] = $_POST['out_trade_no'];
    		
    		$this->trade_no 		 = $_POST['trade_no'];
    		 
    		$this->pay_amount 		 = intval($_POST['total_fee'] * 100);
    		
    		$this->payok 			 = $verify_result;
    		
    	
    		if($_POST['trade_status'] == 'TRADE_FINISHED') {
    			//判断该笔订单是否在商户网站中已经做过处理
    			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
    			//如果有做过处理，不执行商户的业务程序
    	
    			//注意：
    			//该种交易状态只在两种情况下出现
    			//1、开通了普通即时到账，买家付款成功后。
    			//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。
    	
    			//调试用，写文本函数记录程序运行情况是否正常
    			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    		}
    		else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
    			//判断该笔订单是否在商户网站中已经做过处理
    			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
    			//如果有做过处理，不执行商户的业务程序
    	
    			//注意：
    			//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
    	
    			//调试用，写文本函数记录程序运行情况是否正常
    			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    		}
    	
    		//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
    	
    		echo "success";		//请不要修改或删除

            \SeasLog::debug('success');
    		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	}
    	else {
    		//验证失败
    		echo "fail";

            \SeasLog::error('fail');
    		//调试用，写文本函数记录程序运行情况是否正常
    		//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    	}
    	
    	return $verify_result;
    }
    /**
     * 
     * @return Ambigous <boolean, 验证结果>
     */
    protected function return_callback(){
    	//计算得出通知验证结果
    	$alipayNotify = new \AlipayNotify($this->config);
    	$verify_result = $alipayNotify->verifyReturn();
    	if($verify_result) {//验证成功
    		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    		//请在这里加上商户的业务逻辑程序代码
    	
    		//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    		//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
    	
    		//交易状态
    		$this->trade_status = $_GET['trade_status'];
    		
    		//商户订单号
    		$this->order['sn'] = $_GET['out_trade_no'];
    	
    		$this->trade_no 		 = $_GET['trade_no'];
    		
			$this->pay_amount 		 =intval($_GET['total_fee'] * 100);
			
    		$verify_result 			 = true;

    		$this->payok 			 = $verify_result;
    		
    		if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
    			//判断该笔订单是否在商户网站中已经做过处理
    			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
    			//如果有做过处理，不执行商户的业务程序
    			
    		}
    	
    		//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
    	
    		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	}
    	return $verify_result;
    }
    
}
?>
