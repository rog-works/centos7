<?php

namespace App\Tasks;

class MainTask extends \Phalcon\Cli\Task {
	public function mainAction() {
		echo 'Hello Task!';
	}
}
