<?php
namespace Framework\core;

interface InterceptorInterface
{
    public function preHandle();
    public function postHandle();
}