<?php

class Controller_Schools_Classroom extends Controller_Schools
{

	public function action_index()
	{
//        $config=array(
//			'pagination_url'=>"?",
//			'uri_segment'=>"p",
//			'num_links'=>9,
//			'per_page'=>20,
//			'total_items'=>count($data["forum"]),
//		);
//
//		$data["pager"] = Pagination::forge('mypagination', $config);
//
//		$data["news"] = array_slice($data["forum"], $data["pager"]->offset, $data["pager"]->per_page);

        
        $data["user"] = $this->user;
		$view = View::forge("schools/classroom/index", $data);
		$this->template->content = $view;
	}
}
