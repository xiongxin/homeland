<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
					<th class="">会员昵称</th>
					<th class="">加入时间</th>
					<th class="">会员等级</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
                    <?php $level_list = [''=>'暂无','GOLD#'=>'金种子','SILVER'=>'银种子'];?>
					<volist name="_list" id="vo">
					<tr>
						<td><a href="<?=U('user/dtwechat',['userid'=>$vo['userid']])?>"><?=$vo['nickname']?></a></td>
						<td><?=$vo['insert_time']?></td>
						<td><?=$level_list[$vo['level']]?></td>
						<td><a href="<?=U('useredit',['id'=>$vo['id']])?>">修改</a></td>
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
    <script>
        highlight_subnav('{:U('company/index')}');
    </script>
</block>