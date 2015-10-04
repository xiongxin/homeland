<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class IndexController extends MemberController {

    /**
     * 默认动作，首页
     * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/y/index/index/index/name/yantze 的时候, 你就会发现不同
     */
    public function indexAction(){
        $user_company = M('t_user_company')
                            ->get(
                                ['[><]t_company(p)'=>['unionid'=>'unionid']],
                                ['t_user_company.id','t_user_company.insert_time','company'],
                                ['t_user_company.unionid'=>$this->user['unionid']]
                            );

        $this->getView()->assign('user',$this->user);
        $this->getView()->assign('user_company',$user_company);
    }
}
