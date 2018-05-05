<?php

namespace App\Mvc;

use App\Di\Resolver;

class Controller extends \Phalcon\Mvc\Controller {
	/** @var array */
	protected $behaviors = [];

	public function beforeExecuteRoute(...$args) {
		if (!$this->execBehavior($this->behaviors, __FUNCTION__, $args)) {
			return false;
		}
	}

	public function initialize(...$args) {
		if (!$this->execBehavior($this->behaviors, __FUNCTION__, $args)) {
			return false;
		}
	}

	public function afterExecuteRoute(...$args) {
		if (!$this->execBehavior($this->behaviors, __FUNCTION__, $args)) {
			return false;
		}
	}

	public function afterBinding(...$args) {
		if (!$this->execBehavior($this->behaviors, __FUNCTION__, $args)) {
			return false;
		}
	}

	private function execBehavior(array $definitions, $method, array $args) {
		foreach ($definitions[$method] ?? [] as $class) {
			if (!Resolver::resolve($class, [])->$method(...$args)) {
				return false;
			}
		}
		return true;
	}
}
