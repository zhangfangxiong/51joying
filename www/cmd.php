<?php
if ($argc < 2) {
	echo "命令格式错误，请按下面格式运行：\n";
	echo "{$_SERVER['_']} {$argv[0]} env route\n";
	exit;
}

date_default_timezone_set('Asia/Shanghai');

define('ENV_SCENE', $argv[1]);
if (ENV_SCENE == 'dev') {
    //报告运行时错误
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

$sRouteUri = $argv[2];
define('ENV_CHANNEL', 'www');
define('ENV_DOMAIN', 'fangjl.com');
define('ENV_CMD_MAIN', realpath(__FILE__));

define("ROOT_PATH", realpath(__DIR__ . '/..'));
define("APP_PATH", realpath(__DIR__ .'/../app'));
define("LIB_PATH", realpath(__DIR__ .'/../library'));

try {
    require_once LIB_PATH . '/loader.php';
    Yaf_G::$YAF_CONTROLLER_DIRECTORY_NAME = 'Cmd';
    $app = new Yaf_Application();
    $app->bootstrap()->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
