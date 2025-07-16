<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 class Notification_model extends CI_Model
 {
    private $table;
    private $fkid;
    
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


   public function update_default_template($array,$task,$type)
   {
      $this->db->where("task",$task);
      $this->db->where("type",$type);
      $this->db->where("clinic_type",0);
      $this->db->update("default_email",$array); 
   } 

   public function insert($array)
   {
      $this->db->insert($this->table,$array);
   }

   public function update($id,$array)
   {
      $this->db->where($this->fkid,$id);
      $this->db->update($this->table,$array);
   }

   public function get_default_email_template($task,$type)
   {
      $this->db->where("task",$task);
      $this->db->where("type",$type);
      $this->db->where("clinic_type",0);
      $result = $this->db->get("default_email")->row_array(); 

      return $result;
   }

   public function get_custom_email($id)
   {
     $this->db->where($this->fkid,$id);
     $values = $this->db->get($this->table)->row_array();
     return $values;
   }

   public function delete($id)
   {
      $this->db->where($this->fkid,$id);
      $this->db->delete($this->table);
   }

}

?>

