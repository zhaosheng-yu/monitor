<?php
/*
 * 系统初始化
 */
if (1) error_reporting(E_ERROR | E_PARSE);

if (!defined('IN_SYSTEM'))
    define('IN_SYSTEM', true);
if(!defined("SYSDIR_ROOT"))
    define("SYSDIR_ROOT", dirname(dirname(__FILE__)) );
if(!defined("SYSDIR_INCLUDE"))
    define("SYSDIR_INCLUDE", SYSDIR_ROOT. "/include" );
if(!defined("SYSDIR_ADMIN"))
    define("SYSDIR_ADMIN", SYSDIR_ROOT. "/admin" );
if(!defined("SYSDIR_CACHE"))
    define("SYSDIR_CACHE", SYSDIR_ROOT. "/cache" );
if(!defined("SYSDIR_STATIC"))
    define("SYSDIR_STATIC", SYSDIR_ROOT. "/static" );
if(!defined("SYSDIR_UTILS"))
    define("SYSDIR_UTILS", SYSDIR_ROOT. "/utils" );
if(!defined("SYSDIR_API"))
    define("SYSDIR_API", SYSDIR_ROOT. "/api" );
	
if( file_exists(SYSDIR_INCLUDE. "/360safe/360webscan.php") ) {
    require_once SYSDIR_INCLUDE. "/360safe/360webscan.php";
}

include_once SYSDIR_INCLUDE. "/config.inc.php"; 
include_once SYSDIR_INCLUDE. "/mysqli.class.php"; 
include_once SYSDIR_INCLUDE. "/redis.class.php"; 
include_once SYSDIR_INCLUDE. "/func.utils.php";

if(isset($SESSION_CONFIG)) {
    $CONF_SESS = $SESSION_CONFIG[$SESSION_CONFIG['use_config']];
    session_set_cookie_params(0, '/', $CONF_SESS['domain']);
    session_save_path($CONF_SESS['save_path']);
    session_cache_expire($CONF_SESS['cache_expire']);
    session_name($CONF_SESS['session_name']);
    session_start();
}
