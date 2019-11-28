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

    public function dispatch() {

    }
}