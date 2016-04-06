<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <form action="<?= empty($item) ?  U('Meeting/add') : U('Meeting/edit')  ?>" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">标题</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="title"
                       value="<?= empty($item) ? "" : $item['title'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">副标题</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="subheading"
                       value="<?= empty($item) ? "" : $item['subheading'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议描述</label>
            <div class="col-xs-12 col-sm-7">
                <textarea  name="description">{$item.description}</textarea>
                {:hook('adminArticleEdit', array('name'=>'description'))}
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系人</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contacts"
                       value="<?= empty($item) ? "" : $item['contacts'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系电话</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contact_phone"
                       value="<?= empty($item) ? "" : $item['contact_phone'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议时间</label>
            <div class="col-xs-12 col-sm-7">
                <input name="agenda_date" class="form-control date-picker" value="{$item.agenda_date}" type="text" data-date-format="dd-mm-yyyy">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议地址</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="address"
                       value="<?= empty($item) ? "" : $item['address'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系邮箱</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contact_email"
                       value="<?= empty($item) ? "" : $item['contact_email'] ?>">
            </div>
        </div>
        <hr>
        <h3 style="text-align: center;">报名会议页面设置</h3>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">背景图片</label>
            <div class="col-xs-12 col-sm-6">
                <div class="upload-wrap">
                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="pic" val="{$item['pic']|default=''}" >
                        <i class="icon-cloud-upload "></i>上传图片
                    </a>
                    <notempty name="item['pic']">
                        <div class="preview"><img src="<?=imageView2($item['pic'],120,120)?>" width="120"/></div>
                    </notempty>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">背景图片</label>
            <div class="col-xs-12 col-sm-6">
                <select name="background" data-id="{$item.background}" id="simple-colorpicker-1" class="hide">
                    <option value="#ac725e">#ac725e</option>
                    <option value="#d06b64">#d06b64</option>
                    <option value="#f83a22">#f83a22</option>
                    <option value="#fa573c">#fa573c</option>
                    <option value="#ff7537">#ff7537</option>
                    <option value="#ffad46" selected="">#ffad46</option>
                    <option value="#42d692">#42d692</option>
                    <option value="#16a765">#16a765</option>
                    <option value="#7bd148">#7bd148</option>
                    <option value="#b3dc6c">#b3dc6c</option>
                    <option value="#fbe983">#fbe983</option>
                    <option value="#fad165">#fad165</option>
                    <option value="#92e1c0">#92e1c0</option>
                    <option value="#9fe1e7">#9fe1e7</option>
                    <option value="#9fc6e7">#9fc6e7</option>
                    <option value="#4986e7">#4986e7</option>
                    <option value="#9a9cff">#9a9cff</option>
                    <option value="#b99aff">#b99aff</option>
                    <option value="#c2c2c2">#c2c2c2</option>
                    <option value="#cabdbf">#cabdbf</option>
                    <option value="#cca6ac">#cca6ac</option>
                    <option value="#f691b2">#f691b2</option>
                    <option value="#cd74e6">#cd74e6</option>
                    <option value="#a47ae2">#a47ae2</option>
                    <option value="#555">#555</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">文字颜色</label>
            <div class="col-xs-12 col-sm-6">
                <select id="simple-colorpicker-2" data-id="{$item.font_color}" name="font_color" class="hide">
                    <option value="#ac725e">#ac725e</option>
                    <option value="#d06b64">#d06b64</option>
                    <option value="#f83a22">#f83a22</option>
                    <option value="#fa573c">#fa573c</option>
                    <option value="#ff7537">#ff7537</option>
                    <option value="#ffad46" selected="">#ffad46</option>
                    <option value="#42d692">#42d692</option>
                    <option value="#16a765">#16a765</option>
                    <option value="#7bd148">#7bd148</option>
                    <option value="#b3dc6c">#b3dc6c</option>
                    <option value="#fbe983">#fbe983</option>
                    <option value="#fad165">#fad165</option>
                    <option value="#92e1c0">#92e1c0</option>
                    <option value="#9fe1e7">#9fe1e7</option>
                    <option value="#9fc6e7">#9fc6e7</option>
                    <option value="#4986e7">#4986e7</option>
                    <option value="#9a9cff">#9a9cff</option>
                    <option value="#b99aff">#b99aff</option>
                    <option value="#c2c2c2">#c2c2c2</option>
                    <option value="#cabdbf">#cabdbf</option>
                    <option value="#cca6ac">#cca6ac</option>
                    <option value="#f691b2">#f691b2</option>
                    <option value="#cd74e6">#cd74e6</option>
                    <option value="#a47ae2">#a47ae2</option>
                    <option value="#555">#555</option>
                </select>
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-xs-12">
                <if condition="!empty($item)">
                    <input type="hidden" name="id" value="{$item.id}" />
                </if>
                <button type="submit" target-form="form-horizontal" class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                    确认
                </button>
                <a class="btn btn-white" href="javascript:history.go(-1)">
                    返回
                </a>
            </div>
        </div>
    </form>
</block>

<block name="script">
    <include file="Public/upload.js"/>
    <include file="Public/upload.pic"/>
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
    <link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
    <link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="__ACE__/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {


            var background = $('#simple-colorpicker-1').data('id');
            if (!!background) $('#simple-colorpicker-1').val(background);

            var font_color = $('#simple-colorpicker-2').data('id');
            if (!!font_color) $('#simple-colorpicker-2').val(font_color);

            $('#simple-colorpicker-1').ace_colorpicker();
            $('#simple-colorpicker-2').ace_colorpicker();
        });
        //搜索功能
        $("#search").click(function(){
            var url = $(this).attr('url');
            var query  = $('.search-form').find('input').serialize();
            query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
            query = query.replace(/^&/g,'');
            if( url.indexOf('?')>0 ){
                url += '&' + query;
            }else{
                url += '?' + query;
            }
            window.location.href = url;
        });
        //回车搜索
        $(".search-input").keyup(function(e){
            if(e.keyCode === 13){
                console.info($("#search"));
                $("#search").click();
                return false;
            }
        });
        $('.date-picker').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
        //导航高亮
        highlight_subnav('{:U('Meeting/index')}');
    </script>
</block>