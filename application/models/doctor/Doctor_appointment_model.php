<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor_appointment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

    }

    public function add_time_slot($data = array())
    {
        $this->db->insert("time_slots", $data);
    }

    public function get_time_slot($day_type, $doctor_id = "")
    {
        if ($doctor_id == "") {
            $doctor_id = $this->session->userdata('id');
        }

        $this->db->order_by("start_time", "asc");
        $this->db->where("doctor_id", $doctor_id);
        $this->db->where("day_type", $day_type);
        $query = $this->db->get("time_slots");
        return $query->result_array();
    }

    public function delete_time_slot($slote_id = "")
    {
        $this->db->where("pkslotid", $slote_id);
        $this->db->delete("time_slots");
    }

    public function clear_time_slot($day_type = "")
    {
        $doctor_id = $this->session->userdata('id');

        $this->db->where("doctor_id", $doctor_id);
        $this->db->where("day_type", $day_type);
        $this->db->delete("time_slots");
    }

    public function add_app_category($insert_data)
    {
        $this->db->insert('app_category', $insert_data);
    }

    public function get_app_category($id = "")
    {
        if ($id != "") {
            $this->db->where('pk_app_categoryid', $id);
            $query = $this->db->get("app_category");
            return $result = $query->row_array();
        }
    }

    public function get_app_category_all($doctor_id = "")
    {
        if (!empty($doctor_id)) {
            $this->db->where('doctor_id', $doctor_id);
        }

        $query = $this->db->get("app_category");
        return $result = $query->result_array();
    }

    public function edit_app_category($id, $update_data)
    {
        $this->db->where("pk_app_categoryid", $id);
        $this->db->update('app_category', $update_data);
    }

    public function delete_app_category($id)
    {
        $this->db->where('pk_app_categoryid', $id);
        $this->db->delete('app_category');
    }

    public function update_appointment_category()
    {
        $category_id = $this->input->post('category_id');
        $app_id = $this->input->post('appointment_id');

        $this->db->where("pk_appointment_id", $app_id);
        $this->db->update("appointment", array("fk_app_categoryid" => $category_id));

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

    public function add_appointment($doctor_id, $patient_id)
    {
        $doctor_timezone = $this->session->userdata("timezone");

        $post = $this->input->post();
        $datetime = $post['app_date'] . ' ' . $post['app_time'];
        $appointmentDateTime = date("Y-m-d H:i:s", strtotime($datetime));
        $gmtimezone = timeZoneConvert($appointmentDateTime,$doctor_timezone,'utc');

        $add_arr = array(

            "fk_app_categoryid" => $post['app_category'],
            "fk_service_id" => $post['service'],
            "doctor_id" => $doctor_id,
            "patient_id" => $patient_id,
            "status_appointment" => $post['app_status'],
            "appointment" => $appointmentDateTime,
            "appointment_gmdate" => $gmtimezone,
            "fkslotid" => $post['fkslotid']

        );

        $this->db->insert("appointment", $add_arr);
        $appointment_id = $this->db->insert_id();

        return $appointment_id;

    }

    public function update_appointment($id, $doctor_id)
    {
        $doctor_timezone = $this->session->userdata("timezone");

        $post = $this->input->post();

        $datetime = $post['app_date'] . ' ' . $post['app_time'];
        $appointmentDateTime = date("Y-m-d H:i:s", strtotime($datetime));
        $gmtimezone = timeZoneConvert($appointmentDateTime,$doctor_timezone,'utc');

        $update_arr = array(

            "fk_app_categoryid" => $post['app_category'],
            "fk_service_id" => $post['service'],
            "status_appointment" => $post['app_status'],
            "appointment" => $appointmentDateTime,
            "appointment_gmdate" => $gmtimezone,
            "fkslotid" => $post['fkslotid']

        );

        $this->db->where("pk_appointment_id", $id);
        $this->db->where("doctor_id", $doctor_id);
        $this->db->update("appointment", $update_arr);

    }

    public function appointment_scheduler($doctor_id, $patient_id, $appointment_id, $_type, $priority, $_send_to)
    {
        $post = $this->input->post();
        $datetime = $post['app_date'] . ' ' . $post['app_time'];

        if (isset($post['patient_custom_schedule_hour']) && isset($post['patient_custom_schedule_min'])) {
            $hours = $post['patient_custom_schedule_hour'];
            $minutes = $post['patient_custom_schedule_min'];
        }

        if (isset($post['physician_custom_schedule_hour']) && isset($post['physician_custom_schedule_min'])) {
            $hours_str = $post['physician_custom_schedule_hour'];
            $minutes_str = $post['physician_custom_schedule_min'];
        }

        $date = "";

        if ($priority === "Now") {
            $date = date("Y-m-d H:i:s");
        } elseif ($priority === "24 Hour Prior") {
            $date = date("Y-m-d H:i:s", strtotime($datetime) - 60 * 60 * 24);
        } elseif ($priority === "4 Hour Prior") {
            $date = date("Y-m-d H:i:s", strtotime($datetime) - 60 * 60 * 4);
        } elseif ($priority === "patient custom schedule") {
            $sub_str = 60 * 60 * $hours + 60 * $minutes;
            $date = date("Y-m-d H:i:s", strtotime($datetime) - $sub_str);
        } elseif ($priority === "physician custom schedule") {
            $sub_str_f = 60 * 60 * $hours_str + 60 * $minutes_str;
            $date = date("Y-m-d H:i:s", strtotime($datetime) - $sub_str_f);

        }

        $add_array = array(

            "fkdoctor_id" => $doctor_id,
            "fkpatient_id" => $patient_id,
            "fkappointment_id" => $appointment_id,
            "type" => $_type,
            "task" => $priority,
            "status" => 0,
            "send_to" => $_send_to,
            "send_date" => $date
        );

        $this->db->insert("scheduler_notifications", $add_array);

    }


    public function get_appointment($id, $doctor_id)
    {
        $this->db->where("pk_appointment_id", $id);
        $this->db->join("patient", "appointment.patient_id = patient.patient_user_id", "INNER");
        $this->db->where("doctor_id", $doctor_id);
        $result = $this->db->get("appointment")->row_array();

        return $result;

    }

    public function get_appointment_scheduled_notification($appointment_id)
    {
        $this->db->where("fkappointment_id", $appointment_id);
        $this->db->where("status", 0);
        $result = $this->db->get("scheduler_notifications")->result_array();
        return $result;
    }

    public function delete_appointment_notification($id)
    {
        $this->db->where("pkscheduler_id", $id);
        $this->db->delete("scheduler_notifications");
    }

    public function update_appointment_fields($appointment_id,$data_arr)
    {
        $this->db->where("pk_appointment_id", $appointment_id);
        $this->db->update("appointment",$data_arr);
    }

    public function get_AllHoliday($doctor_id)
    {
        $this->db->select("*,DAY(holiday_date) day, MONTH(holiday_date) month, YEAR(holiday_date) year");
        $this->db->where("doctor_id", $doctor_id);
        $result = $this->db->get("set_holiday")->result_array();

        return $result;
    }

    public function get_holiday($doctor_id, $date)
    {
        $selectedDay = date("d", strtotime($date));
        $selectedMonth = date("m", strtotime($date));
        $selectedDate = date("Y-m-d", strtotime($date));

        $this->db->where("doctor_id", $doctor_id);
        $this->db->group_start();

        $this->db->group_start();
        $this->db->where("DAY(holiday_date)", $selectedDay);
        $this->db->where("MONTH(holiday_date)", $selectedMonth);
        $this->db->where("repeat_year", 1);
        $this->db->group_end();

        $this->db->or_group_start();
        $this->db->where("holiday_date", $selectedDate);
        $this->db->where("repeat_year", 0);
        $this->db->group_end();

        $this->db->group_end();

        $result = $this->db->get("set_holiday")->row_array();

        return $result;
    }

    public function set_holiday($insert)
    {
        $this->db->insert("set_holiday", $insert);
    }

    public function update_holiday($id, $update)
    {
        $this->db->where("pkid", $id);
        $this->db->update("set_holiday", $update);
    }

    public function delete_holiday($holiday_id)
    {
        $this->db->where("pkid", $holiday_id);
        $this->db->delete("set_holiday");
    }

    public function add_extra_service($data)
    {
        $this->db->insert('extra_services', $data);
        $extra_service_id = $this->db->insert_id();

        $services = $this->input->post('service');
        if($services != "")
        {
            foreach($services as $service)
            {
                $this->db->insert("extra_services_linking",array("fk_extra_service_id" => $extra_service_id,"fk_service_id" => $service));
            }
        }

    }

    public function get_extra_service($id)
    {
        $this->db->where("pk_extra_service_id",$id);
        $values = $this->db->get("extra_services")->row_array();

        return $values;
    }

    public function get_extra_service_linking($id)
    {
        $this->db->where("fk_extra_service_id",$id);
        $values = $this->db->get("extra_services_linking")->result_array();
        return $values;
    }

    public function edit_extra_service($id,$update_data)
    {
        $this->db->where("pk_extra_service_id", $id);
        $this->db->update('extra_services', $update_data);

        $this->db->where("fk_extra_service_id",$id);
        $this->db->delete("extra_services_linking");

        $services = $this->input->post('service');
        if($services != "")
        {
            foreach($services as $service)
            {
                $this->db->insert("extra_services_linking",array("fk_extra_service_id" => $id,"fk_service_id" => $service));
            }
        }


    }

    public function delete_extra_service($id)
    {
        $this->db->where("pk_extra_service_id",$id);
        $this->db->delete("extra_services");

        $this->db->where("fk_extra_service_id",$id);
        $this->db->delete("extra_services_linking");
    }


    public function add_service($insert_arr)
    {
        $this->db->insert("services",$insert_arr);
    }

    public function get_service($id)
    {
        $this->db->where("pk_service_id",$id);
        $values = $this->db->get("services")->row_array();
        return $values;
    }

    public function edit_service($id,$update_arr)
    {
        $this->db->where("pk_service_id",$id);
        $this->db->update('services',$update_arr);
    }

    public function delete_service($id)
    {
        $this->db->where("pk_service_id",$id);
        $this->db->delete("services");

        $this->db->where("fk_service_id",$id);
        $this->db->delete("extra_services_linking");
    }   

    public function get_services()
    {
       $values = $this->db->get("services")->result_array();
       return $values;
    }


}

?>   