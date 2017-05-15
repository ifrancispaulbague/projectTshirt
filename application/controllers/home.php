<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public $model  = "prize_model";
    public $model2  = "entry_model";
    public $module = "main";
    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->main_html("homepage", null);
    }

    public function draw()
    {      
        // $where = array("status"=>"A");
        // $prizes = $this->prize_model->get($where);
        //var_dump($this->db->_error_number());
        // //var_dump($prizes->num_rows);
        // //var_dump($prizes->result_object());
        // //return;

        // $data["prizes"] = $prizes->result_object();

        $this->main_html("draw", null);
    }

    public function prizes()
    {
        $where = array("prize_type" => $this->input->post("category"),
                        "status" => "A");
        $prizes = $this->prize_model->get($where);

        if ($this->db->_error_number()) {
            // return $this->db->_error_message()
            return;
        }

        if ($prizes->num_rows == 0) {
            // return no record found
            return;
        }

        echo json_encode($prizes->result_object());
    }

    public function entry()
    {
        $this->main_html("entry", null);
    }

    public function report()
    {
        $this->main_html("report", null);
    }
}