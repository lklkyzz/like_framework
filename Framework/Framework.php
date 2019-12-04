<?php
/**
 * 框架核心类
 */
class Framework
{
    /**
     * 解析路由，路由分发
     */
    public function run()
    {
        require_once 'core/Loader.php';
        spl_autoload_register(['Framework\core\Loader', 'loadCoreClass']);
        $this->route();
        $this->dispatch();
    }

    /**
     * 解析路由
     */
    public function route()
    {
        $this->route = new Framework\core\Route();
        $this->route->init();
    }

    /**
     * 路由分发,执行请求方法
     */
    public function dispatch()
    {
        $controllerName = ucfirst($this->route->controller).'Controller'; //字符串大写首字母
        $actionName = $this->route->action;
        $group = $this->route->group;
        $className = "app\\{$group}\controller\\{$controllerName}";

        $methods = get_class_methods($className) ?: [];
        if (!in_array($actionName, $methods, true)) {
            throw new Exception("方法名{$controllerName}->{$actionName}不存在");
        }

        //执行
        $handler = new $className();
        $reflectedClass = new \ReflectionClass('Framework\core\Controller');
        $reflectedProperty = $reflectedClass->getProperty('route');
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($this->route);
        $handler->params = $this->route->params; //TO DO当无get参数时，报warning错误
        $handler->$actionName(); //example $handler->index();
    }

    /**
     * 异常处理,逻辑和业务逻辑错误
     */
    public static function exceptionHandler($exception)
    {
        echo "caught exception:" .$exception->getMessage(). "\n";
    }

    /**
     * 错误处理，如php语法错误、系统环境错误
     */
    public static function errorHandler($errNo, $errStr, $errFile, $errLine)
    {
        $time = date('Y-m-d H:i:s', time());
        $day = date('Y-m-d', time());
        $err = "{$time} 错误级别：{$errNo}|错误描述：{$errStr}|错误所在文件：{$errFile}|错误所在行：{$errLine}\r\n";
        file_put_contents(ROOT_PATH."/log/{$day}.txt", $err, FILE_APPEND);
    }
}
