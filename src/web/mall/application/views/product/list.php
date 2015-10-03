    <style>
        .tb_type .col-xs-6{ padding: 15px 5px;}
        .tb_type img{ width: 100%}
    </style>
    <header class="header">
        <div class="fix_nav">
            <div class="nav_inner">
                <a class="nav-left back-icon" href="javascript:goback();">返回</a>
                <div class="tit">商品列表</div>
            </div>
        </div>
    </header>
    <div class="container wx_wrap mini-innner">
        <div class="row">
            <div class="tb_box">
                <div class="tb_type clearfix">
                    <?php foreach ($products as $product):?>
                        <div class="col-xs-6">
                            <a href="/product/detail/goods_id/<?php echo $product['id']?>.html">
                                <div class="p_img"><img class="g_pic"  src="<?php echo show_pic($product['pic'])?>" /></div>
                                <div class="p_txt">
                                    <div class="name"><?php echo $product['title']?></div>
                                    <div class="price"><em class="c_price">¥<?php echo price_format($product['price'])?></em></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>