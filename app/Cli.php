<?php

namespace App;

class Cli extends \App\Core\Application {
	/** @var array */
	private $args = [];

	public function __construct(array $args) {
		parent::__construct([
			APP_DIR . '/config/core.php',
			APP_DIR . '/config/cli.php',
			APP_DIR . '/config/' . APP_ENV . '.php',
		]);
		$this->args = $this->parseArgs($args);
	}

	private function parseArgs(array $args): array {
		$args = [
			'task' => $args[1] ?? 'main',
			'action' => $args[2] ?? 'main',
			'params' => array_slice($args, 3),
		];
		return $args;
	}

	public function run() {
		(new \Phalcon\Cli\Console($this->getDI()))->handle($this->args);
	}
}
