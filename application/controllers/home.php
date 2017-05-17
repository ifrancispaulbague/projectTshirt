<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public $model  = "prize_model";
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
        $this->load->model('entry_model');
        $this->load->model('draw_model');
        $where = array("promo_desc" => $this->input->post("category"));
        $entry = $this->entry_model->get($where, $this->input->post("winners"));
        $data["entry"] = $entry->result_object();
        //------
        foreach ($entry->result_object() as $key => $value) {
        
        }
        
        //------
        // $data = array(
                  // "pk" => pk,
        // );
    
        // if ($this->db->_error_number()) {
        //     // return $this->db->_error_message()
        //     // return;
        // }

        // if ($draw_model->num_rows == 0) {
        //     // return no record found
        //     // return;
        //   echo ('none');
        // }
      
        // echo json_encode($entry->result_object());

        $this->main_html("draw", $data);
    }

    public function winners()
    {
        $this->load->model('entry_model');
        $this->load->model('draw_model');

        $where = array("promo_desc" => $this->input->post("category"));
        $entry = $this->entry_model->get($where, $this->input->post("winners"));
        $draw  = $this->draw_model->add($entry);
        foreach ($entry->result_object() as $key => $value) {
            
        }
        
        echo json_encode($entry->result_object());
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

    public function entries()
    {
     
        $entries = $this->entry_model;

        if ($this->db->_error_number()) {
            // return $this->db->_error_message()
            return;
        }

        if ($entries->num_rows == 0) {
            // return no record found
            return;
        }

        echo json_encode($entries->result_object());

        $this->main_html("entry", null);
    }

    public function report()
    {
        $this->main_html("report", null);
    }

    public function upload_entries()
    {
        $csv_filename = $_FILES['filename']['tmp_name'];

        $file = fopen($csv_filename, 'r');
        $ctr = 0;

        /* skip header line of csv file */
        while (($line = fgetcsv($file)) !== FALSE) {
            $ctr += 1;
            if ($ctr != 1) {
                $data = array("promo_desc"  => $this->input->post("promo_desc"),
                              "pk"          => $line[0],
                              "product"     => $line[2],
                              "description" => $line[3],
                              "tran_date"   => $line[1],
                              "upload_date" => date("Y-m-d")
                             );
                $this->load->model("entry_model");
                $this->entry_model->add($data);
            }
        }
    }
}