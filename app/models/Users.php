<?php

namespace App\Models;

class Users extends \Phalcon\Mvc\Model {
	public $id;
	public $name;
	public $email;

	public function findBy(string $email, string $sign): Users {
		return Users::query()
			->andWhere('email = :email:')
			->andWhere('sign = :sign:')
			->bind([
				'email' => $email,
				'sign' => $sign,
			])
			->execute()
			->getFirst();
	}
}
