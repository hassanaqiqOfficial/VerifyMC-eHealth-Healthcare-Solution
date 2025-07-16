<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Widget_model','widget');
        $this->load->model("doctor/Doctor_setting_model", "settings");
    }

    
    public function index($widget_id)
    {
        $data = array();
        $widget = $this->widget->get_widget($widget_id); 
        
        if($widget == ""){
           exit;
        }

        $data['steps'] = json_decode($widget['steps']);
        $istStep = $data['steps'][0];

        $lastStep = end($data['steps']); 
        $laststep = key($data['steps']);

        $data['widget_id'] = $widget_id;
        

        if($istStep)
        {
            switch ($istStep){

                case "Appointment":
                  $data['content'] = $this->appointment($widget['doctor_id'],$widget['pk_widget_id'],$laststep);
                break;
                case "Details":
                  $data['content'] = $this->details($widget['doctor_id'],$widget['pk_widget_id'],$laststep);  
                break;
                case "Payment":
                    $data['content'] = $this->payment();
                break; 
                case "Video":
                    $data['content'] = $this->video();
                break; 
                default :
                    $data['content'] = "Step Content is not Defined"; 
                
            }    
        }

        $data['title'] = $widget['title'];
        $data['doctor_id'] = $widget['doctor_id'];


        view('widget.widget',$data);
    }

    public function load_widgets_wizardSteps($id)
    {
        
        $currstep = $this->input->post("Currstep");
        $widget = $this->widget->get_widget($id); 
        
        if($widget == "")
        {
           exit;
        }

        $data['steps'] = json_decode($widget['steps']);
        $lastStep = end($data['steps']); 
        $laststep = key($data['steps']);

        $currstep = $currstep > $laststep ? "Success" : $data['steps'][$currstep];

        $stepsContent = '';
         
        switch ($currstep){

            case "Appointment":
             
                $stepsContent = $this->appointment($widget['doctor_id'],$widget['pk_widget_id'],$laststep);  
                
            break;
            
            case "Details":

                $stepsContent = $this->details($widget['doctor_id'],$widget['pk_widget_id'],$laststep);  

            break;

            case "Payment":

                $stepsContent = $this->payment();

            break; 
            
            case "Video":

                $stepsContent = $this->video();

            break; 
            
            case "Success":

                $stepsContent = $this->success($laststep);

            break;

            default :

                $stepsContent = "Step Content is not found."; 
            
        }

        echo $stepsContent;
    }

    protected function appointment($doctor_id,$widgetId,$laststep)
    {
        $data = array();
        
        $settings = $this->settings->get_settings($doctor_id);
        
        $settings_arr['date_selected_color'] = isset($settings['date_selected_color']) ? $settings['date_selected_color'] : '';
        $settings_arr['date_selected_text_color'] = isset($settings['date_selected_text_color']) ? $settings['date_selected_text_color'] : '';
        $settings_arr['date_selected_custom_text'] = isset($settings['date_selected_custom_text']) ? $settings['date_selected_custom_text'] : '';
        $settings_arr['date_available_color'] = isset($settings['date_available_color']) ? $settings['date_available_color'] : '';
        $settings_arr['date_available_text_color'] = isset($settings['date_available_text_color']) ? $settings['date_available_text_color'] : '';
        $settings_arr['date_available_custom_text'] = isset($settings['date_available_custom_text']) ? $settings['date_available_custom_text'] : '';        
        $settings_arr['calendar_color_all'] = isset($settings['calendar_color_all']) ? $settings['calendar_color_all'] : '';
        $settings_arr['calendar_text_color_all'] = isset($settings['calendar_text_color_all']) ? $settings['calendar_text_color_all'] : '';
        $settings_arr['calendar_text_custom_all'] = isset($settings['calendar_text_custom_all']) ? $settings['calendar_text_custom_all'] : '';
        
        // echo "<pre>";
        // print_r($settings_arr); exit;
        
        $data['disable_day'] = $this->widget->get_disable_day($doctor_id);
        $data['holidays'] = $this->widget->get_enabled_holidays($doctor_id); 
        $data['disable_days'] = $this->widget->get_disable_days($doctor_id);
        
        $data['widgetID'] = $widgetId;
        $data['lastindex'] = $laststep;
        $data['settings'] = $settings_arr;

        return $this->load->view("widget/widgetSteps/appointment",$data,true);

    }

    protected function details($doctor_id,$widgetId,$laststep)
    {
        $data = array();

        if($widgetId != "")
        {
           $widget_setting = $this->widget->get_widget_settings($doctor_id,$widgetId);
       
           //  echo "<pre>";
           //  print_r($widget_setting);
           //  echo "</pre>"; exit;

           if($widget_setting['custom_question_str'] != "")
           {
              $questions = array();
              $questions_serialize_str = json_decode($widget_setting['custom_question_str']);
              if($questions_serialize_str)
              {
                  foreach($questions_serialize_str as $value)
                  {
                      $questions[] = unserialize($value);
                  }
              }
              
             
            $data['settings'] = $widget_setting;
            $data['questions'] = $questions;
                
              
           }
           
        }
         
       
        $data['widgetID'] = $widgetId;
        $data['lastindex'] = $laststep;

        return $this->load->view("widget/widgetSteps/details",$data,true);

    }

    protected function payment()
    {
        $data = array();

        return $this->load->view("widget/widgetSteps/payment",$data,true);
    }

    protected function video()
    {
        $data = array();
        
        return $this->load->view("widget/widgetSteps/video",$data,true);
    }

    protected function success($laststep)
    {
        $data = array();
        $data['lastindex'] = $laststep;

        return $this->load->view("widget/widgetSteps/success",$data,true);
    }

    public function get_time_slot()
    {
        $widgetID = $this->input->post("widgetID");
        $widget = $this->widget->get_widget($widgetID);
        $doctor_id = $widget['doctor_id'];

        $date = $this->input->post("date_start");
        $day = date("D", strtotime($date));
        $date_new = date("Y-m-d", strtotime($date));


        
            if ($day == "Mon") {
                $day_data = $this->widget->get_time_slot_appointment(1, $doctor_id, $date_new);

            } elseif ($day == "Tue") {
                $day_data = $this->widget->get_time_slot_appointment(2, $doctor_id, $date_new);

            } elseif ($day == "Wed") {
                $day_data = $this->widget->get_time_slot_appointment(3, $doctor_id, $date_new);
            } elseif ($day == "Thu") {
                $day_data = $this->widget->get_time_slot_appointment(4, $doctor_id, $date_new);
            } elseif ($day == "Fri") {
                $day_data = $this->widget->get_time_slot_appointment(5, $doctor_id, $date_new);
            } elseif ($day == "Sat") {
                $day_data = $this->widget->get_time_slot_appointment(6, $doctor_id, $date_new);
            } elseif ($day == "Sun") {
                $day_data = $this->widget->get_time_slot_appointment(7, $doctor_id, $date_new);
            }

        $exist = false;
        $curr_time = date("H:i:00");
        $curr_date = date("Y-m-d");
        
        if($day_data){

            $counter = 0;
            foreach ($day_data as $data) {

                if ($curr_date == $date_new) {

                    if ($curr_time > $data["start_time"]) {
                        continue;
                    }
                }


                $class = 'btn-info book';

                if ($data["count_app"] > 0) {

                    if ($counter == 0) {
                        echo $html_head = '<div class="col-md-12"><span class="fw600 fs14">Available Appointment Times:&nbsp; <span class="fw400">' . date("M d, Y", strtotime($date)) . '</span></span><a class="remove_selected" data-class="btn ' . $class . '" style="float: right;font-size: 12px;color: #3bafda;
                   font-weight: 700;margin-right: 4px;padding-left: 7px;padding-right: 8px;padding-top: 2px;padding-bottom: 2px;cursor: pointer;text-decoration: none;">X Clear</a><hr style="margin-top: 5px;margin-bottom: 15px;"></div>';
                        $counter++;
                    }

                    $exist = true;

                    echo $html = '<div class="col-md-12">
                     <span class="fw600" style="color:black">' . date("h:i A", strtotime($data["start_time"])) . '-' . date("h:i A", strtotime($data["end_time"])) . '</span><a class="btn ' . $class . '" data-class="btn ' . $class . '" style="float:right; border-radius:5px;" 
                     data-time="' . date("h:i A", strtotime($data["start_time"])) . '-' . date("h:i A", strtotime($data["end_time"])) . '" 
                     data-hours="' . date("h", strtotime($data["start_time"])) . '" 
                     data-minutes="' . date("i", strtotime($data["start_time"])) . '" 
                     data-daynight="' . date("A", strtotime($data["start_time"])) . '"
                     data-pkslotid="' . $data["pkslotid"] . '"> Book Now </a><br /><span class="fw600" style="color: #8E8E8E;">' . $data["count_app"] . ' spaces available</span><hr style="margin-top: 15px;margin-bottom: 15px;"></div>';
                }

            }
        }

        if (!$exist) {
            echo $html_head = '<div class="col-md-12"><span class="fw600 fs14">No Appointments Slot Available on <span style="color:red;">' . date("M d, Y", strtotime($date)) . '</span></span><hr style="margin-top: 5px;margin-bottom: 15px;"><span class="fs12" style="font-weight: 700;">This day does not have any avaliable appointment slots set up for it.</span><br><a href="' . base_url("doctor/appointment/manage_availability/") . '" class="fs12" style="color:#3BAFDA;font-weight: 700;cursor:pointer;text-decoration:none;"> >&nbsp;Manage Availability Here</a></div>';
        }


    }

    public function user_authentication()
    {
      if($this->input->post())
      {
        $details = array();
        $patient = $this->widget->check_patient_user_pass($this->input->post('UserName'),$this->input->post('Pass'));
        //echo $this->db->last_query(); exit;
        
        if($patient)
        {
            $details = array(
          
                 "patientID" => $patient['patient_user_id'],
                 "patientPhoto" => $patient['patient_photo'],
                 "patientName" => $patient['patient_fname'].''.$patient['patient_lname'],
                 "patientEmail" => $patient['patient_email'],
                 "patientPhone" => $patient['patient_phone'],
                 "patientDob" => $patient['patient_dob'],
                 "error"  => false
            );
        }else{
            $details = array(
          
                "error"  => true
           );
        }

        echo json_encode($details);
     }  
        
    }

    public function widget_form_submit()
    {
       if($this->input->post())
       {
          $post = $this->input->post();
          $widgetId = $post["widgetID"];

          $widget = $this->widget->get_widget($widgetId);
          $steps = json_decode($widget['steps']);

          if($steps)
          {
             if(in_array("Details",$steps))
             {
                 
                $patient_type = $this->input->post("usertype");
                $patient_id = $this->input->post("patientID");
                
                if($patient_type == 0)
                {
                    $insert_arr = array();
                    $doctor_dir = "uploads/doctor/doctor_".md5($widget['doctor_id']);

                    $insert_arr = array(

                            "patient_fname" => $post['name'],
                            "patient_lname" => $post['lname'],
                            "patient_email" => $post['email'],
                            "patient_phone" => $post['phone'],
                            "patient_dob" => $post['date_of_birth'],
                            "patient_address1" => $post['address1'],
                            "patient_social_sec" => $post['social_security'],
                            "patient_weigth" => $post['weigth'],
                            "patient_height" => $post['height'],
                    );

                    $password = $this->widget->generateStrongPassword(12);
                    
                    $insert_arr['patient_user_pass'] = sha1($password);
                    $insert_arr['patient_user_name'] = $this->widget->generateStrongPassword(8 , '' , 'lud');

                    $insert_arr['is_email'] = isset($post['is_email']) && $post['is_email'] != "" ? $post['is_email'] : 0 ;
                    $insert_arr['is_sms'] = isset($post['is_sms']) && $post['is_sms'] != "" ? $post['is_sms'] : 0 ; 
                    
                    $patient_id = $this->widget->add_patient_appointment($widget['doctor_id'],$insert_arr);

                    
                    $patient_dir = $doctor_dir.'/'.md5($patient_id);
                    
                    if(!is_dir($patient_dir))
                    {
                        mkdir($patient_dir,0777,true);
                    }

                    $update_patient = array();
                    if(isset($post['patient_photo']) && $post['patient_photo'] != "")
                    {

                        if(copy("uploads/tmp/".$post['patient_photo'],$patient_dir.'/'.$post['patient_photo']))
                        {
                            unlink("uploads/tmp/".$post['patient_photo']);
                        }

                        $update_patient['patient_photo'] = $patient_dir.'/'.$post['patient_photo'];

                    }

                    if(isset($post['idcard_url_front']) && $post['idcard_url_front'] != "")
                    {

                        if(copy("uploads/tmp/".$post['idcard_url_front'],$patient_dir.'/'.$post['idcard_url_front']))
                        {
                            unlink("uploads/tmp/".$post['idcard_url_front']);
                        }

                        $update_patient['idcard_url_front'] = $patient_dir.'/'.$post['idcard_url_front'];
                    }

                    if(isset($post['idcard_url_back']) && $post['idcard_url_back'] != "")
                    {
                        if(copy("uploads/tmp/".$post['idcard_url_back'],$patient_dir.'/'.$post['idcard_url_back']))
                        {
                            unlink("uploads/tmp/".$post['idcard_url_back']);
                        }

                        $update_patient['idcard_url_back'] = $patient_dir.'/'.$post['idcard_url_back'];
                    }

                    if($update_patient)
                    {
                        $this->widget->update_patient_fields($patient_id,$update_patient);
                    }

                    if($_FILES && $_FILES['medical_record']["name"] != "")
                    {
                       $this->upload_patientfiles($patient_id,$widget['doctor_id'],1);
                    }

                    if($_FILES && $_FILES['proof_residency']["name"] != "")
                    {
                        $this->upload_patientfiles($patient_id,$widget['doctor_id'],2);
                    }

                   
                } 
                else 
                {
                    if ($post["email_exist"] != "" || $post["phone_exist"] != "")
                    {
                        if($post["email_exist"] != "")
                        {
                             $update_arr['patient_email'] = $post["email_exist"];
                        }
                        if($post["phone_exist"] != "")
                        {
                             $update_arr['patient_phone'] = $post["phone_exist"];
                        }

                        $this->widget->update_patient_fields($patient_id,$update_arr);
                    }
                }
             }

             if(in_array("Appointment",$steps))
             {
                $doctor = $this->widget->get_doctor($widget['doctor_id']);
                $doctor_timezone = $doctor['doctor_timezone']; 
                $appointment_id = $this->widget->add_appointment($widget['doctor_id'],$patient_id,$doctor_timezone);
             }

             if(in_array("Video",$steps))
             {

             }

             if(in_array("Payment",$steps))
             {

             } 

          }
       }
    }

    public function upload_patientfiles($patient_id,$doctor_id,$type)
    {
        $file = $type == 1 ? "medical_record" : "proof_residency";
        $doctor_dir = "uploads/doctor/doctor_" . md5($doctor_id);
        $patient_dir = $doctor_dir . '/' . md5($patient_id);
        $response = $this->upload_image($file,$patient_dir);


        if($response["error"] === 0)
        {
            $insert_data = array(
                "fkpatientid" => $patient_id,
                "name" => $response["upload_data"]["client_name"],
                "contenttype" => $response["upload_data"]["file_type"],
                "size" => $response["upload_data"]["file_size"],
                "dir_filename" => $response["upload_data"]["file_name"],
                "dir_url" => $patient_dir.'/'.$response["upload_data"]["file_name"],
                "type" => $type,
                "uploaded" => date("Y-m-d H:i:s"),
                "upload_by" => 0

            );
            $this->widget->patient_file_add($insert_data);
            return $this->output
                ->set_content_type('Content-Type: application/json')
                ->set_output(json_encode($response));
        }
        else
        {
            $this->output->set_status_header(400);
            return $this->output
                ->set_content_type('Content-Type: application/json')
                ->set_output(json_encode($response));
        }

    }

    
}


?>