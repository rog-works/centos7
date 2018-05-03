<?php

namespace App\Controllers;

class HelloController extends \Phalcon\Mvc\Controller {
	public function indexAction() {
		$this->view->text = 'Hello World';
	}
}
