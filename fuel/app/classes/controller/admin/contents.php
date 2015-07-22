<?php

class Controller_Admin_Contents extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		if(Input::post("t_id", 0) != 0){
			$content = Model_Content::find(Input::post("t_id", 0));
			if($content != null){
				$content->text_type_id = Input::post("text_type_id", 0);
				$content->save();
			}
		}

		if(Input::post("n_id", 0) != 0){
			$content = Model_Content::find(Input::post("n_id", 0));
			if($content != null){
				$content->number = Input::post("number", 0);
				$content->save();
			}
		}
		if(Input::post("e_id", 0) != 0){
			$content = Model_Content::find(Input::post("e_id", 0));
			if($content != null){
				$content->exam = Input::post("course_val", 0);
				$content->text_type_id = 2;
				$content->save();
			}
		}

		// add
		if(Input::post("type", null) != null and Security::check_token()){

			if(is_uploaded_file($_FILES["file"]["tmp_name"])){
				$ext = explode(".", $_FILES["file"]["name"]);
				if(strtolower($ext[1]) == "pdf" or strtolower($ext[1]) == "doc" or strtolower($ext[1]) == "docx"){

					$filename = str_replace("/", "", $_FILES["file"]["name"]);
					$filepath = DOCROOT."/contents/".$filename;

					if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {
						chmod($filepath, 0644);
						
						// save
						$cs = Input::post("course");
						$courses = NULL;
						if(null !=(Input::post("course"))){
							foreach($cs as $course){
								$courses = $courses.$course;
							}
							$content = Model_Content::forge();
							$content->path = $filename;
							$content->type_id = Input::post("type");
							$content->number = 0;
							$content->text_type_id = 2;
							$content->exam = $courses;
							$content->save();
						}else{
							$content = Model_Content::forge();
							$content->path = $filename;
							$content->type_id = Input::post("type");
							$content->number = Input::post("number");
							$content->text_type_id = Input::post("text_type");
							$content->exam = NULL;
							$content->save();
						}

					}else{
						Response::redirect("/admin/contents/?e=1");
					}
				}else{
					Response::redirect("/admin/contents/?e=1");
				}
			}
		}

		$where = [["deleted_at", 0]];

		if(Input::get("search_type", 0) != 0){
			array_push($where, ["type_id" => Input::get("search_type", 0) - 1]);
		}

		$data["contents"] = Model_Content::find("all", [
			"where" => $where,
			"order_by" => [
				["type_id", "asc"],
				["number", "asc"],
				["text_type_id", "asc"],
				//["exam", "asc"],
			]
		]);

		$config=array(
			'pagination_url'=>"?search_type=".Input::get("search_type", 0),
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>100,
			'total_items'=>count($data["contents"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["contents"] = array_slice($data["contents"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/contents/index", $data);
		$this->template->content = $view;
	}
}