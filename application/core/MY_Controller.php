<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $title       = "USSC RAFFLE";
    public $template    = "template";
    public $model       = "";

    public function __construct()
    {
        /*
        ** Pre-load libraries and models
        */
        parent::__construct();
        $this->load->model($this->model);
        $this->load->library('session');
        $this->load->model('Useraccount_model');
        
    }

    public function main_html($content, $body_data, $script = "script")
    {
        $template_data["title"] = $this->title;
        $data['data'] = $body_data;
        $data = array(
                "html_header" =>  $this->load->view($this->template.'/header', $template_data, true),
                "html_menu" =>  $this->load->view($this->template.'/menu', $body_data, true),
                "html_body"   =>  $this->load->view($this->module."/".$content, $body_data, true),
                "html_footer" =>  $this->load->view($this->template.'/footer', null, true),
                "html_script" =>  $this->load->view($this->template."/".$script, null, true)
            );
        $this->load->view($this->template.'/index',$data);
    }
}