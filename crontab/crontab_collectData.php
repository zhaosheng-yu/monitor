<?php
/*
 * 收集上报数据入库
 * Author: zhaosheng
 * Date: 2017-12-26
 */

require_once('./redis.class.php');
require_once('./mysqli.class.php');

$redis = MyRedis::getInstance();
$db = DB::getInstance();

$db->use_db('monitor_write');
$redis->use_redis('user_read');

while (1) {
    $ret = $redis->redis->rpop('monlist');

    if ($ret) {
        $arr = json_decode($ret, true);
        //'monitorid'=>123456, 'source'=>1, 't'=>time()
        if (!$arr['monitorid'] || !$arr['source'] || !$arr['t']) {
            continue;
        }

        $date = date('Y-m-d', $arr['t']);
        $minute = floor((($arr['t'] - strtotime($date))/60) + 1);
        $source = $arr['source'];

        $table = "t_report_{$arr['monitorid']}";

        $sql = "insert into {$table} (`date`, `minute`, `num`, `source`) values ".
               "('{$date}', {$minute}, 1, '{$source}') on duplicate key update `num`=`num`+1";

        $ret = $db->query($sql);
        if (!$ret) {
            echo $db->db->error ."\n";
        }
    }
}
