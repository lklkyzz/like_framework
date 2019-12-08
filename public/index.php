<?php
header("Content-type:text/html;charset=utf-8");
define('ROOT_PATH', dirname( __FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR); //根目录
define('SYS_PATH', ROOT_PATH . 'Framework' . DIRECTORY_SEPARATOR); //系统目录
define('APP_PATH', ROOT_PATH . 'app' . DIRECTORY_SEPARATOR); //应用根目录
define('CONFIG_PATH', ROOT_PATH . 'config' . DIRECTORY_SEPARATOR); //配置根目录
define('LOG_PATH', ROOT_PATH . 'runtime' . DIRECTORY_SEPARATOR); //日志缓存目录
$GLOBALS['config'] = require_once CONFIG_PATH . 'app.php';

require ROOT_PATH . 'vendor/autoload.php';
require SYS_PATH . 'Framework.php';

/**
 * 错误与异常处理
 * 开启debug模式，显示错误，否则写入日志记录
 * 异常都需显示
 **/
if ( $GLOBALS['config']['debug'] == true ) {
    if ( substr(PHP_VERSION, 0, 3) >= '5.5' ) {
        error_reporting(E_ALL);
    } else {
        error_reporting(E_ALL | E_STRICT);
    }
} else {
    set_error_handler(['Framework', 'errorHandler']);
}
set_exception_handler(['Framework', 'exceptionHandler']);

$app = new Framework();
$app->run();
