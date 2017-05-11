<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public $model = "prize_model";
    public $module = "main";
    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->main_html("homepage", null);
    }

    public function draw()
    {
        $this->main_html("draw", null);
    }
}