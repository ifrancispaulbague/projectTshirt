<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Revisions
 *------------------------------------------------------------------
 * Date       | Author                 | Revisions
 *------------------------------------------------------------------
 * 2017-03-30 | Analyn R. Sosa         | Initial Draft
 *------------------------------------------------------------------
 *
 */

class MY_Controller extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
    }    

    public function main_html($url, $html_data = null)
    {
        try{

            // $this->load->model("menu_model");
            // $menu = $this->menu_model->all();
            
            // if ($this->db->_error_message()) {
            //     err_log($this->db->_error_message());
            //     echo ERR0001;
            //     return;
            // }
           
            $data['html_header'] = $this->load->view('main_templates/header', null, true);
            $data['html_menu']   = $this->load->view('main_templates/menu', null, true);
            $data['html_body']   = $this->load->view($url, $html_data, true);
            $data['html_footer'] = $this->load->view('main_templates/footer', null, true);
            $data['html_script'] = $this->load->view('main_templates/script', null, true);

            $this->load->view('main_templates/index', $data);

        }catch(Exception $e){
            echo "Caught exception: " . $e->getMessage() . "\n";
        }
    }
}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */