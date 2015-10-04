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
                                ['t_user_company.id','t_user_company.insert_time','level','company'],
                                ['t_user_company.unionid'=>$this->user['unionid']]
                            );

        $level_list = [''=>'暂无','GOLD#'=>'金种子','SILVER'=>'银种子'];

        $this->getView()->assign('level_list',$level_list);
        $this->getView()->assign('user',$this->user);
        $this->getView()->assign('user_company',$user_company);
    }

    public function bindAction(){
        if(IS_POST){

            $company = trim($this->getRequest()->getPost('company'));
            $bind_code = trim($this->getRequest()->getPost('bind_code'));

            if(empty($company)){
                $this->error('请输入企业名称');
            }
            if(empty($bind_code)){
                $this->error('请输入绑定编码');
            }

            $company_id = M('t_company')->get('id',['AND'=>['company'=>$company,'bind_code'=>$bind_code]]);
            if(empty($company_id)){
                $this->error('没有找到对应的企业，请确认您输入的企业名称和绑定编码匹配！');
            }
            if(M('t_user_company')->insert(['unionid'=>$this->user['unionid'],'company_id'=>$company_id,'insert_time'=>date('Y-m-d')])){
                $this->success('绑定成功！');
            }else{
                $this->error('绑定失败，请重新再试！');
            }
        }
    }
}
