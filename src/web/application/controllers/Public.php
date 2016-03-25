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

        $id = intval(I('id'));
        if(empty($id)){
            $this->error('参数错误，会议ID为空！');
        }
        $item = M('t_meeting')->get('*',['id'=>$id]);
        if(empty($item)){
            $this->error('会议不存在！');
        }
        $this->assign('item',$item);

        $this->layout->setLayoutFile(null);
    }
}
