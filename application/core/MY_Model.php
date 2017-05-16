<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->database();
        $this->CI->load->dbutil();
    }

    public function add($data)
    {
        return $this->CI->db->insert($this->table, $data);
    }

    public function add_batch($data)
    {
        return $this->CI->db->insert_batch($this->table, $data);
    }

    public function edit($where, $data)
    {
        $this->CI->db->where($where);
        return $this->CI->db->update($this->table, $data);
    }

    public function delete($where)
    {
        return $this->CI->db->delete($this->table, $where);
    }

    public function get($where, $limit = FALSE, $order = FALSE, $by = "ASC")
    {
        if($order !== FALSE)
            $this->CI->db->order_by($order,$by);
        if($limit !== FALSE)
            $this->CI->db->limit($limit);
        return $this->CI->db->get_where($this->table, $where);
    }

    public function all($limit = FALSE, $order = FALSE, $by = FALSE)
    {
        if($limit !== FALSE)
            $this->CI->db->limit($limit);
        if($order !== FALSE)
            $this->CI->db->order_by($order, $by);
        return $this->CI->db->get($this->table);
    }

    public function num_rows()
    {
        $result = $this->CI->db->get($this->table);
        return $result->num_rows;
    }

    public function get_paginate($where=FALSE, $limit=10, $offset=0, $order=FALSE, $by='DESC')
    {
        if($where !== FALSE)
            $this->CI->db->where($where);
        $this->db->limit($limit, $offset);
        if($order !== FALSE)
            $this->CI->db->order_by($order, $by);
        return $this->CI->db->get($this->table);
    }

}