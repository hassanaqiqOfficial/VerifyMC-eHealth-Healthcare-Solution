<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Doctor_Controller
{
    public function __construct()
		{
			parent::__construct();
			$this->load->helper('date');
		}


    public function index()
    {
        $data = array();
        $data["active"] = 'dashboard';
        
        view('doctor.dashboard',$data);
    }
 
}