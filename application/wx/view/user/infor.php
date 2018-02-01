<!-- head 中 -->
<link rel="stylesheet" href="//cdn.bootcss.com/weui/0.4.3/style/weui.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/0.8.3/css/jquery-weui.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">

<div class="weui_cells">
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <p>用户名</p>
        </div>
        <div class="weui_cell_ft">
            <?=$users->username?>
        </div>

    </div>
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <p>电话</p>
        </div>
        <div class="weui_cell_ft">
            <?=$users->mobile?>
        </div>

    </div>
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <p>邮箱</p>
        </div>
        <div class="weui_cell_ft">
            <?=$users->email?>
        </div>

    </div>
</div>


<div class="weui_tab">
    <div class="weui_tab_bd">

    </div>
    <div class="weui_tabbar">
        <a href="javascript:;" class="weui_tabbar_item weui_bar_item_on">
            <div class="weui_tabbar_icon">
                <img src="path/to/images/icon_nav_button.png" alt="">
            </div>
            <p class="weui_tabbar_label">微信</p>
        </a>
        <a href="javascript:;" class="weui_tabbar_item">
            <div class="weui_tabbar_icon">
                <img src="path/to/images/icon_nav_msg.png" alt="">
            </div>
            <p class="weui_tabbar_label">通讯录</p>
        </a>
        <a href="javascript:;" class="weui_tabbar_item">
            <div class="weui_tabbar_icon">
                <img src="path/to/images/icon_nav_article.png" alt="">
            </div>
            <p class="weui_tabbar_label">发现</p>
        </a>
        <a href="javascript:;" class="weui_tabbar_item">
            <div class="weui_tabbar_icon">
                <img src="path/to/images/icon_nav_cell.png" alt="">
            </div>
            <p class="weui_tabbar_label">我</p>
        </a>
    </div>
</div>

<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/0.8.3/js/jquery-weui.min.js"></script>