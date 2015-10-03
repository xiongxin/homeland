<!DOCTYPE html>
<html lang="zh-cn">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="yes" name="apple-touch-fullscreen"/>
<meta content="telephone=no" name="format-detection"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1;user-scalable=no;">
<title>天天加油油站导航</title>
<meta name="keywords" content="天天加油,SDP,专业汽车服务电商平台">
<meta name="description" content="专业汽车服务电商平台，产品包括加油卡、汽车配件、汽车美容，以及油站和油品的专业知识介绍">
<meta name="Author" Content="" />
<meta name="Copyright" Content="深圳麦圈互动技术有限公司。All Rights Reserved" />

<link rel="stylesheet" href="/v2/css/bootstrap.min.css?t=14294111">
<style>
#map_canvas *{box-sizing:content-box;}
.form-inline .form-control{ width: 49%; display: inline-block;}
.form-inline .form-control:first-of-type{ margin-right: 5px;}
</style>
<script src="/misc/js/jquery.min.js"></script>
</head>
<body class="">

<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php if(!is_not_wx()):?>
    <script>
        <?php $js_sign = $layout['js_sign'];?>
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
                'onMenuShareWeibo'
            ]
        });

        wx.ready(function () {
        });

        wx.error(function (res) {
            alert('wx.error: '+JSON.stringify(res));
        });


    </script>
<?php endif; ?>

<div id="map_canvas">

</div>

<div class="container" id="mapSearch">
    <form class="form-horizontal" style="">
        <div class="form-group form-inline" style="padding-top: 20px;">
            <div class="col-xs-12" id="city">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-8">
                <input type="text" class="form-control" id="gas_name" name="gas_name" placeholder="加油站" />
            </div>
            <div class="col-xs-4">
                <button type="button" class="btn btn-primary btn-block" id="search-btn">搜索</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=GGu3wNgCtnBMIOmeL0iYNqrG"></script>
<script type="text/javascript" src="http://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
<script src="/misc/js/linkagesel.js?112233"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $.getJSON('/public/gascity',$.proxy(function(json){
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

        var data =  [];
        var _self = <?php echo json_encode($_self);?>;
        $("#map_canvas").height($(window).height()-document.getElementById("mapSearch").offsetHeight-34);

        // 百度地图API功能
        var map = new BMap.Map("map_canvas");
        function init() {

            var point = new BMap.Point(_self.longitude, _self.latitude);
            map.centerAndZoom(point, 14);
            var marker = new BMap.Marker(point);
            map.addOverlay(marker);


            var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
            var top_left_navigation = new BMap.NavigationControl({type: BMAP_NAVIGATION_CONTROL_SMALL});  //左上角，添加默认缩放平移控件
            var mapType2 = new BMap.MapTypeControl({anchor: BMAP_ANCHOR_TOP_RIGHT});

            map.addControl(top_left_control);
            map.addControl(top_left_navigation);
            map.addControl(mapType2);

            map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
            map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用

            initMarker();
        }

        function initMarker(){
            $.each(data, function (k, gas) {
                var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
                    '<br/>地址：' + gas.address +
                    '</div>';
                //创建检索信息窗口对象
                var searchInfoWindow = null;

                searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
                    title: gas.name,      //标题
                    width: 290,             //宽度
                    panel: "panel",         //检索结果面板
                    enableAutoPan: true,     //自动平移
                    searchTypes: [
                        BMAPLIB_TAB_SEARCH,   //周边检索
                        BMAPLIB_TAB_TO_HERE,  //到这里去
                        BMAPLIB_TAB_FROM_HERE //从这里出发
                    ]
                });

                var pt = new BMap.Point(gas.latitude, gas.longitude);
                //谷歌坐标转百度坐标
                BMap.Convertor.translate(pt, 2, function (point) {
                    var myIcon = new BMap.Icon("/misc/images/gas-pump.png", new BMap.Size(24, 25));
                    var marker2 = new BMap.Marker(point, {icon: myIcon});  // 创建标注
                    marker2.addEventListener("click", function (e) {
                        searchInfoWindow.open(marker2);
                    })
                    map.addOverlay(marker2);
                });
            })
        }

        $("#search-btn").click(function(){
            var city = $("#city select option:selected").text().replace('请选择','');
            var gas_name = $("#gas_name").val();
            if(city == '' && gas_name == ''){
                return false;
            }

            map.clearOverlays();
            data  = [];
            map.centerAndZoom(city,14);

            setTimeout(function(){
                center = map.getCenter();
                $.get('/public/station',{latitude:center.lat,longitude:center.lng,keyword:gas_name},function (d){
                    data = d.list;

                    if(d.errcode!=0){
                        alert("数据读取错误，请重试!");
                        return ;
                    }
                    if(gas_name != '' && data.length > 0){
                        var pt = new BMap.Point(data[0].latitude, data[0].longitude);
                        map.centerAndZoom(pt,14);
                    }
                    initMarker();
                },'json');
            },1000)
        });

        <?php if(is_not_wx()):?>
        callback_fun({latitude:22.604136,longitude:114.051979});
        <?php else:?>
        wx.ready(function (){
            wx.getLocation({
                success: callback_fun
            });
        });
        <?php endif;?>
        function callback_fun(res){
            _self.latitude =  res.latitude;
            _self.longitude =  res.longitude;
            $.get('/public/station',res,function (d){
                data = d.list;
                if(d.errcode!=0){
                    alert("数据读取错误，请重试!");
                    return ;
                }
                init();
            },'json');
        }
    });
</script>
</body>
</html>
