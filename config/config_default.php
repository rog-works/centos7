<?php

return [
	'namespaces' => [
		'App' => '/',
	],
	'dispatcher' => [
		'namespace' => 'App\\Controllers',
	],
	'url' => [
		'baseUri' => '/',
	],
	'view' => [
		'baseDir' => '/views',
	],
	'db' => [
		'host' => 'xxx.xxx.xxx.xxx',
		'username' => 'user',
		'password' => 'password',
		'dbname' => 'app',
	],
	'routes' => [
		['verbs' => ['GET'],    'path' => '/:controller',      'map' => ['controller' => 1, 'action' => 'index']],
		['verbs' => ['GET'],    'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'show', 'int' => 2]],
		['verbs' => ['POST'],   'path' => '/:controller',      'map' => ['controller' => 1, 'action' => 'create']],
		['verbs' => ['PUT'],    'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'update', 'int' => 2]],
		['verbs' => ['DELETE'], 'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'delete', 'int' => 2]],
	],
];
