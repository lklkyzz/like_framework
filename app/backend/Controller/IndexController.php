<?php
namespace app\backend\controller;
use Framework\core\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 类前置拦截器
     */
    // public function _before_()
    // {
    //     echo 'before<br>';
    // }

    public function index()
    {
        // $ret = $this->db()->query('select * from demo');
        // $ret = $this->Db->execute('insert into demo (name) values(?)', ['kk']);
        // $this->assign('data', $ret);
        // $this->display('index/index');
        // echo '<br>';
    }

    public function millisecond()
    {
        $temp = explode(" ", microtime());
        return (float) $temp[1] + (float) $temp[0];
    }

}
