<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class MenuController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取所有菜单
        $list = Db::name('menu')->paginate(8);
        $this->assign('list',$list);
        return view('menus');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        if (\request()->isPost()) {

            $name = Request()->post('name');
            $pid = Request()->post('pid');
            $sort = Request()->post('sort' );
            $module = Request()->post('module');
            $url = Request()->post('url' );
            $is_hide = Request()->post('is_hide');
            $icon = Request()->post('icon');
            $status = Request()->post('status');
            $create_time = time();

            if (Db::name('menu')->insert(['name'=>$name,'pid'=>$pid,'sort'=>$sort,'module'=>$module,'url'=>$url,'is_hide'=>$is_hide,'icon'=>$icon,'status'=>$status,'create_time'=>$create_time])) {
                return $this->success('添加成功','index');
            }

        }
        //获取所有的菜单
        $menus = Db::name('menu')->select();
        //分配数据
        $this->assign('menus',$menus);
        return view();
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        if (\request()->isPost()) {

            $name = Request()->post('name');
            $pid = Request()->post('pid');
            $sort = Request()->post('sort' );
            $module = Request()->post('module');
            $url = Request()->post('url' );
            $is_hide = Request()->post('is_hide');
            $icon = Request()->post('icon');
            $status = Request()->post('status');
            $id = Request()->post('id');
            $create_time = time();

            if (Db::name('menu')->where(['id'=>$id])->update(['name'=>$name,'pid'=>$pid,'sort'=>$sort,'module'=>$module,'url'=>$url,'is_hide'=>$is_hide,'icon'=>$icon,'status'=>$status,'create_time'=>$create_time])) {
                return $this->success('修改成功','index');
            }

        }
        //获取所有的菜单
        $menus = Db::name('menu')->select();
        //获得修改的数据 回显
        $menu = Db::name('menu')->find($id);
        //分配数据
        $this->assign('menus',$menus);
        $this->assign('menu',$menu);
        return view();
    }



    public function del($id)
    {
        //找出是否有子类
        if (Db::name('menu')->where(['pid'=>$id])->count()) {
            return $this->error('该菜单下有子菜单，不能删除',url('index'));
        }
        if (Db::name('menu')->delete($id)) {
            return $this->success('删除成功',url('index'));
        }
    }
}
