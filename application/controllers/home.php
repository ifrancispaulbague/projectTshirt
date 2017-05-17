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
        $entry = $this->entry_model->get($where, $limit = $this->input->post("winners"),"rand()");
        $data["entry"] = $entry->result_object();

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

    public function confirm_draw()
    {
        $this->load->model('entry_model');
        

        $where = array("promo_desc" => $this->input->post("category"));
        $entry = $this->entry_model->get($where, $this->input->post("winners"),"rand()");
        //$prize_desc = $this->input->post("prize_type");
        foreach ($entry->result_object() as $key => $value) {    
            $data = array(  "pk"          => $value->pk,
                            "prize_desc"  => $value->pk,
                            "draw_date"   => date("Y-m-d")
                             );
            $this->draw_model->add($data);
            $this->load->model('draw_model');
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
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("entry", $data);
    }

    public function report()
    {
        $this->main_html("report", null);
    }

    public function upload_entries()
    {
        $csv_filename = $_FILES['filename']['tmp_name'];

        $file       = fopen($csv_filename, 'r');
        $ctr        = 0;
        $uploaded   = 0;
        $unuploaded = 0;

        while (($line = fgetcsv($file)) !== FALSE) {
            $ctr += 1;
            if ($ctr != 1) {
                $entries = array("promo_desc"  => $this->input->post("promo_desc"),
                              "pk"          => $line[0],
                              "product"     => $line[2],
                              "description" => $line[3],
                              "tran_date"   => $line[1],
                              "upload_date" => date("Y-m-d H:i:s")
                             );
                $this->load->model("entry_model");
                $add_entry = $this->entry_model->add($entries);

                if ($this->db->_error_number()) {
                    $log  = date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message()." || ";
                    $log .= "PANALOKARD: ".$line[0]."\n";
                    syslogs($log, "ENTRY");

                    $entries["err"] = array("code"=>"99", "msg"=>"DATABASE ERROR. PLEASE CONTACT ADMINISTRATOR.");
                    $this->main_html("entry", $entries);
                    return;
                }

                if (!$add_entry) {
                    $log  = date("Y-m-d H:i:s")." :: ";
                    $log .= "Insert error: ".$this->db->_error_message()." || PANALOKARD: ".$line[0]."\n";
                    syslogs($log, "ENTRY");
                    $unuploaded++;
                } else {
                    $uploaded++;
                }
            }
        }

        $msg  = "<strong>UPLOAD SUCCESSFUL. </strong> <br>";
        $msg .= "Total entries uploaded: ".$uploaded."<br>";
        $msg .= "Error uploading: ".$unuploaded;
        $data["err"] = array("code"=>"00", "msg"=>$msg);
        $this->main_html("entry", $data);
        return;
    }

    public function report_list()
    {
        $category = $this->input->post("category");
        $criteria = $this->input->post("criteria");
    }
}