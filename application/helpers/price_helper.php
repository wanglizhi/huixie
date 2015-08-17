<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

function getPrice($unitPrice, $order){
    return $unitPrice * $order['pageNum'];
}

?>