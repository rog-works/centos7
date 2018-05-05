<?php

return [
	'depends' => [
		'db' => [
			'methods' => [
				'__construct' => [
					[
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
