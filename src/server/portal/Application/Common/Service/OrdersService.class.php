<?php 
namespace Common\Service;

use Think\Model;

class OrdersService extends Model {

    /**
     * 已删除
     * @var int
     */
    const STATUS_DELETED    = 'DEL';

    /**
     * 已取消
     * @var int
     */
    const STATUS_CANCELLED  = 'YQX';

    /**
     * 待付款
     * @var unknown
     */
    const STATUS_WATI_PAY   = 'CRT';

    /**
     * 待付款
     * @var unknown
     */
    const STATUS_WATI_ACTIVE   = 'DJH';


    /**
     * 已完成
     * @var int
     */
    const STATUS_COMPLETED  = 'OK#';

    /**
     * 未付款
     * @var int
     */
    const PAY_STATUS_NO_PAY = 1;

    /**
     * 已付款
     * @var int
     */
    const PAY_STATUS_PAYD   = 2;

    public static $status_text = array(
        'YQX'=>'已关闭',
        'CRT'=>'等待付款',
        'DJH'=>'待激活',
        'OK#'=>'已完成',
        'DEL'=>'已删除',
    );

    public static $pay_status_text = array(
            '',
            '未付款',
            '已付款',
    );

    private function withOf($where=array()){
    
        $fix   = C("DB_PREFIX");
        return M()->table($fix.'orders o')
        ->join("{$fix}order_address a ON o.sn = a.sn",'LEFT')
        ->where($where);
    }
    
    /**
     * 获取订单详情
     * @param string $id
     * @return boolean|unknown
     */
    public function detail($where){
    
        if(!$where){
            return false;
        }

        $prefix     = C('DB_PREFIX');
        $item = $this->withOf($where)->join($prefix.'wx_user m on m.userid = o.userid','LEFT')->field('o.*,a.consignee,a.mobile,a.idnum,m.nickname')->find();
        if(empty($item)){
            return false;
        }
        return $item;
    }
}
