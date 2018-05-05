<?php

namespace App\Core;

use Phalcon\Config;
use App\Di\Injector;

abstract class Application {
	public function createRunner(string $configPath) {
		$config = new Config(require_once($configPath));
		$di = new $config->di->class();
		$di->set('config', $config);
		Injector::inject($di, $config->depends->toArray());
		return new $config->runner->class($di);
	}

	public abstract function run();
}
