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
		'/:controller' => ['controller' => 1, 'action' => 'index'],
		'/:controller/:int' => ['controller' => 1, 'action' => 'show', 'int' => 2],
	],
];
