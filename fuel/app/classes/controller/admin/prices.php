<?php

class Controller_Admin_Prices extends Controller_Admin
{

	public function before(){
		parent::before();

	}

	public function action_index()
	{

		$year = Input::get("year", null);
		if($year == null) $year = date("Y");

		if(Input::post("month", null) != null){
			$price = Model_Grade::forge();
			$price->year = $year;
			$price->month = Input::post("month", null);
			$price->grade_1 = Input::post("grade_1", 0);
			$price->grade_2 = Input::post("grade_2", 0);
			$price->grade_3 = Input::post("grade_3", 0);
			$price->grade_4 = Input::post("grade_4", 0);
			$price->grade_5 = Input::post("grade_5", 0);
			$price->save();
		}

		$data["prices"] = Model_Grade::find("all", [
			"where" => [
				["year", $year]
			],
		]);

		$view = View::forge("admin/prices/index", $data);
		$this->template->content = $view;
	}
}