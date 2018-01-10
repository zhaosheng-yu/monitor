<?php
/*
 * 上报接口
 * Date: 2017-12-11
 * Author: zhaosheng
 */
require_once dirname(dirname(__FILE__)) .'/include/init.php';
require_once SYSDIR_UTILS .'/reportModel.class.php';

if (!$_POST['sign'] || !$_POST['t'] || !$_POST['data']) {
    die('参数错误');
}

if ($_POST['sign'] != generate_sign($_POST, $ACCESS_KEY)) {
    die('签名验证失败');
}

//$_POST['data'] json数据 二维数组
$data = json_decode($_POST['data'], true);

foreach ($data as $key=>$val) {
    reportModel::getInstance()->add(json_encode($val));
}

die('ok');

?>
