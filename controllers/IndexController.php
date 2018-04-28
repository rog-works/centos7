<?php

namespace App\Controllers;

class IndexController extends \Phalcon\Mvc\Controller {
	public function indexAction() {
		$this->view->text = 'Hello World';
	}
}
