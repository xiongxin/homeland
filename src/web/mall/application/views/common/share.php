<style>
/*share*/
#share-overlay {position: fixed;top: 0;left: 0;width: 100%; height: 100%; z-index: 1000;opacity: 0.8; cursor: pointer; display: block; background-color: rgb(119, 119, 119);}
#share-wrap {position: fixed; top: 0px; left: auto; padding:0px; margin:0 auto; text-align:center;z-index: 1100;opacity: 1;outline: none;display: block;}
.share-none{display:none!important;}
.share-block{display:block!important;}
.share_txt{color:#fff; font-size:2em;text-align:left;}
.share_txt img{border:0; height: 25px; vertical-align: top; width: 25px; display:inline-block; margin:5px 0;}
</style>
<div id="share-overlay" style="display:none;"></div>
<div id="share-wrap" style="z-index: 1101;opacity: 1; margin:0 auto;width:100%;outline: none;display: none;">
    <div class="share_txt" style="font-size:16px;margin:0 auto; text-align: center;">
        <p class="mt10">方法一:&nbsp;&nbsp;点击右上角<img src="/misc/images/icon_share.png">图标</p>
        <p>然后 <img src="/misc/images/icon_msg.png"> 发送给朋友</p>
        <p>或 <img src="/misc/images/icon_timeline.png"> 分享到朋友圈</p>
        <p class="mt20">方法二:&nbsp;&nbsp;邀请好友扫二维码</p>
    </div>
    <p id="qrcode_wrap2" style="margin: 0 auto; padding: 10px; background: #fff; width: 200px; height: 200px;">
        <img src="<?=$qrcode?>" width="183" />
    </p><!--这个是二维码-->
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $("#share-overlay").click(function(){
            var parent = document.getElementById("share-overlay");
            $("#share-overlay").removeClass("share-block");
            parent.className = parent.className + " share-none";
            var parent2 = document.getElementById("share-wrap");
            $("#share-wrap").removeClass("share-block");
            parent2.className = parent2.className + " share-none";
        });
        $("#share-wrap").click(function(){
            var parent3 = document.getElementById("share-overlay");
            $("#share-overlay").removeClass("share-block");
            parent3.className = parent3.className + " share-none";
            var parent4 = document.getElementById("share-wrap");
            $("#share-wrap").removeClass("share-block");
            parent4.className = parent4.className + " share-none";
        });
        $("#share_btn,.share_btn").click(function(){
            var parent5 = document.getElementById("share-overlay");
            $("#share-overlay").removeClass("share-none");
            parent5.className = parent5.className + " share-block";
            var parent6 = document.getElementById("share-wrap");
            $("#share-wrap").removeClass("share-none");
            parent6.className = parent6.className + " share-block";
        });
    });
</script>