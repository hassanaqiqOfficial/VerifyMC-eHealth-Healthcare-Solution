<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor_notification_model extends CI_Model
{
    private $table;
    private $fkid = "ID";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }

    public function set_table($table)
    {
        $this->table = $table;
    }

    public function set_fkid($fkid)
    {
        $this->fkid = $fkid;
    }

    public function insert($array)
    {
        $this->db->insert($this->table, $array);
    }

    public function update($id, $array)
    {
        $this->db->where($this->fkid, $id);
        $this->db->update($this->table, $array);
    }

    public function delete($id)
    {
        $this->db->where($this->fkid, $id);
        $this->db->delete($this->table);
    }

    public function update_email_template($data, $doctor_id, $task, $type)
    {
        $option = $this->db->get_where('email_template', array('doctor_id' => $doctor_id, 'task' => $task, "type" => $type))->row_array();
        if ($option) {
            $this->db->where("doctor_id", $doctor_id);
            $this->db->where("task", $task);
            $this->db->where("type", $type);
            $this->db->update("email_template", $data);
        } else {
            $data["doctor_id"] = $doctor_id;
            $data["task"] = $task;
            $data["type"] = $type;
            $this->db->insert("email_template", $data);
        }
    }

    public function get_email_template($doctor_id, $task, $type)
    {
        $result = $this->db->get_where('email_template', array('doctor_id' => $doctor_id, 'task' => $task, "type" => $type))->row_array();
        return $result;

    }


    public function get_default_templates($type)
    {
        $this->db->select('default_email.*, email_template.is_notification');
        $this->db->from('default_email');
        $this->db->join('email_template','default_email.task = email_template.task AND default_email.type = email_template.type','left');
        
        if($type == "patient") 
        {
            $this->db->where("user_type", '2');
        } 
        else 
        {
            $this->db->where("user_type", '1');
        }

        $this->db->group_by("task");
        
        $result = $this->db->get()->result_array();
        return $result;

    }


    public function get_default_email_template($task, $type,$user_type)
    {
        $this->db->where("task", $task);
        $this->db->where("type", $type);
        $this->db->where("user_type", $user_type);
        $this->db->where("clinic_type", 0);
        $result = $this->db->get("default_email")->row_array();

        return $result;
    }

    public function get_custom_email($pkid,$doctor_id)
    {
        $this->db->where("ID", $pkid);
        $this->db->where("doctor_id", $doctor_id);
        $values = $this->db->get("custom_email_sms")->row_array();
        return $values;
    }
    public function add_custom_email($data)
    {
        $this->db->insert("custom_email_sms", $data);
    }

    public function update_custom_email($id,$doctor_id,$data)
    {
        $this->db->where("ID", $id);
        $this->db->where("doctor_id", $doctor_id);
        $this->db->update("custom_email_sms", $data);
    }


    public function get_custom_sms($pkid,$doctor_id)
    {
        $this->db->where("ID", $pkid);
        $this->db->where("doctor_id", $doctor_id);
        $values = $this->db->get("custom_email_sms")->row_array();
        return $values;
    }
    public function add_custom_sms($data)
    {
        $this->db->insert("custom_email_sms", $data);
    }

    public function update_custom_sms($pkid,$doctor_id,$update)
    {
        $this->db->where("ID", $pkid);
        $this->db->where("doctor_id", $doctor_id);
        $this->db->update("custom_email_sms", $update);
    }


    public function delete_custom_email_sms($pkid,$doctor_id,$type)
    {
        $this->db->where("ID", $pkid);
        $this->db->where("type", $type);
        $this->db->where("doctor_id", $doctor_id);
        $this->db->delete("custom_email_sms");
    }

}

?>

