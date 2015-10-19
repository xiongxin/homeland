<!DOCTYPE html>
<html lang="zh-cn">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="yes" name="apple-touch-fullscreen"/>
<meta content="telephone=no" name="format-detection"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1;user-scalable=no;">
<title>民族企业家园<?=isset($meta_title) ? '|'.$meta_title : ''?></title>
<meta name="Author" Content="" />
<meta name="Copyright" Content="深圳麦圈互动技术有限公司。All Rights Reserved" />

<link rel="stylesheet" href="/v2/css/bootstrap.min.css">
<link rel="stylesheet" href="/v2/css/style.css?<?=md5_file('v2/css/style.css')?>">
<?php if(isset($block['style'])) echo $block['style']; ?>
</head>

<body>
<div class="fanhui"><img src="/misc/images/bot_top.png"></div>
<?php $user = session('user_auth');?>
<?php if(intval($user['subscribe']) < 1):?>
<div class="z-up-ewm">
    <div class="z-up-ewm-img">
        <div class="z-up-ewm-pic" style="z-index: 1;"><img src="/misc/images/qrcode_for_gh_d45276cc2d2e_258.jpg"></div>
        <div class="z-up-ewm-text">
        <?php if(isset($layout['alert_msg'])):?>
            <?=$layout['alert_msg'];?>
        <?php else:?>
            <p>长按二维码关注我们</p>
            <p>裂变渠道</p>
            <p>倍增现金流</p>
        <?php endif;?>
        </div>
    </div>
</div>
<?php endif;?>

<?php echo $content?>
<div class="foot_index">
    <div class="foot_index_tit">Powered by 深圳麦圈互动技术有限公司</p></div>
</div>

<footer class="footer">
    <div class="foot-con">
        <div class="foot-con_2">
            <a href="/">
                <i class="glyphicon glyphicon-home"></i>
                <span class="text">首页</span>
            </a>
            <a href="/article/list/cate_id/50.html">
                <i class="glyphicon glyphicon-flag"></i>
                <span class="text">家园课程</span>
            </a>
            <a href="/member/index/index.html">
                <i class="glyphicon glyphicon-user"></i>
                <span class="text">会员中心</span>
            </a>
        </div>
    </div>
</footer>

<script type="text/javascript" src="/v2/js/jquery.min.js"></script>
<script type="text/javascript" src="/misc/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="/v2/js/global.js?20150909"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script type="text/javascript">
    wx.config({
        appId: '<?php echo $js_sign['appid']?>',
        timestamp: <?php echo $js_sign['timestamp']?>,
        nonceStr: '<?php echo $js_sign['noncestr']?>',
        signature: '<?php echo $js_sign['signature']?>',
        jsApiList: [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'scanQRCode'
        ]
    });

    var shareData = {
        title: '民族企业家园',
        desc: '一个做生意的平台，一个结交高端人脉的平台，一个企业家所创造的“一个温暖的大家庭”，同时也是一个企业家俱乐部，让你在紧张工作中放松自己',
        link: window.location.href,
        imgUrl: '<?=DOMAIN?>/misc/images/logo.jpg',
        fail: function (res) {
            alert(JSON.stringify(res));
        }
    };

    var shareTimeLineData = {
        title: '一个做生意的平台，一个结交高端人脉的平台，一个企业家所创造的“一个温暖的大家庭”，同时也是一个企业家俱乐部，让你在紧张工作中放松自己',
        link: window.location.href,
        imgUrl: '<?=DOMAIN?>/misc/images/logo.jpg',
        fail: function (res) {
            alert(JSON.stringify(res));
        }
    };
    wx.ready(function () {

        wx.onMenuShareAppMessage(shareData);
        wx.onMenuShareTimeline(shareTimeLineData);
        wx.onMenuShareQQ(shareData);
        wx.onMenuShareWeibo(shareData);
    });

    wx.error(function (res) {
        alert('wx.error: '+JSON.stringify(res));
    });
    $(function(){
        $(window).scroll(function(){
            if($(this).scrollTop()>500){
                $(".fanhui").fadeIn(1500);
            }else{
                $(".fanhui").fadeOut(1500);
            }
        });
        $(".fanhui").click(function(){
            $("body,html").animate({scrollTop:0},1000);
            return false;
        });
    });
</script>
<?php if(isset($block['script'])) echo $block['script']; ?>
</body>
</html>
