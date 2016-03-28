<?php

namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

/**
 * 会议管理控制器
 * User: xiongxin
 * Date: 2016/3/25
 * Time: 20:53
 */
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

    public function enrollEdit($id) {
        if (empty($id)) $this->error('参数错误');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'company_reg c');
        if (IS_POST) {
            $data = I('post.');
            $id = $data['id'];
            unset($data['id']);
            if (strlen($data['birthday']) == 0) unset($data['birthday']);
            if (strlen($data['birthday']) == 0) unset($data['birthday']);
            if ($model->where(['id'=>$id])->save($data) !== false) {
                $this->success('保存成功！');
            } else {
                $this->error('保存失败！');
            }
        }

        $data = $model->field(array('c.*'))
            ->where(['eid'=>$id])->find();
        if (empty($data)) {
            $this->error('公司注册信息不存在!');
        }
        $enroll = $model->table($prefix.'enroll e')
            ->field(['e.*'])
            ->where(['id'=>$id])->find();
        
        $this->assign('enroll', $enroll);
        $this->assign('item',$data);
        $this->meta_title = '公司注册信息';
        $this->display();
    }

    public function enrollAdd() {
        if (IS_POST) {
//            $data = I('post.');
//            $id = $data['id'];
//            unset($data['id']);
//            if (strlen($data['birthday']) == 0) unset($data['birthday']);
//            if (strlen($data['birthday']) == 0) unset($data['birthday']);
//            if ($model->where(['id'=>$id])->save($data) !== false) {
//                $this->success('保存成功！');
//            } else {
//                $this->error('保存失败！');
//            }
        }

        $this->meta_title = '公司注册信息';
        $this->display();
    }

    public function enrollDelete(){
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'enroll');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>-1]);
        if($result !== false){
            $this->success('修改成功！',U('enroll'));
        }else{
            $this->error('修改失败！');
        }
    }
}