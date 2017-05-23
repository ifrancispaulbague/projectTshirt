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
        $this->db2 = $this->load->database("cif", TRUE);
    }

    public function getName($where_customer) {

        $this->db2->select('b.CustomerFName, b.CustomerLName');
        $this->db2->from('LYCM a');
        $this->db2->join('CUSM b', 'a.CUSM_CustomerNo = b.CustomerNo', 'INNER');
        $this->db2->where($where_customer);
        return $this->db2->get();

    }

}