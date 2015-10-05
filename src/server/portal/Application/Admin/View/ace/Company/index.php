<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  

            <div class="row">
                <form class="search-form">
                    <div class="col-sm-12">
                        <label>企业名称
                            <input type="text" class="search-input" name="school_name" value="<?=I('school_name')?>">
                        </label>
                        <label>状态
                            <?php
                            echo form_dropdown('status',$status_list,I('status'));
                            ?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="<?=U('index')?>">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>
                </form>
            </div>
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
					<th>企业名称</th>
					<th class="">申请人</th>
					<th>法人姓名</th>
					<th class="">申请人手机</th>
					<th class="">企业地址</th>
					<th class="">创建时间</th>
					<th class="">状态</th>
					<th>绑定编码</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
						<td><a href="<?=U('edit',array('id'=>$vo['id']))?>"><?=$vo['company']?></a> </td>
						<td><a href="<?=U('user/dtwechat',['userid'=>$vo['userid']])?>"><?=$vo['nickname']?></a></td>
						<td><?=$vo['corporation']?></td>
						<td><?=$vo['mobile']?></td>
						<td><?=$vo['province'].' '.$vo['city']?></td>
						<td><?=$vo['insert_time']?></td>
						<td><?=$status_list[$vo['status']]?></td>
						<td><?=$vo['bind_code']?></td>
						<td>
                            <a href="<?=U('edit',array('id'=>$vo['id']))?>">修改</a> |
                            <a class="ajax-get" href="<?=U('bindcode',array('id'=>$vo['id']))?>">重置绑定编码</a>
                            |
                            <a href="<?=U('userlist',array('id'=>$vo['id']))?>">成员列表</a>
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