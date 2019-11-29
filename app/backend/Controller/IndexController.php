<?php
class Index {
    public function __construct() {
        require_once SYS_PATH. 'core/Db.php';
        $this->Db= Db::getInstance($GLOBALS['config']['mysql']);
        print_r($this->Db);
    }

    public function index() {
    }
}