<?php
require SYS_PATH . 'core/Render.php';

/**
 * 实现模板
 */
class PhpRender implements Render
{
    private $value = [];

    public function init()
    {
    }

    public function assign($key, $value)
    {
        $this->value[$key] = $value;
    }

    public function display($view = '')
    {
        extract($this->value);
        include $view;
    }
}
