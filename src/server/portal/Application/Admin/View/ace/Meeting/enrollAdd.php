<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <form action="<?= empty($item) ?  U('Meeting/add') : U('Meeting/edit')  ?>" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">姓名</label>
            <div class="col-xs-12 col-sm-7">
                <select>
                    
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">姓名</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="name">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">副标题</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="subheading"
                       value="<?= empty($item) ? "" : $item['subheading'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">回访记录</label>
            <div class="col-xs-12 col-sm-7">
                <textarea  name="description">{$item.description}</textarea>
                {:hook('adminArticleEdit', array('name'=>'description'))}
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系人</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contacts"
                       value="<?= empty($item) ? "" : $item['contacts'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系电话</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contact_phone"
                       value="<?= empty($item) ? "" : $item['contact_phone'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系邮箱</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contact_email"
                       value="<?= empty($item) ? "" : $item['contact_email'] ?>">
            </div>
        </div>
        <div class="clearfix form-actions">
            <div class="col-xs-12">
                <button type="submit" target-form="form-horizontal" class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                    保存
                </button>
                <a class="btn btn-white" href="javascript:history.go(-1)">
                    返回
                </a>
            </div>
        </div>
    </form>
</block>

<block name="script">
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

    <script type="text/javascript">

        highlight_subnav('{:U('Meeting/index')}');
    </script>
</block>