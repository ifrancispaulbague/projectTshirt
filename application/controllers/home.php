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

    public function draw()
    {
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("draw", $data);
    }

    public function draw_winners()
    {
        $this->load->model('entry_model');
        $this->load->model('draw_model');
        $this->load->model('cusm_model');
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

        // $this->db->select('*');
        // $this->db->from('lycm_model');
        // $this->db->join('cusm_model', 'lycm_model.CUSM_CustomerNo = cusm_model.CustomerNo', 'INNER');
        // $query = $this->db->get();
        // var_dump($query);
        // break;

        // $where = array("PanaloKardNo" => '123');
        // $test = $this->lycm_model->get($where);
        // var_dump($test->result_object());
        // return; 

        // $test2 = $this->lycm_model->getName();
        // var_dump($test2);
        // return;

        // $where = array("PanaloKardNo" => '10123');
        // $test = $this->cusm_model->get($where);

        // foreach ($query->result_object() as $key => $value){
        //   $where_lycm = array("pk" => $value->pk);
        //   $customer = $this->cusm_model->get($where);
        //     $data = array("pk"=> $value->pk,
        //                   "name"=> $value->CustomerFName,
        //                   "product"=> $value->product,
        //                   "desc"=>  $value->desc,
        //                   "date"=> date("Y-m-d")
        //     );
        // }

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