<?php
date_default_timezone_set('PRC'); 
ini_set('display_errors', 'On');
define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
define ('APP_PATH', ROOT_PATH.DS.'application'.DS);
define ('CONF_PATH', '/var/www/html/conf/homeland/');

define('DOMAIN','http://'.$_SERVER['HTTP_HOST']);

define('IS_GET',        $_SERVER['REQUEST_METHOD'] =='GET' ? true : false);
define('IS_POST',       $_SERVER['REQUEST_METHOD'] =='POST' ? true : false);
define ('IS_AJAX',       ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || !empty($_POST['is_ajax']) || !empty($_GET['is_ajax'])) ? true : false);

SeasLog::setLogger('api/homeland');

$application = new Yaf\Application( CONF_PATH. "application.ini", "development");
$application->bootstrap()->run();
