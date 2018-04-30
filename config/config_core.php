<?php

return [
	'loader' => [
		'namespaces' => [
			'App' => APP_DIR . '/',
		],
	],
	'di' => [
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
	],
];
