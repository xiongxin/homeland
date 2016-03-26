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

    public function enrollAction(){
        $meeting_id = intval(I('meeting_id'));
        if(empty($meeting_id)){
            $this->error('参数错误，会议ID为空！');
        }

        if (IS_POST) {
            if (M('t_enroll(e)')->get(
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
