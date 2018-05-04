<?php

namespace App\Di;

use App\Exception\Runtime as RuntimeException;

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
		if (!class_exists($class)) {
			throw new RuntimeException("class not found. class = {$class}");
		}
		return new $class(...array_values($args));
	}

	private static function invoke($instance, string $method, array $args) {
		if (!method_exists($instance, $method)) {
			throw new RuntimeException(sprintf('method not found. method = %s::%s', get_class($instance), $method));
		}
		$instance->{$method}(...array_values($args));
	}
}
