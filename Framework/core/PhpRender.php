<?php
namespace Framework\core;
use Framework\core\Render;

/**
 * 实现模板
 */
class PhpRender implements Render
{
    private $value = []; //注入视图参数

    public function init()
    {
    }

    /**
     * 赋值
     * @param $key 键名
     * @param $value 键值
     */
    public function assign($key, $value)
    {
        $this->value[$key] = $value;
    }

    /**
     * 渲染视图
     * @param file $view 视图文件
     */
    public function display($view = '')
    {
        extract($this->value);
        include $view;
    }
}
