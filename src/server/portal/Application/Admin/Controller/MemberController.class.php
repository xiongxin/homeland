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

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ucenter_member um')
            ->join($prefix.'member m on m.uid = um.id','left');
        $list   = $this->lists($model, $map,'','m.*,um.username,um.id');
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }
    
    public function add() {
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            //创建ucenter_member
            $userData['username'] = I('mobile');
            $userData['email'] = I('email');
            //TODO:判断手机号码是否注册
            $user = M()->table($prefix.'ucenter_member');
            if ($newUser = $user->create($userData)) {
                $userResult = $user->add();
                if ($userResult > 0) {
                    //创建member
                    $memberData['uid'] = $newUser->id;
                    $memberData['nickname'] = I('chairman_nickname');
                    $member = M()->table($prefix.'member');
                    if ($member->create($memberData)) {
                        $memberResult = $member->add();
                        if ($memberResult > 0) {
                            //设置用户级别
                            
                            //将company_reg关联到会员
                            $company_reg = M()->table($prefix.'company_reg');
                            if ($company_reg->where(['id'=>I('id')])->save(['uid'=>$newUser->id]) === false) {

                            }
                        } else {
                            $this->error('创建用户失败！');
                        }
                    }
                } else {
                    $this->error('创建用户失败！');
                }
            }
            $return = M()->table($prefix.'user_return_visit');
            $_POST['insert_time'] = date("Y-m-d H:m:s", time());
            $_POST['update_time'] = date("Y-m-d H:m:s", time());
            if ($return->create()) {
                $result = $return->add();
                if ($result > 0) {
                    $this->success('保存成功！',U('user/userReturn'));
                } else {
                    $this->error('保存失败！');
                }
            } else {
                $this->error('保存失败！');
            }
        }

        $search  =  I('search');
        $meeting_id = I('meeting_id');
        $data = [];
        $map = [];

        if (!empty($search)) {
            if (intval($meeting_id) <= 0) $this->error('搜索条件不对，请先选择场次，再输入要搜索的名称或手机号码');
            if(is_numeric($search)){
                $map['cr.telephone']=['like', '%' . intval($search) . '%'];
            }elseif(!empty($search)){
                $map['cr.chairman_name|cr.chairman_nickname']    =   array('like', '%'.(string)$search.'%');
            }
            $map['e.meeting_id'] = intval($meeting_id);
            $model = M()->table($prefix.'company_reg cr')
                ->join($prefix.'enroll e on e.id=cr.eid','left');
            $data = $model->field(array('cr.*'))->where($map)->find();
            //echo $model->getLastSql();exit();
            if (empty($data)) {
                $this->error('该用户不存在!');
            }
        }

        $meetings = M()->table($prefix.'meeting')->where(['status'=>1])->select();

        $this->assign('meetings', $meetings);
        $this->assign('item', $data);
        $this->assign('search', $search);
        $this->meta_title = '添加回访';
        $this->display();
    }
}