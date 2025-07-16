<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor_widget_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
           $this->load->library('session');    
           $this->load->database();
    }

    public function add_widget($insert_arr)
    {
          $this->db->insert("widgets",$insert_arr);
          return $widget_id = $this->db->insert_id();
    }

    public function add_widget_settings($insert)
    {
        $this->db->insert("widget_meta",$insert);
    }

    public function edit_widget($id,$update_arr,$doctor_id)
    {
        $this->db->where("pk_widget_id",$id);
        $this->db->where("doctor_id",$doctor_id);
        $this->db->update("widgets",$update_arr);
    }

    public function get_widget($doctor_id,$widgetID)
    {
        $this->db->where("pk_widget_id",$widgetID);
        $this->db->where("doctor_id",$doctor_id);
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

    public function delete_widget($widgetID,$doctor_id)
    {
       $this->db->where("pk_widget_id",$widgetID);
       $this->db->where("doctor_id",$doctor_id);
       $this->db->delete("widgets");

       $this->db->where("fk_widget_id",$widgetID);
       $this->db->delete("widget_meta");
    }

    public function delete_widget_settings($widgetID)
    {
       $this->db->where("fk_widget_id",$widgetID);
       $this->db->delete("widget_meta");
    }

    public function get_next_incremented_id()
    {
       $next_increment_id = $this->db->query("SELECT widgets.AUTO_INCREMENT 
                                            FROM information_schema.TABLES widgets 
                                            WHERE widgets.TABLE_SCHEMA = 'app_telehealth' 
                                            AND widgets.TABLE_NAME = 'widgets';")->row_array();
      return $next_increment_id['AUTO_INCREMENT'];
    }

    
}

?>