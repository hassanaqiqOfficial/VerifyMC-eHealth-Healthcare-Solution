<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_Patient_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }


    public function add_patient($data,$id)
    {
        if($this->input->post())
        {
            $this->db->insert('patient',$data);
            $patient_id = $this->db->insert_id();
            
            $d = array("fkpatient_id" => $patient_id ,"fkdoctor_id" => $id);
            $this->db->insert('doctor_patient',$d);

        }

       return $patient_id; 

    }

    public function edit_patient($data,$id)
    {
        if($this->input->post())
        {
            $this->db->where("patient_user_id",$id);
            $this->db->update('patient',$data);
        }
    }

    public function get_patient($id)
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

    public function validate_username($username)
    {
       $this->db->where("patient_user_name",$username);
       $result = $this->db->get("patient")->row_array();
       return $result; 
    }

    public function search_patient($doctor_id,$values)
    {
   
      $array = array('patient_user_id' => $values, 'patient_fname' => $values, 'patient_mname' => $values , 'patient_lname' => $values , 'patient_email' => $values , 'patient_phone' => $values);
      $this->db->or_like($array);

      $this->db->join("doctor_patient","(doctor_patient.fkdoctor_id = $doctor_id AND doctor_patient.fkpatient_id = patient_user_id)","INNER");
      $this->db->select(array('patient_mname','patient_fname','patient_user_id','patient_lname','patient_email','patient_phone','CONCAT(patient_fname," ",patient_lname) as value'));
      $query = $this->db->get("patient");
      $result = $query->result_array(); 
      return $result;
    }

    public function add_patient_appointment()
    {

        $doctor_id = $this->session->userdata("id");  
        $post = $this->input->post();
     
            $password = $this->generateStrongPassword(12);
            $data['patient_user_pass'] = sha1($password);
            $username = $this->generateStrongPassword(8 , '' , 'lud');

            if(isset($post['is_email']) && $post['is_email'] != "")
            {
                $data['is_email']      = $post['is_email'];
            }
            if(isset($post['is_sms']) && $post['is_sms'] != "")
            {
                $data['is_sms']        = $post['is_sms'];
            }

            $data['patient_user_name'] = $username;
            $data['patient_fname'] = $post['name'];
            $data['patient_email'] = $post['email'];
            $data['patient_phone'] = $post['phone'];
            $data['patient_lname'] = $post['lname'];
            
            $this->db->insert('patient', $data);
            $patient_id = $this->db->insert_id();

            $d = array("fkpatient_id" => $patient_id ,"fkdoctor_id" => $doctor_id);
            $this->db->insert('doctor_patient',$d);
        
        return $patient_id;

    }

    public function update_patient_fields($patient_id,$update_arr = array())
    {
        $this->db->where("patient_user_id", $patient_id);
        $this->db->update('patient', $update_arr);
    }

    public function generateStrongPassword($length = 8, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if(!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    public function update_field($id,$key,$value)
    {
        $this->db->where("patient_user_id",$id);
        $data = array($key=>$value);
        $this->db->update('patient',$data);
    }

    public function get_field($id,$key)
    {
        $this->db->where("patient_user_id",$id);
        $result = $this->db->get('patient')->row_array();
        return $result[$key];
    }

    public function patient_file_add($data)
    {
        $this->db->insert("patient_files",$data);
    }

    public function update_patient_file($file_id,$field_arr)
    {
       $this->db->where("id",$file_id);
       $this->db->update("patient_files",$field_arr); 
    }

    public function delete_patient_file($file_id,$update_arr)
    {
        $this->db->where("id",$file_id);
        $this->db->update("patient_files",$update_arr);
    }

    public function getAllChats($doctorID)
    {
        $this->db->where("doctorID",$doctorID);
        $result = $this->db->get('chats');
        
        if($result->num_rows() > 0){
            return $result->result_array();
        }else{
            return false;
        }
    }

 }

?>   