<?php
define('ROOT_PATH', dirname( __FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR); //根目录
define('SYS_PATH', ROOT_PATH . 'Framework' . DIRECTORY_SEPARATOR); //系统目录
define('APP_PATH', ROOT_PATH . 'app' . DIRECTORY_SEPARATOR); //应用根目录
define('CONFIG_PATH', ROOT_PATH . 'config' . DIRECTORY_SEPARATOR); //配置根目录

require SYS_PATH . 'Framework.php';
$GLOBALS['config'] = require_once CONFIG_PATH . 'app.php';//临时存放
$app = new Framework();
$app->run();
