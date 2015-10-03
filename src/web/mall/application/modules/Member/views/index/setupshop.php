<link rel="stylesheet" href="/misc/css/member.css?123456778">
<link rel="stylesheet" href="/misc/css/order3.css?122333">
<div class="container">
    <div class="row">
        <div class="member_top member_top_1">
            <?php
                $link = $shopkeeper ? '/member/index/shop.html' : '/product/detail/goods_id/16.html';
            ?>
            <a href="<?=$link?>" style="color: #fff;">
                <div class="member_top_bg">
                    <img src="/misc/images/member_bg.png">
                </div>
                <div class="member_m_pic member_m_pic_1">
                    <img class="img-circle" src="<?=$user['headimgurl']?>">
                </div>
                <div class="member_m_z member_m_z_1">
                    <div class="member_m_x"><?=$user['nickname']?></div>
                    <div class="member_m_s"><?=$user['mobile']?></div>
                    <!--<div class="member_m_bz_1"><a href="/personal/set/phone.html">普通会员</a></div>-->
                </div>
                <div class="member_m_r">
                        <?=$shopkeeper ? '我的店铺' : '我要开店'?> >
                </div>
            </a>
        </div>

        <div class="list-group mt10 mb10">
            <a href="http://mp.weixin.qq.com/s?__biz=MzI3NjAxNzE3OA==&mid=208969664&idx=1&sn=2786b9892004f9471a2a0d7220936152&scene=5#rd" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img16.png"></div>
                开店指南
                <span class="gary pull-right">查看详情</span>
            </a>
        </div>

        <!--九宫格-->
        <div class="list-group mb10 member_list_group clearfix">

            <a href="/public/haibao.html" class="list-group-item col-xs-6">
                <div class="m_img"><img src="/misc/images/m5.png"></div>
                <p class="m_name">推广海报</p>
            </a>
            <!--
            <a href="/public/haibao/type/2.html" class="list-group-item col-xs-6">
                <div class="m_img"><img src="/misc/images/m5.png"></div>
                <p class="m_name">发展下线推广海报</p>
            </a>
            -->
            <a href="/member/index/choosedis.html" class="list-group-item col-xs-6">
                <div class="m_img"><img src="/misc/images/m4.png"></div>
                <p class="m_name">店铺推广链接</p>
            </a>
        </div><!--九宫格END-->

        <div class="list-group mb10">
            <?php foreach($article_list as $article):?>
            <a href="/article/info/id/<?=$article['id']?>.html" class="list-group-item tip">
                <?=$article['title']?>
            </a>
            <?php endforeach;?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".foot-con_2 a:eq(1)").addClass('active');
    })
</script>
