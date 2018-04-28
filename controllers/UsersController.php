<?php

namespace App\Controllers;

class UsersController extends \Phalcon\Mvc\Controller {
	public function indexAction() {
		$this->view->users = \App\Models\Users::find();
	}

	public function showAction(int $id) {
		$this->view->user = \App\Models\Users::findFirst($id);
	}
}
