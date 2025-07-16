<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widget_model extends CI_Model
{
   
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function get_widget($id)
    {
        $this->db->where("md5(pk_widget_id)",$id);
        $result = $this->db->get("widgets")->row_array();  
        return $result;
    }

    public function get_widget_settings($doctor_id,$widgetID)
    {
        $this->db->where("fk_widget_id",$widgetID);
        $this->db->where("doctor_id",$doctor_id);
        $results = $this->db->get("widget_meta")->result_array();

        $widget_settings = array();
        foreach($results as $result)
        {
            $widget_settings[$result['key']] = $result['value'];
        }
        return  $widget_settings;
    }

    public function get_disable_day($doctor_id)
    {
        $slot_q = 'day_type = dayn';

        $query = $this->db->query("SELECT appointment as blockdate ,
              COUNT(*) as totalapp , DAYNAME(appointment) as dayname , 
              ( WEEKDAY(appointment) +1 ) as dayn ,
              (select SUM(no_space) from time_slots where `doctor_id` = " . $doctor_id . " && $slot_q ) as total_space 
              FROM `appointment` where  `doctor_id` = " . $doctor_id . " && appointment.`status_appointment` != 'Cancel' 
              && appointment >= CURDATE()   
              GROUP BY DATE(appointment)  having  totalapp >= total_space");
        //echo $this->db->last_query(); exit;

        return $query->result_array();

    }

    public function get_enabled_holidays($doctor_id)
    {
        $this->db->where("doctor_id",$doctor_id);
        $holidays = $this->db->get("set_holiday")->result_array();  
        return $holidays;
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

    public function get_time_slot_appointment($day_type, $doctor_id, $date_new)
    {
        $query = $this->db->query("
      SELECT *,
      (time_slots.no_space - 
      (SELECT COUNT(*) FROM appointment WHERE time_slots.pkslotid = appointment.fkslotid AND STR_TO_DATE(appointment.appointment,'%Y-%m-%d') = '" . $date_new . "' AND appointment.status_appointment != 'Cancel')
      ) as count_app 
      FROM `time_slots` WHERE doctor_id='" . $doctor_id . "' AND day_type = '" . $day_type . "'  ORDER BY `time_slots`.`start_time` ASC");

        return $query->result_array();
    }

    public function get_app_category_all($doctor_id)
    {
        $this->db->where('doctor_id', $doctor_id);
        $query = $this->db->get("app_category");
        return $result = $query->result_array();
    }

    public function get_patient($id)
    {
        $this->db->where("patient_user_id",$id);
        $result = $this->db->get("patient")->row_array();
        return $result;
    }

    public function check_patient_user_pass($username,$pass)
    {
        $array = array("patient_email"=> $username,"patient_user_name"=>$username);  
        $this->db->group_start();
        $this->db->where("patient_user_pass",sha1($pass));
        $this->db->group_start();
        $this->db->or_where($array);  
        $this->db->group_end();
        $this->db->group_end();
        $result = $this->db->get('patient')->row_array();
        return $result;
    }

    public function add_patient_appointment($doctor_id,$data)
    {
            $post = $this->input->post();

            $this->db->insert('patient', $data);
            $patient_id = $this->db->insert_id();

            if($post['questions'])
            {
                foreach($post['questions'] as $question)
                {
                    $answers = $question['answer'];

                    if($question['type'] == 2)
                    {
                        $answers =  implode(",",$question['answer']);
                    }

                    $insert_arr = array("fk_patient_id" => $patient_id, "question" => $question['question'], "answer" => $answers, "type" => $question['type']);

                    $this->db->insert("patient_additional_questionair",$insert_arr);
                    
                }
            }
            
            $d = array("fkpatient_id" => $patient_id ,"fkdoctor_id" => $doctor_id);
            $this->db->insert('doctor_patient',$d);


        
      return $patient_id;

    }

    public function update_patient_fields($patient_id,$update_arr = array())
    {
        $this->db->where("patient_user_id", $patient_id);
        $this->db->update('patient', $update_arr);
    }

    public function patient_file_add($data)
    {
        $this->db->insert("patient_files",$data);
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

    public function add_appointment($doctor_id,$patient_id,$doctor_timezone)
    {
        $post = $this->input->post();
        
        $datetime = $post['app_date'] . ' ' . $post['app_time'];
        $appointmentDateTime = gmdate("Y-m-d H:i:s", strtotime($datetime));
        $gmtimezone = timeZoneConvert($appointmentDateTime,$doctor_timezone,'utc');
        
        $add_arr = array(
            "doctor_id" => $doctor_id,
            "patient_id" => $patient_id,
            "appointment" => $appointmentDateTime,
            "appointment_gmdate" => $gmtimezone,
            "status_appointment" => 0,
            "fkslotid" => $post['fkslotid']
        );

        $this->db->insert("appointment", $add_arr);
        $appointment_id = $this->db->insert_id();

        return $appointment_id;

    }

    public function get_doctor($doctor_id)
    {
        $this->db->where("doctor_user_id",$doctor_id);
        $result = $this->db->get("doctor")->row_array();
        return $result;
    }




}


?>
