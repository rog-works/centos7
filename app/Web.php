<?php

namespace App;

class Web extends \App\Core\Application {
	public function run() {
		$this->createRunner(APP_DIR . '/config/web.php')->handle()->send();
	}
}
