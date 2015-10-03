<?php
namespace Payment;

abstract class AbstractPayment
{
	/**
	 * 收款账号的加密key
	 * @var string
	 * 
	 */
    CONST MERKEY_SALT_POSTFIX = '7f3hb0r95wZUokMJ7xxa%^IN[TH8~T%WkI2HdrR@k=IQJ1NdyzeWtiKmo-a.C5P=';
    
    /**
     * 订单
     * @var array
     */
    public $order;

    /**
     * 支付成功
     * @var boolean
     */
    var $payok = false;

    /**
     * 第三方支付单号
     * @var string
     */
    var $trade_no;
    
    /**
     * 支付网关返回的成功支付金额
     * @var float
     */
    var $pay_amount;
    
    /**
     * 收款账号
     * @var object
     */
    var $account = null;
    
    function __construct($payment)
    {	
    	$this->account = $payment;
    	$this->_initialize();
    }
    
    /**
     * 子类实现的构造方法
     */
    protected function _initialize(){}

    /**
     * 子类根据具体的支付接口实现支付后续动作
     * @param bool $isNotify
     * @return string  返回输出的信息, 用于日志记录(可选).
     */
    abstract protected function _doCustomerAfterPay($isNotify=false);


    public static function getEncodeMerKey($merId,$merKey)
    {
    	$salt = $merId.self::MERKEY_SALT_POSTFIX;
    	return md5(md5($merKey).$salt);
    }

	/**
	 * 
	 * @param array $order
	 * @return AbstractPayment
	 */
    function setOrder($order=array())
    {
        $this->order = $order;
        return $this;
    }
    
    /**
     * 获取表单
     * @return Form
     */
    function beforePay(){}
    
    /**
     * 进行支付
     * 包括申请token 等前置动作
     */
    function doPay(){}
    
    /**
     * @param bool $isNotify
     * @return bool
     * 完成支付后续动作
     */
    function afterPay($isNotify=false){
    	$success = false;

        //微信支付测试
//        $GLOBALS['HTTP_RAW_POST_DATA'] = <<<xml
//<xml><appid><![CDATA[wxb88f2adbf549aa75]]></appid>
//<bank_type><![CDATA[CMB_CREDIT]]></bank_type>
//<cash_fee><![CDATA[10]]></cash_fee>
//<fee_type><![CDATA[CNY]]></fee_type>
//<is_subscribe><![CDATA[Y]]></is_subscribe>
//<mch_id><![CDATA[1248246601]]></mch_id>
//<nonce_str><![CDATA[uewpvlmfmt2f4szbllply7qh596fksps]]></nonce_str>
//<openid><![CDATA[oITR0uAkXSsTgY2YaU2ItDN2kh7g]]></openid>
//<out_trade_no><![CDATA[SD001506221029748557]]></out_trade_no>
//<result_code><![CDATA[SUCCESS]]></result_code>
//<return_code><![CDATA[SUCCESS]]></return_code>
//<sign><![CDATA[9D852EB3543C656FCEA206A497A9A6FB]]></sign>
//<time_end><![CDATA[20150623115746]]></time_end>
//<total_fee>10</total_fee>
//<trade_type><![CDATA[JSAPI]]></trade_type>
//<transaction_id><![CDATA[1006270750201506220287095066]]></transaction_id>
//</xml>
//xml;

    	//记录请求日志
        if(isset($GLOBALS['HTTP_RAW_POST_DATA'])){

            \SeasLog::debug('notify: '.$GLOBALS['HTTP_RAW_POST_DATA']);
        }else{

            \SeasLog::debug(($isNotify ? 'notify2: ' : 'return: ').var_export($_REQUEST,true));
        }

        if(!$this->checkAccount()){
		    \SeasLog::debug('非法收款账号！');
		    return $success;
    	}

		$verify_result = $this->_doCustomerAfterPay($isNotify);
		$model = M('t_orders');

		if($verify_result && isset($this->order['sn'])){

    		$where['sn'] 	    = $this->order['sn'];
    		$where['amount'] 	= $this->pay_amount;
    		//数据库查找对应的订单
    		$this->order 		= $model->get('*',['AND'=>$where]);

    		if($this->order && $this->order['status'] == \OrderModel::STATUS_WATI_PAY && $this->order['pay_status'] == \OrderModel::PAY_STATUS_NO_PAY){
    		    //记录订单支付日志
    		    $this->addPayLog();

    		    if($this->payok) {
    		        \SeasLog::debug('付款成功'.var_export($this->order,TRUE));

                    $wx_user_model = new \Model('t_wx_user');
    		        $user 	= $wx_user_model->get('*',['userid'=>$this->order['userid']]);
                    $success = $this->runOrderHook($user);
    		    }

    		}elseif($this->order && $this->order['status'] == \OrderModel::STATUS_COMPLETED && $this->order['pay_status'] == \OrderModel::PAY_STATUS_PAYD){
    		    //如果已经完成了付款的订单直接返回true.
    		    $success = true;
    		}else{
    		    \SeasLog::debug('没有找到订单!'.$model->last_query());
    		}
		}

        if(!$success){

            \SeasLog::debug('付款失败,订单信息：'.var_export($this->order,TRUE));
        }
		//如果找到了对应的订单,并且订单状态为未完成  支付状态为未付款

    	return $success;
    }

    /**
     * @param $user
     * @return bool
     * 支付成功后调用订单钩子进行后续处理
     */
    protected function runOrderHook($user)
    {	
    	if(empty($this->order) || empty($user)) {
            return false;
        }
        $data['pay_time'] 	= time_format();
        $data['trade_no'] 	= $this->trade_no;
        $data['pay_code'] 	= $this->account['code'];
        $data['status'] 	= \OrderModel::STATUS_WATI_ACTIVE;
        $data['pay_status'] = \OrderModel::PAY_STATUS_PAYD;
        $data['update_time']= time_format();

        $item = M('t_order_product')->get(
            ['[><]t_product(p)'=>['product_id'=>'id']],
            [
                'p.id',
                'p.category_id',
                'p.earning',
            ],
            ['sn'=>$this->order['sn']]
        );

        //30类型为加盟商品
        if(!empty($item) && intval($item['category_id']) == 30) {
            //直接设置订单为完成状态
            $data['status'] 	= \OrderModel::STATUS_COMPLETED;
        }

        //更新订单状态
        M('t_orders')->update($data,['AND'=>['sn'=>$this->order['sn'],'userid'=>$user['userid']]]);

        \SeasLog::debug('更新订单完成,开始分佣金'.M()->last_query());

        $curl = new \Curl();

        $config = \Yaf\Registry::get('config');
        $resp = $curl->setData(['distributionUserId'=>$user['unionid']])
            ->setApiUrl($config->url->api->sdp)
            ->send('distribution/isShopkeeper');

        if(empty($resp) || !$resp['shopkeeper']){
            //如果不是微商,调用升级微商接口
            $curl->setData(['distributionUserId'=>$user['unionid'],'franchiseFee'=>"1000"])
                ->setApiUrl($config->url->api->sdp)
                ->send('distribution/upgradeToShopkeeper');

            $content = "尊敬的{$user['nickname']}，恭喜您升级成天天加油大掌柜!";
            $msg = [
                'touser'=>$user['openid'],
                'template_id'=>'CfPYzAqZy34LaK7KHMlrbd1Lzoo_u2-pEEKhiwDRN3w',
                'url'=>'http://ttjy.mi360.me/member/index/shop.html',
                'topcolor'=>'',
                'data'=>[
                    'first'=>['value'=>$content."\n",'color'=>'#333333'],
                    'keyword1'=>['value'=>$user['userid'],'color'=>'#333333'],
                    'keyword2'=>['value'=>'永久有效','color'=>'#333333'],
                    'remark'=>['value'=>"\n成为大掌柜后，您就可以邀请您的朋友赚取佣金了！",'color'=>'#333333'],
                ],
            ];

            //发送模板消息通知用户
            $wechat = new \Wechat($config->wechat->toArray());
            $wechat->sendTemplateMessage($msg);

            if(empty($item)){
                \SeasLog::debug('获取商品详情失败,分配佣金失败!');
                return false;
            }
            //把佣金扣1元加盟费，单位厘
            $item['earning'] -= 1000;
        }

        if(intval($item['category_id']) == 30){
            \SeasLog::debug('所购买的商品为加盟商品,无需进行佣金分配');
            return false;
        }

        if(intval($item['earning']) < 0){
            //如果佣金小于0,直接返回
            \SeasLog::debug('所购买的商品佣金小于0,无需进行佣金分配');
            return false;
        }

        $curl->setData2(
                        ['assign'=>
                            [
                                'recordId'=>$this->order['sn'],
                                'distributionUserId'=>$user['unionid'],
                                'earning'=>$item['earning'],
                            ]
                        ]
                        )
            ->setApiUrl($config->url->api->sdp)
            ->send('distribution/assignEarning');

    	return true;
    }
    
    /**
     * 写订单付款日志
     * @return bool
     */
    protected function addPayLog()
    {
        $data['sn']	        = $this->order['sn'];
        $data['create_time']= time_format();
        $data['comment']    = time_format()."  使用 {$this->account['code']} 对" . $this->order['sn'] . "订单支付成功,支付金额".price_format($this->pay_amount).'元';
        $data['userid']     = is_login();
        $model = new \Model('t_order_logs');
        return $model->insert($data);
    }
    
    protected function checkAccount()
    {
//     	echo self::getEncodeMerKey($this->account['mer_id'], $this->account['mer_key']);die;
        return self::getEncodeMerKey($this->account['mer_id'], $this->account['mer_key']) == $this->account['mer_key_encode'];
    }
}
