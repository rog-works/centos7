<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController extends \Phalcon\Mvc\Controller {
	public function indexAction() {
		$this->view->users = Users::find();
	}

	public function showAction(int $id) {
		$this->view->user = Users::findFirst($id);
	}

	public function createAction(int $id) {
		if (!empty(Users::findFirst($id))) {
			throw new Exception('Bad Request', 400);
		}

		$data = $this->request->getPost();
		$user = new Users;
		$user->name = $data['name'] ?? '';
		$user->email = $data['email'] ?? '';
		if (!$user->save()) {
			throw new Exception('Internal Server Error', 500);
		}
	}
}
