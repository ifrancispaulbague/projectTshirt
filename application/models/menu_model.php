<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+----------------+------------------------------------------
 * Date       | Author         | Revisions
 *------------+----------------+------------------------------------------
 * 2017-03-31 | Analyn R. Sosa | Initial Draft
 *------------+----------------+------------------------------------------
 */

class Menu_model extends MY_Model {

    public $table = "menu";

    public function __construct()
    {
        parent::__construct();
    }
}