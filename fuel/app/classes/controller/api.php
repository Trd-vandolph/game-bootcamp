<?php

class Controller_Api extends Controller_Rest
{

	public function post_setemail(){

		$code = 0;
		$message = "ok";

		$email =  Input::post("email", null);

		if($email != null){
			$mail = Model_Email::forge();
			$mail->email = $email;
			$mail->save();

			$body = View::forge("email/email");

			$sendmail = Email::forge("JIS");
			$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
			$sendmail->to($mail->email);
			$sendmail->subject("Thanks for your interest in our classroom. / OliveCode");
			$sendmail->html_body(htmlspecialchars_decode($body));

			$sendmail->send();
		}else{
			$code = 500;
			$message = "email error.";
		}

		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}
}