<?php

namespace App\Di;

use \Phalcon\Di;

class Injector {
	public static function resolve(Di $di, string $class, array $methods) {
		$instance = self::create($di, $class, $methods['__construct'] ?? []);
		foreach ($methods as $method => $args) {
			if ($method !== '__construct') {
				self::invoke($di, $instance, $method, $args);
			}
		}
		return $instance;
	}

	private static function create(Di $di, string $class, array $args) {
		return new $class(...self::resolveArgs($di, $args));
	}

	private static function invoke(Di $di, $instance, string $method, array $args) {
		$instance->{$method}(...self::resolveArgs($di, $args));
	}

	private static function resolveArgs(Di $di, array $args) {
		return array_map(
			function($arg, $key) use ($di) {
				return $key === 'di' ? $di : $arg;
			},
			$args, array_keys($args)
		);
	}
}
