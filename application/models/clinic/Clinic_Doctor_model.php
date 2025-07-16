<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic_Doctor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }


    public function get_doctors($clinic_id)
    {
       $this->db->where("doctor_clinic_id",$clinic_id);
       $doctors = $this->db->get("doctor")->result_array();  

       return $doctors;
    }



} 

?>

