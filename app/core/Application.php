<?php

namespace App\Core;

use Phalcon\Config as Config;
use Phalcon\Di;

abstract class Application {
	/** @var Di */
	private $di;

	public function __construct(array $configPaths) {
		$config = $this->loadConfig($configPaths);
		$this->di = new $config->di->class();
		$this->di->set('config', $config);
		$this->inject($this->di, $config->depends->toArray());
		return $this->di;
	}

	private function loadConfig(array $paths): Config {
		$config = new Config(require_once(array_shift($paths)));
		foreach ($paths as $path) {
			$config->merge(new Config(require_once($path)));
		}
		return $config;
	}

	private function inject(Di $di, array $definitions) {
		foreach ($definitions as $key => $definition) {
			$di->set($key, function() use ($definition) {
				return (new \App\Di\Injector($definition['class'], $definition['methods']))->resolve();
			});
		}
	}

	public function getDI(): Di {
		return $this->di;
	}

	public abstract function run();
}
