<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+------------------------+------------------------------------------
 * Date       | Author                 | Revisions
 *------------+------------------------+------------------------------------------
 * 2017-05-16 | Rienny Jeneben Pascual | Initial Draft
 *------------+------------------------+------------------------------------------
 */

class Draw_model extends MY_Model {

    public $table = "draw";

    public function __construct()
    {
        parent::__construct();
    }
}