<?php

class Controller_Admin_Grameencom_Api extends Controller_Grameencom_Api
{
	private $user = null;
	private $auth_status = false;

	public function before(){

		parent::before();

		if(Auth::check()){

			$user_id = Auth::get_user_id()[1];
			$this->user = Model_User::find($user_id);

			if($this->user->group_id == 0){
				$this->auth_status = true;
			}

		}

	}

	public function post_delreservation(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$reservation = Model_Lessontime::find(Input::post("id", 0));

			if($reservation != null){
				$reservation->deleted_at = time();
				$reservation->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_delnews(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$news = Model_News::find(Input::post("id", 0));

			if($news != null){
				$news->deleted_at = time();
				$news->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}
	
	public function post_delmail(){
	
		$code = 0;
		$message = "ok";
	
		if($this->auth_status){
	
			$mail = Model_Mail::find(Input::post("id", 0));
	
			if($mail != null){
				$mail->deleted_at = time();
				$mail->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
				'code' => $code,
				'message' => $message,
		));
	}
	
	public function post_delevents(){
	
		$code = 0;
		$message = "ok";
	
		if($this->auth_status){
	
			$events = Model_Events::find(Input::post("id", 0));
	
			if($events != null){
				$events->deleted_at = time();
				$events->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
				'code' => $code,
				'message' => $message,
		));
	}
	
	public function post_delforum(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$forum = Model_Forum::find(Input::post("id", 0));

			if($forum != null){
				$forum->deleted_at = time();
				$forum->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_deluser(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$user = Model_User::find(Input::post("id", 0));

			if($user != null){
				$user->deleted_at = time();
				$user->username = $user->username . time();
				$user->email = $user->email . time();
				$user->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_htmlcourse1(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$user = Model_User::find(Input::post("id", 0));

			if($user != null){
				if($user->charge_html == NULL or $user->charge_html == 0){
					$user->charge_html = 1;
				}else{
					$user->charge_html = NULL;
				}
				$user->save();
			}else{
				$code = 404;
				$message = "User not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}
	public function post_htmlcourse2(){
	
		$code = 0;
		$message = "ok";
	
		if($this->auth_status){
	
			$user = Model_User::find(Input::post("id", 0));
	
			if($user != null){
				if($user->charge_html == 1){
					$user->charge_html = 11;
				}else{
					$user->charge_html = 1;
				}
				$user->save();
			}else{
				$code = 404;
				$message = "User not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
				'code' => $code,
				'message' => $message,
		));
	}
	public function post_htmlcourse3(){
	
		$code = 0;
		$message = "ok";
	
		if($this->auth_status){
	
			$user = Model_User::find(Input::post("id", 0));
	
			if($user != null){
				if($user->charge_html == 11){
					$user->charge_html = 111;
				}else{
					$user->charge_html = 11;
				}
				$user->save();
			}else{
				$code = 404;
				$message = "User not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
				'code' => $code,
				'message' => $message,
		));
	}
	public function post_htmlcourse4(){
	
		$code = 0;
		$message = "ok";
	
		if($this->auth_status){
	
			$user = Model_User::find(Input::post("id", 0));
	
			if($user != null){
				if($user->charge_html == 111){
					$user->charge_html = 1111;
				}else{
					$user->charge_html = 111;
				}
				$user->save();
			}else{
				$code = 404;
				$message = "User not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
				'code' => $code,
				'message' => $message,
		));
	}

	public function post_deldocument(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$document = Model_Document::find(Input::post("id", 0));

			if($document != null){
				$document->deleted_at = time();
				$document->save();

			}else{
				$code = 404;
				$message = "Document not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_delcontent(){

	$code = 0;
	$message = "ok";

	if($this->auth_status){

		$content = Model_Content::find(Input::post("id", 0));

		if($content != null){
			$content->deleted_at = time();
			$content->save();
		}else{
			$code = 404;
			$message = "Content not found.";
		}
	}else{
		$code = 500;
		$message = "Auth error.";
	}
	$this->response(array(
		'code' => $code,
		'message' => $message,
	));
}

	public function post_changecontenttype(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$content = Model_Content::find(Input::post("id", 0));

			if($content != null){
				$content->type_id = Input::post("type_id", 0);
				$content->text_type_id = Input::post("text_type_id", 0);
				$content->exam = NULL;
				$content->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_changecontactstatus(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$contact = Model_Contact::find(Input::post("id", 0));

			if($contact!= null){
				$contact->status = Input::post("status", 0);
				$contact->save();
			}else{
				$code = 404;
				$message = "Content not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_changefee(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$fee = Model_Fee::find("first", [
				"where" => [
					["id", Input::post("id")],
				]
			]);

			if($fee != null){
				$fee->is_paid = Input::post("is_paid", 0);
				$fee->fulltime = (int)Input::post("fulltime", 0);
				$fee->grade = Input::post("grade", 0);
				$fee->save();
			}else{
				$code = 404;
				$message = "Fee not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

}
