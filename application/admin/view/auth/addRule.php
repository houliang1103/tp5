{extend name="/layout:common"}
{block name="title"}添加权限{/block}
{block name="main"}
<div class="box">
    <div class="box-header">
        <ob_link><span class="btn btn-success" >添加权限</span></ob_link>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <form action="{:url()}" method="post" class="form_single">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>权限</label>
                                <span>（控制器/方法 ：index/index）</span>
                                <input class="form-control" name="name" placeholder="" type="text">

                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>名称</label>
                                <span></span>
                                <input class="form-control" name="title" placeholder="" type="text">
                            </div>
                        </div>



                        <div class="col-md-8">
                            <div class="form-group">
                                <label>类型</label>
                                <span></span>
                                <div>
                                    <label class="margin-r-5"><input type="radio" checked="checked" name="type" value="1"> 实时验证</label>
                                    <label><input type="radio"  name="type"  value="0"> 登录验证</label>
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
                            <div class="form-group">
                                <label>是否附加条件</label>
                                <span></span>
                                <div>
                                    <label class="margin-r-5"><input type="radio" name="condition" value="1"> 是</label>
                                    <label><input type="radio" checked="checked" name="condition"  value="0"> 否</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
