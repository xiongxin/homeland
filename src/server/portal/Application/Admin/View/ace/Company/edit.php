<extend name="Public/base"/>

<block name="body"> 
    <?php 
        echo ace_form_open();

        echo ace_group(ace_label('申请人姓名'),'<div class="line-height-2 blue">'.$item['nickname'].'</div>');
        echo ace_group(ace_label('申请人手机'),'<div class="line-height-2 blue">'.$item['mobile'].'</div>');

        $options = array(
            'label_text'=>'企业名称',
            'help'=>'',
        );
        echo ace_input($options ,array('name'=>'company','class'=>'width-100'),$item['company']);

        $options = array(
            'label_text'=>'法人姓名',
            'icon'=>'icon-user'
        );
        echo ace_input_m($options ,'corporation',$item['corporation']);

    ?>

    <div class="form-group">
        <label class="col-xs-12 col-sm-2 control-label no-padding-right" for="act_time">
            <span class="red">*</span>企业地址
        </label>
        <div class="col-xs-12 col-sm-5" id="city">
        </div>
        <div class="help-block col-xs-12 col-sm-reset inline" id="city_wrap">

        </div>
    </div>
    <?php

        $options = array(
            'label_text'=>'状态',
        );
        echo ace_dropdown($options ,'status',$status_list,$item['status']);

        echo ace_srbtn();
        echo ace_form_close()
    ?>
</block>
<block name="script">
    <script>
        <?php echo hook('H_XbDistrict', array('id'=>'city','district'=>'district','selected'=>$item['district']));?>
        $(document).on('change','#district',function(){
            var hidden_html = '';
            $.each(XBW.linkagesel.getParentsText(this.value), function (k,v) {
                hidden_html += '<input name="city[]" type="hidden" value="'+v+'"/>';
            })
            $("#city_wrap").html(hidden_html);
        })
        highlight_subnav('{:U('company/index')}');
    </script>
</block>