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
use Phalcon\Db\Pdo\Mysql as DbAdapter;

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

try {
	$app = new Application($di);
	$res = $app->handle();
	$res->send();
} catch (Exception $e) {
	//print_r($di);
	echo $e->getMessage() . "\n";
}
