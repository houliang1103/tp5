<?php

namespace app\wechat\controller;

use think\Controller;

class TestController extends BaseController
{
    //
    public function index(){

        dump(session('wechat_user'));

    }
}
