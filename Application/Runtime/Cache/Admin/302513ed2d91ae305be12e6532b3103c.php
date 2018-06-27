<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
    <title>银河移民后台管理登陆界面</title>
    <link rel="shortcut icon" href="/Admin/img/icon.png">
    <link rel="stylesheet" href="/Admin/css/base.css" />
    <link rel="stylesheet" href="/Admin/css/login.css" />
</head>
<body>


<section>
    <div class="login_con">

        <div class="head">
            <img src="../Admin/img/loginBg_09.jpg"/>
            <h1>easyAdmin后台管理登陆界面</h1>
        </div>
        <div class="wrapper">
            <form action="/Login/index.html" method="post" >
                <div class="loginBox">
                    <div class="loginBoxCenter">
                        <p><label for="username">用户名：</label></p>
                        <p><input type="text" id="username" name="username" class="loginInput" autofocus="autofocus" required="required" autocomplete="off" placeholder="请输入用户名" value="" /></p>
                        <p><label for="password">密码：</label><a class="forgetLink" href="#">忘记密码?</a></p>
                        <p><input type="password" id="password" name="password" class="loginInput" required="required" placeholder="请输入密码" value="" /></p>
                    </div>
                    <div class="loginBoxButtons">
                        <input id="remember" type="checkbox" name="remember" checked/>
                        <label for="remember">记住登录状态</label>
                        <button class="loginBtn">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="/Admin/js/jquery.min.js"></script>
<script src="/Admin/js/jquery.cookie.js"></script>
<script src="/Admin/js/md5.js"></script>
<script src="/Admin/js/login.js"></script>
</body>
</html>