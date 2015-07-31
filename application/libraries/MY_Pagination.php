<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Pagination {

	private function create($controller,$total_pages,$current_page,$method_name){
		$data = array(
			'total_pages' => $total_pages,
			'current_page' => $current_page,
			'url' => site_url($method_name),
		);
		$result = $controller->load->view(ADMIN_PREFIX."pagination",$data,true);
		return $result;
	}

    public function create_links($controller,$total_rows,$current_page,$method_name)
    {
    	$total_pages = ceil($total_rows/ITEMS_PER_PAGE);
    	if($total_pages<=1) return "";
    	$result = $this->create($controller,$total_pages,$current_page,$method_name);
    	return $result;
    }
}

/* End of file Someclass.php */