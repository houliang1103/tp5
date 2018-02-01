{extend name="/layout:common"}
{block name="title"}权限列表{/block}
{block name="main"}
<div class="box">
    <div class="box-header">
        <ob_link><a class="btn btn-success" href="{:url('addRule')}"><i class="fa fa-plus"></i> 添加权限</a></ob_link>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>序号</th>
                <th>权限</th>
                <th>名称</th>
                <th>类别</th>
                <th>状态</th>
                <th>是否有附加条件</th>
                <th>操作</th>
            </tr>
            </thead>
            {notempty name='rules'}
            <tbody>
            <div>
                {volist name='rules' id='vo'}
                <tr>
                    <td>{$vo.id}</td>
                    <td>{$vo.name}</td>
                    <td>{$vo.title}</td>
                    <td><?=$vo['type']==1?'实时验证':'登录验证';?></td>
                    <td><?=$vo['status']==1?'正常':'禁用';?></td>
                    <td><?=$vo['condition']==1?'是':'否';?></td>
                    <td class="col-md-2 text-center">
                        <ob_link><a href="{:url('editRule', array('id' => $vo['id']))}" class="btn btn-info"><i
                                        class="fa fa-edit"></i> 编 辑</a></ob_link>
                        <ob_link><a class="btn btn-danger confirm ajax-get "
                                    href="{:url('delRule', array('id' => $vo['id']))}"><i class="fa  fa-user-times"></i> 删 除</a>
                        </ob_link>
                    </td>
                </tr>
                {/volist}
            </div>

            </tbody>
            {else/}
            <tbody>
            <tr class="odd">
                <td colspan="3" class="text-center" valign="top">{:config('empty_list_describe')}</td>
            </tr>
            </tbody>
            {/notempty}
        </table>
        <div class="text-center">
            {$rules->render() }
        </div>
    </div>

</div>


{/block}
