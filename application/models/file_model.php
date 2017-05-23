<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+------------------------+------------------------------------------
 * Date       | Author                 | Revisions
 *------------+------------------------+------------------------------------------
 * 2017-05-23 | Analyn R. Sosa 		   | Initial Draft
 *------------+------------------------+------------------------------------------
 */

class File_model extends MY_Model {

    public $table = "files";

    public function __construct()
    {
        parent::__construct();
    }
}