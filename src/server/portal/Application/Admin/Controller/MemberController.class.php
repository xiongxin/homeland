<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/3/28
 * Time: 18:46
 */
namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class MemberController extends AdminController {
    /**
     * 用户管理首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $nickname       =   I('nickname');
        $map['m.status']  =   array('egt',0);
        if(is_numeric($nickname)){
            $map['uid|nickname']=   array(intval($nickname),array('like','%'.$nickname.'%'),'_multi'=>true);
        }elseif(!empty($nickname)){
            $map['m.nickname']    =   array('like', '%'.(string)$nickname.'%');
        }

        $map['aga.group_id'] = ['in', [5,6]];
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ucenter_member um')
            ->join($prefix.'member m on m.uid = um.id','left')
            ->join($prefix.'auth_group_access aga on aga.uid = um.id', 'left')
            ->join($prefix.'company_reg cr on cr.uid = um.id');
        $list   = $this->lists($model, $map,'','m.*,um.username,um.id,aga.group_id,cr.eid,
                        cr.position ,cr.company_name, cr.chairman_name, cr.insert_time as reg_time');
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }
    
    public function add() {
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            if(empty(I('group_id'))) $this->error('请选择客户类型!');
            //创建ucenter_member
            $userData['username'] = I('mobile');
            $userData['email'] = I('email');
            $userData['password'] = '';
            $user = M()->table($prefix.'ucenter_member');
            //判断手机号码是否注册
            if ($user->where(['username'=>$userData['username']])->find()) {
                $this->error('该用户手机号码已经被注册!');
            }

            if (M()->table($prefix.'ucenter_member')->create($userData)) {
                $user_id = $user->add();
                if ($user_id > 0) {
                    //创建member
                    $memberData['uid'] = $user_id;
                    $memberData['nickname'] = I('chairman_nickname');
                    $member = M()->table($prefix.'member');
                    if ($member->create($memberData)) {
                        $memberResult = $member->add();
                        if ($memberResult > 0) {
                            //设置用户级别
                            $group = M()->table($prefix.'auth_group_access');
                            if ($group->create(['uid'=>$user_id,'group_id'=>I('group_id')])){
                                $groupResult = $group->add();
                                if ($groupResult> 0) {
                                    //将company_reg关联到会员
                                    $company_reg = M()->table($prefix.'company_reg');
                                    if ($company_reg->where(['id'=>I('id')])->save(['uid'=>$user_id]) === false) {
                                        $this->error('操作失败');
                                    }else {
                                        $this->success('操作成功！', U('index'));
                                    }
                                }else {
                                    $this->error('设置权限失败！');
                                }
                            }
                        } else {
                            $this->error('创建Member失败！');
                        }
                    }
                } else {
                    $this->error('创建用户失败！');
                }
            }
        }

        $search  =  I('search');
        $meeting_id = I('meeting_id');
        $data = [];
        $map = [];

        if (!empty($search)) {
            if (intval($meeting_id) <= 0) {
                $this->error('搜索条件不对，请先选择场次，再输入要搜索的名称或手机号码');
            }
            if(is_numeric($search)){
                $map['cr.telephone']=['like', '%' . intval($search) . '%'];
            }elseif(!empty($search)){
                $map['cr.chairman_name|cr.chairman_nickname']    =   array('like', '%'.(string)$search.'%');
            }
            $map['e.meeting_id'] = intval($meeting_id);
            $model = M()->table($prefix.'company_reg cr')
                ->join($prefix.'enroll e on e.id=cr.eid','left');

            $data = $model->field(array('cr.*'))->where($map)->find();
        }

        $meetings = M()->table($prefix.'meeting')->where(['status'=>1])->select();

        $this->assign('meetings', $meetings);
        $this->assign('item', $data);
        $this->assign('search', $search);
        $this->meta_title = '注册会员类型';
        $this->display();
    }

    public function edit() {
        $prefix = C('DB_PREFIX');
        $uid = I('uid');
        if (empty($uid)) $this->error('参数错误');
        if (IS_POST) {
            $group = M()->table($prefix.'auth_group_access');
            if($group->where(['uid'=>$uid])->save(['group_id'=>I('group_id')])  === false) {
                $this->error('修改失败!');
            } else {
                $this->success('修改成功!',U('index'));
            }
        }

        $company = M()->table($prefix.'company_reg cr')
            ->join($prefix.'auth_group_access aga on aga.uid = cr.uid', 'left')
            ->where(['cr.uid' => $uid])
            ->find();


        $this->assign('item', $company);
        $this->meta_title = '修改会员类型';
        $this->display();
    }
}