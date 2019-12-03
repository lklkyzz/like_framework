<?php
namespace Framework\core;

use Framework\core\PhpRender;
use Framework\core\Db;
/**
 * controller基类
 */
class Controller
{
    private $db;            //数据库连接句柄
    private $view;          //视图模板对象
    protected static $route;//请求路由

    public function __construct()
    {
        $this->view = new PhpRender();
    }

    /**
     * 赋值给视图文件
     * @param $key 键名
     * @param $value 键值
     * @return object 模板对象
     */
    public function assign($key, $value)
    {
        $this->view->assign($key, $value);
        return $this->view;
    }

    /**
     * 连接数据库
     * @param array $conf 连接参数
     * @return 数据库实例
     */
    public function db($conf = [])
    {
        if (empty($conf)) {
            $conf = $GLOBALS['config']['mysql'];
        }
        $this->db = Db::getInstance($conf);
        return $this->db;
    }

    /**
     * 渲染视图
     * @param $file 被渲染文件
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
