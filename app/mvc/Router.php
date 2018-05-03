<?php

namespace App\Mvc;

class Router extends \Phalcon\Mvc\Router {
	public function __construct(array $routes) {
		foreach ($routes as $route) {
			$this->add($route['path'], $route['map'])->via($route['verbs']);
		}
	}
}
