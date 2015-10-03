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

    function signAction(){

    }
}
