<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    private $pkid = "";
    private $fkid;
    private $table;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function get_pkid($pkid)
    {
        $this->pkid = $pkid;
    }
    
    public function get_fkid($fkid)
    {
        $this->fkid = $fkid;
    }
    
    public function get_table($table)
    {
        $this->table = $table;
    }

    public function get($id)
    {
      $this->db->where($this->fkid,$id);
      $query = $this->db->get($this->table);
      
      return $query->row_array();
    }

    public function update($id,$data,$files ="")
    {
        $this->db->where($this->fkid,$id);
        $this->db->update($this->table,$data);
        
        if(isset($post['patient_files']))
        {
            $this->db->where($this->fkid,$id);
            $this->db->update($this->table,$file_array);
        }
        
    }

    public function update_password($id,$password)
    {
        $this->db->where($this->fkid,$id);
        $this->db->update( $this->table,$password);   
    }


}

?>    
