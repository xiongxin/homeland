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
        $list   = $this->lists($model, [],'','m.*');

        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    public function enroll() {
        $search       =   I('search');
        //$map['um.status']  =   array('egt',0);
        $map['status'] = ['egt', 0];
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
        $model = M()->table($prefix.'enroll n')
            ->join($prefix.'meeting m on n.meeting_id=m.id', 'left');
        $list  = $this->lists($model, [],'','n.*, m.title');

        $this->assign('_list', $list);
        $this->meta_title = '报名管理';
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