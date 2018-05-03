<?php

define('ROOT', __DIR__);
define('APP_DIR', ROOT . '/app');
define('PUBLIC_DIR', ROOT . '/public');
define('APP_ENV', getenv('APP_ENV'));

require_once(ROOT . '/vendor/autoload.php');

try {
	(new \App\Cli($argv))->run();
} catch (\Phalcon\Exception $e) {
	echo $e->getMessage() . PHP_EOL;
}
