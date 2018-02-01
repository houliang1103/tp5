<?php

namespace app\admin\controller;

use think\auth\Auth;
use think\Controller;
use think\Cookie;
use think\exception\HttpException;
use think\process\pipes\Windows;

class BaseController extends Controller
{
    public function _initialize()
    {

        $controller = request()->controller();
        $action = request()->action();
        $route = strtolower($controller.'/'.$action);
        //定义白名单
        $allow = [
            'admin/login',
            'admin/logout'
        ];



        if (in_array($route,$allow)===false){
            //判断是否已经有登录信息  完善需要验证  此处未做
            if(!session('user_id')){
               return $this->redirect('/admin/admin/login');
            }
            $auth = new Auth();
            if(!$auth->check($controller . '/' . $action, session('user_id'))){
                $this->error('你没有权限访问');
                //header("Location: http://think.tplay.com/admin/admin/login");
            }
        }
        parent::_initialize();
    }
}
