<?php

namespace App\Mvc;

class Dispatcher extends \Phalcon\Mvc\Dispatcher {
	public function __construct($eventsManager) {
		parent::__construct($eventsManager);
	}
}
