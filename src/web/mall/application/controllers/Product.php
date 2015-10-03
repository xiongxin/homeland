<?php
class ProductController extends MallController
{
    public function init(){
        parent::init();
        $this->getView()->assign("product_id",intval($this->getRequest()->get('goods_id')));
    }

    public function listAction($type=0){

        if(empty($type)){
            $this->error('类型名称不能为空！');
        }
        //读取缓存
        $cache_name = ROOT_PATH.'/runtime/cache/'.md5($this->getMCA().$type).'.php';
        if(file_exists($cache_name)){
            $this->getResponse()->setBody(file_get_contents($cache_name));
            return false;
        }

        $curl = new Curl();
        $products = array();

        $resp = $curl->setData(['module_id'=>$type])->send('mall/product/getModuleProducts');
        if(!empty($resp) && $resp['errcode'] == 0){
            $products = $resp['list'];
        }

        $this->getView()->assign('products',$products);

        //生成缓存文件
        file_put_contents($cache_name,$this->render($this->getAction()));
    }

    public function detailAction($goods_id=0){

        if(empty($goods_id)){
            $this->error("商品ID不能为空");
        }
        //读取缓存
        $cache_name = ROOT_PATH.'/runtime/cache/'.md5($this->getMCA().$goods_id).'.php';
        if(file_exists($cache_name)){
            $this->getResponse()->setBody(file_get_contents($cache_name));
            return false;
        }

        $curl = new Curl();
        $resp = $curl->setData(array('id'=>$goods_id))->send('mall/product/getDetail');
        
        $item = array();
        if(!empty($resp) && $resp['errcode'] == 0){
            $item = $resp['info'];
        }else{
            $this->error('商品不存在，或已经下架！');
        }
        $this->layout->title = $item['title'];
        $this->layout->keywords = $item['meta_keyword'];
        $this->layout->description = $item['meta_description'];

        $this->getView()->assign('item',$item);
        //生成缓存文件
        file_put_contents($cache_name,$this->render($this->getAction()));
    }
    
    public function commentAction($goods_id=0){
        if(empty($goods_id)){
            $this->error('商品ID不能为空!');
        }

        $cur_page = intval($this->getRequest()->getQuery('page',1));

        $pagenum = $this->config->application->pagenum;
        $curl = new Curl();
        $resp = $curl->setData(['id'=>$goods_id,'pagenum'=>$pagenum,'page'=>$cur_page])
                    ->send('mall/product/getComments');

        $list = [];
        $total = 0;
        if(!empty($resp) && $resp['errcode'] == 0){
            $list = $resp['list'];
            $total = $resp['total'];
        }

        if(empty($list)){
            $this->error('没有更多评论了!');
        }

        $return = ['status'=>1,'current_page'=>$cur_page,'page'=>$total,'data'=>'<li>'];

        $rate_text = [1=>'好评',0=>'中评',-1=>'差评'];
        foreach($list as $item){
            $return['data'] .= '<div class="app-user">
                                    <span class="user">'.$item['nickname'].'</span>
                                    <span class="date">'.$item['create_time'].'</span>
                                </div>
                                <div class="app-cnt">'.(empty($item['content']) ? $rate_text[$item['rate']] : $item['content']).'</div>
                                <div class="app-sku">
                                </div>';
        }
        $return['data'] .= '</li>';

        $this->ajaxReturn($return);
    }
    
}
