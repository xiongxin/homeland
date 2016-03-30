<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/3/29
 * Time: 16:51
 */

namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class MyController extends AdminController {
    //我的注册信息
    public function reg() {
        //TODO:需要修改
        $prefix = C('DB_PREFIX');

        $uid = session('user_auth.uid');
        $company = M()->table($prefix.'company_reg');
        if (IS_POST) {
            $data = I('post.');
            unset($data['id']);
            $data['update_time'] = time_format();
            if (strlen($data['birthday']) == 0) unset($data['birthday']);
            if (strlen($data['founding_time']) == 0) unset($data['founding_time']);
            if( $company->create($data) && $company->where(array('uid'=>834))
                    ->save($data) !== false){
                $this->success('保存成功！');
            }
            $this->error('修改失败！');
        }

        $item = $company->where(['uid'=>834])->find();
        if (empty($company)){}
        $this->assign('item', $item);
        $this->meta_title = '我的注册信息';
        $this->display();
    }

    public function company() {
        //判断是否已经通过创建档案
        $prefix = C('DB_PREFIX');
        $uid = session('user_auth.uid');
        $company = M()->table($prefix.'company');
        if ($company->where(['uid'=>$uid])->find()) {
            $this->redirect('companyedit');
        } else {
            $this->redirect('companyadd');
        }
    }
    
    public function companyadd() {
        if (IS_POST) {
            $prefix = C('DB_PREFIX');
            $company = M()->table($prefix.'company');

            $data = I('post.');

            //处理没有填或是 0，'' ""
            foreach ($data as $key => $value) {
                if (empty($value)) unset($data[$key]);
            }

            //$data['registered_capital'] = (intval($data['registered_capital']));
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            $data['uid'] = session('user_auth.uid');

            if($company->create($data)) {
                if($company->add() > 0) {
                    $this->success('添加成功');
                } else {
                    $this->error('添加失败');
                }
            }
        }
        
        $this->meta_title = '我的注册信息';
        $this->display();
    }


    public function companyedit() {
        $prefix = C('DB_PREFIX');
        $uid = session('user_auth.uid');
        $company = M()->table($prefix.'company');
        if (IS_POST) {
            $data = I('post.');
            //处理没有填或是 0，'' ""
            foreach ($data as $key => $value) {
                if (empty($value)) unset($data[$key]);
            }
            $data['update_time'] = time_format();

            if($company->create($data)) {
                if($company->save() !== false) {
                    $this->success('添加成功');
                } else {
                    $this->error('添加失败');
                }
            }
        }

        $data = $company->where(['uid'=>$uid])->find();
        if (empty($data)) $this->error('参数错误!');

        $this->assign('item', $data);
        $this->meta_title = '我的注册信息';
        $this->display('companyadd');
    }


    public function courses() {
        $prefix = C('DB_PREFIX');

        $uid = session('user_auth.uid');
        $courses = M()->table($prefix.'user_courseware');
        $map['uid'] =$uid;
        $map['status'] = 'OK#';
        $list   = $this->lists($courses, $map,'','');

        $this->assign('_list', $list);
        $this->meta_title = '我的课程记录';
        $this->display();
    }

    public function courseShow() {
        $id = I('id');
        if(empty($id)) $this->error('参数错误');

        $this->meta_title = '课程详细';
        $this->display();
    }

    public function courseEdit(){
        $id = I('id');
        if(empty($id)) $this->error('参数错误');

        //$this->assign('item', $data);
        $this->meta_title = '编辑课程';
        $this->display();
    }

    public function courseAdd(){

        
        $this->meta_title = '编辑课程';
        $this->display('edit');
    }

}