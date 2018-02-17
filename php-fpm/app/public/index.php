<?php

// use Phalcon\Mvc\Micro;
// use Phalcon\Di\FactoryDefault;
// use Phalcon\Mvc\View;
// 
// try {
// 	$di = new FactoryDefault();
// 	$di->set('view', function() {
// 		$view = new View();
// 		$view->setViewDir('app/views');
// 	});
// 
// 	$app = new Micro($di);
// 	$app->get('/', function() {});
// 	$app->handle();
// } catch (Exception $e) {
// 	echo $e->getMessage();
// }

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$loader = new Loader();
$loader->registerDirs([
	'../app/controllers',
	'../app/models',
]);
$loader->register();

$di = new FactoryDefault();
$di->set('view', function() {
	$view = new View();
	$view->setViewsDir('../app/views');
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
