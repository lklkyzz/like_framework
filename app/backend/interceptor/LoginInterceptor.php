<?php
namespace app\backend\interceptor;

use Framework\core\InterceptorInterface;

class LoginInterceptor implements InterceptorInterface
{
    public function preHandle()
    {
        echo 'login in<br>';
    }

    public function postHandle()
    {
        echo 'logged<br>';
    }
}