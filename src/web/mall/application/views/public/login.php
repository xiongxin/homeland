<div class="container itemdetail mini-innner">
    <div class="row">
        <div class="col-md-12 p0">
            <div class="wx_bar">
                <div class="wx_bar_back"><a id="indexBack" href="javascript:goback();"></a></div>
                <div class="wx_bar_tit">会员登陆</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 tal mt20">
                        <form action="/member/login.html" method="post" id="theForm" class="form-signin" role="form">
            <input type="hidden" name="formhash" value="security553362bd9e0c3" />
            <input type="hidden" name="forward" value="http://wx.aimbeauty.cn/payment_js/" />
              <input name="account" type="text" style="margin-bottom: -2px;" class="form-control" placeholder="帐户名/手机号码" required autofocus>
              <br />
              <input name="password" type="password" class="form-control" placeholder="请输入密码" required>
              <label class="checkbox"><input type="checkbox" checked value="remember-me"> 记住我

                <a href="/index/public/forget.html"  style="float:right">忘记密码</a>
                </label>

                <div class="clear"></div>
                <div class="col-xs-5 p0">
                    <button type="submit" class="btn btn-warning btn-block">登  陆</button>
                </div>
                <div class="col-xs-2 p0"></div>
                <div class="col-xs-5 p0">
                    <button type="button" class="btn btn-default btn-block" onClick="location.href='/register.html'">注  册</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('#theForm').submit(function(){
        var account = $('input[name=account]').val();
        if($.trim(account) == '') {
            floatNotify.simple('请输入您的用户名','',2E3);
            return false;
        }
        var password = $('input[name=password]').val();
        if($.trim(password) == '') {
            floatNotify.simple('请输入您的登录密码','',2E3);
            return false;
        }
    });
});
</script>