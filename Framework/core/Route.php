<?php
class Route {
    public $group;
    public $controller;
    public $action;
    public $params;

    public function __construct() {

    }

    public function init() {
        $route = $this->getRequest();
        $this->group = $route['group'];
        $this->controller = $route['controller'];
        $this->action = $route['action'];
        if ( $route['params'] ) {
            $this->params = $route['params'];
        }
    }

    public function getRequest() {
        $filterParams = ['<', '>', '"', '% 3C', '% 3E', '% 22', '% 27',  '% 3c', '% 3e'];
        $uri = str_replace($filterParams, '', $_SERVER['REQUEST_URI']);
        $path = parse_url($uri);
        //截去'index.php' || '/index.php'
        if ( strpos($path['path'], 'index.php') == 0 ) {
            $urlR0 = $path['path'];
        } else {
            $urlR0 = substr($path['path'], strlen('index.php') + 1 );
        }
        $urlR = ltrim($urlR0, '/');

        //获取group、controller、action
        if ($urlR == '' ) {
            $route = $this->parseTradition();
            return $route;
        } else {
            $temp = explode('/', $urlR);
            $regArr = [];
            foreach ( $temp as $v ) {
                if ( !empty($v) ) {
                    $regArr[] = $v;
                }
            }
        }
        if ( count($regArr) == 3 ) {
                $route['group'] = $regArr[0];
                $route['controller'] = $regArr[1];
                $route['action'] = $regArr[2];
        } else {
                $route['group'] = $GLOBALS['config']['defaultGroup'];
                $route['controller'] = $GLOBALS['config']['defaultController'];
                $route['action'] = $GLOBALS['config']['defaultAction'];
        }

        if ( !empty($path['query']) ) {
            parse_str($path['query'], $route['params']);
        }

        return $route;
    }

    public function parseTradition() {

    }
}