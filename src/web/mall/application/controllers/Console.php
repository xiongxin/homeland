<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 * php cli.php "request_uri=/console/method"
*/
class ConsoleController extends Yaf\Controller_Abstract  {

    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
    }

    private function delete_files($path, $del_dir = FALSE, $level = 0){
        // Trim the trailing slash
        $path = rtrim($path, DIRECTORY_SEPARATOR);

        if ( ! $current_dir = @opendir($path))
        {
            return FALSE;
        }

        while (FALSE !== ($filename = @readdir($current_dir)))
        {
            if ($filename != "." and $filename != "..")
            {
                if (is_dir($path.DIRECTORY_SEPARATOR.$filename))
                {
                    // Ignore empty folders
                    if (substr($filename, 0, 1) != '.')
                    {
                        $this->delete_files($path.DIRECTORY_SEPARATOR.$filename, $del_dir, $level + 1);
                    }
                }
                else
                {
                    unlink($path.DIRECTORY_SEPARATOR.$filename);
                }
            }
        }
        @closedir($current_dir);

        if ($del_dir == TRUE AND $level > 0)
        {
            return @rmdir($path);
        }

        return TRUE;
    }

    public function cleanCacheAction(){

        if($this->delete_files(ROOT_PATH.'/runtime/cache')){
            echo json_encode(['errcode'=>0,'errmsg'=>'清除缓存成功!']);
        }else{
            echo json_encode(['errcode'=>1,'errmsg'=>'清除缓存失败!']);
        }
    }

    public function ordersSyncAction(){

        $query = M()->query("SELECT
                                    t_orders.sn,
                                    oa.consignee,
                                    oa.idnum,
                                    oa.mobile,
                                    t_orders.amount,
                                    t_orders.count_num,
                                    t_orders.pay_time
                                FROM
                                    t_orders
                                INNER JOIN t_order_product AS op ON t_orders.sn = op.sn
                                INNER JOIN t_order_address AS oa ON t_orders.sn = oa.sn
                                INNER JOIN t_product AS t ON op.product_id = t.id
                                WHERE
                                    t_orders.pay_status = ".OrderModel::PAY_STATUS_PAYD."
                                AND t_orders.status = '".OrderModel::STATUS_COMPLETED."'
                                AND t.category_id = 32
                                AND TO_DAYS(NOW()) - TO_DAYS(t_orders.update_time) = 1"
                            );
        $orders = $query ? $query->fetchAll(PDO::FETCH_ASSOC) : false;

//        var_dump(M()->last_query());
//        var_dump($orders);
        if(empty($orders) || !is_array($orders)){
            SeasLog::info(date('Ymd',strtotime('-1 day')).'没有激活的翼汇通订单!');
            return false;
        }

        $file_content = '';
        foreach($orders as $item){
            $item['amount'] = intval($item['amount']) /100;
            $item[] = 'MQHD';
            $item[] = 0;
            $file_content .= implode('|',$item)."\n";
        }

        $save_path = ROOT_PATH.'/sync_order/';
        $file_name = 'MQHD'.date('Ymd',strtotime('-1 day')).'.txt';
        file_put_contents($save_path.$file_name,$file_content);

        $config = new Yaf\Config\Ini(CONF_PATH.'ftp.ini');
        $ftp = new Ftp($config->toArray());

        $file = ['savepath'=>'','savename'=>$file_name,'tmp_name'=>$save_path.$file_name];
        if($ftp->save($file)){

            SeasLog::info('订单同步成功!');
        }else{
            SeasLog::error('订单同步失败,原因:'.$ftp->getError());
        }
    }
}
