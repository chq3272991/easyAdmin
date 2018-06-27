<?php
return array(
    //在Home模块配置文件中设置VIEW_PATH参数单独定义某个模块的视图目录
    'VIEW_PATH'=>'./Admin/',
    'DEFAULT_MODULE'        =>  'Admin',  // 子域名绑定才能找到这里，这里定义是没效果的
    'DEFAULT_CONTROLLER'    =>  'Static', // 默认控制器名称mStatic
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称index
);