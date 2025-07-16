<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Account_model", "account");
    }

    function validateEmail($type = "")
    {
        $doctor_id = $this->input->post("user_id");

        if (!empty($_POST['email']) && $doctor_id != "" && $type == "clinic")
        {
            $email = $_POST['email'];
            $clinic_credential = array('clinic_email' => $email, 'clinic_user_id !=' => $doctor_id, "is_delete" => 0);
            $check_clinic = $this->db->get_where('clinic', $clinic_credential);

            $doctor_credential = array('doctor_email' => $email, "is_delete" => 0);
            $check_doctor = $this->db->get_where('doctor', $doctor_credential);

            if ($check_clinic->num_rows() == 0 && $check_doctor->num_rows() == 0)
            {
                echo "true";
            }
            else
            {
                echo "false"; //already registered
            }

        }
        elseif (!empty($_POST['email']) && $doctor_id != "" && $type == "doctor")
        {
            $email = $_POST['email'];
            $clinic_credential = array('clinic_email' => $email, "is_delete" => 0);
            $check_clinic = $this->db->get_where('clinic', $clinic_credential);

            $doctor_credential = array('doctor_email' => $email, 'doctor_user_id !=' => $doctor_id, "is_delete" => 0);
            $check_doctor = $this->db->get_where('doctor', $doctor_credential);

            if ($check_clinic->num_rows() == 0 && $check_doctor->num_rows() == 0)
            {
                echo "true";
            }
            else
            {
                echo "false"; //already registered
            }
        }
        elseif (!empty($_POST['email']) && $type == "patient")
        {
            $email = $_POST['email'];
            $clinic_credential = array('patient_email' => $email);
            $check_patient = $this->db->get_where('patient', $clinic_credential);

            
            if ( $check_patient->num_rows() == 0)
            {
                echo "true";
            }
            else
            {
                echo "false"; //already registered
            }
        }
        elseif (!empty($_POST['email']) && $doctor_id == "")
        {
            $email = $_POST['email'];
            $clinic_credential = array('clinic_email' => $email, "is_delete" => 0);
            $check_clinic = $this->db->get_where('clinic', $clinic_credential);

            $doctor_credential = array('doctor_email' => $email, "is_delete" => 0);
            $check_doctor = $this->db->get_where('doctor', $doctor_credential);

            if ($check_clinic->num_rows() == 0 && $check_doctor->num_rows() == 0)
            {
                echo "true";
            }
            else
            {
                echo "false"; //already registered
            }
        }
        else
        {
            echo "false"; //invalid post var
        }
    }
}


?>