<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_setting_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function update_option($key,$value,$doctor_id)
    {
       $option =  $this->db->get_where('doctor_meta', array('fkdoctor_id' => $doctor_id, 'key' => $key))->row_array();
       if($option)
       {
           $this->db->where("fkdoctor_id",$doctor_id);
           $this->db->where("key",$key);
           $this->db->update("doctor_meta",array(
               "value" => $value
           ));
       }
       else
       {
          $this->db->insert("doctor_meta",array(
              "fkdoctor_id" => $doctor_id,
              "key" => $key,
              "value" => $value
          ));
       }

    }

    public function add_quick_note($insertData)
    {
        $this->db->insert("quick_notes",$insertData);
    }

    public function update_quick_note($doctor_id,$updateData,$note_id)
    {
        $this->db->where("pk_note_id",$note_id);
        $this->db->where("doctor_id",$doctor_id);
        $this->db->update("quick_notes",$updateData);
    }

    public function get_note($note_id,$doctor_id)
    {
        $this->db->where("pk_note_id",$note_id);
        $this->db->where("doctor_id",$doctor_id);
        $values = $this->db->get("quick_notes")->row_array();
        return $values;
    }

    public function delete_quick_note($note_id)
    {
        $doctor_id = $this->session->userdata("id");
        
        $this->db->where("pk_note_id",$note_id);
        $this->db->where("doctor_id",$doctor_id);
        $this->db->delete("quick_notes");
    }

    public function get_settings($doctor_id)
    {
       $this->db->where("fkdoctor_id",$doctor_id);
        $settings_db = $this->db->get("doctor_meta")->result_array();

        $settings = array();
        if($settings_db){
            foreach($settings_db as $setting_db)
            {
                $settings[$setting_db['key']] = $setting_db['value'];

            }
        }


       return $settings;
    }


  
 } 

?>   