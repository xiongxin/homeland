<header class="header">
    <div class="fix_nav">
        <div class="nav_inner">
            <a class="nav-left back-icon" href="javascript:goback();">返回</a>
            <div class="tit">家园分布</div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div id="container" style=""></div>
    </div>
</div>
<block name="script">
    <script type="text/javascript" src="http://static.hcharts.cn/highmaps/highmaps.js"></script>
    <script type="text/javascript" src="/v2/js/cn-all-sar-taiwan.js"></script>

    <script>
        $(function () {

            var data = <?=$data?>;
            // Instanciate the map
            $('#container').highcharts('Map', {

                chart : {
                    borderWidth : 1
                },

                title : {
                    text : '家园分布图'
                },

                legend: {
                    layout: 'horizontal',
                    borderWidth: 0,
                    backgroundColor: 'rgba(255,255,255,0.85)',
                    floating: true,
                    verticalAlign: 'top',
                    y: 25
                },

                mapNavigation: {
                    enabled: true
                },

                colorAxis: {
                    min: 1,
                    type: 'logarithmic',
                    minColor: '#EEEEFF',
                    maxColor: '#000022',
                    stops: [
                        [0, '#EFEFFF'],
                        [0.67, '#4444FF'],
                        [1, '#000022']
                    ]
                },

                series : [{
                    animation: {
                        duration: 1000
                    },
                    mapData: Highcharts.maps['countries/cn/custom/cn-all-sar-taiwan'],
                    joinBy: ['postal-code', 'code'],
                    data:data,
                    dataLabels: {
                        enabled: true,
                        color: 'white',
                        format: '{point.name}'
                    },
                    name: '家园',
                    tooltip: {
                        pointFormat: '{point.name}: {point.value}'
                    }
                }]
            });
        });
    </script>
</block>