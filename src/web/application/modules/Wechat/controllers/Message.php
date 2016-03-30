<?php
/**
 * Class MessageController
 * @author xuebingwang
 * @desc Message控制器
 */
class MessageController extends Core\Wechat  {

    public function init(){
        parent::init();

        $this->raw_data = json_to_array(file_get_contents('php://input'));
//        $this->raw_data['enroll'] = [
//            'id'=>12,
//            'name'=>'王xx',
//            'openid'=>'oCmwKv9ErXuGDmJYWGV2KSxEYj6A',
//            'title'=>'麦圈宣讲会',
//            'agenda_date'=>'2016-03-30 15:00:00',
//            'address'=>'成都市锦江区东大街芷泉段6号时代1号3110',
//        ];
//
        if(!isset($this->raw_data['body']) || empty($this->raw_data['body'])){
            throw new \Exception('{"errcode":10000,"errmsg":"body节点不能为空"}',10000);
        }
    }

    public function enrollAffirmAction(){

        $url = DOMAIN.'/index/sign.html?enroll_id='.$this->raw_data['enroll']['id'];

        $file_path = '/tmp/qrcode.png';
        \QRcode::png($url, $file_path, QR_ECLEVEL_L, 9, true);

        $config = [
            'accessKey'=>$this->config->qiniu->accessKey,
            'secrectKey'=>$this->config->qiniu->secrectKey,
            'bucket'=>$this->config->qiniu->picture->bucket,
            'domain'=>$this->config->qiniu->picture->domain
        ];
        $qiniu = new Qiniu\Storage($config);

        $file = [
            'name'=>'file',
            'fileName'=>md5($url).'.png',
            'fileBody'=>file_get_contents($file_path)
        ];
        $result = $qiniu->upload([],$file);
        $link = '';
        if(is_array($result) && isset($result['key'])){
            $link = 'http://'.$this->config->qiniu->picture->domain.'/'.$result['key'];
            $link = DOMAIN.'/show/pic.html?pic='.urlencode($link);
        }

        $content = '尊敬的'.$this->raw_data['enroll']['name'].'，您的报名已确认';
        $msg = [
            'touser'=>$this->raw_data['enroll']['openid'],
            'template_id'=>'kjsw2T4m0TpCvuqhD9lad2vGtnOq6AnztKOR1qUnIs4',
            'url'=>$link,
            'topcolor'=>'',
            'data'=>[
                'first'=>['value'=>$content."\n",'color'=>'#333333'],
                'keyword1'=>['value'=>$this->raw_data['enroll']['title'],'color'=>'#333333'],
                'keyword2'=>['value'=>$this->raw_data['enroll']['agenda_date'],'color'=>'#333333'],
                'keyword3'=>['value'=>$this->raw_data['enroll']['address'],'color'=>'#333333'],
                'remark'=>['value'=>"\n感谢你的参与，点击查看报名二维码！",'color'=>'#333333'],
            ],
        ];

        $result = $this->wechat->sendTemplateMessage($msg);

//
//        if(empty($result)){
//
//            $this->quick_return($this->wechat->errCode,$this->wechat->errMsg);
//        }else{
//            $this->ajax_return($result);
//        }

        $result = $this->wechat->uploadMedia(['media'=>'@'.$file_path],'image');

        if(is_array($result) && isset($result['media_id'])){
            $data = [
                'touser'=>$this->raw_data['enroll']['openid'],
                'msgtype'=>'image',
                'image'=>['media_id'=>$result['media_id']]
            ];
            $result = $this->wechat->sendCustomMessage($data);
        }


        echo $this->quick_return('处理成功！');
    }
}
