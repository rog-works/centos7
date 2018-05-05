<?php

namespace App\Di;

use Phalcon\Di;

class Injector {
	public static function inject(Di $di, array $definitions) {
		foreach ($definitions as $key => $definition) {
			$di->set($key, function() use ($definition) {
				$depended = Resolver::resolve($definition['class'], $definition['methods'] ?? []);
				if (isset($definition['events'])) {
					$depended->setEventsManager(self::injectEvents($this, $definition['events']));
				}
				return $depended;
			});
		}
	}

	private static function injectEvents(Di $di, array $definitions) {
		$eventsMamager = $di->getShared('eventsManager');
		foreach ($definitions as $eventType => $definition) {
			$eventsMamager->attach($eventType, Resolver::resolve($definition['class'], $definition['methods'] ?? []));
		}
		return $eventsMamager;
	}
}
