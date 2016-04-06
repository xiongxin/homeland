<?php
use Core\Mall;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class PublicController extends Mall {

    public function init(){
        parent::init();
        $this->assign('user',$this->user);
    }

    public function bindAction(){

        if(is_not_wx() || empty($this->user)){
            $this->error('本功能仅开放给微信用户使用！');
        }
        if(!empty($this->user['uid'])){
            $this->error('您已经绑定了账号，不要来闹了！');
        }

        if(IS_POST){
            $username = trim(I('username'));
            if(empty($username)){
                $this->error('请输入用户名！');
            }
            $password = trim(I('password'));
            if(empty($password)){
                $this->error('请输入密码！');
            }

            $model = M('t_ucenter_member');
            $user = $model->get(
                                [
                                   '[><]t_auth_group_access(b)'=>['id'=>'uid','AND'=>['b.group_id'=>1]],
                                ],
                                ['id','username','password','mobile','wx_id','b.group_id'],['username'=>$username]);

            if(empty($user)){
                $this->error('用户不存在或密码不正确！');
            }

            if(!empty($user['wx_id'])){
                $this->error('该用户已经被绑定！');
            }

            require_once '/var/www/html/conf/homeland/onethink/User/config.php';
            if(think_ucenter_md5($password,UC_AUTH_KEY) != $user['password']){
                $this->error('用户不存在或密码不正确！');
            }
            if($model->update(['wx_id'=>$this->user['wx_id']],['id'=>$user['id']])){

                $this->user['uid'] = $user['id'];
                $this->user['username'] = $user['username'];
                $this->user['mobile'] = $user['mobile'];
                $this->user['group_id'] = $user['group_id'];
                session('user_auth',$this->user);

                $this->success('',U('/public/bindSuccess'));
            }else{

                $this->error('绑定失败，请重新再试或联系客服人员！');
            }
        }
    }
    
    /**
     * 绑定成功提示页面
     */
    public function bindSuccessAction(){
        $this->success('绑定成功,请点击左上角的关闭按钮继续操作！');
    }

    /**
     * 报名成功提示页面
     */
    public function enrollSuccessAction(){
        $this->success('报名成功！三个工作日内客服将与您电话联系!');
    }
    /**
     * 会议报名
     */
    public function enrollAction(){
        $meeting_id = intval(I('meeting_id'));
        if(empty($meeting_id)){
            $this->error('参数错误，会议ID为空！');
        }

        if (IS_POST) {
            //用户登录到并且表里有对性的会议和用户id
            if (!empty($this->user) && M('t_enroll(e)')->get(
                ["*"],
                ['AND'=>['e.meeting_id'=>$meeting_id,'e.wx_id'=>$this->user['wx_id']]])){
                $this->error('您已经报名，请勿重复报名！');
            }
            $data = [
                'wx_id' => $this->user['wx_id'],
                'create_time' => time_format(time()),
                'update_time' => time_format(time()),
                'sign_time' => time_format(time()),
                'meeting_id' => $meeting_id,
                'name' => I('post.name'),
                'mobile' => I('post.mobile'),
                'position' => I('post.position'),
                'company_name' => I('post.company_name'),
                'referee' => I('post.referee'),
            ];
            $company_reg = [
                'chairman_name' => I('post.name'),
                'company_name' => I('post.company_name'),
                'position' => I('post.position'),
                'email' => I('post.email'),
                'mobile' => I('post.mobile'),
                'founding_time' => I('post.founding_time'),
                'business_licence_num' => I('post.business_licence_num'),
                'industry_id' => I('post.industry_id'),
                'enterprise_nature' => I('post.enterprise_nature'),
                'scale' => I('post.scale'),
                'insert_time' => time_format(time()),
                'update_time' => time_format(time()),
            ];
            //$data = array_merge(I('post.'), $data);
            //$company_reg = array_merge(I('post.'), $company_reg);
            if ( $last = M('t_enroll')->insert($data) ){
                $company_reg['eid'] = $last;
                if (M('t_company_reg')->insert($company_reg)) {
                    $this->redirect(U('/public/enrollSuccess'));
                }
            }  else {
                $this->error('报名失败！');
            }
        }

        $item = M('t_meeting')->get('*',['id'=>$meeting_id]);
        if(empty($item)){
            $this->error('会议不存在！');
        }
        $this->assign('item',$item);

        $this->layout->setLayoutFile(null);
    }
}
