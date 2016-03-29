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
        if(empty($this->user['uid'])){
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
            $user = $model->get(['id','username','password','wx_id'],['username'=>$username]);
            if(empty($user)){
                $this->error('用户不存在或密码不正确！');
            }

            if(!empty($user['wx_id'])){
                $this->error('该用户已经被绑定！');
            }

            require_once '/var/www/html/conf/paas/onethink/User/config.php';
            if(think_ucenter_md5($password,UC_AUTH_KEY) != $user['password']){
                $this->error('用户不存在或密码不正确！');
            }

            if($model->update(['wx_id'=>$this->user['wx_id']],['id'=>$user['id']])){

                $this->user['uid'] = $user['id'];
                session('user_auth',$this->user);

                $this->success('绑定成功！',U('/public/bind'));
            }else{
                $this->error('绑定失败，请重新再试或联系客服人员！');
            }
        }
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
                'sign_time' => time_format(time())
            ];
            $data = array_merge(I('post.'), $data);
            if (M('t_enroll')->insert($data)) {
                $this->success('报名成功！三个工作日内客服将与您电话联系!');
            } else {
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
