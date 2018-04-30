<?php

define('APP_DIR', __DIR__);

require_once(APP_DIR . '/vendor/autoload.php');

try {
	$di = require_once(APP_DIR . '/config/cli.php');
	$console = new \Phalcon\Cli\Console($di);
	$console->handle([
		'task' => $argv[1] ?? 'main',
		'action' => $argv[2] ?? 'main',
		'params' => array_slice($argv, 3),
	]);
} catch (\Phalcon\Exception $e) {
	echo $e->getMessage() . "\n";
}
