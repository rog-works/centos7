<?php
define('APP_DIR', __DIR__);

require_once(realpath(APP_DIR . '/vendor/autoload.php'));

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$loader = new Loader();
$loader->registerDirs([
	APP_DIR . '/controllers',
	APP_DIR . '/models',
]);
$loader->register();

$di = new FactoryDefault();
$di->set('view', function() {
	$view = new View();
	$view->setViewsDir(APP_DIR . '/views');
	return $view;
});
$di->set('url', function() {
	$url = new UrlProvider();
	$url->setBaseUri('/');
	return $url;
});
$di->set('db', function() {
	return new DbAdapter([
		'host' => 'db',
		'username' => 'root',
		'password' => '',
		'dbname' => 'test',
	]);
});

try {
	$app = new Application($di);
	$res = $app->handle();
	$res->send();
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}
