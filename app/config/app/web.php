<?php

return [
	'runner' => [
		'class' => \Phalcon\Mvc\Application::class,
	],
	'di' => [
		'class' => \Phalcon\Di\FactoryDefault::class,
	],
	'depends' => [
		'security' => [
			'class' => \Phalcon\Security::class,
		],
		'dispatcher' => [
			'class' => \Phalcon\Mvc\Dispatcher::class,
			'methods' => [
				'setDefaultNamespace' => [
					'App\Controllers'
				],
			],
			'events' => [
				'dispatch:beforeException' => [
					\App\Plugins\ExceptionForwarder::class => [],
				]
			],
		],
		'session' => [
			'class' => \Phalcon\Session\Adapter\Files::class,
			'methods' => [
				'start' => [],
			],
		],
		'flashSession' => [
			'class' => \Phalcon\Flash\Session::class,
		],
		'view' => [
			'class' => \Phalcon\Mvc\View::class,
			'methods' => [
				'setViewsDir' => [
					APP_DIR . '/views',
				],
			],
		],
		'router' => [
			'class' => \App\Mvc\Router::class,
			'methods' => [
				'__construct' => [
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
	],
];
