<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function getPatient($id)
    {
        $this->db->where("patient_user_id",$id);
        $result = $this->db->get("patient")->row_array();
        return $result;
    }

    public function getAllPatients($doctorID)
    {
        $this->db->select('patient.*,doctor_patient.fkdoctor_id as doctor_id');
        $this->db->join("doctor_patient","patient.patient_user_id = doctor_patient.fkpatient_id",'INNER');
        $this->db->join("doctor","doctor_patient.fkdoctor_id = doctor.doctor_user_id",'INNER');
        $this->db->where("doctor_user_id",$doctorID);
        $result = $this->db->get('patient');
        
        if($result->num_rows() > 0){
            return $result->result_array();
        }else{
            return false;
        }
    }

    public function getPatientDoctor($patientID)
    {
        $this->db->select('doctor.*');
        $this->db->where("patient_user_id",$patientID);
        $this->db->join("doctor_patient","patient.patient_user_id = doctor_patient.fkpatient_id",'INNER');
        $this->db->join("doctor","doctor_patient.fkdoctor_id = doctor.doctor_user_id",'INNER');
        $result = $this->db->get('patient');
        
        if($result->num_rows() > 0){
            return $result->row_array();
        }else{
            return false;
        }
    }

 }

?>   