<?php
define('APP_DIR', __DIR__);

require_once(APP_DIR . '/vendor/autoload.php');

try {
	$di = require_once(APP_DIR . '/config/core.php');
	$app = new \Phalcon\Mvc\Application($di);
	$res = $app->handle();
	$res->send();
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}
