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
            color: #ae7ac5
        }

        .fs_component {
            background-color: #cab8d3;
            color: #7c4593
        }

        .fs_header {
            background-color: #9553b1;
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
<img src="https://asset-mikecrm-com.alikunlun.com/getimg/origin/images/formTemplate/img-bmsq-0-0.jpg" "="" class="fs_fixbackground" />
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
            <form action="" id="submit-form" method="post">
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">您的姓名
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <input type="text" id="name" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">手机号码
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <input type="text" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">年龄
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <div class="f_select medium">
                        <select class="insideSelect fs_content fs_input">
                            <option value=""> 请选择 </option>
                            <option value="1"> 30-40岁 </option>
                            <option value="2"> 40-50岁 </option>
                            <option value="3"> 50岁以上 </option>
                        </select>
                    </div>
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">
                        职位
                        <span class="f_cValidate fs_cValidate">*</span>
                    </p>
                    <div class="f_select medium">
                        <select class="insideSelect fs_content fs_input">
                            <option value=""> 请选择 </option>
                            <option value="1"> 董事长 </option>
                            <option value="2"> 总裁 </option>
                            <option value="3"> 总经理 </option>
                            <option value="4"> 其他 </option>
                        </select>
                    </div>
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">公司名称<span class="f_cValidate fs_cValidate">*</span></p>
                    <p class="f_cDescribe fs_cDescribe">请填写真实公司名称</p>
                    <input type="text" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle">推荐人</p>
                    <p class="f_cDescribe fs_cDescribe">选填，请填写推荐人手机号码</p>
                    <input type="text" class="input medium fs_content fs_input" value="" />
                </div>
                <div class="f_component">
                    <p class="f_cTitle fs_cTitle" style="text-align:left">活动联系人：<?=$item['contacts']?></p>
                    <p class="f_sectionDescribe fs_sectionDescribe" style="text-align:left">手机：<?=$item['contact_phone']?><br />Email：<?=$item['contact_email']?></p>
                </div>
                <div class="f_error"></div>
                <div class="f_submit">
                    <a class="f_submitBtn fs_submitBtn validate_submit">提交</a>
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
<script>
    $("input,select").focus(function(){
        $(this).closest('.f_component').addClass('fs_component');
    }).blur(function(){
        $(this).closest('.f_component').removeClass('fs_component')
    });

    function show_error(obj){
        obj.prevAll('.f_cTitle').append('<label class="error">此项为必填项</label>');
    }

    $('.f_submitBtn').click(function(){
        var flag = false;
        $('#submit-form').find('input').each(function(){
            if($.trim(this.value) == ''){
                show_error($(this));
                flag = true;
            }
        });

        $('#submit-form').find('select').each(function () {
            if($.trim(this.value) == ''){
                show_error($(this).parent());
                flag = true;
            }
        });

        if(!flag){
            layer.alert('验正通过！');
        }
        return false;
    });
</script>
</body>
</html>