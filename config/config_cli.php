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
	],
];
