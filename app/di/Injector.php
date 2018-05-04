<?php

namespace App\Di;

class Injector {
	public static function resolve(string $class, array $methods) {
		$instance = self::create($class, $methods['__construct'] ?? []);
		foreach ($methods as $method => $args) {
			if ($method !== '__construct') {
				self::invoke($instance, $method, $args);
			}
		}
		return $instance;
	}

	private static function create(string $class, array $args) {
		return new $class(...array_values($args));
	}

	private static function invoke($instance, string $method, array $args) {
		$instance->{$method}(...array_values($args));
	}
}
