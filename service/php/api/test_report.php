<?php
/*
 * 测试 上报接口
 * Date: 2017-12-25
 * Author: zhaosheng
 */

require_once dirname(dirname(__FILE__)) .'/include/init.php';
define('API', 'http://47.93.198.181:8085/service/php/api/report.php');

$arr = array(
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1003, 'source'=>1, 't'=>time()),
            array('monitorid'=>1003, 'source'=>1, 't'=>time()),
            array('monitorid'=>1003, 'source'=>2, 't'=>time()),
            array('monitorid'=>1003, 'source'=>2, 't'=>time()),
            array('monitorid'=>1003, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1004, 'source'=>2, 't'=>time()),
            array('monitorid'=>1004, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1002, 'source'=>2, 't'=>time()),
            array('monitorid'=>1003, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>1, 't'=>time()),
            array('monitorid'=>1004, 'source'=>1, 't'=>time()),
            array('monitorid'=>1004, 'source'=>1, 't'=>time()),
            array('monitorid'=>1004, 'source'=>1, 't'=>time()),
            array('monitorid'=>1004, 'source'=>1, 't'=>time()),
            array('monitorid'=>1004, 'source'=>1, 't'=>time()),
            array('monitorid'=>1004, 'source'=>2, 't'=>time()),
            array('monitorid'=>1004, 'source'=>2, 't'=>time()),
            array('monitorid'=>1003, 'source'=>2, 't'=>time()),
            array('monitorid'=>1002, 'source'=>2, 't'=>time()),
            array('monitorid'=>1002, 'source'=>2, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1002, 'source'=>1, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
            array('monitorid'=>1001, 'source'=>2, 't'=>time()),
        );

$data = array();

foreach ($arr as $val) {
    if (rand(0,100) > 30) {
        $data[] = $val;
    }
}

$arr['data'] = json_encode($data);
$arr['t'] = time();
$arr['sign'] = generate_sign($arr, $ACCESS_KEY);

$ret = makeRequest(API, $arr, 10, 'POST');
?>
