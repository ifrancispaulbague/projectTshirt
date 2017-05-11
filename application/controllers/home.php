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

class Home extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();
    }
	
	public function index()
	{
		// raffle draw
		// $this->load->model("prize_model");
		// $where = array("status"=>"A");
		// $prizes = $this->prize_model->get($where);
		// // var_dump($this->db->_error_number());
		// // var_dump($prizes->num_rows);
		// // var_dump($prizes->result_object());
		// // return;

		// $data["prizes"] = $prizes->result_object();
		// $this->main_html("home/index", $data);

		// -------------------------------------------------

		//
	}

	public function drawww()
	{
		$this->main_html("home/draw");
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */