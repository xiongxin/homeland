<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
	                    <label>
	                        <a class="btn btn-sm btn-primary" href="{:U('add')}"><i class="icon-plus"></i>新增</a>
	                    </label>
	                    <label>
	                        <button type="button" class="btn btn-sm btn-success ajax-post" target-form="ids" url="{:U('changeStatus?method=resumeUser')}">
	                            <i class="icon-ok"></i>启 用
	                        </button>
	                    </label>
	                    <label>
	                        <button type="button" class="btn btn-sm btn-inverse ajax-post" target-form="ids" url="{:U('changeStatus?method=forbidUser')}">
	                            <i class="icon-ban-circle"></i>暂停
	                        </button>
	                    </label>
                        <label>
                            <button type="button" class="btn btn-sm btn-danger ajax-post" target-form="ids" url="{:U('changeStatus?method=deleteUser')}">
                                <i class="icon-trash"></i>删除
                            </button>
                        </label>
                        <label>用户昵称或者ID 
                            <input type="text" class="search-input" name="nickname" value="{:I('nickname')}" placeholder="请输入用户昵称或者ID">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('index')}">
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
                    <th class="row-selected center">
                       <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                       </label>
                    </th>
					<th class="">UID</th>
					<th class="">用户名</th>
					<th class="">昵称</th>
					<th class="">登录次数</th>
					<th class="">最后登录时间</th>
					<th class="">最后登录IP</th>
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
                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.uid}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td>{$vo.uid} </td>
						<td><a href="{:U('uedit',array('id'=>$vo['uid']))}">{$vo.username}</a></td>
						<td>{$vo.nickname}</td>
						<td>{$vo.login}</td>
						<td><span>{$vo.last_login_time|time_format}</span></td>
						<td><span>{:long2ip($vo['last_login_ip'])}</span></td>
						<td>{$vo.status_text}</td>
						<td>
					        <eq name="vo.status" value="1">
							<a href="{:U('User/changeStatus?method=forbidUser&id='.$vo['uid'])}" class="ajax-get">禁用</a>
							<else/>
							<a href="{:U('User/changeStatus?method=resumeUser&id='.$vo['uid'])}" class="ajax-get">启用</a>
							</eq>
							<a href="{:U('AuthManager/group?uid='.$vo['uid'])}" class="authorize">授权</a>
			                <a href="{:U('User/changeStatus?method=deleteUser&id='.$vo['uid'])}" class="confirm ajax-get">删除</a>
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
    highlight_subnav('{:U('User/index')}');
	</script>
</block>
