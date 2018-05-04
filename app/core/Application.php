<?php

namespace App\Core;

use Phalcon\Config;
use Phalcon\Di;
use App\Di\Injector;

abstract class Application {
	public function createRunner(array $configPaths) {
		$config = $this->loadConfig($configPaths);
		$di = new $config->di->class();
		$di->set('config', $config);
		$this->inject($di, $config->depends->toArray());
		return new $config->runner->class($di);
	}

	private function loadConfig(array $paths): Config {
		$config = new Config(require_once(array_shift($paths)));
		foreach ($paths as $path) {
			$config->merge(new Config(require_once($path)));
		}
		return $config;
	}

	private function inject(Di $di, array $definitions) {
		$that = $this;
		foreach ($definitions as $key => $definition) {
			$di->set($key, function() use ($that, $definition) {
				$depended = Injector::resolve($definition['class'], $definition['methods'] ?? []);
				if (isset($definition['events'])) {
					$depended->setEventsManager($that->injectEvents($this, $definition['events']));
				}
				return $depended;
			});
		}
	}

	private function injectEvents(Di $di, array $definitions) {
		$eventsMamager = $di->getShared('eventsManager');
		foreach ($definitions as $eventType => $definition) {
			$eventsMamager->attach($eventType, Injector::resolve($definition['class'], $definition['methods'] ?? []));
		}
		return $eventsMamager;
	}

	public abstract function run();
}
