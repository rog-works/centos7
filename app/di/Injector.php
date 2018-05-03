<?php

namespace App\Di;

class Injector {
	/** @var string */
	private $class = '';

	/** @var array */
	private $methods = [];

	public function __construct(string $class, array $methods) {
		$this->class = $class;
		$this->methods = $methods;
	}

	public function resolve() {
		$instance = $this->create($this->methods['__construct'] ?? []);
		foreach ($this->methods as $method => $args) {
			if ($method !== '__construct') {
				$this->invoke($instance, $method, $args);
			}
		}
		return $instance;
	}

	private function create(array $args) {
		return new $this->class(...array_values($args));
	}

	private function invoke($instance, string $method, array $args) {
		$instance->{$method}(...array_values($args));
	}
}
