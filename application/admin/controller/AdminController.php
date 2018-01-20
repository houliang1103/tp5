<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 19:46
 */

namespace app\admin\controller;


use think\Controller;
use think\Cookie;
use think\Db;

class AdminController extends Controller
{

    public function index(){

        $list =  Db::name('member')->where(['status'=>1])->paginate(2);
        $this->assign('list',$list);
        return $this->fetch('show');
    }
    //登录
    public function login(){
        //判断是否已经有登录信息
        if(Cookie::get('username')){
            return $this->redirect('index');
        }
        if (request()->isPost()) {
            //验证验证码
//            if(!captcha_check(input('post.captcha'))){
//                return  $this->error('验证码不正确');
//            }
            // 输入数据效验
            $username = $this->request->post('name', '', 'trim');
            $password = $this->request->post('password', '', 'trim');
            //$user =Db::name('admin')->where('password',$password)->find();
            $user =  Db::name('member')->where('username', $username)->find();
            if ($user && $user['password'] == $password) {
                //保存登录信息 判断是否有保留的登录信息
                if (Cookie::has('username')){
                    Cookie::delete('username');
                }
               // 如果有点击记住登录

                if ($this->request->post('remember')){
                    Cookie::set('username',$user,3600*24);
                }
                return  $this->success('登录成功，正在进入系统...', 'index');
            }else{
                return $this->error('账号或密码错误，请重新输入!');
            }
           /* strlen($username) < 4 && $this->error('登录账号长度不能少于4位有效字符!');
            strlen($password) < 4 && $this->error('登录密码长度不能少于4位有效字符!');
            // 用户信息验证
            $user = Db::name('SystemUser')->where('username', $username)->find();
            empty($user) && $this->error('登录账号不存在，请重新输入!');
            ($user['password'] !== md5($password)) && $this->error('登录密码与账号不匹配，请重新输入!');
            empty($user['status']) && $this->error('账号已经被禁用，请联系管理!');
            // 更新登录信息
            $data = ['login_at' => ['exp', 'now()'], 'login_num' => ['exp', 'login_num+1']];
            Db::name('SystemUser')->where(['id' => $user['id']])->update($data);
            session('user', $user);
            !empty($user['authorize']) && NodeService::applyAuthNode();
            LogService::write('系统管理', '用户登录系统成功');
            $this->success('登录成功，正在进入系统...', '@admin');*/
        }

        return $this->fetch('login');

    }

//退出登录
    public function logout()
    {
        //dump(Cookie::get('username'));exit;
        Cookie::delete('username');
        if(Cookie::get('username')) {
            return $this->error('退出失败');
        } else {
            return $this->fetch('login');
        }
    }
    //上传图片
    public function image(){

        if (request()->isPost()){
            $width = request()->post('width');
            $height = request()->post('height');
            $file = request()->file('image');
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move( ROOT_PATH .'public' . DS .'static'.DS . 'images');
                if($info){
                    // 成功上传后 获取上传信息
                    // 输出 jpg
                    //echo $info->getExtension();
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    //echo $info->getSaveName();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    //echo $info->getFilename();

                    $image = \think\Image::open(ROOT_PATH .'public' . DS .'static'.DS . 'images'.DS.$info->getSaveName());
                    $image->thumb($width, $height)->save(ROOT_PATH .'public' . DS .'static'.DS . 'images'.DS.$width.'x'.$height.'_'.$info->getFilename());
                    //创建画布
                    imagecreatefromjpeg(ROOT_PATH .'public' . DS .'static'.DS . 'images'.DS.$width.'x'.$height.'_'.$info->getFilename());
                    //设置header头
                    header('content-type:image/jpeg');
                    imagejpeg();
                    die;
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }

        }

        return $this->fetch('images');
    }


    public function add(){
        if (Request()->isPost()) {

            $username = Request()->post('username', '', 'trim');
            $password = Request()->post('password', '', 'trim');
            $email = Request()->post('email', '', 'trim');
            $mobile = Request()->post('mobile', '', 'trim');
            $is_share_member = Request()->post('is_share_member', '', 'trim');
            $time = time();
            if ($username && $password) {
                if (Db::name('member')->insert(['password' => $password, 'username' => $username, 'email' => $email, 'mobile' => $mobile,  'create_time' => $time,'is_share_member'=>$is_share_member])) {
//                    return $this->success('添加成功', url('/admin/admin/index'), 3);
                    return $this->redirect('index');
                }
            } else {
                return $this->error('用户名或密码不能为空');
            }

        }
        return $this->fetch('add');
    }

    //编辑
    public function edit($id){
        if (Request()->isPost()) {
            $id = Request()->post('id', '', 'trim');
            $username = Request()->post('username', '', 'trim');
            $password = Request()->post('password', '', 'trim');
            $email = Request()->post('email', '', 'trim');
            $mobile = Request()->post('mobile', '', 'trim');
            $is_share_member = Request()->post('is_share_member', '', 'trim');
            $time = time();
            if ($username && $password) {
                if (Db::name('member')->where(['id' => $id])->update(['password' => $password, 'username' => $username, 'email' => $email, 'mobile' => $mobile,  'update_time' => $time,'is_share_member'=>$is_share_member])) {
//                    return $this->success('添加成功', url('/admin/admin/index'), 3);
                    Cookie::set('id',null);
                    return $this->redirect('index');
                }
            } else {
                return $this->error('用户名或密码不能为空');
            }

        }
        Cookie::set('id',$id);
        return $this->fetch('add');
    }
    //删除
    public function del($id)
    {
        Db::name('member')->where(['id' => $id])->update(['status'=>0]);
        return $this->redirect('index');
    }
}