<?php

namespace App\Traits;

use \Phalcon\Validation;
use \App\Exception\Runtime as RuntimeException;
use \App\Di\Resolver;

trait Validator {
	public function validate(): array {
		return $this->__validate($this->__getAction(), $this->__getParams());
	}

	private function __getAction(): string {
		return $this->dispatcher->getActionName();
	}

	private function __getParams(): array {
		if ($this->request->isGet()) {
			return $this->request->getQuery();
		} else if ($this->request->isPost()) {
			return $this->request->getPost();
		} else if ($this->request->isPut()) {
			return $this->request->getPut();
		} else {
			return [];
		}
	}

	private function __validate(string $action, array $params): array {
		if (empty($this->validators[$action])) {
			throw new RuntimeException('validators not defined');
		}

		$validators = $this->validators[$action] ?? [];
		$validation = $this->__createValidation($validators);
		$messages = $validation->validate($params);
		$validated = ['errors' => []];
		foreach (array_keys($validators) as $key) {
			if (isset($messages[$key])) {
				$validated[$key] = $params[$key];
			}
		}
		foreach ($messages as $message) {
			$validated['errors'][] = $message->getMessage();
		}
		return $validated;
	}

	private function __createValidation(array $validators): Validation {
		$validation = new Validation;
		foreach ($validators ?? [] as $key => $definitions) {
			foreach ($definitions as $class => $args) {
				$validation->add($key, Resolver::resolve($class, ['__construct' => $args]));
			}
		}
		return $validation;
	}
}
