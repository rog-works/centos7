<?php

namespace App\Plugins;

use Phalcon\Dispatcher;
use Phalcon\Events\Event;

class ExceptionForwarder /* extends \Phalcon\Pluginds */ {
	public function beforeException(Event $event, Dispatcher $dispatcher, \Exception $exception) {
		$actions = [
			\App\Exception\DataNotFound::class => 'show404',
			\Phalcon\Mvc\Dispatcher\Exception::class => 'show404',
		];
		$dispatcher->forward([
			'controller' => 'error',
			'action' => $actions[get_class($exception)] ?? 'show500',
		]);
		return false;
	}
}