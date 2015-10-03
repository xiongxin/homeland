<?php if($shopkeeper):?>
    <?php if($userid == is_login()):?>
    <div class="alert alert-success mb0" role="alert">
        <?php
        $tip_titles = [
                        '',
                        '海报主要投放到有车的群体，如滴滴专车群、优步专车群等，投放方式：',
                        '海报主要投放到微商群体，如某某微商群、某某代理群、某某加盟群，投放方式：'
        ];
        ?>
        <b>投放方式：</b>
        <p>1.打开右上角图标，可以直接分享此页面给个人、朋友圈或QQ。</p>
        <p>2.长按下图，可以保存到手机上，您还可以在微信以外的平台发布海报，如：微博、贴吧。</p>
        <p>（技能get√：把二维码海报分享到有车一族的QQ群、微信群，涨粉很快的哦！）</p>
    </div>
    <?php endif;?>
<img src="/<?=$file_path?>?<?=$info['qr_create_time']?>" width="100%"/>

<?php else:?>
    <header class="header">
        <div class="fix_nav">
            <div class="nav_inner">
                <a class="nav-left back-icon" href="javascript:goback();">返回</a>
                <div class="tit">温馨提示</div>
            </div>
        </div>
    </header>

    <div class="container itemdetail">
        <div class="row">
            <div class="col-md-12 p10">
                <div class="alert alert-danger" role="alert" style="font-size: 18px;">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    很抱歉，您还未开店，我们需要购买1元加盟，或者买任意一个商品即可以成为店铺大掌柜。成为店铺大掌柜后，您可以分享“店铺推广海报”和“店铺推广链接”给好友，发展更多地会员，将为您赚更多的钱。
                </div>
                <a href="/product/detail/goods_id/16.html" class="btn btn-success btn-block">1元购买加盟，立即成为店铺大掌柜</a>
            </div>
        </div>
    </div>
<?php endif;?>
