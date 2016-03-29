<?php

namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class MeetingController extends AdminController {
    public function index(){
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'meeting m');
        $list   = $this->lists($model, ['status'=>1],'','m.*');

        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    public function add() {
        if (IS_POST) {
            $data = I('post.');
            unset($data['parse']);
            $prefix = C('DB_PREFIX');
            $return = M()->table($prefix.'meeting');
            $data['insert_time'] = date("Y-m-d H:m:s", time());
            $data['update_time'] = date("Y-m-d H:m:s", time());
            if ($return->create()) {
                $result = $return->add();
                if ($result > 0) {
                    $this->success('创建成功！',U('Meeting/index'));
                } else {
                    $this->error('创建失败！');
                }
            } else {
                $this->error('创建失败！');
            }
        }

        $this->meta_title = '添加会议';
        $this->display('edit');
    }

    public function edit() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误');

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'meeting m');

        if (IS_POST) {
            $data = I('post.');
            unset($data['parse']);
            $data['update_time'] = date("Y-m-d H:m:s", time());
            if(!$model->where(array('id'=>$id))
                ->save($data)){
                $this->error('修改失败！');
            }

            $this->success('保存成功！',U('Meeting/index'));
        }


        $data = $model->field(array('m.*'))
            ->where(['id'=>$id])->find();
        if (empty($data)) {
            $this->error('该回访不存在!');
        }
        $this->assign('item',$data);
        $this->meta_title = '会员回访详细信息';
        $this->display();
    }

    public function meetingDelete(){
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'meeting');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>-1]);
        if($result !== false){
            $this->success('修改成功！',U('index'));
        }else{
            $this->error('修改失败！');
        }
    }

    //查看所有报名表
    public function enroll() {
        $search       =   I('search');
        //$map['um.status']  =   array('egt',0);
        $map['n.status'] = ['egt', 0];
        if(is_numeric($search)){
            $map['n.mobile']=['like', '%' . intval($search) . '%'];//   array(intval($search),array('like','%'.$search.'%'),'_multi'=>true);
        }elseif(!empty($search)){
            $map['n.name']  = array('like', '%'.(string)$search.'%');
        }

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'enroll n')
            ->join($prefix.'meeting m on n.meeting_id=m.id', 'left');
        $list  = $this->lists($model, $map,'','n.*, m.title, m.id as m_id');

        $this->assign('_list', $list);
        $this->meta_title = '报名管理';
        $this->display();
    }

    public function changeAffirm($method, $id) {
        if (IS_AJAX) {
            $status = [
                'affirm' => 'YES',
                'no_affirm' => 'NO#'
            ];
            if (empty($method) || empty($status[$method]) || empty($id)) $this->error('修改失败！');

            $prefix = C('DB_PREFIX');
            $model = M()->table($prefix.'enroll');
            $result = $model->where('id =' . $id)->setField('is_affirm', $status[$method]);

            if($result !== false){
                $this->success('修改成功！');
            }else{
                $this->error('修改失败！');
            }
        }
    }

    public function changeSign($method, $id) {
        if (IS_AJAX) {
            $status = [
                'sign' => 'YES',
                'no_sign' => 'NO#'
            ];
            if (empty($method) || empty($status[$method]) || empty($id)) $this->error('修改失败！');

            $prefix = C('DB_PREFIX');
            $model = M()->table($prefix.'enroll');
            $result = $model->where('id =' . $id)->setField('is_sign', $status[$method]);

            if($result !== false){
                $this->success('修改成功！');
            }else{
                $this->error('修改失败！');
            }
        }
    }
    
    //添加企业信息
    public function companyAdd($eid) {
        if (empty($eid)) $this->error('报名信息不存在!');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $_POST = I('post.');
            $_POST['eid'] = $eid;
            $model = M()->table($prefix.'company_reg');
            $_POST['insert_time'] = date("Y-m-d H:m:s", time());
            $_POST['update_time'] = date("Y-m-d H:m:s", time());
            if (strlen($_POST['birthday']) == 0) unset($_POST['birthday']);
            if (strlen($_POST['founding_time']) == 0) unset($_POST['founding_time']);
            if ($model->create()) {
                $result = $model->add();
                if ($result > 0) {
                    $this->success('创建成功！',U('Meeting/enroll'));
                } else {
                    $this->error('创建失败！');
                }
            } else {
                $this->error('创建失败！');
            }
        }
    
        $enroll = M()->table($prefix.'enroll e')
            ->field(['e.*'])
            ->where(['id'=>$eid])->find();
        
        $this->assign('enroll', $enroll);
        $this->meta_title = '公司注册信息';
        $this->display();
    }

    //编辑注册信息
    public function companyEdit($eid) {
        if (empty($eid)) $this->error('报名信息不存在!');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $id = $data['id'];
            unset($data['id']);
            $data['eid'] = $eid;
            $data['update_time'] = date("Y-m-d H:m:s", time());
            if (strlen($data['birthday']) == 0) unset($data['birthday']);
            if (strlen($data['founding_time']) == 0) unset($data['founding_time']);
            if( M()->table($prefix.'company_reg')->where(array('id'=>$id))
                    ->save($data) === false){
                $this->error('修改失败！');
            }
            $this->success('保存成功！',U('Meeting/enroll'));
        }

        $enroll = M()->table($prefix.'enroll e')
            ->field(['e.*'])
            ->where(['id'=>$eid])->find();

        $company = M()->table($prefix.'company_reg')->where(['eid'=>$eid])->find();

        $this->assign('item', $company);
        $this->assign('enroll', $enroll);
        $this->meta_title = '公司注册信息';
        $this->display('companyadd');
    }

    //编辑报名信息
    public function enrollEdit($id) {
        if(empty($id)) $this->error('参数错误');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            unset($data['parse']);
            $data['update_time'] = date("Y-m-d H:m:s", time());
            $data['referee'] = intval($data['referee']);
            if(M()->table($prefix.'enroll')->where(array('id'=>$id))
                ->save($data) === false){
                $this->error('修改失败！');
            }
            $this->success('保存成功！',U('Meeting/enroll'));
        }
        $meetings = M()->table($prefix.'meeting')->where(['status'=>1])->select();
        $enroll = M()->table($prefix.'enroll')->where(['id'=>$id])->find();
        if (empty($enroll)) $this->error('没有找到该报名表');
        $this->assign('item', $enroll);
        $this->assign('meetings', $meetings);
        $this->meta_title = '编辑报名信息';
        $this->display('enrolladd');
    }

    //新建报名
    public function enrollAdd() {
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $model = M()->table($prefix.'enroll');
            $_POST['insert_time'] = date("Y-m-d H:m:s", time());
            $_POST['update_time'] = date("Y-m-d H:m:s", time());
            $_POST['referee'] = intval($_POST['referee']);
            if ($model->create()) {
                $result = $model->add();
                if ($result > 0) {
                    $this->success('创建成功！',U('Meeting/enroll'));
                } else {
                    $this->error('创建失败！');
                }
            } else {
                $this->error('创建失败！');
            }
        }
        $meetings = M()->table($prefix.'meeting m')->where(['status'=>1])->select();
        
        $this->assign('meetings', $meetings);
        $this->meta_title = '添加报名信息';
        $this->display();
    }

    //删除报名
    public function enrollDelete(){
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'enroll');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>-1]);
        if($result !== false){
            $this->success('删除成功！',U('enroll'));
        }else{
            $this->error('删除失败！');
        }
    }
}