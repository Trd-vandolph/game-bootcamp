<?php


class Controller_Base extends Controller_Template
{
    public $auth_status = false;
	public $auth = null;
	public $user = null;

    public function before(){

		parent::before();

		$this->auth = Auth::instance();
		// logout
		if((int)Input::get("logout", null) === 1){
			$this->auth->logout();
			Response::redirect('/');
		}

		// check login
		if(Auth::check()){
			$this->auth_status = true;
			$user_id = $this->auth->get_user_id();
			// set header info
			$this->user = Model_User::find($user_id[1]);

			if($this->user->timezone != ""){
				$timezone = Config::get("timezone.timezone");
				if(isset($timezone[$this->user->timezone])){
					date_default_timezone_set($timezone[$this->user->timezone]);
				}
			}


		}else{

		}
	}
}
