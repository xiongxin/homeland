<extend name="Public/base" />

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <form method="get" action="__SELF__" class="search-form">
                        <label>用户昵称
                            <input type="text" class="search-input" name="nickname" value="{:I('nickname')}" placeholder="请输入用户昵称或者ID">
                        </label>
                        <label>状态：
                            <?php
                            echo form_dropdown('status',$status_list,I('status'));
                            ?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('wechat')}">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
                </div>
            </div>

            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th class="row-selected center">
                        <label>
                            <input class="ace check-all" type="checkbox"/>
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th class="">UID</th>
                    <th class="">昵称</th>
                    <th class="">头像</th>
                    <th class="">openid</th>
                    <th class="">unionid</th>
                    <th class="">关注时间</th>
                    <th class="">创建时间</th>
                    <th class="">状态</th>
                    <th class="">操作</th>
                </tr>
                </thead>
                <tbody>
                <notempty name="_list">
                    <volist name="_list" id="vo">
                        <tr>
                            <td class="center">
                                <label>
                                    <input class="ace ids" type="checkbox" name="id[]" value="{$vo.userid}" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{$vo.userid} </td>
                            <td><a href="{:U('User/dtwechat',array('userid'=>$vo['userid']))}">{$vo.nickname}</a></td>
                            <td><img src="{$vo.headimgurl}" width="50"/></td>
                            <td>{$vo.openid}</td>
                            <td>{$vo.unionid}</td>
                            <td><span>{$vo.subscribe_time|time_format}</span></td>
                            <td><span>{$vo.add_time}</span></td>
                            <td><?=$status_list[$vo['subscribe']]?></td>
                            <td>
                                <a href="{:U('User/dtwechat?userid='.$vo['userid'])}">详情</a>
                            </td>
                        </tr>
                    </volist>
                    <else/>
                    <td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
                </notempty>
                </tbody>
            </table>
            <include file="Public/page"/>
        </div>
    </div>
</block>

<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('User/wechat')}');
    </script>
</block>
