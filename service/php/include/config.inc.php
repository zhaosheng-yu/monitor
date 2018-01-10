<?php
/*
** 设计思路:将数据库读操作,和数据库写操作,完全分离开来,使用不同的连接参数,可以分别连到不同服务器上的数据库。
** 数据库连接函数,根据参数数组,依次尝试连接数据库,直到某个连接成功为止,或者全部失败。
**/
$DB_CONFIG = array(
    'monitor_read' => array(
        array('dbms' => 'mysql',
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'pfdsj@LY2yzs',
            'port' => 3306,
            'dbname' => 'monitor',
            'charset' => 'utf8'
        )
    ),
    'monitor_write' => array(
        array('dbms' => 'mysql',
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'pfdsj@LY2yzs',
            'port' => 3306,
            'dbname' => 'monitor',
            'charset' => 'utf8'
        )
    ),
    //更多数据库在这里填写
);

/****** REDIS配置 ***********/
$REDIS_CONFIG = array(
    'user_write' => array(
        array(
            'host' => '127.0.0.1',
            'port' => '6379',
            'password' => '',
            'dbN' => 0,
        ),
    ),
    'user_read' => array(
        array(
            'host' => '127.0.0.1',
            'port' => '6379',
            'password' => '',
            'dbN' => 0,
        ),
    ),
);

/********* SESSION配置,  use_config 表示使用files or memcache ******/
$SESSION_CONFIG = array(
    'use_config' => 'files',
    'memcache' =>
        array(
            'domain' => '.guopan.cn',
            'type' => 'memcache',
            'save_path' => 'tcp://192.168.20.144:11211',
            'cache_expire' => 7200,  //minutes
        ),
    'files' =>
        array(
            'domain' => '.guopan.cn',
            'type' => 'files',
            'save_path' => SYSDIR_CACHE . '/sessions/',
            'cache_expire' => 180,  //minutes
        )
);

$ACCESS_KEY = 'FE490u2940#RJGF#GF#(';
?>
