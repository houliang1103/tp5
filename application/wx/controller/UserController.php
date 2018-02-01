<?php

namespace app\wx\controller;

use app\wx\model\User;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use think\Controller;
use think\Db;

class UserController extends BaseController
{
    //用户详细信息
    public function index(){
        if (!User::get(['open_id'=>$this->openId])) {
            return $this->redirect('bind');
        }

        $users = User::get(['open_id'=>$this->openId]);
        return $this->fetch('infor',compact('users'));
    }
    //绑定账号
    public function bind(){

        if (User::get(['open_id'=>$this->openId])) {
            return view('unbind');
        }

        if (request()->isPost()){

            $username = input('username');
            $password = input('password');
            $user = User::get(['username'=>$username]);
            file_put_contents('user.text',$user.$password.$username);
            if ($user && password_verify($password,$user->password_hash) ) {
                $user->open_id=$this->openId;
                if ($user->save()) {
                    //发模板消息
                    $app = new Application(config('weixin'));
                    $notice = $app->notice;
                    $userId = $this->openId;
                    $templateId ='y5IX5SbnpKplsRZJXKP9VTEaqCsAaYbrUVc471lG-NY';
                    $url = 'http://baidu.com';
                    $data = array(
                        "first"  => "绑定账号成功",
                        "name"   => $user->username,
                        "time"  => date('Y-m-d'),
                        "remark" => "欢迎入住小店",
                    );
                    $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
                    //刷新当前页面
                    return $this->success('绑定成功',url('/wx/user/bind'));
                }
            }else{
                return $this->error("用户名或密码错误");
            }


        }
        //指定视图
        return view();

    }
    //解除绑定
    public function unbind(){
        //找到解绑用户
        $user=User::get(['open_id'=>$this->openId]);
        if ($user) {
            $user->open_id="";
            // $user->save();
            if ($user->save()) {
                //发模板消息
                $app = new Application(config('weixin'));
                $notice = $app->notice;
                $userId = $this->openId;
                $templateId ='y5IX5SbnpKplsRZJXKP9VTEaqCsAaYbrUVc471lG-NY';
                $url = 'http://baidu.com';
                $data = array(
                    "first"  => "解除绑定成功",
                    "name"   => $user->username,
                    "time"  => date('Y-m-d'),
                    "remark" => "欢迎下次光临",
                );
                $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
                //刷新
                return $this->success("解绑成功",url('/wx/user/bind'));
            }
        }

    }

    //获得订单
    public function orders(){
        if (!User::get(['open_id'=>$this->openId])) {
            return $this->redirect('bind');
        }

        $user = User::get(['open_id'=>$this->openId]);
        $orders = Db::name('orders')->where('user_id',$user->id)
            ->select();
        return $this->fetch('show',compact('orders'));
    }




}
