<?php

return [
	'depends' => [
		'logger' => [
			'class' => \App\Log\Logger::class,
			'methods' => [
				'__construct' => [
					'path' => '/var/log/app/web.log',
					'format' => '%date% %type% %message%',
					'dateFormat' => 'Y-m-d H:i:s',
				],
			],
		],
		'db' => [
			'class' => \Phalcon\Db\Adapter\Pdo\Mysql::class,
			'methods' => [
				'__construct' => [
					[
						'host' => 'xxx.xxx.xxx.xxx',
						'username' => 'user',
						'password' => 'password',
						'dbname' => 'app',
					],
				],
			],
		],
	],
];
