{extend name="/layout:common"}
{block name="title"}分组列表{/block}
{block name="main"}
<div class="box">
    <div class="box-header">
        <ob_link><a class="btn btn-success" href="{:url('addGroup')}"><i class="fa fa-plus"></i> 添加分组</a></ob_link>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>序号</th>
                <th>名称</th>
                <th>状态</th>
                <th>权限</th>
                <th>操作</th>
            </tr>
            </thead>
            {notempty name='groups'}
            <tbody>
            <div>
                {volist name='groups' id='vo'}
                <tr>
                    <td>{$vo.id}</td>
                    <td>{$vo.title}</td>
                    <td><?=$vo['status']==1?'正常':'禁用';?></td>
                    <td>
                    <?php $str='';  foreach (explode(',',$vo['rules']) as $rule){
                       $str .=   (\think\Db::name('auth_rule')->find($rule))['title']." ||";

                    }
                    echo substr($str,0,-2);?>

                    </td>
                    <td class="col-md-2 text-center">
                        <ob_link><a class="btn btn-danger confirm ajax-get " href="{:url('delGroup', array('id' => $vo['id']))}"><i class="fa  fa-user-times"></i> 删 除</a>
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
        </div>
    </div>

</div>


{/block}
