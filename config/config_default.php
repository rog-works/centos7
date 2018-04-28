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
		['verb' => 'GET',    'path' => '/:controller',      'map' => ['controller' => 1, 'action' => 'index']],
		['verb' => 'GET',    'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'show', 'int' => 2]],
		['verb' => 'POST',   'path' => '/:controller',      'map' => ['controller' => 1, 'action' => 'create']],
		['verb' => 'PUT',    'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'update', 'int' => 2]],
		['verb' => 'DELETE', 'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'delete', 'int' => 2]],
	],
];
