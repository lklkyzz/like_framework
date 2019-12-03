<?php
namespace Framework\core;
/**
 * 视图模板引擎
 */
interface Render
{
    public function init();
    public function assign($key, $value);
    public function display($view='');
}