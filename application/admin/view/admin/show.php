{extend name="/layout:common"}
{block name="title"}会员列表{/block}
{block name="main"}
<div class="box">
    <div class="box-header">
        <ob_link><a class="btn btn-success" href="{:url('add')}"><i class="fa fa-plus"></i> 新 增</a></ob_link>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>管理员名称</th>
                <th>管理员密码</th>
                <th>手机号码</th>
                <th>手机邮箱</th>
                <th>注册时间</th>
                <th style="text-align: center">操作</th>
            </tr>
            </thead>
            {notempty name='list'}
            <tbody>
            <div>
                {volist name='list' id='vo'}
                <tr>
                    <td>{$vo.username}</td>
                    <td>{$vo.password}</td>
                    <td>{$vo.mobile}</td>
                    <td>{$vo.email}</td>
                    <td>{$vo.create_time}</td>
                    <td class="col-md-2 text-center">
                       <!-- <ob_link><a href="{:url('edit', array('id' => $vo['id']))}" class="btn btn-info"><i
                                        class="fa fa-edit"></i> 编 辑</a></ob_link>-->
                        <ob_link><a class="btn btn-danger confirm ajax-get "
                                    href="{:url('del', array('id' => $vo['id']))}"><i class="fa  fa-user-times"></i> 删 除</a>
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
            {$list->render() }
        </div>
    </div>

</div>


{/block}
