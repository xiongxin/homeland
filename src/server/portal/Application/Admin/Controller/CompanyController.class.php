<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Admin\Service\ApiService;
use User\Api\UserApi;
/**
 * 后台用户控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class CompanyController extends AdminController {

    /**
     * @param int $id
     */
    public function userlist($id=0){

        if(empty($id)){
            $this->error('ID不能为空！');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'user_company c')
            ->join($prefix.'wx_user b on c.unionid = b.unionid','left');

        $this->assign('_list', $this->lists($model,['c.company_id'=>$id],'c.insert_time desc','c.*,b.nickname,b.userid'));

        $this->display();
    }

    /**
     * @param int $id
     */
    public function useredit($id=0){

        if(empty($id)){
            $this->error('ID不能为空！');
        }
        if(IS_POST){

            $level = I('level');
            if(M('user_company')->where(['id'=>$id])->save(['level'=>$level])){
                $this->success('修改成功！',U('userlist',['id'=>I('post.company_id')]));
            }else{
                $this->error('修改失败，请重新再试！');
            }
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'user_company c')
            ->join($prefix.'wx_user b on c.unionid = b.unionid','left');

        $this->assign('item', $model->where(['c.id'=>$id])->field('c.*,b.nickname,b.userid')->find());

        $this->display();
    }

    /**
     * @param int $id
     */
    public function bindcode($id=0){

        $bind_code = mt_rand(100000,999999);
        if(M('company')->where(['bind_code'=>$bind_code])->find()){
            $bind_code = mt_rand(100000,999999);
        }

        if(M('company')->where(['id'=>$id])->save(['bind_code'=>$bind_code])){
            $this->success('重置成功');
        }else{
            $this->error('重置失败，请重新再试！'.M()->_sql());
        }
    }

    public function index(){

        $where = [];
        $company = I('company');
        if(!empty($company)){
            $where['c.company'] = ['like', '%'.(string)$company.'%'];
        }

        $status = I('status');
        if(!empty($status)){
            $where['c.status'] = $status;
        }

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'company c')
                    ->join($prefix.'wx_user b on c.unionid = b.unionid','left');


        $this->assign('status_list',[''=>'--请选择--','WAT'=>'待审核','OK#'=>'正常','RJT'=>'审核拒绝']);
        $this->assign('_list', $this->lists($model,$where,'c.id desc','c.*,b.nickname,b.userid'));

        $this->meta_title = '公司列表查询';
        $this->display();
    }

    function edit($id=0){
        if(empty($id)){
            $this->error('ID不能为空！');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'company c')
            ->join($prefix.'wx_user b on c.unionid = b.unionid','left');

        $item = $model->where(['c.id'=>$id])
                    ->field('c.*,b.nickname,b.userid')
                    ->find();

        if(IS_POST){
            $data = [];
            $data['company'] = I('post.company');
            $data['corporation'] = I('post.corporation');
            $data['district'] = I('post.district');
            $data['status'] = I('post.status');
            $citys = I('post.city',[]);

            if(is_array($citys)){
                $keys = ['province','city'];
                foreach($citys as $k=>$city){
                    $data[$keys[$k]] = $city;
                }
            }

            if(M('company')->where(['id'=>$id])->save($data)){
                $this->success('修改成功！',U('company/index'));
            }else{
                $this->error('修改失败，请重新再试！');
            }
        }

        $this->assign('item',$item);
        $this->meta_title = '公司修改';
        $this->assign('status_list',['WAT'=>'待审核','OK#'=>'正常','RJT'=>'审核拒绝']);

        $this->display();
    }

}
