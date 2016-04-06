<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>报名表-<?=$item['title']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="robots" content="noarchive" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="description" content="<?=$item['title']?>"/>
    <link href="/style/weui.css" rel="stylesheet" type="text/css" />
    <link href="/style/form.css?v=20160202" rel="stylesheet" type="text/css" />

    <style type="text/css">
        html {
            background-color: #ae7ac5;
            color: #000000;
            background-position: left top;
        }

        .fs_main {
            width: 640PX
        }

        .fs_cTitle {
            font-size: 16PX;
            line-height: 25PX;
        }

        .fs_content {
            font-size: 14px;
        }

        @media screen and (max-width:640PX) {
            div.fs_main {
                width: 100%;
            }
        }

        div.f_share {
            left: 640PX
        }

        div.f_share_main {
            width: 640PX
        }

        @media screen and (max-width:862px) {
            div.f_share {
                display: none;
            }
        }

        .fs_fixbackground {
            min-height: 100%;
            min-width: 1024px;
            width: 100%;
            height: auto;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .fs_cValidate {
            color: #7c4593;
        }

        .fs_cDescribe a, .fs_cDescribe a:visited {
            color: #ae7ac5
        }

        .fs_cDescribe, .fs_cLink, .fs_cLink:visited {
            color: #ae7ac5
        }

        .fs_cExtraDescribe {
            color: #ae7ac5
        }

        .fs_sectionDescribe, .fs_imgDescribe {
            color: <?= $item['font_color'] ?>
        }

        .fs_component {
            background-color: #cab8d3;
            color: #7c4593
        }

        .fs_header {
            background-color: <?= $item['background'] ?>;
            color: #ffffff;
        }

        .fs_main {
            background-color: #f9eefe;
            color: #7c4593;
        }

        .fs_submitBtn,.fs_mobile_vcode_btn {
            background-color: #9553b1;
            color: #fff;
            box-shadow: 0 2px 4px -2px #ac6dc6;
        }

        .fs_submitBtn:hover,.fs_mobile_vcode_btn:hover {
            background-color: #ac6dc6
        }

        .f_copyright .fs_powerby {
            color: #EEE;
        }

        .Zebra_DatePicker td.dp_selected {
            background-color: #9553b1;
            color: #fff;
        }

        .Zebra_DatePicker td.dp_current {
            color: #ac6dc6
        }
    </style>
</head>
<body>
<img
    src="<?=imageView2($item['pic'])?>" class="fs_fixbackground" />
<div class="f_wrapper fs_wrapper">
    <div class="f_main fs_main">
        <div class="f_header fs_header">
            <div class="f_text_no_logo">
                <h2 class="f_title fs_title"><?=$item['title']?></h2>
                <p class="f_describe fs_describe"><?=$item['subheading']?></p>
            </div>
        </div>
        <div class="f_body fs_body">
            <?=$item['description']?>
            <form action="<?= U('/public/enroll') ?>" id="submit-form" method="post">
                <input type="hidden" name="meeting_id" value="<?= $_GET['meeting_id'] ?>" >
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">您的姓名
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <input data-type="name" name="name" type="text" id="name" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">手机号码
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <input data-type="mobile" name="mobile" type="text" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">邮箱
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <input data-type="email" name="email" type="text" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">年龄
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <div class="f_select medium">
                        <select data-type="age" name="age" class="insideSelect fs_content fs_input">
                            <option value=""> 请选择 </option>
                            <option value="1"> 30-40岁 </option>
                            <option value="2"> 40-50岁 </option>
                            <option value="3"> 50岁以上 </option>
                        </select>
                    </div>
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">公司名称<span class="f_cValidate fs_cValidate">*请填写真实公司名称</span></p>
                    <input type="text" name="company_name" data-type="company" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">
                        职位
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <div class="f_select medium">
                        <select name="position" data-type="position" class="insideSelect fs_content fs_input">
                            <option value=""> 请选择 </option>
                            <option value="董事长"> 董事长 </option>
                            <option value="总裁"> 总裁 </option>
                            <option value="总经理"> 总经理 </option>
                            <option value="其他"> 其他 </option>
                        </select>
                    </div>
                </div>

                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">
                        企业分类
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <div class="f_select medium">
                        <select data-type="industry_id" name="industry_id" id="catid" data-id="" class="insideSelect fs_content fs_input">
                            <option value="">选择行业分类</option>
                            <option value="1">电脑、通讯、数码</option><option value="43">家具、洁具、日用品</option><option value="10">建材、五金、装饰</option><option value="8">纺织、服装、鞋帽</option><option value="23">礼品、玩具、工艺品</option><option value="11">家电、照明、电子</option><option value="9">文具、乐器、体育</option><option value="3">机电、仪器、设备</option><option value="25">食品、饮料、酒类</option><option value="14">汽车、摩托、电动车</option><option value="46">能源、环保、节能</option><option value="45">冶金、金属、零件</option><option value="18">农业、水产、养殖</option><option value="29">矿产、石油、化工</option><option value="17">珠宝、首饰、化妆品</option><option value="44">医药、医器、保健品</option><option value="47">包装、印刷、造纸</option><option value="26">书画、艺术、收藏</option><option value="39">通用、其他制造业</option><option value="2">房地产、建筑、装修</option><option value="13">餐饮、咖啡、茶楼</option><option value="34">咨询、策划、翻译</option><option value="31">金融、证券、典当</option><option value="16">健身、运动俱乐部</option><option value="27">家政、保洁、搬家</option><option value="19">医院、诊所、保健</option><option value="36">旅游、宾馆、农家乐</option><option value="22">美容、休闲、养生</option><option value="15">婚庆、摄影、影楼</option><option value="40">仓储、物流、租车</option><option value="33">维修、保养、回收</option><option value="42">广告、会展、设计</option><option value="41">文化、教育、培训</option><option value="32">政府、协会、机构</option><option value="12">其他行业网站</option>
                        </select>
                    </div>
                </div>


                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">
                        企业性质
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <div class="f_select medium">
                        <select data-type="enterprise_nature" name="enterprise_nature" id="enterprise_nature" data-id="" class="insideSelect fs_content fs_input">
                            <option value="">选择企业</option>
                            <option value="GFZ">股份制企业</option>
                            <option value="SY#">私营企业</option>
                            <option value="GT#">个体企业</option>
                            <option value="WSD">外商独资企业</option>
                            <option value="ZWH">中外合资企业</option>
                            <option value="GY#">国营企业</option>
                        </select>
                    </div>
                </div>

                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">
                        企业规模
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <div class="f_select medium">
                        <select data-type="scale" name="scale" id="scale" data-id="" aria-invalid="false" class="insideSelect fs_content fs_input">
                            <option value="">选择企业规模</option>
                            <option value="QIN">1000以上</option>
                            <option value="F2Q">501-1000人</option>
                            <option value="O2F">100-500人</option>
                            <option value="F2O">50-100人</option>
                            <option value="FIV">50人一下</option>
                        </select>
                    </div>
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">成立时间<span class="f_cValidate fs_cValidate">*请填写真实公司名称</span></p>
                    <input id="founding_time" data-type="founding_time" name="founding_time" class="input medium fs_content fs_input" value="" type="text" data-date-format="dd-mm-yyyy" aria-invalid="false">
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">主营业务及产品<span class="f_cValidate fs_cValidate">*请填写真实公司名称</span></p>
                    <input data-type="primary_business" name="primary_business" class="input medium fs_content fs_input" value="" type="text" data-date-format="dd-mm-yyyy" aria-invalid="false">
                </div>

                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">营业执照注册号<span class="f_cValidate fs_cValidate">选填</span></p>
                    <input type="text" name="business_licence_num"  class="input medium fs_content fs_input" value="" />
                </div>




                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">推荐人<span class="f_cValidate fs_cValidate">选填，请填写推荐人手机号码</span></p>
                    <input name="referee" type="text" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle" style="text-align:left">活动联系人：<?=$item['contacts']?></p>
                    <p class="f_sectionDescribe fs_sectionDescribe" style="text-align:left">手机：<?=$item['contact_phone']?><br />Email：<?=$item['contact_email']?></p>
                </div>
                <div class="f_error"></div>
                <div class="f_submit">
                    <a id="sbt" class="f_submitBtn fs_submitBtn validate_submit">提交</a>
                </div>
            </form>
        </div>
    </div>
    <!--[if (IE 7)|(IE 8)]>
    <div class="f_main_ie_shadow"></div>
    <![endif]-->
    <div class="f_copyright">
        <a class="f_powerby fs_powerby" href="javascript:">
            由麦圈互动提供技术支持
        </a>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<script type="text/javascript" src="/js/form.js?m=20160325"></script>
<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="//cdn.bootcss.com/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.standalone.css" rel="stylesheet">
<script src="//cdn.bootcss.com/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap-datepicker/1.6.0/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<script>
    jQuery(function ($) {
        $('#founding_time').datepicker({
            format: 'yyyy-mm-dd',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
    })
    $("input,select").focus(function(){
        $(this).closest('.f_component').addClass('fs_component');
    }).blur(function(){
        $(this).closest('.f_component').removeClass('fs_component')
    });

    function show_error(obj, msg){
        if (obj.prev().has('label').length < 1) {
            obj.prevAll('.f_cTitle').append('<label class="error">' + msg + '</label>');
        } else {
            console.log(obj.prev().find('label'));
            $(obj.prev().find('label')[0]).text(msg);
        }
    }


    $('.f_submitBtn').click(function(){
        var flag = true;
        $('#submit-form').find('input').each(function(){
            if ($(this).data('type') ==  'name' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this), '用户名不能为空');
                    flag = false
                }
            }
            if ($(this).data('type') ==  'founding_time' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this), '成立时间不能为空');
                    flag = false
                }
            }
            if ($(this).data('type') ==  'primary_business' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this), '主营业务及产品不能为空');
                    flag = false
                }
            }
            if ($(this).data('type') ==  'mobile' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this), '手机号码不能为空');
                    flag = false;
                }
                else {
                    var pattern=/(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;

                    if(!pattern.test($.trim(this.value))) {
                        show_error($(this), '手机号码格式不正确');
                        flag = false;
                    }
                }
            }
            if($(this).data('type') == 'email') {
                if($.trim(this.value) == '') {
                    show_error($(this),'邮箱不能为空');
                    flag = false;
                }
                else {
                    var reg=/^[a-z0-9](\w|\.|-)*@([a-z0-9]+-?[a-z0-9]+\.){1,3}[a-z]{2,4}$/i;
                    if(!reg.test($.trim(this.value))) {
                        show_error($(this), '邮箱格式不正确');
                        flag = false;
                    }
                }
            }

            if ($(this).data('type') ==  'company' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this), '公司名称不能为空');
                    flag = false
                }
            }
        });

        $('#submit-form').find('select').each(function () {
            if ($(this).data('type') ==  'age' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this).parent(), '请选择年龄');
                    flag = false
                }
            }
            if ($(this).data('type') ==  'position' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this).parent(), '请选择职位');
                    flag = false
                }
            }
            if ($(this).data('type') ==  'industry_id' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this).parent(), '请选择企业分类');
                    flag = false
                }
            }
            if ($(this).data('type') ==  'enterprise_nature' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this).parent(), '请选择企业性质');
                    flag = false
                }
            }
            if ($(this).data('type') ==  'scale' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this).parent(), '请选择企业规模');
                    flag = false
                }
            }
        });

        if(flag){
            $("#submit-form").submit();
        }
        return false;
    });
</script>
</body>
</html>