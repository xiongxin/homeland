<extend name="Public/base" />
<!-- 管理员用户组新增和编辑页面 -->
<block name="body">
    <form action="{:U('AuthManager/writeGroup')}" enctype="application/x-www-form-urlencoded" method="POST"
            class="form-horizontal">
        <div class="form-group">
            <label for="auth-title" class="col-xs-12 col-sm-2 control-label no-padding-right">用户组</label>
            <div class="col-xs-12 col-sm-5">
                <input id="auth-title" type="text" name="title" class="width-100" value="{$auth_group.title}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="auth-description" class="col-xs-12 col-sm-2 control-label no-padding-right">描述</label>
            <div class="col-xs-12 col-sm-5">
                <textarea id="auth-description" name="description" class="autosize-transition span12 form-control">{$auth_group.description}</textarea>
            </div>
        </div>
        <div class="clearfix form-actions">
            <input type="hidden" name="id" value="{$auth_group.id}" />
            <div class="col-xs-12 center">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button> 
                <button type="reset" class="btn" id="reset-btn">
                    <i class="icon-undo bigger-110"></i> 重置
                </button>   
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
                   <i class="icon-reply"></i>返回上一页
                </a>  
            </div>
        </div>
    </form>
</block>
<block name="script">
<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('{:U('AuthManager/index')}');
</script>
</block>