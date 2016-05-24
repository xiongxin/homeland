<?php
use Core\Mall;
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class IndexController extends Mall {

    /**
     *
     */
    public function indexAction(){
        Yar_Concurrent_Client::call("http://homeland.me/api/user",'insertUser',[10,'测试产品']);
        Yar_Concurrent_Client::loop();
    }

    public function signAction(){
        if(is_not_wx()){
            $this->error('本功能仅允许在微信内使用！');
        }

        if(empty($this->user['uid'])){
            $this->error('您还没有绑定运营账号！',U('/public/bind'),['btn_text'=>'去绑定']);
        }
        if($this->user['group_id'] != 1){
            $this->error('本功能仅允许运营人员使用！');
        }
        $query = M()->query("select id,title,address from t_meeting where date(agenda_date) = '".date('Y-m-d')."'");
        $list = $query ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
        if(empty($list)){
            $this->error('啊哈，今天没有任何会议哦！');
        }
        $meeting = $list[0];

        if(IS_POST){
            $enroll_id = intval(I('enroll_id'));

            if(empty(I('enroll_id'))){
                $this->error('参数错误，报名ID不能为空！');
            }
            if(M('t_enroll')->update(['is_sign'=>Model::BOOL_YES,'sign_time'=>time_format()],['AND'=>['id'=>$enroll_id,'meeting_id'=>$meeting['id'],'is_affirm'=>Model::BOOL_YES]])){
                $this->success('签到成功！');
            }else{
                $this->error('签到失败，请重新再试或联系管理人员！');
            }
        }

        $id = intval(I('enroll_id'));
        if(!empty($id)){
            $item = M('t_enroll(a)')->get(
                [
                    '[><]t_company_reg(b)'=>['a.id'=>'eid'],
                ],
                [
                    'a.id',
                    'a.mobile',
                    'a.create_time',
                    'a.is_affirm',
                    'a.is_sign',
                    'b.chairman_name',
                    'b.sex',
                    'b.company_name',
                ],
                [
                        'AND'=>['a.id'=>$id,'meeting_id'=>$meeting['id']]
                ]);

            if(empty($item)){
                $this->error('没有找到报名记录！');
            }

            if($item['is_affirm'] != Model::BOOL_YES){
                $this->error('此报名还没经过确认！');
            }
            if($item['is_sign'] == Model::BOOL_YES){
                $this->error('此报名已经签到过，无需重复签到！');
            }
            $this->assign('item',$item);
        }
        if(!is_not_wx()){
            $js_ticket = $this->wechat->getJsTicket();
            if (!$js_ticket) {
                echo "获取js_ticket失败！<br>";
                echo '错误码：'.$this->wechat->errCode;
                echo ' 错误原因：'.ErrCode::getErrText($this->wechat->errCode);
                exit;
            }

            $url = DOMAIN.$_SERVER['REQUEST_URI'];
            $js_sign = $this->wechat->getJsSign($url);
            $this->assign('js_sign',$js_sign);
        }

        $this->assign('meeting',$meeting);
    }

    public function searchAction(){

        $keyword = I('keyword');
        if(empty($keyword)){
            $this->error('请输入手机号码！');
        }
        $meeting_id = intval(I('meeting_id'));

        $list = M('t_enroll(a)')->select(
            [
                '[><]t_company_reg(b)'=>['a.id'=>'eid'],
            ],
            [
                'a.id',
                'a.mobile',
                'a.create_time',
                'b.chairman_name',
                'b.sex',
                'b.company_name',
            ],
            [
                'AND'=>[
                    'a.meeting_id'=>$meeting_id,
                    'a.is_affirm'=>Model::BOOL_YES,
                    'a.is_sign'=>Model::BOOL_NO,
                    'a.mobile[~]'=>$keyword,
                ]
            ]);
//        SeasLog::info(M()->last_query());
        $this->success('','',['list'=>$list]);
    }

    public function meetingsAction() {
        $list = M('t_meeting(a)')->select(
            ['a.*'],
            [
                'AND' => [
                    'a.agenda_date[>=]' => time_format()
                ]
            ]
        );
        $this->assign('list', $list);
        $this->layout->setLayoutFile(null);
    }
}
