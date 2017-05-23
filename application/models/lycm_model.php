<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+------------------------+------------------------------------------
 * Date       | Author                 | Revisions
 *------------+------------------------+------------------------------------------
 * 2017-05-16 | Rienny Jeneben Pascual | Initial Draft
 *------------+------------------------+------------------------------------------
 */

class Lycm_model extends MY_Model {

    public $table = "LYCM";

    public function __construct()
    {
        parent::__construct();
    }

    public function getName($where) {

        // $this->db->select('*');
        // $this->db->from($this->table);
        // $this->db->where("PK" => '123');
        // $query = $this->db->get($where);
  
        // $this->db->select('b.CustomerFName, b.CustomerLName');
        // $this->db->from('LYCM a');
        // $this->db->join('CUSM b', 'a.CUSM_CustomerNo = b.CustomerNo', 'INNER');
        // $this->db->where("PK"=>'123');
        // return $this->db->get();


    }

}