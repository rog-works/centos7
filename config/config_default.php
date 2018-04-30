<?php

return [
	'loader' => [
		'namespaces' => [
			'App' => APP_DIR . '/',
		],
	],
	'di' => [
		'dispatcher' => [
			'class' => '\Phalcon\Mvc\Dispatcher',
			'method' => 'setDefaultNamespace',
			'args' => [
				'App\Controllers',
			],
		],
		'view' => [
			'class' => '\Phalcon\Mvc\View',
			'method' => 'setViewsDir',
			'args' => [
				APP_DIR . '/views',
			],
		],
		'db' => [
			'class' => '\Phalcon\Db\Adapter\Pdo\Mysql',
			'method' => '__construct',
			'args' => [
				[
					'host' => 'xxx.xxx.xxx.xxx',
					'username' => 'user',
					'password' => 'password',
					'dbname' => 'app',
				],
			],
		],
		'router' => [
			'class' => '\Phalcon\Mvc\Router',
			'callback' => function($router, $routes) {
				foreach ($routes as $route) {
					$router->add($route['path'], $route['map'])->via($route['verbs']);
				}
			},
			'args' => [
				[
					['verbs' => ['GET'],    'path' => '/:controller',      'map' => ['controller' => 1, 'action' => 'index']],
					['verbs' => ['GET'],    'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'show', 'int' => 2]],
					['verbs' => ['POST'],   'path' => '/:controller',      'map' => ['controller' => 1, 'action' => 'create']],
					['verbs' => ['PUT'],    'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'update', 'int' => 2]],
					['verbs' => ['DELETE'], 'path' => '/:controller/:int', 'map' => ['controller' => 1, 'action' => 'delete', 'int' => 2]],
				],
			],
		],
	],
];
