<?php

return [
	'depends' => [
		'db' => [
			'methods' => [
				'__construct' => [
					'settings' => [
						'host' => 'db',
						'username' => 'root',
						'password' => '',
						'dbname' => 'test',
					],
				],
			],
		],
	],
];
