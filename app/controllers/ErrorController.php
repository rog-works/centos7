<?php

namespace App\Controllers;

class ErrorController extends \Phalcon\Mvc\Controller {
	public function show404Action() {
		$this->logger->info('routed');
	}
}
