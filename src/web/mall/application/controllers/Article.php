<?php
/**
 * @name ArticleController
 * @author xuebingwang
 * @desc 文章控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class ArticleController extends MallController {

    public function infoAction($id=0){

        $model = new Model('t_document_article');
        $item = $model->get(['[><]t_document'=>['id'=>'id']],['t_document.title','t_document_article.content'],['t_document.id'=>$id]);
        $this->getView()->assign('item',$item);
        $this->getView()->assign('current_menu','brand');
    }

    public function listAction($cate_id=0){

        $cate_id = intval($cate_id);
        $this->getView()->assign('cate_name',M('t_category')->get('title',['id'=>$cate_id]));
        $model = new Model('t_document');
        $list = $model->select(
                                ['[><]t_picture(p)'=>['cover_id'=>'id']],
                                ['t_document.id','title','description','t_document.update_time','p.url(pic_url)'],
                                ['category_id'=>$cate_id]
                            );

        $this->getView()->assign('list',$list);
    }
}
