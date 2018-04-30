<?php

return [
	'di' => [
		'dispatcher' => [
			'class' => '\Phalcon\Cli\Dispatcher',
			'method' => 'setDefaultNamespace',
			'args' => [
				'App\Tasks',
			],
		],
		'logger' => [
			'args' => [
				'path' => '/var/log/app/cli.log', // XXX override 'path'
			],
		],
	],
];
