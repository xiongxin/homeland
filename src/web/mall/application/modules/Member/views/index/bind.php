<header class="header">
    <div class="fix_nav">
        <div class="nav_inner">
            <a class="nav-left back-icon" href="javascript:goback();">返回</a>
            <div class="tit">绑定企业</div>
        </div>
    </div>
</header>
<div class="container tb_box">
    <form id="form1" action="#" method="post">
        <p>
        </p>
        <div class="alert alert-info alert-dismissable">
            您还未绑定企业，请填写企业名称和绑定编码进行绑定
        </div>
        <div class="panel panel-success">
            <div class="panel-body">

                <div class="form-group">
                    <input placeholder="企业名称" class="form-control" id="company" />
                </div>
                <div class="form-group">
                    <input placeholder="绑定编码" class="form-control" id="bind_code" />
                </div>
                <button class="btn btn-warning btn-block" type="button" id="submit">提  交</button>
            </div>
        </div>
    </form>
</div>
<block name="script">
<script>
$(document).ready(function(){
    $("#submit").click(function(){

        var company = $.trim($("#company").val());
        if(company == ''){

            floatNotify.simple('请输入企业名称！');
            return false;
        }
        var bind_code = $.trim($("#bind_code").val());
        if(bind_code == ''){

            floatNotify.simple('请输入绑定编码！');
            return false;
        }
        var $this = $(this);
        $this.prop('disabled',true);
        $.post('/member/index/bind.html',{company:company,bind_code:bind_code},function(resp){
            floatNotify.simple(resp.msg);
            if(resp.status == '0'){
                setTimeout(function(){
                    window.location = '/member/index/index.html';
                },1000)
            }
        },'json').always(function(){
            $this.prop('disabled',false);
        })
    })
});
</script>
</block>