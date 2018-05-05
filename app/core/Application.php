<?php

namespace App\Core;

use Phalcon\Config;
use App\Di\Injector;

abstract class Application {
	public function createRunner(array $configPaths) {
		$config = $this->loadConfig($configPaths);
		$di = new $config->di->class();
		$di->set('config', $config);
		Injector::inject($di, $config->depends->toArray());
		return new $config->runner->class($di);
	}

	private function loadConfig(array $paths): Config {
		$config = new Config(require_once(array_shift($paths)));
		foreach ($paths as $path) {
			$config->merge(new Config(require_once($path)));
		}
		return $config;
	}

	public abstract function run();
}
