<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic_Patient_model extends CI_Model
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

    public function edit_patient($data,$id,$doctor_id)
    {
        if($this->input->post())
        {
            $this->db->where("patient_user_id",$id);
            $this->db->update('patient',$data);

            $this->db->where("fkpatient_id",$id);
            $this->db->update("doctor_patient",array("fkdoctor_id" => $doctor_id));
        }

    }

    public function get_patient($id)
    {
        $this->db->join("doctor_patient","patient.patient_user_id = doctor_patient.fkpatient_id","INNER");
        $this->db->where("patient_user_id",$id);
        $result = $this->db->get("patient")->row_array();
        return $result;
    }

    public function delete_patient($id)
    {
        $this->db->where("patient_user_id",$id);
        $query = $this->db->delete("patient");

        $this->db->where("fkpatient_id",$id);
        $query = $this->db->delete("doctor_patient");

        return $query;
    }

    public function validate_username($username)
    {
       $this->db->where("patient_user_name",$username);
       $result = $this->db->get("patient")->row_array();
       return $result; 
    }

    public function add_patient_appointment()
    {

      $post = $this->input->post();
      $doctor_id = $this->session->userdata("id");
      $patient_type = $this->input->post("patient_type"); 
  
       if($patient_type == 0)
       {
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
            $data['patient_email'] = $post['optional_email'];
            $data['patient_phone'] = $post['phone'];
            $data['patient_lname'] = $post['lname'];
            
            $this->db->insert('patient', $data);
            $patient_id = $this->db->insert_id();
       } 
        
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

}

?>   