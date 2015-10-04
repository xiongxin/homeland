<link rel="stylesheet" href="/misc/css/member.css?123456778">
<link rel="stylesheet" href="/misc/css/order3.css?122333">
<div class="container">
    <div class="row">
        <div class="member_top member_top_1">
            <div class="member_top_bg"><img src="/misc/images/member_bg.png"></div>

            <?php
            $link = empty($user_company) ? '/member/index/bind.html' : 'javascript:';
            ?>
            <a href="<?=$link?>" style="color: #fff;">
                <div class="member_m_pic member_m_pic_1">
                    <img class="img-circle" src="<?=$user['headimgurl']?>">
                </div>
                <?php if(!empty($user_company)):?>
                <div class="member_m_z member_m_z_1">
                    <div class="member_m_x"><a href="javascript:"><?=$user_company['company']?></a></div>
                </div>
                <?php else:?>
                <div class="member_m_r" style="font-size: 1.6rem;">
                    去绑定企业
                </div>
                <?php endif;?>
            </a>
        </div>
        <?php if(!empty($user_company)):?>
        <div class="list-group mb10 mt10">
            <a href="/member/order/index.html" class="list-group-item">
                <div class="list_group_img"><img src="/misc/images/member_img15.png"></div>
                会员级别
                <span class="gary pull-right"><?=$level_list[$user_company['level']]?></span>
            </a>
        </div>

        <div class="list-group">
            <a href="/member/index/barcode.html" class="list-group-item">
                <div class="list_group_img"><img src="/misc/images/member_img16.png"></div>
                加入时间
                <span class="gary pull-right"><?=$user_company['insert_time']?></span>
            </a>
        </div>
        <?php endif;?>

        <div class="list-group mt10 mb10">
            <a href="/article/info/id/23.html" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img19.png"></div>
                会员特权
            </a>
        </div>

    </div>
</div>