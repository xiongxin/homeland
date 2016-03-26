<?php

namespace Admin\Controller;
use Admin\Service\ApiService;
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
}