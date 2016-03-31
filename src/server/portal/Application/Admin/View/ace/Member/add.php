<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row" style="padding-top: 4px;padding-bottom: 0;">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>请先选择会议场次
                            <select id="meeting_id" name="meeting_id" data-id="{:I('meeting_id')}">
                                <volist name="meetings" id="vo">
                                    <option value="{$vo.id}">{$vo.title}</option>
                                </volist>
                            </select>
                        </label>
                        <label>输入用户昵称或者手机号码
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="请输入用户昵称或者手机号码">
                        </label>

                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('add')}">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
                </div>
            </div>
            <?php if(empty($search)):?>
                <h4 class="text-warning bigger-110 orange">
                    <i class="icon-warning-sign"></i>
                    请选择会议场次并输入关键字搜索用户
                </h4>
            <?php elseif(empty($item)):?>
                <div class="row">
                    <div class="alert alert-danger">
                        没有找到指定条件的用户！
                    </div>
                </div>
            <?php else:?>
                <div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
                    <div class="widget-header widget-header-small header-l-blue">
                        <h5 class="smaller">用户详细信息</h5>
                    </div>
                    <table class="table table-striped table-bordered table-hover item-table" style="margin-bottom:0px;">
                        <tbody>
                        <tr>
                            <td><span style="color:#999;padding-right:8px;">姓名:</span>
                                <a href="{:U('Meeting/companyedit',array('eid'=>$item['eid']))}">{$item.chairman_name}</a></td>
                        </tr>
                        <tr>
                            <td><span style="color:#999;padding-right:8px;">手机号码:</span>{$item.mobile}</td>
                        </tr>
                        <tr>
                            <td><span style="color:#999;padding-right:8px;">职位:</span>{$item.position}</td>
                        </tr>
                        <tr>
                            <td><span style="color:#999;padding-right:8px;">公司名称:</span>{$item.company_name}</td>
                        </tr>
                        <tr>
                            <td><span style="color:#999;padding-right:8px;">公司描述:</span>{$item.description}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <form action="{:U()}" class="form-horizontal" method="post">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">添加类型</label>
                        <div class="col-xs-12 col-sm-7">
                            <label><input type="radio" class="ace" name="group_id" value="6"><span class="lbl">金种子&nbsp;</span></label>
                            <label><input type="radio" class="ace" name="group_id" value="5"><span class="lbl">银种子&nbsp;</span></label>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        保存后将会发送短信和微信通知给用户！
                    </div>

                    <div class="clearfix form-actions">
                        <div class="col-xs-12">
                            <input type="hidden" name="id" value="{$item.id}"/>
                            <input type="hidden" name="mobile" value="{$item.mobile}"/>
                            <input type="hidden" name="email" value="{$item.email}"/>
                            <input type="hidden" name="chairman_nickname" value="{$item.chairman_nickname}"/>
                            <button type="submit" target-form="form-horizontal"
                                    class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                                    保存并发送通知
                            </button>
                            <a class="btn btn-white" href="javascript:history.go(-1)">
                                返回
                            </a>
                        </div>
                    </div>
                </form>
            <?php endif;?>

        </div>
    </div>
</block>

<block name="script">
    <script type="text/javascript">
        (function($){
            var meeting_id = <?=intval(I('meeting_id'));?>;
            if(meeting_id > 0){
                $('#meeting_id').val(meeting_id);
            }
        })(jQuery);
        //导航高亮
        highlight_subnav('{:U('member/index')}');
    </script>
</block>
