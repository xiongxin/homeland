<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Think\Upload\Driver;
use Think\Controller;
/**
 * 行为控制器
 * @author huajie <banhuajie@163.com>
 */
class ShowController extends Controller {

    public function index(){
        $id = I('id');
        $model = M()->table( C('DB_PREFIX').'page p');
        $page   = $model->where('id=' .$id)->find();

        $this->assign('cont', $page['html']);
        $this->meta_title = '魔法页面列表';
        $this->display();
    }
}
