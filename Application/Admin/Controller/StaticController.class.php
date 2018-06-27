<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/27
 * Time: 10:39
 */

namespace Admin\Controller;


class StaticController extends InterfaceController
{
    //登录页面
    public function index()
    {
        $this->display("login");
    }

    //默认主模块
    public function galaxy_sys(){
        //查看当前session是否有用户登录会话，没有就退出返回登录页
        $this->display();
    }

    //列表页
    public function showlist(){
        $model = I('get.model');
        $temp = $this->fetch($model.'List');
        $this->assign('model',$model);
        $this->assign('temp',$temp);
        $this->display("list");
        //echo $model;exit;
    }

    //详情页
    public function showdetail(){
        $model = I('get.model');
        $action = I('get.action');
        $form = $this->fetch($model.'Detail');
        $this->assign('model',$model);
        $this->assign('action',$action);
        $this->assign('form',$form);
        $this->display('detail');
    }

}