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
		foreach ($definitions as $key => $definition) {
			$di->set($key, function() use ($di, $definition) {
				$depended = Injector::resolve($definition['class'], $definition['methods'] ?? []);
				if (isset($definition['events'])) {
					$eventsMamager = $di->getShared('eventsManager');
					foreach ($definition['events'] as $eventType => $eventDefinition) {
						$handler = Injector::resolve($eventDefinition['class'], $eventDefinition['methods'] ?? []);
						$eventsMamager->attach($eventType, $handler);
					}
					$depended->setEventsManager($eventsMamager);
				}
				return $depended;
			});
		}
	}

	public abstract function run();
}
