<?php
return [
    'debug' => true,
    'charSet' => 'UTF-8',
    'defaultGroup' => 'backend',
    'defaultController' => 'Index',
    'defaultAction' => 'index',

    'mysql' => [
        'type'   => 'mysql',     //数据库类型
        'host'   => '127.0.0.1', //数据库主机名
        'dbName' => 'test',      //使用的数据库
        'username'   => 'root',      //数据库连接用户名
        'pwd'    => '123456',    //对应的密码
    ],

    'interceptorArr' => [
        'app\backend\interceptor\LoginInterceptor' => '*',
        'app\backend\interceptor\AccessInterceptor' => 'backend\/in(.*)',
    ],
];