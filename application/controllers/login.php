<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

    public $model  = "prize_model";
    public $module = "main";
    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("login", $data);
    }

    public function log_in()
    {

        $username    = rawurldecode($this->input->post("user"));
        $password    = rawurldecode($this->input->post("pwd"));
        
        $where = array( 'username' => $username, 
                        'password' => $password, 
                        'status' => 'A'
                        );

        $userAccount = $this->Useraccount_model->get($where);

        if ($userAccount->num_rows() > 0) {
            $this->session->set_userdata('user_data', $userAccount->result_object()[0]); 
            echo json_encode(array("code"=>"00", "msg"=>'Successfully logged in'));
        } else {
            echo json_encode(array("code"=>"99", "msg"=>'Invalid User Account'));
        }
        return;
    }

    public function sign_up()
    {
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("signup", $data);
    }

    public function create_user() 
    {
        $username    = rawurldecode($this->input->post("user"));
        $password    = rawurldecode($this->input->post("pwd1"));
        $firstname   = rawurldecode($this->input->post("fname"));
        $lastname    = rawurldecode($this->input->post("lname"));

        $data = array(  'username'      => $username, 
                        'password'      => $password, 
                        'user_type'     => 'U',
                        'status'        => 'A',
                        'first_name'    => $firstname,
                        'last_name'     => $lastname
                        );

        $createAcct = $this->Useraccount_model->add($data);

        if ($createAcct) {
            $this->session->set_userdata('user_data', $data); 
            echo json_encode(array("code"=>"00", "msg"=>'Successfully Signed up'));
        } else {
            echo json_encode(array("code"=>"99", "msg"=>'Invalid User Account'));
        }
        return;
    }
}