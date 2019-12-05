<?php
namespace app\backend\interceptor;

use Framework\core\InterceptorInterface;

class AccessInterceptor implements InterceptorInterface
{
    public function preHandle()
    {
        echo 'pre access<br>';
    }

    public function postHandle()
    {
        echo 'post access<br>';
    }
}