<?php
/**
 * 框架核心类
 */
class Framework {
    public function run() {
        require_once SYS_PATH . 'core/Route.php';
        $this->route();
        $this->dispatch();
    }

    public function route() {
        $this->route = new Route();
        $this->route->init();
    }
    
    /**
     * 路由分发,执行请求方法
     */
    public function dispatch() {
        $controllerName = ucwords($this->route->controller);//大写首字母
        $actionName = $this->route->action;
        $path = APP_PATH.$this->route->group.DIRECTORY_SEPARATOR. 'Controller' .DIRECTORY_SEPARATOR. 
        $controllerName. 'Controller.php';
        require $path;//类名与方法名一致(不区分大小写)，且无构造函数时，此方法会成为构造函数，php向下兼容，报warning级别错误

        $methods = get_class_methods($controllerName);
        if ( !in_array($actionName, $methods, true) ) {
            throw new Exception("方法名{$controllerName}->{$actionName}不存在");
        }

        //执行
        $handler = new $controllerName();
        require_once SYS_PATH. 'core/Controller.php';
        $reflectedClass = new \ReflectionClass('Controller');
        $reflectedProperty = $reflectedClass->getProperty('route');
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($this->route);
        $handler->params = $this->route->params;//TO DO当无get参数时，报warning错误
        $handler->$actionName();//example $handler->index();
    }
}