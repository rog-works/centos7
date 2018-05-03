<?php

namespace App\Tasks;

class MainTask extends \Phalcon\Cli\Task {
	public function mainAction() {
		echo 'Hello Task!';
		$this->logger->info('test');
	}

	public function subAction(array $args) {
		echo 'args: ' . implode(',', $args);
	}
}
