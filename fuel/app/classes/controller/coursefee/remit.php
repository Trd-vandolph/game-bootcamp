<?php

class Controller_CourseFee_Remit extends Controller_CourseFee
{

	public function action_index()
	{
		$this->template->title = "Remittance Payment";
		$this->template->sub = "Follow the steps below to pay";

		if(isset($this->user)) {
			$data["student"] = Model_User::find("first", [
					"where" => [
							["deleted_at", 0],
							["id", $this->user->id],
					]
			]);
		}

		if(Input::post('action') == 'submit'):
			if(Input::post("pay-method", null) != null && Input::post("refno", null) != null){
				$checkExist = Model_Payment::find("first", [
						"where" => [
								["student_id", Input::post("studentId")],
								["paid", Input::post("quarter")],
								["status", 0],
						]
				]);

				if($checkExist==NULL) {
					// save
					$payment = Model_Payment::forge();
					$payment->student_id = Input::post("studentId");
					$payment->pay_method = Input::post("paymethod");
					$payment->paid_at = Input::post("date");
					$payment->status = 0;
					$payment->method = Input::post("pay-method");
					$payment->ref_no = Input::post("refno");
					if(Input::post("pay-method") == 1){
						$payment->paid = "1111";
					}else{
						$payment->paid = Input::post("quarter");
					}
					$payment->save();

					$data["user"] = Model_User::find("first", [
							"where" => [
									["id", Input::post("studentId")],
							]
					]);

					$pay = Model_Payment::query()->where('status', 0);

					$lastID = $pay->max('id');

					$data["pay"] = Model_Payment::find("first", [
							"where" => [
									["id", $lastID],
							]
					]);

					//sending mail
					$body = View::forge("email/payment", $data);
					$sendmail = Email::forge("JIS");
					$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
					$sendmail->to("support@game-bootcamp.com");
					//$sendmail->to("lasuganob123@gmail.com");
					$sendmail->subject("Payment / Game-bootcamp");
					$sendmail->html_body("Dear Admin,<br><br>". htmlspecialchars_decode($body));

					$sendmail->send();

					Response::redirect("/students/top/?success=2");
				}else {
					Response::redirect("/coursefee/remit/?e=2&g=".Input::post('paymethod', 0));
				}
			}else{
				Response::redirect("/coursefee/?e=4");
			}
		endif;

		if(isset($this->user)) {
			$view = View::forge("coursefee/remit", $data);
		}else {
			$view = View::forge("coursefee/remit");
		}
		$this->template->content = $view;
	}
}
