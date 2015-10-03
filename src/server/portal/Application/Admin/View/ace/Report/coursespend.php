<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>年份
                            <input type="text" class="search-input" name="stat_year" value="{$stat_year}" placeholder="请输入查询的年份">
                        </label>
                        <label>月份
                            <input type="text" class="search-input" name="stat_month" value="{$stat_month}" placeholder="请输入查询的月份">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('report/coursespend')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>  
                </div>
            </div>
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
<!--
                    <th class="row-selected center">
                       <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                       </label>
                    </th>
-->
					<th class="center" rowspan="3">月份</th>
					<th class="center" rowspan="3">宝宝姓名</th>
					<th class="center" rowspan="3">报课时间</th>
					<th class="center" rowspan="3">报课节数</th>
					<th class="center" rowspan="3">赠送节数</th>
					<th class="center" rowspan="3">报课金额</th>
					<th class="center" colspan="4">本月耗课</th>
					<th class="center" colspan="4">未耗课</th>
			        <tr>
					<th class="center" colspan="2" >历史报课</th>
					<th class="center" colspan="2">本月报课</th>
					<th class="center" colspan="2" >历史耗课</th>
					<th class="center" colspan="2">本月耗课</th>
				</tr>
			        <tr class="center">
					<th class="center">节数</th>
					<th class="center">金额</th>
					<th class="center">节数</th>
					<th class="center">金额</th>
					<th class="center">节数</th>
					<th class="center">金额</th>
					<th class="center">节数</th>
					<th class="center">金额</th>
				</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr class="center">
<!--
                        <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
-->
						<td>{$vo.stat_year}年{$vo.stat_month}月</td>
						<td>{$vo.baby_name}</td>
						<td>{$vo.course_add_time}</td>
						<td>{$vo.course_count}</td>
						<td>{$vo.given_count}</td>
						<td>{$vo.course_amount|price_format}</td>
						<td>{$vo.before_course_count}</td>
						<td>{$vo.before_course_amount|price_format}</td>
						<td>{$vo.current_course_count}</td>
						<td>{$vo.current_course_amount|price_format}</td>
						<td>{$vo.before_course_left_count}</td>
						<td>{$vo.before_course_left_amount|price_format}</td>
						<td>{$vo.current_course_left_count}</td>
						<td>{$vo.current_course_left_amount|price_format}</td>
					</tr>
					</volist>
					<else/>
					<td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
            </table>
            <include file="Public/page"/>
        </div>
    </div>
</block>

<block name="script">
	<script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
	<script type="text/javascript">
	//搜索功能
	$("#search").click(function(){
		var url = $(this).attr('url');
        var query  = $('.search-form').find('input').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
        if( url.indexOf('?')>0 ){
            url += '&' + query;
        }else{
            url += '?' + query;
        }
		window.location.href = url;
	});
	//回车搜索
	$(".search-input").keyup(function(e){
		if(e.keyCode === 13){
		    console.info($("#search"));
			$("#search").click();
			return false;
		}
	});
    //导航高亮
	</script>
</block>
