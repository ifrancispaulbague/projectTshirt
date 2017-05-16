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
    }
}