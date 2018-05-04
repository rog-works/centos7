<?php

namespace App;

class Web extends \App\Core\Application {
	public function run() {
		$this->createRunner([
			APP_DIR . '/config/core.php',
			APP_DIR . '/config/web.php',
			APP_DIR . '/config/' . APP_ENV . '.php',
		])->handle()->send();
	}
}
