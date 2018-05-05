<?php

namespace App\Controllers;

use \App\Models\Users;

class SessionsController extends \App\Mvc\Controller {
	use \App\Traits\Validator;

	protected $behaviors = [
		'beforeExecuteRoute' => [
			\App\Plugins\CSRFTokenChecker::class,
		]
	];

	private $validators = [
		'create' => [
			'email' => [
				\Phalcon\Validation\Validator\Email::class => [['allowEmpty' => false]],
			],
			'password' => [
				\Phalcon\Validation\Validator\StringLength::class => [['allowEmpty' => false, 'min' => 1]],
			],
		]
	];

	public function indexAction() {
	}

	public function createAction() {
		$validated = $this->validate();
		if (!empty($validated['errors'])) {
			$this->flashSession->error(implode(',', $validated['errors']));
			$this->response->redirect('sessions');
			return;
		}

		$user = Users::findBy($validated['email'], $this->security->hash($validated['passward']));
		if (empty($user)) {
			$this->flashSession->error('user not found');
			$this->response->redirect('sessions');
			return;
		}

		$this->session->set('user', $user);
		$this->response->redirect();
	}

	public function deleteAction() {
	}
}
