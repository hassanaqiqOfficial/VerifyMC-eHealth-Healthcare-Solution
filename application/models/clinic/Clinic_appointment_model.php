<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic_appointment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Doctor_model','doctor');
    
    }

    public function add_time_slot($data = array())
    {
        $this->db->insert("time_slots" , $data);
    }
    
    public function get_time_slot($day_type , $doctor_id = "")
    {
        if($doctor_id == "")
        {
            $doctor_id = $this->session->userdata('id');
        }

        $this->db->order_by("start_time","asc");
        $this->db->where("doctor_id",$doctor_id);
        $this->db->where("day_type",$day_type);
        $query = $this->db->get("time_slots");
        return $query->result_array(); 
   }

    public function delete_time_slot($slote_id = "")
    {
        $this->db->where("pkslotid",$slote_id);
        $this->db->delete("time_slots"); 
    }

    public function clear_time_slot($day_type = "")
    {
        $doctor_id = $this->session->userdata('id');
      
        $this->db->where("doctor_id" , $doctor_id);
        $this->db->where("day_type" , $day_type);
        $this->db->delete("time_slots"); 
    }
  
    public function get_availability($id)
    {
       $this->db->where("fkdoctor_id",$id);
       $this->db->where("key","Availability");
       $query = $this ->db->get("doctor_meta");
      
       if($query->num_rows() == 0)
       {
           return 0;
       }
       else
       {
           $result = $query->row_array();
           return $result["value"];
       }
    }

    public function save_availability($id)
    {
        $this->db->where("fkdoctor_id",$id);
        $this->db->where("key","Availability");
        $query = $this ->db->get("doctor_meta");
        if($query->num_rows() == 0)
        {
            $insert_arr = array(
                "fkdoctor_id" => $id,
                "key" => "Availability",
                "value" => $this->input->post('time_slot_manage')
            );
            $this->db->insert("doctor_meta", $insert_arr);
        }
        else
        {
            $insert_arr = array(
                "value" => $this->input->post('time_slot_manage')
            );
            $this->db->where("fkdoctor_id",$id);
            $this->db->where("key","Availability");
            $this->db->update("doctor_meta", $insert_arr);
        }
      }

    public function get_app_category($id="")
    {
     
     $doctor_id = $this->session->userdata('id');
     
         if($id != "")
         {
              $this->db->where('pk_app_categoryid',$id);
              $query = $this->db->get("app_category");
              return $result = $query->row_array();
         }

     }

    public function get_app_category_all($doctor_id="")
    {

      if(!empty($doctor_id))
      {
         $this->db->where('doctor_id',$doctor_id);
      }
     
         $query = $this->db->get("app_category");
         return $result = $query->result_array();
    }

    public function add_app_category($data)
    {
      $this->db->insert('app_category',$data);  
    }

    public function edit_app_category($id,$data)
    {
          $this->db->where("pk_app_categoryid",$id);
          $this->db->update('app_category',$data);
    } 

    public function delete_app_category($id)
    {
       $this->db->where('pk_app_categoryid',$id);
       $this->db->delete('app_category');
    }

    public function update_appointment_category()
    {
        $category_id = $this->input->post('category_id');
        $app_id = $this->input->post('appointment_id');
      
        $this->db->where("pk_appointment_id",$app_id);
        $this->db->update("appointment",array("fk_app_categoryid" => $category_id));
    }
        

    public function get_disable_day($doctor_id,$availibilty)
    {
      $slot_q = 'day_type = dayn'; 
     
      if($availibilty == 1)
      {
        $slot_q = 'day_type = -1 && DATE(appointment) = month_date';
      }

      $query = $this->db->query("SELECT appointment as blockdate ,
              COUNT(*) as totalapp , DAYNAME(appointment) as dayname , 
              ( WEEKDAY(appointment) +1 ) as dayn ,
              (select SUM(no_space) from time_slots where `doctor_id` = ".$doctor_id." && $slot_q ) as total_space 
              FROM `appointment` where  `doctor_id` = ".$doctor_id." && appointment.`status_appointment` != 'Cancel' 
              && appointment >= CURDATE()   
              GROUP BY DATE(appointment)  having  totalapp >= total_space");
              //echo $this->db->last_query(); exit;

      return $query->result_array();

     }

    public function get_enable_day($doctor_id)
    {
        $query = $this->db->query("SELECT * FROM `time_slots` WHERE `doctor_id` = ".$doctor_id." && `day_type` = -1 && manage_type = 1 GROUP BY month_date");
        return $query->result_array();
    }

    public function get_disable_days($doctor_id)
    {
        $query = $this->db->query("SELECT `day_type` as day FROM `time_slots` WHERE `doctor_id` = ".$doctor_id." && day_type != -1 GROUP BY day_type");
        $result = $query->result_array();
        
        $day = array();
        foreach($result as $result)
        {
            $day[] = $result['day'];
        }
        
        return $day;
    }

    public function get_time_slot_appointment($day_type,$doctor_id,$date_new)
    {
      $query = $this->db->query("
      SELECT *,
      (time_slots.no_space - 
      (SELECT COUNT(*) FROM appointment WHERE time_slots.pkslotid = appointment.fkslotid AND STR_TO_DATE(appointment.appointment,'%Y-%m-%d') = '". $date_new."' AND appointment.status_appointment != 'Cancel')
      ) as count_app 
      FROM `time_slots` WHERE doctor_id='".$doctor_id."' AND day_type = '".$day_type."'  ORDER BY `time_slots`.`start_time` ASC");
      
      return $query->result_array();
    }

    public function get_time_slot_month($doctor_id,$date_new)
    {
        $query = $this->db->query("
        SELECT *,
        (time_slots.no_space - 
        (SELECT COUNT(*) FROM appointment WHERE time_slots.pkslotid = appointment.fkslotid AND STR_TO_DATE(appointment.appointment,'%Y-%m-%d') = '". $date_new."' AND appointment.status_appointment != 'Cancel')
        ) as count_app 
        FROM `time_slots` WHERE doctor_id='".$doctor_id."' AND month_date = '".$date_new."' AND `day_type` = -1 AND manage_type = 1  ORDER BY `time_slots`.`start_time` ASC");
        
        return $query->result_array(); 
    }  
  
    public function get_timeslot_manage_type($doctor_id)
    {
        $this->db->where("fkdoctor_id",$doctor_id);
        $query = $this->db->get("doctor_meta");
        return $query->row_array();
    }

    public function add_appointment($doctor_id,$patient_id)
    {
        $post = $this->input->post();
        $datetime = $post['app_date'].' '.$post['app_time'];

        $add_arr = array(

            "fk_app_categoryid"    => $post['app_category'],
            "doctor_id"            => $doctor_id,
            "patient_id"           => $patient_id,
            "status_appointment"   => $post['app_status'],
            "appointment"          => date("Y-m-d H:i:s",strtotime($datetime)),
            "fkslotid"             => $post['fkslotid']

        );

        $this->db->insert("appointment",$add_arr);
        $appointment_id = $this->db->insert_id();
      
        return $appointment_id;
      
    }

    public function update_appointment($id,$doctor_id)
    {
      $post = $this->input->post();
      $datetime = $post['app_date'].' '.$post['app_time'];

      $update_arr = array(

          "fk_app_categoryid"    => $post['app_category'],
          "status_appointment"   => $post['app_status'],
          "appointment"          => date("Y-m-d H:i:s",strtotime($datetime)),
          "fkslotid"             => $post['fkslotid']

      );

        $this->db->where("pk_appointment_id",$id);
        $this->db->where("doctor_id",$doctor_id);
        $this->db->update("appointment",$update_arr);

    }

    public function appointment_scheduler($doctor_id,$patient_id,$appointment_id,$_type,$priority,$_send_to)
    {
            $post = $this->input->post();
            $datetime = $post['app_date'].' '.$post['app_time'];

            if(isset($post['patient_custom_schedule_hour']) && isset($post['patient_custom_schedule_min']))
            {
                $hours = $post['patient_custom_schedule_hour'];
                $minutes = $post['patient_custom_schedule_min'];
            }

            if(isset($post['physician_custom_schedule_hour']) && isset($post['physician_custom_schedule_min']))
            {
                $hours_str = $post['physician_custom_schedule_hour'];
                $minutes_str = $post['physician_custom_schedule_min'];
            }

            $date = "";
            
            if($priority === "Now")
            {
                $date = date("Y-m-d H:i:s");
            }
            elseif($priority === "24 Hour Prior")
            {
                $date = date("Y-m-d H:i:s",strtotime($datetime) - 60*60*24);
            }
            elseif($priority === "4 Hour Prior")
            {
                $date = date("Y-m-d H:i:s",strtotime($datetime) - 60*60*4);
            }
            elseif($priority === "patient custom schedule")
            {
               $sub_str = 60*60*$hours + 60*$minutes;
               $date = date("Y-m-d H:i:s",strtotime($datetime) - $sub_str);
            }
            elseif($priority === "physician custom schedule")
            {
                $sub_str_f = 60*60*$hours_str + 60*$minutes_str;
                $date = date("Y-m-d H:i:s",strtotime($datetime) - $sub_str_f);

            }

            $add_array = array(

              "fkdoctor_id"       => $doctor_id,
              "fkpatient_id"      => $patient_id,
              "fkappointment_id"  => $appointment_id,
              "type"              => $_type,
              "task"              => $priority,
              "status"            => 0,
              "send_to"           => $_send_to,
              "send_date"         => $date
            );

         $this->db->insert("scheduler_notifications",$add_array);

    }

    
    public function get_appointment($id,$doctor_id)
    {
       $this->db->where("pk_appointment_id",$id);
       $this->db->join("patient","appointment.patient_id = patient.patient_user_id","INNER");
       $this->db->where("doctor_id",$doctor_id);
       $result = $this->db->get("appointment")->row_array();

       return $result;

    }

    public function get_appointment_scheduled_notification($appointment_id)
    {
        $this->db->where("fkappointment_id",$appointment_id);
        $this->db->where("status",0);
        $result = $this->db->get("scheduler_notifications")->result_array();
        return $result;
    }

    public function delete_appointment_notification($id)
    {
       $this->db->where("pkscheduler_id",$id);
       $this->db->delete("scheduler_notifications");
    }

    public function delete_appointment($id)
    {
        $this->db->where("pk_appointment_id",$id);
        $this->db->delete("appointment");

        $this->db->where("fkappointment_id",$id);
        $this->db->delete("scheduler_notifications");
    }


}

?>   