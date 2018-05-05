<?php

namespace App;

class Cli extends \App\Core\Application {
	/** @var array */
	private $args = [];

	public function __construct(array $args) {
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
		$this->createRunner(APP_DIR . '/config/cli.php')->handle($this->args);
	}
}
