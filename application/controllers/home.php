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
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("draw", $data);
    }

    public function draw_winners()
    {
        $this->load->model('entry_model');
        $this->load->model('draw_model');

        $where = array("promo_desc" => $this->input->post("category"),
                       "status"     => 0);

        $limit = $this->input->post("winners");

        $raffle = $this->entry_model->get($where, $limit, "record_id", "rand");
        
        if ($this->db->_error_message()) {
            syslogs(date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message(), "DRAW");
            echo json_encode(array("code"=> "99", "msg"=>"DATABASE ERROR. PLEASE CONTACT ADMINISTRATOR."));
            return;
        }
        
        if ($raffle->num_rows == 0) {
            echo json_encode(array("code"=>"99", "msg"=>"NO RAFFLE ENTRIES TO BE DRAWN."));
            return;
        }

        echo json_encode(array("code"=>"00", "msg"=>$raffle->result_object()));
        return;
    }

    public function confirm_draw()
    {
        $winners = 0;
        $ids = explode("|", $this->input->post("record_id"));

        $this->load->model('entry_model');
        foreach ($ids as $key => $value) {
            if ($value) {
                $this->entry_model->edit(array("record_id"=>$value), array("status"=>1));

                if ($this->db->_error_message()) {
                    $log  = date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message()." || ";
                    $log .= "RECORD ID: ".$value."\n";
                    syslogs($log, "WINNER");
                }

                if ($this->db->affected_rows() == 0) {
                    $log = date("Y-m-d H:i:s")." :: Unable to update record id: ".$value."\n";
                    syslogs($log, "WINNER");
                } else {
                    $winners++;
                }
            }
        }
        return;
        
        $where = array("record_id" => $this->input->post("category"));
        $entry = $this->entry_model->get($where, $this->input->post("limit"),"rand()");
        $data["entry"] = $entry->result_object();
        $desc = $this->input->post("confirm");

        foreach ($entry->result_object() as $key => $value) { 
            $data = array(  "pk"          => $value->pk,
                            "prize_desc"  => $this->input->post("confirm"),
                            "draw_date"   => date("Y-m-d")
                          );
            $this->load->model('draw_model');
            $this->draw_model->add($data);           
        } 
        redirect(base_url().'home/draw');
        return;
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