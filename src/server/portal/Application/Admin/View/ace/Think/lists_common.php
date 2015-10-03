<table class="table table-striped table-bordered table-hover dataTable">
    <!-- 表头 -->
    <thead>
    <tr>
        <th class="row-selected">
            <label>
                <input class="ace check-all" type="checkbox"/>
                <span class="lbl"></span>
            </label>
        </th>
        <volist name="list_grids" id="field">
            <th>{$field.title}</th>
        </volist>
    </tr>
    </thead>

    <!-- 列表 -->
    <tbody>
    <volist name="list_data" id="data">
        <tr>
            <td>
                <label>
                    <input class="ace ids" type="checkbox" name="ids[]" value="{$data['id']}" />
                    <span class="lbl"></span>
                </label>
            </td>
            <volist name="list_grids" id="grid">
                <td><?=get_list_field($data,$grid)?></td>
            </volist>
        </tr>
    </volist>
    </tbody>
</table>