<?php
/*
 * 分析数据告警
 * 当天数据跟七天前或跟上一天对比
 * Author: zhaosheng
 * Date: 2017-12-26
 */

require_once('./mysqli.class.php');

$db = DB::getInstance();

$db->use_db('monitor_read');

while (1) {
    
    $monitorids = array(array('monitorid'=>1001, 'diffval'=>1));

    foreach ($monitorids as $minfo) {
        $mid = $minfo['monitorid'];
        $table = 't_report_'. $mid;

        //当前数据
        $date = date('Y-m-d');
        $minute = floor(((time() - strtotime($date))/60) + 1);
        //$minute = 976;
        $sql = "select sum(num) as num from {$table} where date='{$date}' and minute={$minute}";
        $ret = $db->query($sql);
        $nowNum = $ret[0]['num'] ? $ret[0]['num'] : 0;

        //与7天前对比
        $oldDate = date('Y-m-d', time()-86400*7);
        $sql = "select sum(num) as num from {$table} where date='{$oldDate}' and minute={$minute}";
        $ret = $db->query($sql);
        $oldNum = $ret[0]['num'] ? $ret[0]['num'] : 0;

        //还未到7天，则与前一天对比
        if (!$oldNum) {
            $oldDate = date('Y-m-d', time()-86400);
            $sql = "select sum(num) as num from {$table} where date='{$oldDate}' and minute={$minute}";
            $ret = $db->query($sql);
        }
        $oldNum = $ret[0]['num'] ? $ret[0]['num'] : 0;


        $diffnum = abs($nowNum - $oldNum);
        if ($diffnum > $minfo['diffval']) {
            sendDingdingMsg($mid." notice");
        }
    }
}

function sendDingdingMsg($message) {
    $webhook = "https://oapi.dingtalk.com/robot/send?access_token=d1c055d0f53cbb97fdf29485b7627216cff9a6def2492fbe667ae56acdf42158";
    $data = array ('msgtype' => 'text','text' => array ('content' => $message));
    $post_string = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $webhook);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
