<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_chat_model extends CI_Model
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
    
    public function getChatMessages($data)
    {
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