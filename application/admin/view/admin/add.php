{extend name="/layout:common"}
{block name="title"}添加会员{/block}
{block name="main"}
<div class="box">
    <div class="box-header">
       <ob_link><span class="btn btn-success" >添加会员</span></ob_link>
        <br/>
    </div>
    <div class="box-body table-responsive">
        <form action="{:url()}" method="post" class="form_single">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>用户名</label>
                                <span>（用户名会作为默认的昵称）</span>
                                <input class="form-control" name="username" placeholder="请输入用户名" type="text">
                                <input type="hidden" name="id" value="<?=\think\Cookie::get('id')?>">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>密码</label>
                                <span>（用户密码不能少于6位）</span>
                                <input class="form-control" name="password" placeholder="请输入密码" type="password">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>所属分组</label>
                                <select class="form-control" name="group_id">
                                    {volist name="group" id="vo"}
                                        <option value="{$vo.id}">{$vo.title}</option>
                                    {/volist}
                                </select>

                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>邮箱</label>
                                <span>（用户邮箱，用于找回密码等安全操作）</span>
                                <input class="form-control" name="email" placeholder="请输入邮箱" type="text">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>电话</label>
                                <span>（用户邮箱，用于找回密码等安全操作）</span>
                                <input class="form-control" name="mobile" placeholder="请输入电话" type="text">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>电话</label>
                                <span>（用户邮箱，用于找回密码等安全操作）</span>
                                <input class="form-control" value="获取地址"  type="button" onclick="getLocation()">
                                <p id="demo">12312</p>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>是否共享会员</label>

                                <div>
                                    <label class="margin-r-5"><input type="radio" name="is_share_member" value="1"> 是</label>
                                    <label><input type="radio" checked="checked" name="is_share_member"  value="0"> 否</label>
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

<script>
    var x=document.getElementById("demo");
    function getLocation()
    {
        //alert(111);
        if (navigator.geolocation)
        {

            navigator.geolocation.getCurrentPosition(function (position) {
                alert(111);
                x.innerHTML="Latitude: " + position.coords.latitude +
                    "<br />Longitude: " + position.coords.longitude;
            });

        }
        else{x.innerHTML="Geolocation is not supported by this browser.";}
    }
    function showPosition(position)
    {
        alert(111);
        x.innerHTML="Latitude: " + position.coords.latitude +
            "<br />Longitude: " + position.coords.longitude;
    }
</script>
{/block}
