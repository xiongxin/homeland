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
class MagicController extends AdminController {

    public function index(){
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'page p');
        $list   = $this->lists($model, ['status'=>1],'','p.*');

        $this->assign('_list', $list);
        $this->meta_title = '魔法页面列表';
        $this->display();
    }

    public function add() {
        if (IS_POST) {
            $data = I('post.');
            //array(1) { ["wapeditor"]=> array(2) { ["params"]=> string(160) "[{"id":"header","name":"微页面标题","params":{"title":"微页面标题","description":"","thumb":"","bgColor":""},"issystem":1,"index":0,"displayorder":0}]" ["html"]=> string(62) "
            //" } }
            $json_arr = json_decode($data['wapeditor']['params']);
            $html = $data['wapeditor']['html'];
            $data['title'] = $json_arr[0]->params->title;
            $data['html'] = $html;
            $data['params'] = $data['wapeditor']['params'];
            $prefix = C('DB_PREFIX');
            $return = M()->table($prefix.'page');
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            if ($return->data($data)) {
                $result = $return->add();
                if ($result > 0) {
                    $this->success('创建成功！',U('Magic/index'));
                } else {
                    $this->error('创建失败！');
                }
            } else {
                $this->error('创建失败！');
            }
        }

        $this->meta_title = '添加魔法页面';

        $this->display();
    }

    public function edit() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误');

        if (IS_POST) {
            $page =M()->table(C('DB_PREFIX').'page');
            $data = I('post.');
            $json_arr = json_decode($data['wapeditor']['params']);
            $html = $data['wapeditor']['html'];
            $data['title'] = $json_arr[0]->params->title;
            $data['html'] = $html;
            $data['params'] = $data['wapeditor']['params'];
            $data['update_time'] = time_format();
            if($page->create($data) && $page->where(array('id'=>$id))
                ->save()){
                $this->success('保存成功！',U('Magic/index'));
            } else {
                $this->error('修改失败！');
            }
        }
        $model = M()->table(C('DB_PREFIX').'page');
        $data = $model->where(['id'=>$id])->find();
        if (empty($data)) {
            $this->error('数据不存在!');
        }
        $this->assign('item',$data);
        $this->meta_title = '编辑魔法页面';
        $this->display('add');
    }

    public function del(){
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $model = M()->table(C('DB_PREFIX').'page');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>-1]);
        if($result !== false){
            $this->success('修改成功！',U('index'));
        }else{
            $this->error('修改失败！');
        }
    }

    public function upload() {
        //var_dump($_FILES['file']);["name"]=> string(16) "我的订单.png" ["type"]=> string(9) "image/png" ["tmp_name"]=> string(14) "/tmp/phpiVter5" ["error"]=> int(0) ["size"]=> int(442283)
        if (empty($_FILES['file']['name'])) {
            $this->error('上传失败, 请选择要上传的文件！');
        }
        if ($_FILES['file']['error'] != 0) {
            $this->error('上传失败, 请重试.');
        }
        $url = $_FILES['file']['tmp_name'];
        $config = array(
            'secrectKey'     => 'yetfBK45sGhRSJgYbDCKkCY4sNAhnd8cGPNLR0_V', //七牛服务器
            'accessKey'      => 'xNgZC-3TPDcYJv8gnRNDKsa9pKQbohKEdReyIK79', //七牛用户
            'domain'         => '7xn7ez.com1.z0.glb.clouddn.com', //七牛密码
            'bucket'         => 'homeland', //空间名称
            'timeout'        => 300, //超时时间
        );
        $qiniu = new Driver\Qiniu($config);
        if ($qiniu->save($url) === false ) {
            $this->error('保存图片到服务器失败,请重新尝试！');
        } else {
            $info = array(
                'name' => $_FILES['file']['name'],
                'ext' => strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),
                'filename' => $_FILES['file']['name'],
                'attachment' =>  $_FILES['file']['name'],
                'url' => $url,
                'is_image' => 1,
                'filesize' => filesize($_FILES['file']['name']),
            );
            $this->ajaxReturn($info);
        }
    }

    // 请选择链接中的系统菜单接口
    public function link() {
        
        $this->assign('callback', I('callback'));
        $this->display();
    }

    // 请选择链接中的微页面链接接口
    public function pagelist() {

        $this->assign('callback', I('callback'));
        $this->display();
    }
}
