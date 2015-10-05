<extend name="Public/base"/>

<block name="body">
    <?php
    echo ace_form_open();

    echo ace_group(ace_label('会员昵称'),'<div class="line-height-2 blue">'.$item['nickname'].'</div>');
    echo ace_group(ace_label('加入时间'),'<div class="line-height-2 blue">'.$item['insert_time'].'</div>');

    $level_list = [''=>'暂无','GOLD#'=>'金种子','SILVER'=>'银种子'];
    $options = array(
        'label_text'=>'会员等级',
    );
    echo ace_dropdown($options ,'level',$level_list,$item['level']);

    echo form_hidden('company_id',$item['company_id']);

    echo ace_srbtn();
    echo ace_form_close()
    ?>
</block>
<block name="script">
    <script>
        highlight_subnav('{:U('company/index')}');
    </script>
</block>