<extend name="Public/base"/>

<block name="body">
<div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>
                            <a class="btn btn-sm btn-primary" href="{:U('addaction')}"><i class="icon-plus"></i>新增</a>
                        </label>
                        <label>
                            <button type="button" class="btn btn-sm btn-success ajax-post" target-form="ids" url="{:U('setstatus?Model=Action&status=1')}">
                                <i class="icon-ok"></i>启 用
                            </button>
                        </label>
                        <label>
                            <button type="button" class="btn btn-sm btn-inverse ajax-post" target-form="ids" url="{:U('setstatus?Model=Action&status=0')}">
                                <i class="icon-ban-circle"></i>暂停
                            </button>
                        </label>
                        <label>
                            <button type="button" class="btn btn-sm btn-danger ajax-post confirm" target-form="ids" url="{:U('setStatus?Model=Action&status=-1')}">
                                <i class="icon-trash"></i>删除
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
					<th class="">编号</th>
					<th class="">标识</th>
					<th class="">名称</th>
					<th class="">类型</th>
					<th class="">规则</th>
					<th class="">状态</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<volist name="_list" id="vo">
					<tr>
                        <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td>{$vo.id} </td>
						<td>{$vo.name}</td>
						<td><a href="{:U('editAction?id='.$vo['id'])}">{$vo.title}</a></td>
						<td><span>{:get_action_type($vo['type'])}</span></td>
						<td>{$vo.remark}</td>
						<td>{$vo.status_text}</td>
						<td><a href="{:U('User/editAction?id='.$vo['id'])}">编辑</a>
							<a href="{:U('User/setStatus?Model=action&ids='.$vo['id'].'&status='.abs(1-$vo['status']))}" class="ajax-get">{$vo.status|show_status_op}</a>
							<a href="{:U('User/setStatus?Model=action&status=-1&ids='.$vo['id'])}" class="confirm ajax-get">删除</a>
			                </td>
					</tr>
					</volist>
				</tbody>
            </table>
            <include file="Public/page"/>
        </div>
    </div>
</block>