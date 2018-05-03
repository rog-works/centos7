<?php

namespace App\Mvc;

use Phalcon\Di;
use Phalcon\Dispatcher as PhDispatcher;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Event;
use Exception;

class Dispatcher extends MvcDispatcher {
	public function __construct(Di $di) {
		$this->on($di, 'dispatch:beforeException');
	}

	private function on(Di $di, string $trigger) {
		$eventsMamager = $di->getShared('eventsManager');
		$eventsMamager->attach($trigger, $this);
		$this->setEventsManager($eventsMamager);
	}

	public function beforeException(Event $event, PhDispatcher $dispatcher, Exception $exception) {
		$actions = [
			\App\Exceptions\DataNotFound::class => 'show404',
			\Phalcon\Mvc\Dispatcher\Exception::class => 'show404',
		];
		$dispatcher->forward([
			'controller' => 'error',
			'action' => $actions[get_class($exception)] ?? 'show500',
		]);
		return false;
	}
}
