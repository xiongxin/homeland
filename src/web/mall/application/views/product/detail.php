<style type="text/css">
    .txt-imgs img{width: 100%;display: block;;}
    .wap_page{  width: 304px;
        margin: 15px auto 5px;
        text-align: center;}
    .wap_page span{display: inline-block;
        zoom: 1;
        padding: 8px 10px;
        color: #888888;
        border: 1px solid #d3d3d3;
        margin: 0 5px;}
    .container{margin-bottom: 10px; background-color:#fff;}

    .hd_2{position:fixed;height:40px;line-height: 40px;top:44px;top:0px;z-index:1000;background:#fff;border-bottom: 1px solid #e5e5e5;width:100%;max-width: 768px;}
    .hd_2 ul{margin:0px;border: 0 none;  outline: 0 none;padding:0px;}
    .hd_2 ul .on{border-bottom: 2px solid #f63234;color: #f63234;height: 40px;}
    .hd_2 ul li{cursor: pointer;float: left; font-size: 16px;text-align: center;width: 33.33%;}

    .pp_prop_attr dl{display: block;}
    .pp_prop_attr{width: 100%;float: left;margin:5px 0;}
    .pp_prop_attr dt, .pp_prop_attr dd {line-height: 34px;min-height: 34px;}
    .pp_prop_attr dt {color: #999;width: 80px;}
    .pp_prop_attr dt, .pp_prop_attr dd {float: left;line-height: 26px;min-height: 26px;}
    .pp_prop_attr dd {position: relative;margin-bottom: -5px;}
    .pp_prop_attr dt, .pp_prop_attr dd {line-height: 34px;min-height: 34px;}
    .pp_prop_attr dd {width: 80%;}
    ul, ol {list-style: none;}
    .pp_prop_attr li {display: inline;}
    .pp_prop_attr li a {float: left;border: 1px solid #e2e1e3;color: #333;height: 30px;line-height: 30px;padding: 1px 10px;margin: 0 5px 5px 0;white-space: nowrap;}
    .pp_prop_attr a:hover, .pp_prop_attr a.cur {border: 2px solid #d70000;padding: 0 9px;text-decoration: none;}

    .block-item {
        border: 1px #ddd solid;
        border-left: none;
        border-right: none;
        margin-top: 10px;;
        padding: 8px 0;
        font-size: 12px;
        color: #666;
    }

    .rz-img {
        background-position: -18px -30px;
        display: inline-block;
        height: 13px;
        vertical-align: middle;
        width: 13px;
    }
    .rz-img {
        background-image: url("http://dn-kdt-static.qbox.me/v2/image/wap/showcase/goods/goods_c9431a6d41.png");
        background-repeat: no-repeat;
        background-size: 58px 48px;
    }
    .goods-content p{ margin: 0;}
</style>

<header class="header" style="height: 44px;">
    <div class="fix_nav">
        <div class="nav_inner">
            <a class="nav-left back-icon" href="javascript:goback()">返回</a>
            <div class="tit">商品详情</div>
        </div>
    </div>
</header>
<div class="container" >
    <div class="row white-bg">
        <div id="slide">
            <div class="hd">
                <ul></ul>
            </div>
            <div class="bd">
                <ul>
                    <?php foreach ($item['pic'] as $pic):?>
                        <li><a href="#"><img _src="<?php echo show_pic($pic)?>" src="<?php echo show_pic($pic)?>"/></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="row gary-bg">
        <div class="buy-area white-bg p10">
            <h1 class="item-name"><?php echo $item['title']?></h1>
            <p class="p-origin">
                <em class="price"  id="priceSale">¥<?php echo price_format($item['price'])?></em>
                <span class="pull-right" style="color: #000;">
                    成交:<?=$item['sales_num']?>件
                </span>
            </p>
            <p class="mb0">
                <?php if($item['id'] != 16):?>
                <a class="pull-right btn btn-danger btn-xs btn-share" href="/member/index/distribution/goods_id/<?=$item['id']?>.html"><span class="glyphicon glyphicon-jpy" aria-hidden="true"></span>我要分享</a>
                <?php endif;?>
                <del class="old-price">¥<?php echo price_format($item['market_price'])?></del>
            </p>

            <div class="renzheng block-item">
                <span data-type="team_certificate_company" class="js-rz-item-alert rz-item">
                    <i class="rz-img"></i>
                    <span class="rz-name font-size-12 c-gray-darker">企业认证</span>
                </span>
                &nbsp; &nbsp;
                <span data-type="is_secured_transactions" class="js-rz-item-alert rz-item">
                    <i class="rz-img"></i>
                    <span class="rz-name font-size-12 c-gray-darker">担保交易</span>
                </span>
            </div>
        </div>
        <div id="goodsContent" class="goods-content white-bg">

            <div class="hd hd_fav">
                <ul>
                    <li>图文详情</li>
                    <li>评价(<?=$item['comment_total']?>)</li>
                </ul>
            </div>

            <div class="bd">
                <!-- 商品属性 -->
                <ul class="property tabconent">
                    <div class="prop-area" style="min-height:300px;overflow: hidden;">
                        <?=$item['description']?>
                    </div>
                </ul><!-- 商品属性END -->
                <ul class="appraise tabconent" rel='1' status='1'>
                    <div style="height:30px;">
                        <div id="ajax_loading" style="margin: 10px  auto 15px;text-align:center;"> <img src="/v2/images/loading.gif"  style="width: auto; display: block;  margin: auto;"/></div>
                    </div>
                    <div class="wap_page" style="display: none; cursor: pointer" onClick="next_comments(this)"><span>下一页</span></div>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="fixed-foot">
    <div class="fixed_inner">
        <!--
        <a class="btn-fav" href="javascript:;"><i class="i-fav"></i><span>收藏</span></a>
        <a class="cart-wrap" href="/cart/list">
            <i class="i-cart"></i>
            <span>购物车</span>
            <span class="add-num" id="totalNum">1</span>
        </a>
        -->
        <a class="cart-wrap">
            &nbsp;
        </a>

        <div class="buy-btn-fix">
            <!--
            <a class="btn btn-info btn-cart"  onClick="add_cart('<?php /*echo $item['id']*/?>',0,0)" href="javascript:;">加入购物车</a>
            -->
            <a class="btn btn-danger btn-buy"  onClick="add_cart('<?php echo $item['id']?>',0,0)"  href="javascript:;">立即购买</a>
        </div>
    </div>
</div>
<script>
    var hd_fav_top = 300;

    $(document).ready(function(){
        var hd_fav = $('.hd_fav');
        var position = hd_fav.position();
        hd_fav_top = position.top;
// 	alert('hd_fav_top'+hd_fav_top);
    });
    $(window).scroll(function(){
        if($(this).scrollTop()>hd_fav_top){
            $('#goodsContent .hd_fav').addClass('hd_2');
            $('#goodsContent .hd_fav').removeClass('hd');
        }else {
            $('#goodsContent .hd_fav').removeClass('hd_2');
            $('#goodsContent .hd_fav').addClass('hd');
        }
    });
</script>
<script type="text/javascript" src="/v2/js/TouchSlide.1.1.js"></script>
<script type="text/javascript" src="/v2/js/global.js"></script>
<script type="text/javascript">

    //http://www.superslide2.com/TouchSlide/index.html
    TouchSlide({
        slideCell:"#slide",
        titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        mainCell:".bd ul",
        effect:"left",
        autoPlay:true,//自动播放
        autoPage:true, //自动分页
        switchLoad:"_src" //切换加载，真实图片路径为"_src"
    });

    var scrollTop = 0;
    TouchSlide({
        slideCell:"#goodsContent",
        startFun:function(i,c){
            if(i==1){
                var th = jQuery("#goodsContent .bd ul.tabconent").eq(i);
                var p = th.attr('rel');
                var status = th.attr('status');

                if(!th.hasClass('hadConments') && status > 0){
                    $.getJSON('/product/comment/goods_id/<?=$item['id']?>?page='+p, function(json){
                        if(json.status == 1){
                            th.find('.wap_page').before(json.data).show();
                            th.find('#ajax_loading').parent().remove();
                            th.addClass('hadConments');
                            th.attr('rel',(parseInt(p)+1));
                            if(json.current_page >= json.page){
                                th.attr('status',0);
                            }
                        }else{
                            floatNotify.simple('没有评论！');
                            th.find('#ajax_loading').parent().remove();
                            th.attr('status',0);
                        }
                    });

                }

                if($(window).scrollTop() > scrollTop){
                    $(window).scrollTop(scrollTop);
// 				    alert(scrollTop);
                }
            }else{

                if(scrollTop == 0){
                    $(window).scrollTop(scrollTop);
                    var hd_fav = $('.hd_fav');
                    var position = hd_fav.position();

                    scrollTop = position.top;
                }
            }
        }
    });

    function next_comments(th2){
        var th = $(th2).parent();
        var p = th.attr('rel');
        var status = th.attr('status');
        if(status > 0){
            floatNotify.simple('正在加载中...');
            $.getJSON('/product/comment/goods_id/<?=$item['id']?>?page='+p, function(json){
                if(json.status == 1){
                    th.find('.wap_page').before(json.data);
                    th.attr('rel',(parseInt(p)+1));
                    if(json.current_page >= json.page){
                        th.attr('status',0);
                    }
                }else{
                    floatNotify.simple('已经是最后一页了！');
                    th.attr('status',0);
                }
            });
        }else{
            floatNotify.simple('已经是最后一页了！');
        }
    }
    function add_cart(product_id,is_gift,is_ajax ) {

        var qty = 1;
        url = "/cart/add?id="+product_id+'&qty='+qty

        if(is_gift == 1){
            url += '&is_gift=1';
        }
        if(is_ajax){
            $.getJSON(url, function(json){
                if(json.status  == '1'){
                    floatNotify.simple('已成功添加到购物车');
                } else {
                    floatNotify.simple(json.msg);
                }
            });
        } else {
            location.href=url;
        }
    }
</script>

