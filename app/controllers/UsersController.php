<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController extends \App\Mvc\Controller {
	public function indexAction() {
		$this->view->users = Users::find();
		throw new \App\Exception\Runtime('hoge');
	}

	public function showAction(int $id) {
		$this->view->user = Users::findFirst($id);
	}

	public function createAction() {
		$data = $this->request->getPost();
		$user = new Users;
		foreach ($user as $key => $_) {
			if (isset($data[$key])) {
				$user->{$key} = $data[$key];
			}
		}
		if (!$user->save()) {
			throw new \App\Exception\Runtime(sprintf('Model save failed. error = %s', implode(',', $user->getMessages())));
		}
	}
}
