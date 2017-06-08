<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public $model  = "";
    public $module = "main";
    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->sess_destroy();
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("homepage", $data);

    }

    public function homepage()
    {   
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("homepage", $data);
    }

    public function draw()
    {
        // check session
        $session = $this->common_library->check_session();
        if (!$session) {
            redirect(base_url());
            return;
        }

        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("draw", $data);
    }
}