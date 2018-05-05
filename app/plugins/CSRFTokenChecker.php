<?php

namespace App\Plugins;

use \Phalcon\Events\Event;
use \Phalcon\Mvc\Dispatcher;

class CSRFTokenChecker extends \Phalcon\Mvc\User\Plugin {
	public function beforeExecuteRoute(Dispatcher $dispatcher): bool {
		if (!$this->request->isPost() && !$this->request->isPut()) {
			return true;
		}

		if ($this->security->checkToken()) {
			return true;
		}

		$this->flashSession->error('CSRF token not valid');
		$this->response->redirect($this->request->getHTTPReferer());
		return false;
	}
}
