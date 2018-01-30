<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer{
		protected $mailer;
		protected $from = 'admin@example.com';
		protected $to;
		protected $view;
		protected $data = [];

		public function __construct(Mailer $mailer)
		{
			# code...
			$this->mailer=$mailer;
		}

		public function sendEmailConfirmationTo(User $user)
		{
			# code...
			$this->to=$user->email;
			$this->view='emails.confirm';
			$this->data=compact('user');
			$this->deliver();
		}

		public function deliver()
		{
			# code...
			$this->mailer->send($this->view, $this->data, function($message){
				$message->from($this->from, 'Online Article')->to($this->to)->subject("Verify");
			});
		}
}