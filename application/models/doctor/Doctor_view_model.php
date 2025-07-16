<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_view_model extends CI_Model
{
    private $table;
    private $fkid;
    private $pkid;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function get_table($table)
    {
        $this->table = $table;
    }

    public function get_fkid($fkid)
    {
        $this->fkid = $fkid;
    }

    public function get_pkid($pkid)
    {
        $this->pkid = $pkid;
    }

    public function get($id)
    {
        $this->db->where($this->fkid, $id);
        $result = $this->db->get($this->table)->row_array();
        return $result;
    }

    public function get_multiple($id)
    {
        $this->db->where($this->fkid, $id);
        $result = $this->db->get($this->table)->result_array();
        return $result;
    }

    public function get_quick_notes($doctor_id)
    {
        $this->db->where("doctor_id",$doctor_id);
        $notes = $this->db->get("quick_notes")->result_array();
        return $notes;
    }

    public function get_quick_note($doctor_id,$note_id)
    {
        $this->db->where("doctor_id",$doctor_id);
        $this->db->where("pk_note_id",$note_id);
        $notes = $this->db->get("quick_notes")->row_array();
        return $notes;
    }

    public function get_patient_note($patient_id,$note_id)
    {
        $doctor_id = $this->session->userdata("id");

        $this->db->where("fk_doctor_id",$doctor_id);
        $this->db->where("fk_patient_id",$patient_id);
        $this->db->where("pk_noteID",$note_id);

        $notes = $this->db->get("patient_notes")->row_array();
        return $notes;
    }

    public function add_note($insert_arr)
    {
       $this->db->insert("patient_notes",$insert_arr);
       return $ins = $this->db->insert_id();
    }

    public function update_note($noteID,$update_arr)
    {
        $this->db->where("pk_noteID",$noteID);
        $this->db->update("patient_notes",$update_arr);
    }

    public function delete_note($noteID)
    {
        $this->db->where("pk_noteID",$noteID);
        $this->db->delete("patient_notes");
    }

    public function get_custom_notifications($doctor_id,$type)
    {
       $this->db->where("doctor_id",$doctor_id);
       $this->db->where("type",$type);
       $result = $this->db->get('custom_email_sms')->result_array();
       return $result;
    }

    public function get_custom_notification($doctor_id,$pkid,$type)
    {
       $this->db->where("ID",$pkid);
       $this->db->where("type",$type);
       $this->db->where("doctor_id",$doctor_id);
       $result = $this->db->get('custom_email_sms')->row_array();
       return $result;
    }

    public function add_schedule_notification($insert)
    {
        $this->db->insert("custom_email_sms_scheduler",$insert);
    }

    public function update_schedule_notification($update,$schedulerID,$doctor_id)
    {
        $this->db->where("pk_scheduler_ID",$schedulerID);
        $this->db->where("fkdoctor_id",$doctor_id);
        $this->db->update("custom_email_sms_scheduler",$update);
    }

    public function get_scheduled_notification($doctor_id,$type,$pkid)
    {
        $this->db->where("pk_scheduler_ID",$pkid);
        $this->db->where("Notification_type",$type);
        $this->db->where("fkdoctor_id",$doctor_id);
        $result = $this->db->get('custom_email_sms_scheduler')->row_array();
        return $result;
    }

    public function get_default_email_notifications($type,$userType)
    {
        $this->db->where("type",$type);
        $this->db->where("user_type",$userType);
        $result = $this->db->get("default_email")->result_array();
        return $result;
    }

    public function get_notification($notificationID,$type,$doctor_id ="")
    {
       if($doctor_id != "")
       {
         $this->db->where("doctor_id",$doctor_id);
       }
       $this->db->where($this->pkid,$notificationID);
       $this->db->where("type",$type);
       $values = $this->db->get($this->table)->row_array();
       return $values; 
    }

    public function delete_notification($shedulerID,$type,$doctor_id)
    {
        $this->db->where("pk_scheduler_ID",$shedulerID);
        $this->db->where("fkdoctor_id",$doctor_id);
        $this->db->where("Notification_type",$type);
        $this->db->delete("custom_email_sms_scheduler");
        
    }

    


}
?>   