<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function check_admin_user_pass($username, $pass)
    {
        $this->db->where('admin_user_name', $username);
        $this->db->where('admin_user_pass', sha1($pass));
        $query = $this->db->get('admin');

        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            return $result;
        }
        else
        {
            return;
        }
    }
    
    public function check_clinic_user_pass($username, $pass)
    {
        $this->db->where('clinic_email', $username);
        $this->db->where('clinic_user_pass', sha1($pass));
        $query = $this->db->get('clinic');
        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            return $result;
        }
        else
        {
            return;
        }
    }

    public function check_doctor_user_pass($username, $pass)
    {
        $this->db->where('doctor_email', $username);
        $this->db->where('doctor_user_pass', sha1($pass));
        $query = $this->db->get('doctor');

        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            return $result;
        }
        else
        {
            return;
        }
    }

    public function check_patient_user_pass($username, $pass)
    {
        $this->db->where('patient_user_name', $username);
        $this->db->where('patient_user_pass', sha1($pass));
        $query = $this->db->get('patient');
        
        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            return $result;
        }
        else
        {
            return;
        }

        // if ($query->num_rows() > 0) 
        // {
        //     $result = $query->row_array();
        //     $level = $result["user_level"];
           
        //     if ($level == 0) 
        //     {
        //         return $result;
        //     }
        //     elseif($level == 1) 
        //     {
        //         $user_id = $result["user_data_id"];
        //         $this->db->where('id', $user_id);
        //         $query = $this->db->get('staff');
        //         $staff_data = $query->row_array();
        //         if ($staff_data["user_banned"] == 1 || $staff_data["user_delete"] == 1) {
        //             return;
        //         }
        //         else {

        //             return $result;
        //         }
        //     }
        //     elseif ($level == 2) {
        //         $user_id = $result["user_data_id"];
        //         $this->db->where('id', $user_id);
        //         $query = $this->db->get('customers');
        //         $staff_data = $query->row_array();
        //         if ($staff_data["user_banned"] == 1 || $staff_data["user_delete"] == 1) {
        //             return;
        //         }
        //         else {

        //             return $result;
        //         }
        //     }
        // }
        // else {
        //     return;
        // }

    }

}