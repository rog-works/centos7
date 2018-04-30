<?php

return [
	'loader' => [
		'namespaces' => [
			'App' => APP_DIR . '/',
		],
	],
	'di' => [
		'logger' => [
			'callback' => function(string $path, string $format, string $dateFormat) {
				$logger = new \Phalcon\Logger\Adapter\File($path);
				$logger->setFormatter(new \Phalcon\Logger\Formatter\Line($format, $dateFormat));
				return $logger;
			},
			'args' => [
				'path' => '/var/log/app/web.log', // XXX override 'path'
				'format' => '%date% %type% %message%',
				'dateFormat' => 'Y-m-d H:i:s',
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
	],
];
