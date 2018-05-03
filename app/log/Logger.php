<?php

namespace App\Log;

use Phalcon\Logger\Formatter\Line as Formatter;

class Logger extends \Phalcon\Logger\Adapter\File {
	public function __construct(string $path, string $format, string $dateFormat) {
		parent::__construct($path);
		$this->setFormatter(new Formatter($format, $dateFormat));
	}
}
