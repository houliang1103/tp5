<?php

namespace app\admin\controller;



use think\Db;

class AuthController extends BaseController
{
    //权限列表
    public function rules(){
        //获得所有分组
        $rules = Db::name('auth_rule')->paginate(8);
        $this->assign('rules',$rules);
        return view('rules');
    }
    //添加权限
    public function addRule(){

        if (Request()->isPost()){
            $name = Request()->post('name', '', 'trim');
            $title = Request()->post('title');
            $type = Request()->post('type');
            $status = Request()->post('status');
            $condition = Request()->post('condition');

            if (Db::name('auth_rule')->insert(['name' => $name, 'title' => $title, 'type' => $type, 'status' => $status, 'condition' => $condition])) {

                return $this->success('添加成功', 'rules');
                //return $this->redirect('index');
            } else {
                return $this->error('用户名或密码不能为空');
            }
        }
        //获得所有分组
        $group = Db::name('auth_group')->where('status','=',1)->select();
        $this->assign('group',$group);
        return view('addRule');

    }
    //删除权限
    public function delRule($id){
        if (Db::name('auth_rule')->delete(['id'=>$id])) {
            return $this->success('删除成功', 'rules');
        }
    }
    //分组列表
    public function groups(){


        $groups = Db::name('auth_group')->select();

        $this->assign('groups',$groups);
        return view('groups');
    }
    //添加权限
    public function addGroup(){

        if (Request()->isPost()){
            $title = Request()->post('title');
            $status = Request()->post('status');
            $rules = Request()->post('rules/a');
            $rules = implode(',',$rules);
            if (Db::name('auth_group')->insert(['title' => $title,'status' => $status,'rules'=>$rules])) {

                return $this->success('添加成功', 'groups');
                //return $this->redirect('index');
            } else {
                return $this->error('用户名或密码不能为空');
            }
        }
        //获得所有权限
        $rules = Db::name('auth_rule')->where('status',1)->select();
        $this->assign('rules',$rules);
        return view('addGroup');
    }

    //删除分组
    public function delGroup($id){
        if (Db::name('auth_group')->delete($id)) {

            return $this->success('删除成功', 'groups');
        }
    }
}
