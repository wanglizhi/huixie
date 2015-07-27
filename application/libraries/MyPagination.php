<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class MyPagination {

	private function echo_head($total_pages,$current_page,$method_name){
		$result = "<div class=\"row-fluid\">
		<div class=\"span12\">
			<div class=\"dataTables_paginate paging_bootstrap pagination\">
				<ul>";	
		if($current_page>1)
			$result.="<li class=\"prev\">
				<a style=\"margin: 0px;\" href=\"".site_url($method_name)."/".($current_page-1)."\">← <span class=\"hidden-480\">Prev</span></a>
				</li>";
		for($i = 1;$i<=$total_pages;$i++){
			if($i==$current_page){
				$result.="<li class=\"active\">
							<a style=\"margin: 0px;\" href=\"".site_url($method_name)."/".$i."\">".$i."</a>
						</li>";
			}
			else{
				$result.="<li>
							<a style=\"margin: 0px;\" href=\"".site_url($method_name)."/".$i."\">".$i."</a>
						</li>";
			}
		}
		if($current_page+1<=$total_pages)
			$result.="<li class=\"next\"><a style=\"margin: 0px;\" href=\"".site_url($method_name)."/".($current_page+1)."\"><span class=\"hidden-480\">Next</span> → </a></li>
					</ul></div></div></div>";
		return $result;
	}

    public function create_links($total_pages,$current_page,$method_name)
    {
    	$result = $this->echo_head($total_pages,$current_page,$method_name);
    	return $result;
    }
}

/* End of file Someclass.php */