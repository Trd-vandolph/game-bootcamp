<?php

class Controller_Admin_Payment extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{		
		$id = Input::get('id',0);
		
		$data['payment'] = Model_Payment::find("all", [
			"where" => [
				["id", $id],
			]
		]);
		
		
		//save
		if(Input::post('action') == 'submit'){
			if(Input::post("payid", null) != null){
				$payid = Input::post("payid", null);
				
				$payUp = Model_Payment::find("first", [
						"where" => [
							["id", $payid],
						]
				]);
				
				DB::update('payment')->value("status", "1")->where('id','=',$payid)->execute();
				
				DB::update('users')->value("charge_html", $payUp->paid)->where('id','=',$payUp->student_id)->execute();
				
				$data["user"] = Model_User::find("first", [
						"where" => [
								["id", $payUp->student_id],
						]
				]);
				
				$data["pay"] = Model_Payment::find("first", [
						"where" => [
								["student_id", $payUp->student_id],
								["id", $payUp->id],
						]
				]);
				
				$user = $data["user"];
				//sending mail
				$body = View::forge("email/confirm", $data);
				$sendmail = Email::forge("JIS");
				$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
				$sendmail->to($user->email);
				$sendmail->subject("Payment Confirmation / OliveCode");
				$sendmail->html_body("Dear ".$user->firstname.",<br><br>". htmlspecialchars_decode($body));
				
				$sendmail->send();
				
				Response::redirect("/admin/top/?pay=1");
			}else {
				
			}			
		}
		
		if(Input::post("paymentID", 0) != 0){
			$cancel = Model_Payment::find(Input::post("paymentID", 0));
			if($cancel != null){
				
				//save
				$cancel->reason = Input::post("explain", 0);
				$cancel->status = 2;
				$cancel->save();
				
				$data["cancel"] = Model_Payment::find("first", [
					"where" => [
							["id", Input::post("paymentID", 0)],
						]
				]);
				
				$student = $data["cancel"];
				
				$data["student"] = Model_User::find("first", [
					"where" => [
							["id", $student->student_id],
						]
				]); 
				
				$stud = $data["student"];
				//sendingmail
				$body = View::forge("email/cancelpayment", $data);
				$sendmail = Email::forge("JIS");
				$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
				$sendmail->to($stud->email);
				$sendmail->subject("Denied Payment / OliveCode");
				$sendmail->html_body("Dear ".$stud->firstname.",<br><br>". htmlspecialchars_decode($body));
				
				$sendmail->send();
				
				Response::redirect("/admin/top/?s=1");
			}
		}
		
		
		
		$view = View::forge("admin/payment/index", $data);
		$this->template->content = $view;
	}
}