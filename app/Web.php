<?php

namespace App;

class Web extends \App\Core\Application {
	public function __construct() {
		parent::__construct([
			APP_DIR . '/config/core.php',
			APP_DIR . '/config/web.php',
			APP_DIR . '/config/' . APP_ENV . '.php',
		]);
	}

	public function run() {
		(new \Phalcon\Mvc\Application($this->getDI()))
			->handle()
			->send();
	}
}
