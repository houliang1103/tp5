<?php

namespace app\admin\controller;

use think\captcha\Captcha;
use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{

    //登录
    public function index()
    {
        //判断是否post提交
        if (Request()->isPost()) {
            //验证码
            $captcha = Request()->post('captcha');
            if (!captcha_check($captcha)) {
                return $this->error('验证码错误');
            };
            $username = Request()->post('username', '', 'trim');
            $password = md5(Request()->post('password', '', 'trim'));
            if (Db::name("system_user")->where(['username' => $username])->find()) {
                if (Db::name("system_user")->where(['username' => $username, 'password' => $password])->find()) {
                    return $this->success('登录成功', url('admin/index/show'), 3);
                } else {
                    return $this->error('密码错误');
                }
            } else {
                return $this->error('用户名存在');
            }
        }
        return $this->fetch('login');

    }

    //注销
    public function logout(){
        session(null);
        $this->success('注销成功','Index/index');

    }


    //后台展示
    public function show()
    {
        $list = Db::name('system_user')->where(['is_deleted'=>0])->paginate(2);
//        分配数据
        $this->assign('list', $list);
//        跳转页面
        return $this->fetch('show');
    }

//    修改方法
    public function edit($id = 0)
    {
//        判断是否有id输入
        if ($id) {
            $user = Db::name('system_user')->find($id);
            $this->assign('user', $user);
        }
        if (Request()->isPost()) {
            $username = Request()->post('username', '', 'trim');
            $password = Request()->post('password', '', 'trim');
            $qq = Request()->post('qq', '', 'trim');
            $email = Request()->post('email', '', 'trim');
            $tel = Request()->post('tel', '', 'trim');
            $id = Request()->post('id', '', 'trim');
            if ($password) {
                if (Db::name('system_user')->where(['id' => $id])->update(['password' => md5($password), 'username' => $username,'mail' => $email, 'phone' => $tel, 'qq' => $qq,])) {
                    return $this->redirect(url('admin/index/show'));
                }
            } else {

                if (Db::name('system_user')->where(['id' => $id])->update(['username' => $username])) {
                }
                return $this->redirect(url('admin/index/show'));
            }
        }

        return $this->fetch('add');

    }

    //删除方法
    public function del($id)
    {
        Db::name('system_user')->where(['id' => $id])->update(['is_deleted'=>1]);
        return $this->success('删除成功', url('admin/index/show'), 3);
    }

    //添加方法
    public function add()
    {
        if (Request()->isPost()) {

            $username = Request()->post('username', '', 'trim');
            $password = Request()->post('password', '', 'trim');
            $qq = Request()->post('qq', '', 'trim');
            $email = Request()->post('email', '', 'trim');
            $tel = Request()->post('tel', '', 'trim');
            $time = time();
            if ($username && $password) {
                if (Db::name('system_user')->insert(['password' => md5($password), 'username' => $username, 'mail' => $email, 'phone' => $tel, 'qq' => $qq, 'create_at' => $time])) {
                    return $this->success('添加成功', url('admin/index/show'), 3);
                }
            } else {
                return $this->error('用户名或密码不能为空');
            }

        }
        return $this->fetch('add');
    }

}
