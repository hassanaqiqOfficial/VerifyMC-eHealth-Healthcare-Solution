<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends MY_users_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user/Patient_chat_model','chat');
        $this->load->model('user/Patient_model','patient');
    
    }

    public function index()
    {
        $data = array();
        $patientID = $this->session->userdata("id");
        
        $data['doctor'] = $this->patient->getPatientDoctor($patientID);
        $data['patient'] = $this->patient->getPatient($patientID);
        
        $data['doctorID'] = $data['doctor']['doctor_user_id'];
        $data['patient_id'] = $patientID;

        $data['active'] = "invoices";
        $data['active_page'] = "invoices";

        view('user.chat.manage_chat', $data);
    }

    public function getChatMessages()
    {   
        header('Content-Type: application/json; charset=utf-8');

        if($_POST){

            $chat = $this->chat->getChat($_POST['patientID'],$_POST['doctorID']);

            if($chat)
            {   
                $page = $_POST['page'];       
                $limit = 200;
                $offset = ($page-1)*$limit;
                
                $data = array(                          
                     'chatID' => $chat['chatID'],
                     'limit' =>  $limit,
                     'offset' => $offset
                );

                $result = $this->chat->getChatMessages($data);

                if($result['Messages']){
                    
                    $totalPages = ceil($result['totalMessages']/$limit);
                
                    $messageData = array(
                            'error' => false,
                            'page' => $page,
                            'totalPages' => $totalPages,
                            'totalMessages' => $result['totalMessages'],
                            'Messages' => $result['Messages']
                    );
                }
                else{
                    $messageData = array(
                             'error' => true,
                             'message' => 'No messages has been found against chat'
                    );
                }

                echo json_encode($messageData);  
            }
        }
    }

    
}

?>