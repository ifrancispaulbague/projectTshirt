<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Session_model extends CI_Model{
       
	private $DB2;

    public function __construct()
    {
        parent::__construct();
    	$this->DB2 = $this->load->database('ucs_db', TRUE); 
    }

    public function save_session($username, $session, $user_type)
    {

		$data = array(
			'username' 	=> $username,
			'session' 	=> $session,
			'user_type' => $user_type,
			'date' 		=> date("Y-m-d")
		);

		$this->DB2->select('id');
        $this->DB2->from('user_session');
        $this->DB2->where('username', $username);
        $record = $this->DB2->get()->result_array();

        if (count($record) > 0)
        {        	
        	$this->DB2->where('id', $record[0]["id"]);
			$this->DB2->update('user_session', $data); 
        }
        else
        {
			$this->DB2->insert('user_session', $data); 
        }
    }

    public function check_session($username)
    {
		$this->DB2->select('session');
        $this->DB2->from('user_session');
        $this->DB2->where('username', $username);
        return $this->DB2->get()->result_array();
    }

}
