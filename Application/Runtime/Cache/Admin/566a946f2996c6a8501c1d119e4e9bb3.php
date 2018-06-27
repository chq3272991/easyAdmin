<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>数据库首页</title>
    <link rel="shortcut icon" href="/Admin/img/icon.png">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Admin/css/base.css" />
    <link rel="stylesheet" href="/Admin/css/index.css" />
    <link rel="stylesheet" href="/Admin/css/tableBase.css" />
</head>
<body class="fixed-sidebar full-height-layout gray-bg">
<div id="wrapper">
    <!--左侧导航开始-->
<nav class="nav-left" role="navigation">
    <h3>
        <i class="glyphicon glyphicon-user"></i>
        <span>数据库管理</span>
    </h3>
    <div class="classify_pd">

        <div class="classify" style="display: none">
            <p class="classify_title">分类</p>
            <h4 class="clearfix">
                <a href="table_base.html">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>首页</span>
                </a>
            </h4>
        </div>

        <div class="classify classify_line">
            <h4 class="clearfix classify_h">
                <i class="glyphicon glyphicon-list-alt"></i>
                <span>新闻系统</span>
                <b class="glyphicon glyphicon-chevron-left"></b>
            </h4>
            <ul class="classify_list none">
                <li><a href="showlist?model=infolist&pageNum=5">所有列表</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D14">头条新闻</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D15">银河快讯</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D43">常见问题</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D53">香港保险</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D180">移民资讯</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D181">当地教育</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D182">移民政策</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D183">移民生活</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D184">税收福利</a></li>
                <li><a href="showlist?model=infolist&pageNum=5&where=classid%3D190">活动讲座</a></li>
            </ul>
        </div>
        <div class="classify classify_line">
            <h4 class="clearfix classify_h">
                <i class="glyphicon glyphicon-list-alt"></i>
                <span>数据分析</span>
                <b class="glyphicon glyphicon-chevron-left"></b>
            </h4>
            <ul class="classify_list">
            </ul>
        </div>
        <div class="classify classify_line">
            <h4 class="clearfix classify_h">
                <i class="glyphicon glyphicon-list-alt"></i>
                <span>内容管理</span>
                <b class="glyphicon glyphicon-chevron-left"></b>
            </h4>
            <ul class="classify_list">
                <li><a href="showlist?model=rebanner&pageNum=6&order=orderid&where=classid%3D13">PC端滚动展示</a></li>
                <li><a href="showlist?model=admin&pageNum=10">管理员管理</a></li>
            </ul>
        </div>
    </div>

</nav>
<!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper">
        <iframe id="R_iframe" width="100%" src="showlist?model=infolist&pageNum=5" scrolling="no" frameborder="0" seamless ></iframe>
    </div>
    <!--右侧部分结束-->
</div>

<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/Admin/js/tools/jquery.cookie.js"></script>
<script src="/Admin/temps/layer/layer.js"></script>
<script src="/Admin/js/init.js"></script>
<script src="/Admin/js/galaxy_sys.js" defer=true></script>
</body>
</html>