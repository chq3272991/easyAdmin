<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/3
 * Time: 9:22
 */

namespace Admin\Controller;


class LoginController extends InterfaceController
{
    //登录
    public function index()
    {
        $username = I('post.username');
        $password = I('post.password');
        $param['username'] = $username;
        $param['password'] = md5($password);
        $result = D('User')->where($param)->find();

        if($result){
            // 成功后跳转到新闻列表页面
            $this->success('登录成功，即将前往列表页面', '/Static/galaxy_sys');
        }else{
            $this->error('登录失败，请重新登录', '/');
        }
    }

    //注册
    public function register(){
        $username = I('post.username');
        $password = I('post.password');
        $param['username'] = $username;
        $param['password'] = md5($password);
        //查找当前用户列表是否有同名的
        $isExist = D('User')->where('username='.$username)->find();
        if($isExist){
            $this->ajaxJSON('已存在该用户！');
        }
        //继续注册
        $result = D('User')->add($param);
    }
}