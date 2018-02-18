<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller {
	public function indexAction() {
		$user = Users::findFirst();
		if (empty($user)) {
			$data = [
				'name' => 'fuga',
				'email' => 'fuga@gmail.com',
			];
			if (!(new Users)->save($data)) {
				throw new Exception('failed add user');
			}
		}
		$this->view->user = $user;
	}
}
