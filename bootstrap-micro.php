<?php
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;

try {
	$di = new FactoryDefault();
	$di->set('view', function() {
		$view = new View();
		$view->setViewDir('./views');
	});

	$app = new Micro($di);
	$app->get('/', function() {});
	$app->handle();
} catch (Exception $e) {
	echo $e->getMessage();
}
