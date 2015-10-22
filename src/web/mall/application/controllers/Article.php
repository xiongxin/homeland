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

        $cur_page = intval($this->getRequest()->getQuery('page',1));

        $pagenum = $this->config->application->pagenum;

        $limit      = ($cur_page-1)*$pagenum;


        $cate_id = intval($cate_id);
        $this->getView()->assign('cate_name',M('t_category')->get('title',['id'=>$cate_id]));
        $model = new Model('t_document');

        $total = $model->count(
                                ['[><]t_picture(p)'=>['cover_id'=>'id']],
                                '*',
                                [
                                    'AND'=>['category_id'=>$cate_id,'t_document.status'=>1]
                                ]
                            );

        $list = $model->select(
                                ['[><]t_picture(p)'=>['cover_id'=>'id']],
                                ['t_document.id','title','description','t_document.update_time','p.url(pic_url)'],
                                [
                                    'AND'=>['category_id'=>$cate_id,'t_document.status'=>1],
                                    'LIMIT'=>[$limit,$pagenum]
                                ]
                            );

        $page = new Page(intval($total),$pagenum,$_REQUEST);

        $this->getView()->assign('list',$list);
        $this->getView()->assign('page',$page->show());
        $this->getView()->assign('total',$total);
    }
}
