<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends MY_Doctor_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("doctor/Doctor_Patient_model", "patient");
        $this->load->model("doctor/Doctor_chat_model", "chat");
        $this->load->model("General_model","general");
    }

    public function index()
    {
        $data = array();
        $doctorID = $this->session->userdata("id");
       
        $this->general->fkid = 'doctor_user_id';
        $this->general->table = 'doctor';
        $data['doctor'] = $this->general->get($doctorID);

        
        $data['doctorID'] = $doctorID;
        $data['active'] = "invoices";
        $data['active_page'] = "invoices";

        view('doctor.chat.manage_chat', $data);
    }

    public function getDoctorChats(){
        
        header('Content-Type: application/json; charset=utf-8');

        if($_POST){

            $page = $_POST['page'];       
            $limit = 20;
            $offset = ($page-1)*$limit;
            
            $data = array(                          
                    'doctorID' => $_POST['doctorID'],
                    'limit' =>  $limit,
                    'offset' => $offset
            );

            $chatsData = $this->chat->getAllChats($data);
              
            if($chatsData['chats']){
                
                $totalPages = ceil($chatsData['totalChats']/$limit);
            
                $chatData = array(
                        'error' => false,
                        'page' => $page,
                        'totalPages' => $totalPages,
                        'totalChats' => $chatsData['totalChats'],
                        'Chats' => $chatsData['chats']
                );
            }
            else{
                $chatData = array(
                            'error' => true,
                            'message' => 'No messages has been found against chat'
                );
            }

            echo json_encode($chatData);  
        
        }
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