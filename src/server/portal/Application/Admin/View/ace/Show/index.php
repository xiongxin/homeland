
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{$item['title']}</title>
    <meta name="format-detection" content="telephone=no, address=no">
    <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <link rel="shortcut icon" href="/attachment/images/global/wechat.jpg" />
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript" src="/app/resource/js/app/util.js"></script>
    <script src="/app/resource/js/require.js"></script>
    <script src="/app/resource/js/app/config.js"></script>
    <script type="text/javascript" src="/app/resource/js/lib/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/app/resource/js/lib/mui.min.js"></script>
    <script type="text/javascript" src="/app/resource/js/app/common.js"></script>
    <link href="/app/resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="/app/resource/css/common.min.css" rel="stylesheet">
    <script type="text/javascript">
        if(navigator.appName == 'Microsoft Internet Explorer'){
            if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
        window.sysinfo = {
            'uniacid': '2',		'acid': '2',				'siteroot': '/',
            'siteurl': '/app/index.php?i=2&c=home&a=page&id=1',
            'attachurl': '/attachment/',
            'attachurl_local': '/attachment/',
            'attachurl_remote': '',
            'cookie' : {'pre': '2f17_'}
        };
        // jssdk config 对象
        jssdkconfig = null || {};
        // 是否启用调试
        jssdkconfig.debug = false;
        jssdkconfig.jsApiList = [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'
        ];
    </script>
</head>
<body>
<div class="container container-fill">
    {item['html']}
    <script type="text/javascript" src="./resource/js/app/common.js"></script>				
    <div class="text-center footer" style="margin:10px 0; width:100%; text-align:center; word-break:break-all;">
        <a href="http://www.012wz.com">关于微赞</a>&nbsp;&nbsp;<a href="http://bbs.012wz.com">微赞帮助</a>								&nbsp;&nbsp;			</div>
    <script>require(['bootstrap']);</script>
</div>
<style>
    h5{color:#555;}
</style>
<script type="text/javascript">
    $(function(){
        wx.config(jssdkconfig);
        var $_share = {"desc":"","title":"\u5fae\u9875\u9762\u6807\u9898","imgUrl":"","link":"http:\/\/weizan.me\/app\/index.php?i=2&c=home&a=page&id=1"};
        if(typeof sharedata == 'undefined'){
            sharedata = $_share;
        } else {
            sharedata['title'] = sharedata['title'] || $_share['title'];
            sharedata['desc'] = sharedata['desc'] || $_share['desc'];
            sharedata['link'] = sharedata['link'] || $_share['link'];
            sharedata['imgUrl'] = sharedata['imgUrl'] || $_share['imgUrl'];
        }
        if(sharedata.imgUrl == ''){
            var _share_img = $('body img:eq(0)').attr("src");
            if(_share_img == ""){
                sharedata['imgUrl'] = window.sysinfo.attachurl + 'images/global/wechat_share.png';
            } else {
                sharedata['imgUrl'] = util.tomedia(_share_img);
            }
        }
        if(sharedata.desc == ''){
            var _share_content = util.removeHTMLTag($('body').html());
            if(typeof _share_content == 'string'){
                sharedata.desc = _share_content.replace($_share['title'], '')
            }
        }
        wx.ready(function () {
            wx.onMenuShareAppMessage(sharedata);
            wx.onMenuShareTimeline(sharedata);
            wx.onMenuShareQQ(sharedata);
            wx.onMenuShareWeibo(sharedata);
        });
        if($('.js-quickmenu')!=null && $('.js-quickmenu')!=''){
            var h = $('.js-quickmenu').height()+'px';
            $('body').css("padding-bottom",h);
        }else{
            $('body').css("padding-bottom", "0");
        }
    });
</script>
</body>
</html>
