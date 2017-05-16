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

    public function entries()
    {
     
        // $entries = $this->entry_model;

        // if ($this->db->_error_number()) {
        //     // return $this->db->_error_message()
        //     return;
        // }

        // if ($entries->num_rows == 0) {
        //     // return no record found
        //     return;
        // }

        // echo json_encode($entries->result_object());

        $this->main_html("entry", null);
    }

    public function report()
    {
        $this->main_html("report", null);
    }

    public function upload_entries()
    {
        $new_name = $_FILES["filename"]['name'];
        $config = array(
                    'upload_path'     => UPLOAD_PATH,
                    'allowed_types'   => "csv|xls|xlsx",
                    'overwrite'       => TRUE,
                    'max_size'        => "2048000",
                    'max_height'      => "768",
                    'file_name'       => $new_name,
                    'max_width'       => "1024"
                    );

        /* load and initialize built in library upload */
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if ( ! $this->upload->do_upload("filename"))
        {       
            echo $this->upload->display_errors();
            // redirect(base_url()."home/entries");
        }
        else
        {     
            $data = array('upload_data' => $this->upload->data());
            var_dump($data);
            return;
            
            // process upload
            $this->CI->load->model('pkcd_model');

            $csvFileName = $_FILES['filename']['tmp_name'];

            $file = fopen($csvFileName, 'r');
            $ctr = 0;

            /* IR38951 - addded error log */
            $log = "\n*** ".$this->session->userdata("emp_no")."-".$this->session->userdata("cost_center")."-".date("Y-m-d H:i:s")." ***\n";
            /* skip header line of csv file */
            while (($line = fgetcsv($file)) !== FALSE) {
            $ctr += 1;
                if ($ctr != 1) { 
                    if (strlen($line[0]) != 16) {
                        $invalid_card .= " Invalid Card Number: ".$line[0].'<br>';
                        $this->session->set_flashdata("error", $invalid_card);
                        $log .= "Invalid Card Number: ".$line[0]."\n";
                    } else {
                        /* IR39066 - Updated where clause */
                        $where = array( "LYCM_PanaloKardNo" => $line[1],
                                        "CDPM_CardType"     => "B",
                                        "Status"            => "2"
                                    );
                        $result = $this->CI->pkcd_model->get($where, $limit = 1, $order = 'Sequence', $by = 'DESC')->result_object();

                        /* IR38951 - addded error log */
                        if (!$result) {
                            $invalid_card .= " Please check status of this PanaloKardNo: ".$line[1].'<br>';
                            $this->session->set_flashdata("error", $invalid_card);
                            $log .= "No Record Found - Card Number: ".$line[0]." - PanaloKardNo :".$line[1]."\n";
                        } else {
                            $this->CI->db->trans_begin();
                            $this->CI->db->query("SET FOREIGN_KEY_CHECKS=0;");

                            $update_where = array("CardNo"        => $result[0]->CardNo,
                                                  "CDPM_CardType" => "B",
                                                  "Status"        => "2"
                                                );

                            $update_status = array( "Status"        => $status, 
                                                    "IssueDate"     => date('Y-m-d', strtotime($line[5])),
                                                    "IssueTime"     => date('H:i:s', strtotime($line[6])),
                                                    "UpdatedBy"     => $this->session->userdata("emp_no"),
                                                    "UpdatedBranch" => $this->session->userdata("cost_center"),
                                                    "UpdatedDate"   => date("Y-m-d H:i:s")
                                            );

                            $update_result = $this->CI->pkcd_model->edit($update_where, $update_status);

                            /* IR38951 - addded error log */
                            if (!$update_result) {
                                $log .= $this->db->_error_message()." ~ Card Number: ".$line[0]." - PanaloKardNo :".$line[1]."\n";
                            }

                            $this->CI->db->query("SET FOREIGN_KEY_CHECKS=1;");
                            if ($this->CI->db->trans_status() === FALSE) {
                                $this->CI->db->trans_rollback();
                                $this->session->set_flashdata("error", "Failed to Update Card: ".$line[0]);
                            } else {
                                $this->CI->db->trans_commit();
                                $this->session->set_flashdata("success", "Successfully uploaded!");
                            } 
                        }
                    }
                }
            }
            /* IR38951 - addded error log */
            $this->common_functions->write_log($log, "", "cif/printed");
            redirect(base_url().$this->module);
        }
    }
}