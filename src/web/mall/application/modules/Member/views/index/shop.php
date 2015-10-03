    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- BEGIN THEME STYLES -->
    <link href="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
    <link href="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
<script src="/mex/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/mex/lance/shopx.js"></script>
<div class="container-fluid">
    <div class="portlet light profile-sidebar-portlet">
        <div class="profile-userpic">
            <img src="<?=$user['headimgurl']?>" class="img-responsive" alt="" style="width:100px; height:100px">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?=$item['params']['shop_name']?>
            </div>
            <div class="profile-usertitle-job">
                <?=$item['params']['shop_title']?>
            </div>
        </div>
        <div class="profile-userbuttons">
            <a href="javascript:;" class="btn red"> 收益/￥<?=price_format($data['totalEarning']/10)?> </a>
        </div>
        <br>
        <br>
        <br>
    </div>

    <?php if(!$shopkeeper):?>
    <a class="btn red  btn-block" href="/product/detail/goods_id/16.html">1元购买加盟，立即成为店铺大掌柜</a> <br>
    <?php endif;?>
    <div class="panel-group accordion" id="accordion1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a class=" accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_1" aria-expanded="false" > <i class="fa fa-user"></i> 我的大东家 </a></h4>
            </div>
            <div id="collapse_1_1" class="panel-collapse collapse" aria-expanded="false">
                <div class="panel-body">
                    <div style="vertical-align:middle;text-align: center;height: 180px;">
                        <img src="<?=$parent['headimgurl']?>" style="width: 80px;height: 80px;-moz-border-radius: 80px; -webkit-border-radius: 80px; border:5px solid #666666; " />
                        <br />
                        <div style="height: 30px;line-height: 30px;font-size: 14px;vertical-align:middle;text-align: center;"></div>
                        <p style="text-align: left;">姓名：<?=$parent['nickname']?> </p>
                        <p style="text-align: left;">手机：<?=$parent['mobile']?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_3" aria-expanded="false" > <i class="fa fa-bar-chart"></i> 销售统计 </a></h4>
            </div>
            <div id="collapse_1_3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    <p>
                        <span style="font-size: 32px;color: #a94442;"> ￥<?=price_format($total['wait'])?></span><span style="font-size: 12px;"> &nbsp;&nbsp;&nbsp;&nbsp;未支付金额</span></br></br>
                        <span style="font-size: 32px;color: #a94442;"> ￥<?=price_format($total['completed'])?></span><span style="font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;已支付金额</span></br></br>
                        <span style="font-size: 32px;color: #a94442;"> ￥<?=price_format($total['cancel'])?></span><span style="font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;已作废金额</span></br></br>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-group accordion" id="accordion2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a onclick="wd_get_fs(0)" class=" accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1" aria-expanded="false" > <i class="fa fa-sun-o"></i> 我的店小二  <span class="badge badge-danger">	0 </span></a></h4>
            </div>

            <div id="collapse_2_1" class="panel-collapse collapse" aria-expanded="false">
                <div class="panel-body">
                    <div class="portlet-input input-inline" style="width: 90px;display: inline-block;">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input onchange="wd_get_fs(0)" id="fs_key0" name="fs_key0" type="text" class="form-control" placeholder="search...">
                        </div>
                    </div>
                    <select  class="form-control" style="width:80px;display: inline-block;"  data-inline="true" id="fs_page0" onchange="wd_get_fs(0)">
                        <option value="1">第1页</option>
                    </select>
                    <div style="clear: both;height: 20px;width: 100%;" ></div>
                    <p id="fs_tbody0"></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a onclick="wd_get_fs(1)" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_2" aria-expanded="false" > <i class="fa fa-moon-o"></i> 我的小伙计  <span class="badge badge-danger">0</span></a></h4>
            </div>
            <div id="collapse_2_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    <div class="portlet-input input-inline" style="width: 90px;display: inline-block;">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input onchange="wd_get_fs(1)" id="fs_key1" name="fs_key1" type="text" class="form-control" placeholder="search...">
                        </div>
                    </div>
                    <select  class="form-control" style="width:80px;display: inline-block;"  data-inline="true" id="fs_page1" onchange="wd_get_fs(1)">
                        <option value="1">第1页</option>
                    </select>
                    <div style="clear: both;height: 20px;width: 100%;" ></div>
                    <p id="fs_tbody1"></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a onclick="wd_get_fs(2)" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_3" aria-expanded="false"  > <i class="fa fa-star-o"></i> 我的会员  <span class="badge badge-danger">0</span> </a></h4>
            </div>
            <div id="collapse_2_3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    <div class="portlet-input input-inline" style="width: 90px;display: inline-block;">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input onchange="wd_get_fs(2)" id="fs_key2" name="fs_key2" type="text" class="form-control" placeholder="search...">
                        </div>
                    </div>
                    <select  class="form-control" style="width:80px;display: inline-block;"  data-inline="true" id="fs_page2" onchange="wd_get_fs(2)">
                        <option value="1">第1页</option>
                    </select>
                    <div style="clear: both;height: 20px;width: 100%;" ></div>
                    <p id="fs_tbody2"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">工具箱</h3>
        </div>
        <!-- List group -->
        <div class="list-group">
	    <div class="panel-body">
                <p>
                修改了头像，昵称等微信信息后，请使用【重新同步微信信息】工具，与微信信息保持同步；
                </p>
            </div>
            <a class="list-group-item" href="/member/info/sync.html">
                <i class="fa fa-wechat"></i> 重新同步微信信息
            </a>
            <a class="list-group-item" href="javascript:;" onclick="alert_ts('请返回微信公众号界面，点左下角键盘小按钮，联系我们的客服人员。')">
                <i class="fa fa-bullhorn"></i> 联系客服人员
            </a>
            <a class="list-group-item" href="/public/haibao.html">
                <i class="fa fa-paper-plane-o"></i> 店铺推广海报
            </a>
            <a class="list-group-item" href="/member/index/distribution.html">
                <i class="glyphicon glyphicon-link"></i> 店铺推广链接
            </a>
        </div>
    </div>
    <!--
    <div class="panel-group accordion" id="accordion3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4 class="panel-title"><a onclick="wd_yshb()" class=" accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1" aria-expanded="false" > <i class="fa fa-money"></i> 已收红包  <span class="badge badge-danger">0</span> </a></h4>
            </div>

            <div id="collapse_3_1" class="panel-collapse collapse" aria-expanded="false">
                <div class="panel-body">
                    <p>
                        <select  class="form-control" style="width:100px;display: inline-block;"  data-inline="true" id="wd_yshb_page" onchange="wd_yshb(0)">
                            <option value="1">第1页</option>
                        </select>
                    <p id="wd_yshb"></p>
                    </p>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title"><a onclick="wd_dshb()" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2" aria-expanded="false" > <i class="fa fa-clock-o"></i> 预收红包 </a></h4>
            </div>
            <div id="collapse_3_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    <p id="wd_dshb"></p>
                </div>
            </div>
        </div>
    </div>
    -->
</div>

<div class="modal fade" id="alert_ts">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body" id="alert_ts_body">
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn default blue">
                    <i class="fa fa-send"></i>
                    好的
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/respond.min.js"></script>
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/jquery.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/scripts/metronic.js" type="text/javascript"></script>
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="http://cloudxt.oss-cn-hangzhou.aliyuncs.com/mex/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/mex/lance/base.js" type="text/javascript"></script>
<script src="/mex/lance/ad.js" type="text/javascript"></script>
<link href="/mex/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script>
    $(function(){
        Metronic.init(); // init metronic core components

        $.getJSON("/member/info/getChildCount",function(resp) {

            if (resp.status == 1) {
                $("#accordion2 .panel .panel-heading .panel-title .badge-danger").each(function(i){
                    $(this).text(resp.total[i]);
                })
            }
        });
    });
</script>
<style>
    a:link{
        text-decoration:none;
    }
    a:visited{
        text-decoration:none;
    }
    a:hover{
        text-decoration:none;
    }
    a:active{
        text-decoration:none;
    }
</style>
