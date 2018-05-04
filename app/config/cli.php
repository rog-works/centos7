<?php

return [
	'runner' => [
		'class' => \Phalcon\Cli\Console::class,
	],
	'di' => [
		'class' => \Phalcon\Di\FactoryDefault\Cli::class,
	],
	'depends' => [
		'dispatcher' => [
			'class' => \Phalcon\Cli\Dispatcher::class,
			'methods' => [
				'setDefaultNamespace' => [
					'App\Tasks',
				],
			],
		],
		'logger' => [
			'methods' => [
				'__construct' => [
					'path' => '/var/log/app/cli.log', // XXX override 'path'
				],
			],
		],
	],
];
