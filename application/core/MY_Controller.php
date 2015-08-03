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

class CustomerController extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        if(!$this->checkLogin()){
            //Login 失败
            redirect('customer/oauth/loginPage');
        }
    }
    private function checkLogin(){
        if (!session_id()) session_start();
        // 判断Session
        if(isset($_SESSION['user'])){
            return true;
        }

        $this->load->model('Http_model');
        $this->load->model('User_model');
        $this->load->model('Weixin_model');
        if(isset($_GET['code'])) {
            $appid = 'wxcd901e4412fc040b';
            $appsecret = '16a24c163a44ee41fa3ef630c1c455ec';
            $code = $_GET['code'];
            $para = array('appid'=>$appid, 'secret'=>$appsecret, 'code'=>$code, 'grant_type'=>'authorization_code');
            $ret = $this->Http_model->doCurlGetRequest('https://api.weixin.qq.com/sns/oauth2/access_token',$para);
            $retData = json_decode($ret, true);
            
            // 判断结果
            if(!isset($retData['openid'])){
                return false;
            }

            $openid = $retData['openid'];
            $access_token = $retData['access_token'];

            $result = $this->User_model->searchById($openid);
            if($result){
                $user = $result;
            }else{
                $followerInfo = $this->Weixin_model->getFollowerInfo($openid);
                if(isset($followerInfo['errorcode'])){
                    return false;
                }
                date_default_timezone_set('PRC');
                $followerInfo['createTime'] = date('Y-m-d h:i:s'); 
                $this->User_model->add($followerInfo);
                $user = $this->User_model->searchById($openid);
            }
            if (!session_id()) session_start();
            $_SESSION['user'] = $user;
            return true;
        }else{
            return false;
        }
    }
    
}

?>