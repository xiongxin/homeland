<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class IndexController extends MallController {

    public function init(){

        parent::init();
        //$this->layout->setLayoutFile('v1_layout.php');
    }

    public function scanSignAction(){
        if(!M('t_user_company')->get('id',['unionid'=>$this->user['unionid']])){
            $this->error('对不起，您还没有绑定企业！');
        }
        $f = M('t_sign')->insert(['unionid'=>$this->user['unionid'],'insert_time'=>time_format()]);

        if($f){
            $this->success('签到成功！','/');
        }else{
            $this->error('签到失败，请重新再试！','/');
        }
    }

    /** 
    * 默认动作，首页
    * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
    * 对于如下的例子, 当访问http://yourhost/y/index/index/index/name/yantze 的时候, 你就会发现不同
    */
    public function indexAction(){

        //读取缓存
        $cache_name = ROOT_PATH.'/runtime/cache/'.md5($this->getMCA()).'.php';
        if(!$this->config->application->debug && file_exists($cache_name)){
            $this->getResponse()->setBody(file_get_contents($cache_name));
            return false;
        }

        $banners = [];
        foreach(M('t_banner')->select('*',['AND'=>['status'=>1]]) as $item){
            $banners[$item['type']][] = $item;
        }

        $this->getView()->assign('banners',$banners);

        $cate_list = M('t_category')->select(
                                                ['[><]t_picture(p)'=>['icon'=>'id']],
                                                ['t_category.id','name','pid','title','groups(link)','p.url(pic_url)'],
                                                ['AND'=>['pid'=>[39,46],'display[!]'=>0],'ORDER'=>'sort']
                                            );

        $this->getView()->assign('cate_list',$cate_list);
        //生成缓存文件
        file_put_contents($cache_name,$this->render($this->getAction()));
    }

    public function homeMapAction(){
        $pro_codes = [
            '北京市'=>'BJ',
            '广西壮族自治区'=>'GX',
            '海南省'=>'HA',
            '重庆市'=>'CQ',
            '四川省'=>'SC',
            '贵州省'=>'GZ',
            '云南省'=>'YN',
            '西藏自治区'=>'XZ',
            '陕西省'=>'SA',
            '甘肃省'=>'GS',
            '青海省'=>'QH',
            '宁夏回族自治区'=>'NX',
            '新疆维吾尔自治区'=>'XJ',
            '台湾省'=>'TW',
            '香港特别行政区'=>'HK',
            '澳门特别行政区'=>'3681',
            '广东省'=>'GD',
            '湖南省'=>'HN',
            '天津市'=>'TJ',
            '河北省'=>'HB',
            '山西省'=>'SX',
            '内蒙古自治区'=>'NM',
            '辽宁省'=>'LN',
            '吉林省'=>'JL',
            '黑龙江省'=>'HL',
            '上海市'=>'SH',
            '江苏省'=>'JS',
            '浙江省'=>'ZJ',
            '安徽省'=>'AH',
            '福建省'=>'FJ',
            '江西省'=>'JX',
            '山东省'=>'SD',
            '河南省'=>'HE',
            '湖北省'=>'HB',
        ];
        $counts = M()->query('SELECT COUNT(id) as count,province FROM t_company GROUP BY province')->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        foreach($counts as $item){
            $tmp = [
                'code'=>$pro_codes[$item['province']],
                'value'=>$item['count']
            ];
            $data[] = $tmp;
        }
        $this->getView()->assign('data',json_encode($data));
    }

    function signAction(){

    }

}
