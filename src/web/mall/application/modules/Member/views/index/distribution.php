<?php $url = DOMAIN.'/spread?cpsid='.$cpsid;?>
<style>
.itemdetail{ background: #fff;}
/* 分销 */
.fx_t_count{ width: 100%;overflow: hidden;}
.fx_t_count_l{width:110px;border:5px solid #ddd;float:left;}
.fx_t_count_l img{width:100%;}
.fx_t_count_r{width:100%;padding-left: 12px; padding-top:5px; padding-left: 120px;}
.fx_t_count_r_t{color:#000;font-size: 14px;height: 40px;line-height: 20px;overflow: hidden;}
.fx_t_count_r_c{color:#f63234;font-size: 16px;float: left;}
.fx_t_count_r_b{padding-top: 3px;overflow: hidden;padding-top: 15px;}
.fx_bg_bor{height:8px;background:#eee;margin-top: 5px;clear: both;}
.fx_cen_z{line-height: 40px;height: 40px;border-bottom:1px solid #e5e5e5;padding-left: 10px;padding-right: 10px;}
.fx_cen_z_l{float:left;color:#6a94e7;}
.fx_fx{}
.fx_fx_tit{color:#f63234;padding-top: 15px;font-size:12px;}
.fx_fx_text{padding-top: 5px;}
.fx_bot_cou_l span{color:#000;margin-right: 3px;}
</style>
<header class="header">
    <div class="fix_nav">
        <div class="nav_inner">
            <a class="nav-left back-icon" href="javascript:goback();">返回</a>
            <div class="tit">我要分享</div>
        </div>
    </div>
</header>

<div class="container itemdetail">
    <div class="row">
        <div class="col-md-12 p10">
            <?php if(isset($item['id'])):?>
            <?php $url = DOMAIN.'/product/detail/goods_id/'.$item['id'].'.html?cpsid='.$cpsid;?>
            <div class="fx_t_count">
                <div class="fx_t_count_l" id="share_for_money">

                </div>
                <div class="fx_t_count_r">
                    <div class="fx_t_count_r_t"><?php echo $item['title']?></div>

                    <div class="fx_t_count_r_b">
                        <div class="fx_t_count_r_c">￥<?php echo price_format($item['price'])?></div>

                    </div>

                    <div style="color:#999;text-decoration:line-through;padding-top: 3px;">￥ <?php echo price_format($item['market_price'])?></div>
                </div>
            </div>
            <?php endif;?>

            <?php if(isset($item['id']) || $shopkeeper):?>

                <div class="fx_cen_z">
                    <span class="fx_cen_z_l">您的专属分享链接</span>
                </div>
                <div class="fx_fx form-group">
                    <div class="fx_fx_tit">你可以复制后直接分享微信朋友或朋友圈哦</div>
                    <div id="textarea_c" style="display:none;"><?=$url?></div>
                    <div class="fx_fx_text">
                        <input id="target" class="form-control" value="<?=$url?>" />
                    </div>
                    <?php if($type == 'custom'):?>
                    <div class="fx_fx_tit" style="color: #006666">请直接填写分享的内容语言</div>
                    <div class="fx_fx_text">
                        <textarea id="share_content" class="form-control" rows="3"><?=$item['meta_description']?></textarea>
                    </div>
                    <?php else:?>
                        <input type="hidden" id="share_content" value="<?=$item['meta_description']?>" />
                    <?php endif;?>
                </div>

                <div class="row form-group">
                    <div class="col-xs-12"><button type="button" class="btn btn-info btn-block" onClick="javascript:;" id="share_btn">我要分享</button></div>
                </div>
                <div class="alert alert-info" role="alert">
                    <h4>分享提示：</h4>
                    <ul>
                        <li>请按住分享文字链接并复制链接在微信朋友圈发布；</li>
                        <li>您的好友通过您分享链接注册成为“天天加油”会员,TA将成为您的推荐会员；</li>
                        <li>您推荐的好友任何时候在“天天加油”购买产品，你可以获得佣金（可以提现）；</li>
                        <li>您好友的好友在“天天加油”购买产品，您又可以获得佣金。</li>
                    </ul>
                </div>
                <p class="alert alert-success" role="alert">*说明：您的分享链接都带有身份标识，您的好友访问并注册后，系统会自动统计。如有疑问，请及时联系“天天加油”客服人员。全国服务热线：0755-32917786。</p><!--说明：可以根据需要调用不同class，bg-primary蓝色背景、bg-success浅绿色背景、bg-info淡蓝色背景、bg-warning浅黄色背景、bg-danger浅红色背景-->
            <?php else:?>
                <div class="container">
                    <div class="alert alert-danger" role="alert" style="font-size: 18px;">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        很抱歉，您还未开店，我们需要购买1元加盟，或者买任意一个商品即可以成为店铺大掌柜。成为店铺大掌柜后，您可以分享“店铺推广海报”和“店铺推广链接”给好友，发展更多地会员，将为您赚更多的钱。
                    </div>
                    <a href="/product/detail/goods_id/16.html" class="btn btn-success btn-block">1元购买加盟，立即成为店铺大掌柜</a>
                </div>
            <?php endif;?>

        </div>
    </div>
</div>
<?php include APP_PATH.'views/common/share.php'?>

<script type="text/javascript" src="/misc/js/qrcode/jquery.qrcode.js"></script>
<script type="text/javascript" src="/misc/js/qrcode/qrcode.js"></script>
<script type="text/javascript"><!--分享按钮-->
    wx.ready(function () {

        var desc = $("#share_content").val();
        var shareData = {
            title: '<?=$item['title']?>',
            desc: desc,
            link: '<?=$url?>',
            imgUrl: '<?=$item['pic'][0]?>',
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        };

        var shareTimeLineData = {
            title: desc,
            link: '<?=$url?>',
            imgUrl: '<?=$item['pic'][0]?>',
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        };
	
        wx.onMenuShareAppMessage(shareData);
        wx.onMenuShareTimeline(shareTimeLineData);
        wx.onMenuShareQQ(shareData);
        wx.onMenuShareWeibo(shareData);
	
	$("#share_content").keydown(function(){
	    shareData.desc = this.value;
	    shareTimeLineData.title = this.value;
            wx.onMenuShareAppMessage(shareData);
            wx.onMenuShareTimeline(shareTimeLineData);
            wx.onMenuShareQQ(shareData);
            wx.onMenuShareWeibo(shareData);
        })
    });

    $(document).ready(function(){
        $('#share_for_money').qrcode({
            text	: "<?=$url?>",
            width   : 100,
            height  : 100
        });
    });
</script>

