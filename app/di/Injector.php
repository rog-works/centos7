<?php

namespace App\Di;

use Phalcon\Di;
use Phalcon\Events\Manager as EventsManager;

class Injector {
	public static function inject(Di $di, array $definitions) {
		foreach ($definitions as $key => $definition) {
			$di->set($key, function() use ($definition) {
				$depended = Resolver::resolve($definition['class'], $definition['methods'] ?? []);
				if (isset($definition['events'])) {
					$eventsMamager = $this->getShared('eventsManager');
					self::attachEvents($eventsMamager, $definition['events']);
					$depended->setEventsManager($eventsMamager);
				}
				return $depended;
			});
		}
	}

	public static function attachEvents(EventsManager $eventsMamager, array $eventDefinitions) {
		foreach ($eventDefinitions as $eventType => $definitions) {
			foreach ($definitions as $class => $methods)
			$eventsMamager->attach($eventType, Resolver::resolve($class, $methods));
		}
	}
}
