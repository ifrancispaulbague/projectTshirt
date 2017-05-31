<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+------------------------+------------------------------------------
 * Date       | Author                 | Revisions
 *------------+------------------------+------------------------------------------
 * 2017-05-15 | Rienny Jeneben Pascual | Initial Draft
 *------------+------------------------+------------------------------------------
 */

class Entry_model extends MY_Model {

    public $table = "entry";

    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database("raffle", TRUE);
    }

    public function getPrizeMinor($where) {

        $this->db3->select('a.*, b.prize_name, b.prize_id');
        $this->db3->from('entry a');
        $this->db3->join('prize b', 'a.minor_prize = b.prize_id', 'INNER');
        $this->db3->where($where);
        return $this->db3->get();

    }

    public function getPrizeMajor($where) {

        $this->db3->select('a.*, b.prize_name, b.prize_id');
        $this->db3->from('entry a');
        $this->db3->join('prize b', 'a.major_prize = b.prize_id', 'INNER');
        $this->db3->where($where);
        return $this->db3->get();

    }
}