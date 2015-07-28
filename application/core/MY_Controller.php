<?php

class MY_AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->checkLogin();
    }

    function checkLogin(){
        if (!session_id()) session_start();
        if(!isset($_SESSION['admin'])){
            redirect(ADMIN_PREFIX.'login/loginPage');
        }
    }

   
}

?>