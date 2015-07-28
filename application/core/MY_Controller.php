<?php

class MY_AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->checkLogin();
    }

    function loadView($view,$data){
        $this->load->view(ADMIN_PREFIX.'admin_header',$data);       
        $this->load->view($view);
        $this->load->view(ADMIN_PREFIX.'admin_footer');
    }

    function checkLogin(){
        if (!session_id()) session_start();
        if(!isset($_SESSION['admin'])){
            redirect(ADMIN_PREFIX.'login/loginPage');
        }
    }

   
}

?>