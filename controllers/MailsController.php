<?php

namespace App\Controllers;

class MailsController extends \Phalcon\Mvc\Controller {
	public function indexAction() {
		$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
			->setUsername('hoge@gmail.com')
			->setPassword('password');
		$mailer = new Swift_Mailer($transport);
		$message = (new Swift_Message('subject'))
			->setFrom(['hoge@gmail.com' => 'send user'])
			->setTo(['fuga@gmail.com' => 'respond user'])
			->setBody('mail body');
		if ($mailer->send($message)) {
			$this->view->result = 'success';
		} else {
			$this->view->result = 'failure';
		}
	}
}
