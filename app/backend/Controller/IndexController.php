<?php
require_once SYS_PATH. 'core/Controller.php';

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // require_once SYS_PATH . 'core/Db.php';
        // $this->Db = Db::getInstance($GLOBALS['config']['mysql']);
    }

    public function index()
    {
        $this->assign('name', $_GET['name']);
        // $ret = $this->db()->query('select * from demo');
        // $ret = $this->Db->execute('insert into demo (name) values(?)', ['kk']);
        // print_r($ret);
        $this->display('index/index');
    }

    public function millisecond()
    {
        $temp = explode(" ", microtime());
        return (float) $temp[1] + (float) $temp[0];
    }

}
