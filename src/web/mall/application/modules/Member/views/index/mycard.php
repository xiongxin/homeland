<link rel="stylesheet" href="/v2/css/member.css">
<header class="header">
    <div class="fix_nav">
        <div class="nav_inner">
            <a class="nav-left back-icon" href="javascript:goback();">返回</a>
            <div class="tit">我的卡券</div>
        </div>
    </div>
</header>
<div class="order_bg_img">
    <div class="order_i_p_c">
        <div class="order_i">
            <a href="/member/index/barcode.html">
                <div class="order_pic"><img src="/misc/images/order_bg_4.png"></div>
                <div class="order_tit">我的券</div>
            </a>
        </div>
    </div>
    <div class="order_i_p_c">
        <div class="order_i" id="qb">
            <a href="javascript:">
                <div class="order_pic"><img src="/misc/images/order_bg_3.png"></div>
                <div class="order_tit">我的卡</div>
            </a>
        </div>
    </div>
</div>
<div class="order_content_cou" id="dfk_df">
    <div class="tab-content order_info">
    <!--全部-->

    <?php
        $status_text = [
                        'OK#'=>'正常',
                        'FRZ'=>'冻结',
                        'END'=>'结束',
                        'NOP'=>'未开通',
                        ];
        $status_class = [
                        'OK#'=>'status_complete',
                        'FRZ'=>'red',
                        'END'=>'red',
                        'NOP'=>'status_waitpay',
                        ];
    ?>
    <?php foreach($list as $item): ?>
        <div class="order_i_h"></div>
        <div class="order_co_top">
            <div class="order_co_t_l fk">
                <span class="<?=$status_class[$item['status']]?>"><?=$status_text[$item['status']]?></span>
            </div>
            <div class="order_co_t_r">
                卡号:<?=$item['accountId']?>
            </div>
        </div>
        <div class="order_c_pic_tit"  style="border:1px solid #fff">
            <div class="order_c_p_l">
                <img  src="/misc/images/card.png"" class="photo">
            </div>

            <div class="order_c_p_r">
                <div class="order_c_p_r_t">
                    <div class="order_c_p_r_tit">
                        有效开始日期：<?=$item['startTime']?>
                    </div>
                    <div class="order_c_p_r_tit">
                        有效结束日期：<?=$item['endTime']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="order_bot_cou">
            <div class="order_bot_l">
                <div class="order_bot_l_s">
                    <span>卡面额:</span>tdddd
                    <span class="order_bot_l_m">￥<?= price_format($item['amount'])?></span>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </div><!--全部END-->
    <div class="clear"></div>
    <div class="order_i_h"></div>

    <?php if(count($list) == 0):?>
        <div class="alert alert-info" role="alert" style="background: #fff; border: none;">
            您还没有激活任何电子卡!
            <a class="btn btn-info" href="/">去购买</a>
        </div>
    <?php endif;?>
    <?php include APP_PATH.'views/common/page.php'?>
</div>