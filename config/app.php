<?php
return [
    'mode' => 'debug',
    'charSet' => 'UTF-8',
    'defaultGroup' => 'backend',
    'defaultController' => 'Index',
    'defaultAction' => 'index',

    'mysql' => [
        'type'   => 'mysql',     //数据库类型
        'host'   => 'localhost', //数据库主机名
        'dbName' => 'test',      //使用的数据库
        'username'   => 'root',      //数据库连接用户名
        'pwd'    => '123456',    //对应的密码
    ],
];