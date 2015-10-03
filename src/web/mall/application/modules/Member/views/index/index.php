<link rel="stylesheet" href="/misc/css/member.css?123456778">
<link rel="stylesheet" href="/misc/css/order3.css?122333">
<div class="container">
    <div class="row">
        <div class="member_top member_top_1">
            <div class="member_top_bg"><img src="/misc/images/member_bg.png"></div>
            <div class="member_m_pic member_m_pic_1">
                <a href="javascript:">
                    <img class="img-circle" src="<?=$user['headimgurl']?>">
                </a>
            </div>
            <div class="member_m_z member_m_z_1">
                <div class="member_m_x"><a href="javascript:"><?=$user['nickname']?></a></div>
                <div class="member_m_s"><a href="javascript:"><?=$user['mobile']?></a></div>
                <!--<div class="member_m_bz_1"><a href="/personal/set/phone.html">普通会员</a></div>-->
            </div>
            <!--
            <div class="member_m_r">
                <a href="javascript:">账户管理、收货地址></a>
            </div>
            -->
        </div>

        <div class="list-group mb10 mt10">
            <a href="/member/order/index.html" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img16.png"></div>
                我的订单
                <span class="gary pull-right">查看全部</span>
            </a>
            <div class="list-group-item p0 clearfix">
                <div class="col-xs-4 p0">
                    <a class="order_tab_link" href="/member/order/index/type/wait.html">
                        <em class="order_img"><img src="/misc/images/order_bg_3.png"></em>待付款
                    </a>
                </div>
                <div class="col-xs-4 p0">
                    <a class="order_tab_link" href="/member/order/index/type/activate.html">
                        <em class="order_img"><img src="/misc/images/order_bg_1.png"></em>待激活
                    </a>
                </div>
                <div class="col-xs-4 p0">
                    <a class="order_tab_link" href="/member/order/index/type/comment.html">
                        <em class="order_img"><img src="/misc/images/order_bg.png"></em>待评价
                    </a>
                </div>
            </div>
        </div>

        <div class="list-group mb10">
            <a href="/member/index/barcode.html" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img15.png"></div>
                我的卡券
                <span class="gary pull-right">查看详情</span>
            </a>
        </div>


        <div class="list-group mb10">
            <a href="/member/index/shop.html" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img4.png"></div>
                我的店铺
                <span class="gary pull-right">查看详情</span>
            </a>
        </div>

        <div class="list-group mb0">
            <a href="javascript:" class="list-group-item" style="border-bottom: none;">
                <div class="list_group_img"><img src="/misc/images/member_img9.png"></div>
                我的钱包
            </a>
        </div>

        <!--九宫格-->
        <div class="list-group mb10 member_list_group clearfix">

            <a href="javascript:" class="list-group-item col-xs-4">
                <div class="m_img"><img src="/misc/images/m3.png"></div>
                <p class="m_name">账户余额</p>
                ￥<span class="red">0</span>
            </a>
            <a href="javascript:" class="list-group-item col-xs-4">
                <div class="m_img"><img src="/misc/images/m2.png"></div>
                <p class="m_name">我的收益</p>
                <span class="red"><?=price_format($data['totalEarning']/10)?></span>
            </a>
            <a href="javascript:" class="list-group-item col-xs-4">
                <div class="m_img"><img src="/misc/images/m1.png"></div>
                <p class="m_name">我的红包</p>
                <span class="red">0</span>
            </a>
        </div><!--九宫格END-->

        <div class="list-group mb10">
            <a href="/article/list/cate_id/41.html" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img17.png"></div>
                常见问题
            </a>
            <a href="/member/feedback/index.html" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img18.png"></div>
                意见反馈
            </a>
            <a href="/article/info/id/23.html" class="list-group-item tip">
                <div class="list_group_img"><img src="/misc/images/member_img19.png"></div>
                关于产品
            </a>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".foot-con_2 a:eq(3)").addClass('active');
    })
</script>
