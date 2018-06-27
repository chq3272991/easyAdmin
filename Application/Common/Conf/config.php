<?php
return array(
    //'配置项'=>'配置值'

    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址localhost
    'DB_NAME'   => 'easydb', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'easydb_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

    'URL_CASE_INSENSITIVE' => true,
    'URL_PARAMS_BIND_TYPE'  =>  1, // 设置参数绑定按照变量顺序绑定  虽然简化了url，但是也需要重构分页生成url的问题
    //'VAR_URL_PARAMS'      => '_URL_', // PATHINFO URL参数变量
    //eg: http://serverName/index.php/Home/Blog/archive/2013/11  =>?year=2013&month=11
    'ImgConfig' => array(
        'maxSize'    =>    3145728,
        'rootPath'   =>    './uploads/image/',
        'savePath'   =>    '',
        'saveName'   =>    array('uniqid',''),
        'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub'    =>    true,
        'subName'    =>    array('date','Ymd'),
    ),
);