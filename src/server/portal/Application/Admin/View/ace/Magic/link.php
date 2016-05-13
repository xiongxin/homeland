<script type="text/javascript">
    function clicklink(href, title) {
        if(href=='tel:'){
            require(['util'],function(u){
                u.message('请添加一键拨号号码.');
            });
            return;
        }
        if($.isFunction(selectLinkComplete)){
            selectLinkComplete(href, title);
        }
    }
    function linkModal(a) {
        $(".link-browser").addClass('hide');
        $(".link-modal > div").addClass('hide');
        $(a).removeClass('hide');
    }
    function retrunLinkBrowser() {
        $(".link-browser").removeClass('hide');
        $(".link-modal > div").addClass('hide');
    }
    require(['util'], function (u) {
        $('.pagination a').click(function() {
            var page = $(this).attr('page');
            selectLinkComplete('', page);
        });
    });
</script>
<style type="text/css">
    .link-browser ul li{width: 120px; }
    .list-group .list-group-item a{color:#428bca;}
    .link-browser .page-header, .link-modal .page-header{margin:25px 0 10px;}
    .link-browser .page-header:first-child, .link-modal .page-header:first-of-type{margin-top:0;}
    .link-browser div.btn, .link-modal div.btn{min-width:100px; text-align:center; margin:5px 2px;}
</style>

<!--二级页面-->
<div class="link-modal">
    <!--一键拨号-->
    <div id="telphone-modal" class="hide">
        <ol class="breadcrumb">
            <li><a href="javascript:;" onclick="retrunLinkBrowser();">选择器首页</a></li>
            <li><a href="javascript:;" onclick="retrunLinkBrowser();">系统默认链接</a></li>
            <li class="active">一键拨号</li>
        </ol>
        <div class="form-group list-group-item clearfix">
            <label class="col-xs-12 col-sm-2 col-md-2 control-label" style="margin-top:5px;">号码</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="telphone" id="telphone" value="" />
            </div>
            <div class="col-sm-4">
                <a href="javascript:;" class="btn btn-primary" onclick="clicklink('tel:' + $('#telphone').val());">确定</a>
            </div>
        </div>
    </div>
</div>

<!--一级页面-->
<div class="link-browser">
    <div class="page-header">
        <h4><i class="fa fa-folder-open-o"></i> 系统默认链接</h4>
    </div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=home&', '微站首页');" title="微站首页">微站首页</div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=mc&', '个人中心');" title="个人中心">个人中心</div>
    <div class="btn btn-default" onclick="linkModal('#telphone-modal')">一键拨号</div>
    <div class="page-header">
        <h4><i class="fa fa-folder-open-o"></i> 会员卡功能链接</h4>
    </div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=mc&a=bond&do=mycard&', '我的会员卡');" title="我的会员卡">我的会员卡</div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=mc&a=card&do=notice&', '消息');" title="消息">消息</div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=mc&a=card&do=sign_display&', '签到');" title="签到">签到</div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=mc&a=card&do=recommend&', '推荐');" title="推荐">推荐</div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=mc&a=store&', '适用门店');" title="适用门店">适用门店</div>
    <div class="btn btn-default" onclick="clicklink('./index.php?i=2&c=mc&a=profile&', '完善会员资料');" title="完善会员资料">完善会员资料</div>
</div>
