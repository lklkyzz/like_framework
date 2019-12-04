<?php
namespace Framework\core;

class Exception extends \Exception
{
    /**
     * 当echo此类时，此魔术方法能把类转成字符串
     */
    public function __toString()
    {
    }

    public function _Log()
    {
        $day = date('Y-m-d', time());
        $err = date('Y-m-d H:i:s', time()). '|';
        $err .= '错误信息：' .self::getMessage(). '|';
        $err .= '错误码：' .self::getCode(). '|';
        $err .= '栈回溯：' .serialize(debug_backtrace()). PHP_EOL;
        file_put_contents(ROOT_PATH."/log/{$day}.txt", $err, FILE_APPEND);
    }

    public function errMessage()
    {
        self::_Log();
    }
}