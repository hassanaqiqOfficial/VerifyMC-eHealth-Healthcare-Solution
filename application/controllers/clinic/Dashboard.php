<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Clinic_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
		
   
   public function index()
   {  
       $data = array();
       $data['active'] = "dashboard";
       view('clinic.dashboard',$data);
   }
 
}