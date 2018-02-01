<?php

namespace app\wechat\controller;

use EasyWeChat\Foundation\Application;
use think\Controller;

class UserController extends Controller
{
    //
    public function index(){
        dump(session('target_url'));
    }

    public function call(){

        $app = new Application(config('weixin'));
        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session('wechat_user',$user->toArray());
        $targetUrl = empty(session('target_url')) ? '/' : session('target_url');
        header('location:'. $targetUrl); // 跳转到 user/profile
    }
    public function getMenu(){
        $app = new Application(config('weixin'));
        $menu = $app->menu;
        dump($menu);
    }

    public function setMenu(){
        $app = new Application(config('weixin'));
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "今日SB排行",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "美女一堆",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
    }



}
