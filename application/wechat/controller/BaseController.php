<?php

namespace app\wechat\controller;

use think\Controller;
use EasyWeChat\Foundation\Application;


class BaseController extends Controller
{
    //
    public function _initialize()
    {
        // 未登录
        if (empty(session('wechat_user'))) {
            $app = new Application(config('weixin'));
            $oauth = $app->oauth;
            session('target_url','/'.request()->module().'/'.request()->controller().'/'.request()->action());
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
             $oauth->redirect()->send();
        }

        parent::_initialize();
    }
}
