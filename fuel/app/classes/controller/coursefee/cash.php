<?php

class Controller_CourseFee_Cash extends Controller_CourseFee
{

	public function action_index()
	{
		$this->template->title = "Cash Payment";
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
		// add
			if(Input::post("studentId", null) != null){
				if(is_uploaded_file($_FILES["photo"]["tmp_name"])){
					$filename = str_replace("/", "", $_FILES["photo"]["name"]);
					$filepath = DOCROOT."/contents/receipt/".$filename;

					$checkExist = Model_Payment::find("first", [
							"where" => [
									["student_id", Input::post("studentId")],
									["paid", Input::post("quarter")],
									["status", 0],
							]
					]);

					if($checkExist==NULL) {
						if(move_uploaded_file($_FILES["photo"]["tmp_name"], $filepath)) {
							chmod($filepath, 0644);

							// save
							$payment = Model_Payment::forge();
							$payment->student_id = Input::post("studentId");
							$payment->pay_method = Input::post("paymethod");
							$payment->paid_at = Input::post("date");
							$payment->receipt = $filename;
							$payment->status = 0;
							$payment->method = Input::post("method");
							if(Input::post("method") == 1){
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
							//$sendmail->to("support@game-bootcamp.com");
							$sendmail->to("lasuganob123@gmail.com");
							$sendmail->subject("Payment / Game-bootcamp");
							$sendmail->html_body("Dear Admin,<br><br>". htmlspecialchars_decode($body));

							$rec = $data["pay"];
							$receipt = Model_Payment::query()->where('id', $rec->id)->limit(1)->get_one();
							$query = Model_Payment::find($receipt->id);
							$sendmail->attach(DOCROOT.'/contents/receipt/'.$query->receipt);

							$sendmail->send();

							Response::redirect("/students/top/?success=1");
						}else{
							Response::redirect("/coursefee/?e=1");
						}
					}else {
						Response::redirect("/coursefee/cash/?e=2&g=".Input::post('g', 0));
					}
				}else{
					Response::redirect("/coursefee/?e=3");
				}
			}else{
				Response::redirect("/coursefee/?e=4");
			}
		endif;

		if(isset($this->user)) {
			$view = View::forge("coursefee/cash", $data);
		}else {
			$view = View::forge("coursefee/cash");
		}
		$this->template->content = $view;
	}
}
