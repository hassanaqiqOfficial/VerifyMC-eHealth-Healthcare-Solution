<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_chat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function getChat($patientID,$doctorID)
    {
        $this->db->where("patientID",$patientID);
        $this->db->where("doctorID",$doctorID);
        $result = $this->db->get("chats")->row_array();
        return $result;
    }

    public function getAllChats($data)
    {
        $this->db->select("chats.*,patient.patient_photo,patient.patient_fname,patient.patient_lname,");
        $this->db->from("chats");
        $this->db->where("chats.doctorID",$data['doctorID']);
        $this->db->join('patient',"chats.patientID = patient.patient_user_id",'INNER');
        
        $totalchats = $this->db->count_all_results('',false);
        
        $this->db->limit($data['limit']);
        $this->db->offset($data['offset']);

        $result = $this->db->get()->result_array();

        return [
            'totalChats' => $totalchats,
            'chats' => $result
        ];
    }
    
    public function getChatMessages($data)
    {
        $totalMessages = 0;
        $this->db->from("chatMessages");
        $this->db->where("chatID",$data['chatID']);
        
        $totalMessages = $this->db->count_all_results('',false);
        
        $this->db->limit($data['limit']);
        $this->db->offset($data['offset']);
        $result = $this->db->get()->result_array();
        
        return [
                'totalMessages' => $totalMessages,
                'Messages' => $result            
               ];
    }
}

?>