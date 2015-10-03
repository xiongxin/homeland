<header class="header">
    <div class="fix_nav">
        <div class="nav_inner">
            <a class="nav-left back-icon" href="javascript:goback();">返回</a>
            <div class="tit">加入家园</div>
        </div>
    </div>
</header>
<form id="reg-form" name="form" action="" class="form-horizontal" role="form"  method="post">
<div class="container itemdetail mini-innner category">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name" class="col-xs-offset-1 col-xs-2 control-label p0">企业名称：</label>
                <div class="col-sm-7 col-xs-9">
                  <input type="text" name="company" class="form-control" placeholder="请输入企业名称">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-xs-offset-1 col-xs-2 control-label p0">法人：</label>
                <div class="col-sm-7 col-xs-9">
                    <input type="text" name="corporation" class="form-control"  placeholder="请输入法人姓名">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-xs-offset-1 col-xs-2 control-label p0">手机号码：</label>
                <div class="col-sm-7 col-xs-9">
                  <input type="text" name="mobile" maxlength="11" class="form-control" id="mobile" placeholder="请输入您的手机号码">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-xs-offset-1 col-xs-2 control-label p0">地区：</label>
                <div class="col-sm-7 col-xs-9" id="city">

                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-6 mt10">
                  <button type="submit" class="btn btn-warning btn-lg" >申请加入家园</button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<block name="style">
<style>
    #city select{ width: 45%; float: left; }
    #city select:first-of-type{ margin-right: 15px;}
</style>
</block>
<block name="script">
<script src="/misc/js/linkagesel.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $.getJSON('/public/district.html',$.proxy(function(json){
        XBW.linkagesel.data = json;
        delete(json);

        XBW.linkagesel.selector  = "#city";
        XBW.linkagesel.init(
            {
                root:0,
                district:'district',
                selected:''
            }
        );
    }));
});
$("#reg-form").submit(function () {
    var data = $(this).serializeArray();
    var district = XBW.linkagesel.getParentsText($("#district").val());
    if(district == ''){
        floatNotify.simple("请选择地区！");
    }
    data.push({name:"city",value:district.join('|')})

    $.post(window.location.href,data,function(resp){
        floatNotify.simple(resp.msg);
        if(resp.status == '0'){
            setTimeout(function () {
                window.location = window.location;
            },1000)
        }
    },'json')
   return false;
});
</script>
</block>