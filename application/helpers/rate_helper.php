<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

function getRate(){
	$html = new simple_html_dom();
	$html->load_file('http://www.boc.cn/sourcedb/whpj/enindex.html');
	foreach($html->find('table tr[align=center]') as $tr){
		$currency_name = $tr->children(0)->plaintext;
		if($currency_name=="USD"){
			$rate['currency_name'] = $currency_name;
			$rate['buying_rate'] = $tr->children(1)->plaintext;
			$rate['cash_buying_rate'] = $tr->children(2)->plaintext;
			$rate['selling_rate'] = $tr->children(3)->plaintext;
			$rate['cash_selling_rate'] = $tr->children(4)->plaintext;
			$rate['middle_rate'] = $tr->children(5)->plaintext;
			$rate['pub_time'] = str_replace("&nbsp;", '',$tr->children(6)->plaintext);
			return $rate;
		}
	}
	return array();
}

?>