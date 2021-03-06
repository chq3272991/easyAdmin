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
    <link rel="stylesheet" href="/Admin/css/tableBase.css?v=20170118" />
</head>
<body class="fixed-sidebar full-height-layout gray-bg" id="list">
    <!--<iframe id="R_iframe" width="100%" src="assessment2.html" scrolling="no" frameborder="0" seamless ></iframe>-->
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>列表信息<?php echo ($model); ?></h5>
                    <div class="ibox-tools">
                        <a href="javascript:;" id="refresh">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a href="javascript:;" id="chevron">
                            <i class="glyphicon glyphicon-chevron-down"></i>
                        </a>
                        <a href="javascript:;" id="dropdownMenu1" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-wrench"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li><a href="javascript:;">选项1</a>
                            </li>
                            <li><a href="javascript:;">选项2</a>
                            </li>
                        </ul>
                        <a href="javascript:;" id="close">
                            <i class="glyphicon glyphicon-remove-circle"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" id="ibox-content">
                    <!--头部一些搜索条件-->
                    <div class="row">
                        <div class="col-sm-2 m-b-xs">
                            <select class="input-sm form-control input-s-sm inline" id="form_control">
                                <option value='10'>每页显示10条</option>
                                <option value='15'>每页显示15条</option>
                                <option value='25'>每页显示25条</option>
                                <option value='100'>每页显示100条</option>
                                <option value='0'>全部</option>
                            </select>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            <input placeholder="开始日期" class="form-control layer-date" id="start">
                            <input placeholder="结束日期" class="form-control layer-date" id="end">
                        </div>

                        <div class="col-sm-6 m-b-xs" style="text-align: right;">
                            <select class="input-sm inline" id="optionsSearch">
                                <option value='0'>id</option>
                                <option value='1' selected="selected">名称</option>
                                <option value='2'>手机</option>
                                <option value='3'>国家</option>
                                <option value='4'>分类</option>
                            </select>
                            <select class="input-sm inline" id="optionsCondition">
                                <option value='='>等于</option>
                                <option value='like' selected="selected">包含</option>
                            </select>
                            <input type="text" id="searchCon" value=""/>
                            <button id="reset" type="button" class="btn1 btn-default"> <i class="glyphicon glyphicon-refresh"></i> 重置</button>
                            <button id="search" type="button" class="btn1 btn-default"> <i class="glyphicon glyphicon-search"></i> 搜索</button>
                        </div>
                    </div>
                    <!--正文-->
                    <div class="table-responsive" id="table_list">
                        <table class="table table-striped on">
                            <?php echo ($temp); ?>
                        </table>
                    </div>

                    <!--批量删除-->
                    <div class="delete">
                        <a href="javascript:;">
                            <i class="glyphicon glyphicon-trash"></i> 删除
                        </a>
                    </div>

                    <!--新增-->
                    <div class="add">
                        <a href="javascript:;" onclick="observer.helper.openLayer('0','add');return false;">
                            <i class="glyphicon glyphicon-plus-sign"></i> 新增
                        </a>
                    </div>

                    <!--动态分页构造器-->
                    <div id="pageDiv">

                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/Admin/temps/laydate/laydate.js"></script>
    <script src="/Admin/temps/layer/layer.js"></script>
    <script src="/Admin/js/tools/vue.js"></script>
    <script src="/Admin/js/init.js?v=20170118"></script>
    <script src="/Admin/js/tools/page.js"></script>
    <!---->
    <script src="/Admin/js/helper/list.js?v=20170118" defer=true></script>
    <script src="/Admin/js/helper/common.js?v=20170118" defer=true></script>
    <script src="/Admin/js/observer/observe.js?v=20170118" defer=true></script>
    <script src="/Admin/js/list.js?v=20170118" defer=true></script>

</body>
</html>