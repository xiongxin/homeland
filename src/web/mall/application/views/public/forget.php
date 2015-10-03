<form  id="form" name="form" action="" class="form-horizontal" role="form"  method="post">
<div class="container itemdetail mini-innner">
    <div class="row">
        <div class="col-md-12 p0">
            <div class="wx_bar">
                <div class="wx_bar_back"><a id="indexBack" href="javascript:goback();"></a></div>
                <div class="wx_bar_tit">重置密码</div>
            </div>
        </div>
    </div>
    <div class="row mt20">
        <div class="col-md-12">
            <script type="text/javascript">
            /**
             * 倒计时函数
             * 需要在按钮上绑定单击事件
             * 如: <input value="发送短信" data-cke-editable="1" data-cke-pa-onclick="setInterval('mycountDown(this,30)',1000);" contenteditable="false" type="button">
             * 30代表秒数，需要倒计时多少秒可以自行更改
             */
            function mycountDown(obj,second){
                var mobile = $('input[name=mobile]').val();
                if($.trim(mobile) == ''){
                    floatNotify.simple('请输入您的手机号码');
                    return false;
                } else {
            
                // 如果秒数还是大于0，则表示倒计时还没结束
                if(second>=0){
            
                      // 获取默认按钮上的文字
                    if(typeof buttonDefaultValue === 'undefined' ){
                        buttonDefaultValue =  obj.val();
                        buttonClickValue =  "发送短信中";
                    }
                    // 按钮置为不可点击状态
                    obj.attr('disabled', true);
                    // 按钮里的内容呈现倒计时状态
                    obj.val(buttonClickValue+'('+second+')');
                    // 时间减一
                    second--;
                    // 一秒后重复执行
                    setTimeout(function(){mycountDown(obj,second);},1000);
                // 否则，按钮重置为初始状态
                }else{
                    // 按钮置未可点击状态
            
                    obj.attr('disabled', false);
                    // 按钮里的内容恢复初始状态
                    obj.val(buttonDefaultValue);
                }
                }
            }
            </script>


            <div class="form-group">
                <label for="phone" class="col-xs-offset-1 col-xs-3 control-label p0">手机：</label>
                <div class="col-sm-7 col-xs-8">
                    <input type="text" name="mobile" maxlength="11" class="form-control" id="mobile" placeholder="请输入您的手机号码">
                </div>
            </div>
            
            <div class="form-group">
                <label for="code" class="col-xs-offset-1 col-xs-3 control-label p0">验证码：</label>
                <div class="col-sm-4 col-xs-4 pr0">
                    <input type="text" name="mobile_code" class="form-control" id="mobile_code" placeholder="请输入验证码">
                </div>
                <div class="col-sm-3 col-xs-4">
                    <input type="button" class="form-control btn-sm btn-primary get_mobile_code"  value="获取验证码">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-xs-offset-1 col-xs-3 control-label p0">新密码：</label>
                <div class="col-sm-7 col-xs-8">
                    <input type="password" name="password" class="form-control" id="password" placeholder="请输入您新的密码">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-xs-offset-1 col-xs-3 control-label p0">确认新密码：</label>
                <div class="col-sm-7 col-xs-8">
                    <input type="password" name="confirm" class="form-control" id="confirm" placeholder="请再次输入您新的密码">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-6 mt10">
                    <button type="button" onclick="formSubmit();"class="btn btn-warning vip_reg btn-lg" >确认</button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top:160px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
      </div>
      <div class="modal-body tac">


      </div>
    </div>
  </div>
</div>

<script type="application/javascript" src="/misc/js/jquery.form.js"></script>

<script type="text/javascript">

function countDown(secs,surl){

 //alert(surl);
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs;
 if(--secs>0){
     setTimeout("countDown("+secs+",'"+surl+"')",1000);
 }
 else{
     location.href=surl;
     }
}
$(".close").click(function(){
    $("#myModal").removeClass(" in share-block");
    var parent = document.getElementById("myModal");
    parent.className = parent.className + " share-none";
});
function formSubmit(){
        var obj = $('.vip_reg');

        var mobile = $('input[name=mobile]').val();
        if($.trim(mobile) == ''){
        floatNotify.simple('请输入您的手机号码');
        return false;
        }
        //obj.attr('disabled', true);

        $('#form').ajaxSubmit({
            dataType:"json",
            success: function(json) {
                obj.attr('disabled', false);

                if(json.success==true){


                    location.href='/member/login.html';

                } else {
                    floatNotify.simple(json.msg);
                }
            }
        });
        return false;
}
$(document).ready(function(){
    $('.get_mobile_code').click(function(){


         var mobile = $('input[name=mobile]').val();
         if($.trim(mobile) == ''){
            floatNotify.simple('请输入您的手机号码');
            return false;
         }

         var sex = $('input[name=sex]').val();

         obj = $(this);
         obj.attr('disabled', true);
         $.post('/card/smscode2.html?in_ajax=1&_='+Math.random(),{mobile:mobile},function(res){
            if(res.status == 1)
            {
                mycountDown(obj,30);
                floatNotify.simple(res.msg);
            }
            else
            {
                $(".ui-loader").remove();
                floatNotify.simple(res.msg);
                obj.attr('disabled', false);
            }
        },'json');

    });
});

</script>