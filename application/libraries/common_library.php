<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Revisions
 *------------------------------------------------------------------
 * Date       | Author                 | Revisions
 *------------------------------------------------------------------
 *
 */

class Common_library{
        
    private $CI;
    
    function __construct()
    {
        $this->CI =& get_instance();
    }

    public function check_session()
    {
        if (! $this->CI->session->userdata('emp_no'))
        {
            $this->CI->session->sess_destroy();
            return FALSE;
        }
        $this->CI->load->model("session_model");
        $data = $this->CI->session_model->check_session($this->CI->session->userdata('emp_no'));
        if($data[0]["session"] != $this->CI->session->userdata('rfs_session'))
        {
            $this->CI->session->sess_destroy();
            return FALSE;
        }
        return TRUE;
    }
}