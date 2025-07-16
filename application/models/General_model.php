<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model
{
    public $fkid;
    public $table;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function insert($data)
    {
        $this->db->insert($this->table,$data);
    }

    public function update($id,$data,$files ="")
    {
        $this->db->where($this->fkid,$id);
        $this->db->update($this->table,$data);
    }

    public function delete($id)
    {
        $this->db->where($this->fkid,$id);
        $this->db->delete($this->table);
    }

    public function get($id)
    {
      $this->db->where($this->fkid,$id);
      $query = $this->db->get($this->table);
      
      return $query->row_array();
    }

    public function getAll()
    {
        $result = $this->db->get($this->table);
        if($result->num_rows() > 0){
            return $result->result_array();
        }else{
            return false;
        }
    }

}

?>    
