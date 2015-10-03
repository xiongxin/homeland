<extend name="Public/base" />

<block name="body">
    <?php 
        $sex = ['未知','男','女'];

        $status_list = [
            '1'=>'已关注',
            '0'=>'已取消关注',
            '-1'=>'从未关注过',
        ];
        echo ace_form_open();

        echo ace_group(ace_label('openid'),'<div class="line-height-2 blue">'.$item['openid'].'</div>');
        echo ace_group(ace_label('unionid'),'<div class="line-height-2 blue">'.$item['unionid'].'</div>');
        echo ace_group(ace_label('昵称'),'<div class="line-height-2 blue">'.$item['nickname'].'</div>');
        echo ace_group(ace_label('照片'),'<div class="line-height-2 blue"><img src="'.$item['headimgurl'].'" width="100" /></div>');
        echo ace_group(ace_label('性别'),'<div class="line-height-2 blue">'.$sex[$item['sex']].'</div>');
        echo ace_group(ace_label('国家'),'<div class="line-height-2 blue">'.$item['province'].'</div>');
        echo ace_group(ace_label('省份'),'<div class="line-height-2 blue">'.$item['country'].'</div>');
        echo ace_group(ace_label('城市'),'<div class="line-height-2 blue">'.$item['city'].'</div>');
        echo ace_group(ace_label('关注时间'),'<div class="line-height-2 blue">'.time_format($item['subscribe_time']).'</div>');
        echo ace_group(ace_label('关注状态'),'<div class="line-height-2 blue">'.$status_list[$item['subscribe']].'</div>');
        echo ace_group(ace_label('备注'),'<div class="line-height-2 blue">'.$item['remark'].'</div>');
        ?>
        <div class="clearfix form-actions">
              <div class="col-xs-12 center">
                  <a href="javascript:;" class="btn btn-info" onclick="history.go(-1)">
                    <i class="icon-reply"></i>返回上一页
                  </a>  
              </div>
        </div>
        <?php
        echo ace_form_close()
    ?>
</block>
<block name="script">
    <script>
    //导航高亮
    highlight_subnav('{:U('user/wechat')}');
    </script>
</block>

