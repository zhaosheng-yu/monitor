<?php
/*
 * 打点上报类
 * data 2017-12-12
 * athor zhaosheng
 */

/*
 * 先写到redis中，定时任务整理入库
 *
 * 数据上报表t_report_1001, 按业务编号后缀分表(1001为业务号)
 * 字段：date:日期，minute:当前分值(1-1440), num:每分钟上报数据量。
 */

require_once dirname(dirname(__FILE__)) . '/include/init.php';

class reportModel
{
    public $db = null;
    public $redis = null;

    private static $_instance = null;

    public function __construct() {
        $this->db = DB::getInstance();
        $this->redis = MyRedis::getInstance();
        $this->redis->use_redis('user_write');

        $this->rkey = "monlist";
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function add($data) {
        $ret = $this->redis->redis->lpush($this->rkey, $data);
        return $ret;
    }
}
