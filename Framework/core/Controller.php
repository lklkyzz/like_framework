<?php
/**
 * controller基类
 */
class Controller
{
    private $db;
    private $view;
    protected static $route;

    public function __construct()
    {
        require_once SYS_PATH . 'core/PhpRender.php';
        $this->view = new PhpRender();
    }

    /**
     * 赋值给模板
     */
    public function assign($key, $value)
    {
        $this->view->assign($key, $value);
        return $this->view;
    }

    /**
     * 连接数据库
     */
    public function db($conf = [])
    {
        if (empty($conf)) {
            $conf = $GLOBALS['config']['mysql'];
        }
        require_once SYS_PATH . 'core/Db.php';
        $this->db = Db::getInstance($conf);
        return $this->db;
    }

    /**
     * 渲染视图
     */
    public function display($file = null)
    {
        $group = self::$route->group;
        $controller = self::$route->controller;
        $action = self::$route->action;

        if (func_num_args() == 0 || $file == null) {
            $viewFilePath = APP_PATH . "{$group}/view/{$controller}/{$action}.html";
        } else {
            $viewFilePath = APP_PATH . "{$group}/view/{$file}.html";
        }
        $this->view->display($viewFilePath);
    }
}
