{extend name="/layout:common"}
{block name="title"}修改菜单{/block}
{block name="main"}
<div class="box">
    <div class="box-header">
        <ob_link><span class="btn btn-success" >修改菜单</span></ob_link>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <form action="{:url()}" method="post" class="form_single">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>名称</label>
                                <span></span>
                                <input class="form-control" name="name" placeholder="" type="text" value="{$menu.name}">

                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>父级菜单</label>
                                <span></span>
                                <select class="form-control" name="pid">
                                    {volist name="menus" id="vo"}
                                    <option value="{$vo.id}" <?php if($menu['pid']==$vo['id']){echo 'checkde';}?>>{$vo.name}</option>
                                    {/volist}
                                </select>
                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="form-group">
                                <label>同级排序</label>
                                <span></span>
                                <input class="form-control" name="sort" placeholder="" type="text" value="{$menu.sort}">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>所属模块</label>
                                <span></span>
                                <input class="form-control" name="module" placeholder="" type="text" value="{$menu.module}">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>路由</label>
                                <span></span>
                                <input class="form-control" name="url" placeholder="" type="text" value="{$menu.url}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>图标</label>
                                <span></span>
                                <input class="form-control" name="icon" placeholder="" type="text" value="{$menu.icon}">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>是否隐藏</label>
                                <span></span>
                                <div>
                                    <label class="margin-r-5"><input type="radio" checked="checked" name="is_hide" value="1"> 显示</label>
                                    <label><input type="radio"  name="is_hide"  value="0"> 隐藏</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>状态</label>
                                <span></span>
                                <div>
                                    <label class="margin-r-5"><input type="radio" checked="checked" name="status" value="1"> 正常</label>
                                    <label><input type="radio"  name="status"  value="0"> 禁用</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">


                    </div>
                </div>
                    <input type="hidden" name="id" value="{$menu.id}">
                <div class="box-footer">
                    <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
                        <span class="ladda-label">确 定</span>
                    </button>

                    <a class="btn" onclick="javascript:history.back(-1);return false;"> 返 回</a>
                </div>
            </div>
        </form>
        <div class="text-center">
        </div>
    </div>

</div>


{/block}
