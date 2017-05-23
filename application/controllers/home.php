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
        // $data["err"] = array("code"=>"", "msg"=>"");
        // $this->main_html("login", $data);
    }

    public function login()
    {
        //
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
        $this->load->model('lycm_model');

        $where = array("promo_desc" => $this->input->post("category"),
                       "status"     => 0);

        $limit = $this->input->post("winners");

        $raffle = $this->entry_model->get($where, $limit, "record_id", "RANDOM");

        if ($this->db->_error_message()) {
            syslogs(date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message(), "DRAW");
            echo json_encode(array("code"=> "99", "msg"=>"DATABASE ERROR. PLEASE CONTACT ADMINISTRATOR."));
            return;
        }
        
        if ($raffle->num_rows == 0) {
            echo json_encode(array("code"=>"99", "msg"=>"NO RAFFLE ENTRIES TO BE DRAWN."));
            return;
        }
          
        foreach ($raffle->result_object() as $key => $value){
          $where_customer = array('a.PanaloKardNo' => $value->pk);
          $customer = $this->lycm_model->getName($where_customer); 
      
          $result[] = array("pk"=>$value->pk,
                            "fname"=>$customer->result_object()[0]->CustomerFName,
                            "lname"=>$customer->result_object()[0]->CustomerLName,
                            "product" => $value->product,
                            "description" => $value->promo_desc,
                            "tran_date" => date("Y-m-d")
                            );
        }

        echo json_encode(array("code"=>"00", "msg"=>$result));
        return;
    }

    public function confirm_draw()
    {
        $winners = 0;
        $ids = explode("|", $this->input->post("record_id"));

        $this->load->model('entry_model');
        foreach ($ids as $key => $value) {
            if ($value) {
                // check if minor or major prize
                if ($this->input->post("prize_category") == "minor") {
                    $data = array("minor_prize" => $this->input->post("prize_type"),
                                  "status"      => 1);
                } else {
                    $data = array("major_prize" => $this->input->post("prize_type"),
                                  "status"      => 1);
                }

                // update raffle entries
                $this->entry_model->edit(array("record_id"=>$value), $data);

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

        $data["err"] = array("code"=>"00", "msg"=>"SUCCESSFUL. CONFIRMED WINNERS: ".$winners);
        $this->main_html("draw", $data);
        return;
    }

    public function prizes()
    {
        $where = array("prize_type" => $this->input->post("category"),
                        "status"    => "A");
        $prizes = $this->prize_model->get($where);

        if ($this->db->_error_number()) {
            syslogs(date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message(), "PRIZE");
            echo json_encode(array("code"=> "99", "msg"=>"DATABASE ERROR. PLEASE CONTACT ADMINISTRATOR."));
            return;
        }

        if ($prizes->num_rows == 0) {
            echo json_encode(array("code"=> "99", "msg"=>"NO AVAILABLE PRIZES."));
            return;
        }

        echo json_encode(array("code"=> "00", "msg"=>$prizes->result_object()));
        return;
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
        // check if file is already uploaded
        $where = array("file_name"=>$_FILES['filename']['name'], "upload_date"=>date("Y-m-d"));
        $this->load->model("file_model");
        $find_file = $this->file_model->get($where);

        // check if there is a database error
        if ($this->db->_error_number()) {
            $log  = date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message()." || ";
            $log .= "FILE: ".$_FILES['filename']['name']."\n";
            syslogs($log, "ENTRY");

            $entries["err"] = array("code"=>"99", "msg"=>"DATABASE ERROR. PLEASE CONTACT ADMINISTRATOR.");
            $this->main_html("entry", $entries);
            return;
        }

        if ($find_file->num_rows > 0) {
            $entries["err"] = array("code"=>"99", "msg"=>"FILE WAS ALREADY UPLOADED.");
            $this->main_html("entry", $entries);
            return;
        }

        $csv_filename = $_FILES['filename']['tmp_name'];

        $file       = fopen($csv_filename, 'r');
        $ctr        = 0;
        $uploaded   = 0;
        $unuploaded = 0;

        // save entries to database
        $this->db->trans_begin();
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

                // check if there is a database error
                if ($this->db->_error_number()) {
                    $this->db->trans_rollback();

                    $log  = date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message()." || ";
                    $log .= "PANALOKARD: ".$line[0]."\n";
                    syslogs($log, "ENTRY");

                    $entries["err"] = array("code"=>"99", "msg"=>"DATABASE ERROR. PLEASE CONTACT ADMINISTRATOR.");
                    $this->main_html("entry", $entries);
                    return;
                }

                // check if a record is not inserted
                if (!$add_entry) {
                    $this->db->trans_rollback();

                    $log  = date("Y-m-d H:i:s")." :: ";
                    $log .= "Insert error: ".$this->db->_error_message()." || PANALOKARD: ".$line[0]."\n";
                    syslogs($log, "ENTRY");
                    
                    $entries["err"] = array("code"=>"99", "msg"=>"UNABLE TO SAVE RAFFLE ENTRIES. PLEASE TRY AGAIN.");
                    $this->main_html("entry", $entries);
                    return;
                }
            }
        }

        // save file to database
        $file_upload = array("file_name"   => $_FILES['filename']['name'],
                             "upload_by"   => "39126",
                             "upload_date" => date("Y-m-d"));

        $add_file = $this->file_model->add($file_upload);

        // check if there is a database error
        if ($this->db->_error_number()) {
            $this->db->trans_rollback();

            $log  = date("Y-m-d H:i:s")." :: Database error: ".$this->db->_error_message()." || ";
            $log .= "FILE: ".$_FILES['filename']['name']."\n";
            syslogs($log, "ENTRY");

            $entries["err"] = array("code"=>"99", "msg"=>"DATABASE ERROR. PLEASE CONTACT ADMINISTRATOR.");
            $this->main_html("entry", $entries);
            return;
        }

        // check if a record is not inserted
        if (!$add_file) {
            $this->db->trans_rollback();

            $log  = date("Y-m-d H:i:s")." :: ";
            $log .= "Insert error: ".$this->db->_error_message()." || FILE: ".$_FILES['filename']['name']."\n";
            syslogs($log, "ENTRY");
            
            $entries["err"] = array("code"=>"99", "msg"=>"UNABLE TO SAVE RAFFLE ENTRIES. PLEASE TRY AGAIN.");
            $this->main_html("entry", $entries);
            return;
        }

        $this->db->trans_commit();
        $data["err"] = array("code"=>"00", "msg"=>"UPLOAD SUCCESSFUL.");
        $this->main_html("entry", $data);
        return;
    }

    public function report_list()
    {
        $category = $this->input->post("category");
        $criteria = $this->input->post("criteria");
    }
}