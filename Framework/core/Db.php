<?php
namespace Framework\core;
/**
 * 数据库类
 */
class Db
{
    private $dbLink;
    private static $instance;
    protected $PDOStatement;
    public $rows;

    /**
     * @param array 连接参数
     */
    private function __construct($config)
    {
        $this->format = [
            'dns' => "{$config['type']}:host={$config['host']};dbname={$config['dbName']}",
            'username' => $config['username'],
            'pwd' => $config['pwd'],
        ];
        $this->connect($this->format);
    }
    private function __clone()
    {
    }

    /**
     * 获取类实例
     * @param array 连接参数
     * @return object 类实例
     */
    public static function getInstance($config)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    /**
     * 连接数据库
     * @param array 连接参数
     */
    public function connect($format)
    {
        try {
            $this->dbLink = new \PDO($format['dns'], $format['username'], $format['pwd']);
        } catch (\PDOException $e) {
            throw $e; //记录到日志后往上抛
        }

        return $this->dbLink;
    }

    /**
     * @param string $sql 查询语句
     * @param array $bind 查询参数
     * @param const $type 查询结果类型
     * @return array
     */
    public function query($sql, $bind = [], $type = \PDO::FETCH_ASSOC)
    {
        if (!$this->dbLink) {
            throw new \Exception('db connection failed');
        }

        $this->PDOStatement = $this->dbLink->prepare($sql);
        $this->PDOStatement->execute($bind);
        $ret = $this->PDOStatement->fetchAll($type);
        $this->rows = count($ret);
        return $ret;
    }

    /**
     * 执行语句
     * @param string $sql 执行语句
     * @param array $bind 查询参数
     * @return array
     */
    public function execute($sql, $bind = [])
    {
        if (!$this->dbLink) {
            throw new \Exception('db connection failed');
        }

        $this->PDOStatement = $this->dbLink->prepare($sql);
        $ret = $this->PDOStatement->execute($bind);
        $this->rows = $this->PDOStatement->rowCount();
        return $ret;
    }

}
