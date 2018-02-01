<?php

namespace app\api\controller;



use think\Db;

class UserController extends BaseController
{
    //aaa
    public function login($username,$pwd)
    {
//        $username = input('username');
//        $pwd = input('pwd');

      $user =   Db::name('user')->where(['username'=>$username])->find();
        if ($user && password_verify($pwd,$user['password_hash'])){
            return $this->getJson('登录成功',true,$user);
        }else{
            return $this->getJson('账号或密码错误');
        }
    }
}
