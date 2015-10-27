<?php

class Controller_Admin_Documents extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{

		// add
		if(!empty($_FILES["file"]) and is_uploaded_file($_FILES["file"]["tmp_name"])){
			$ext = explode(".", $_FILES["file"]["name"]);
			if(strtolower($ext[1]) == "pdf" or strtolower($ext[1]) == "doc" or strtolower($ext[1]) == "docx"){

				$filename = str_replace("/", "", $_FILES["file"]["name"]);
				$filepath = DOCROOT."/contents/".$filename;

				if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {
					chmod($filepath, 0644);

					// save
					if(Input::post("doc_type")==1){
						$documents = Model_Document::query()->where('type', 2)->where('deleted_at', 0)->limit(1)->get_one();
						if(count($documents)<1){
							$document = Model_Document::forge();
							$document->path = $filename;
							$document->type = Input::post("doc_type");
							$document->save();
						}else{
							$query = Model_Document::find($documents->id);
							$query->path = $filename;
							$query->type = Input::post("doc_type");
							$query->save();
						}

					}else{
						$document = Model_Document::forge();
						$document->path = $filename;
						$document->type = Input::post("doc_type");
						$document->save();
					}

					Response::redirect("/admin/documents/");

				}else{
					Response::redirect("/admin/documents/?e=1");
				}
			}else{
				Response::redirect("/admin/documents/?e=3");
			}
		}
		$where = [
					["deleted_at", 0],
					["type", 0],
		];

		$data["documents"] = Model_Document::find("all", [
			"where" => $where,
			"order_by" => [
				["created_at", "desc"],
			]
		]);
		$where_online = [
				["deleted_at", 0],
				["type", 1],
		];

		$data["online"] = Model_Document::find("all", [
				"where" => $where_online,
				"order_by" => [
						["created_at", "desc"],
				]
		]);

		$config=array(
			'pagination_url'=>"",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>100,
			'total_items'=>count($data["documents"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["documents"] = array_slice($data["documents"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/documents/index", $data);
		$this->template->content = $view;
	}
}
