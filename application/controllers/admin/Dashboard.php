<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Admin_Controller
{
    public function __construct()
		{
      parent::__construct();
      $this->load->model("admin/Admin_dashboard_model", "dashboard");
		}
		
   
   public function index()
   {
       $data = array();
       $data['active'] = "dashboard";
       view('admin.dashboard',$data);

   }
 public function dashboard_v2()
   {
       $data = array();
       view('admin.dashboard',$data);

   }

}