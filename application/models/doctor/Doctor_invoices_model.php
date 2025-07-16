<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor_invoices_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function add_invoice($insert_arr)
    {
       $this->db->insert("invoices",$insert_arr);
       $invoice_id = $this->db->insert_id(); 

       return $invoice_id;
    }

    public function add_service_entries($insert_arr)
    {
       $this->db->insert("invoice_service_entries",$insert_arr);
    }

    public function get_invoice($invoice_id,$doctor_id)
    {
        $this->db->select("*");
        $this->db->select("invoices.date_created as invoiceDate");
        $this->db->select("invoices.fk_patient_id as patient_id");
       
        $this->db->join("payment","invoices.pk_invoice_id = payment.fk_invoice_id","LEFT");
        $this->db->join("patient","invoices.fk_patient_id = patient.patient_user_id","LEFT");
        
        $this->db->where("pk_invoice_id",$invoice_id);
        $this->db->where("doctor_id",$doctor_id);
        $result = $this->db->get("invoices")->row_array();
        return $result;
    }
    public function get_invoice_services($invoice_id)
    {
        $this->db->where("fk_invoice_id",$invoice_id);
        $result = $this->db->get("invoice_service_entries")->result_array();
        return $result;
    }

    public function delete_service_entries($invoice_id)
    {
        $this->db->where("fk_invoice_id",$invoice_id);
        $this->db->delete("invoice_service_entries");
    }

    public function update_invoice($update_arr,$invoice_id)
    {
      $this->db->where("pk_invoice_id",$invoice_id);
      $result = $this->db->update("invoices",$update_arr);
      return $result;
    }

    public function delete_invoice($invoice_id,$doctor_id)
    {
        $exist = $this->db->get_where("invoices",array("pk_invoice_id" => $invoice_id , "doctor_id" => $doctor_id))->row_array();
        
        if($exist)
        {
            $this->db->where("pk_invoice_id",$invoice_id);
            $this->db->where("doctor_id",$doctor_id);
            $this->db->update("invoices",array("is_delete" => 1));
            $return = true; 
        }
        else
        {
            $return = false; 
        }
        
        return $return;
    }

    public function get_nextIncrement_Id()
    {
       $result = $this->db->query('SELECT AUTO_INCREMENT
                          FROM information_schema.TABLES
                          WHERE TABLE_SCHEMA = "app_telehealth"
                          AND TABLE_NAME = "invoices" ')->row();

        return $result;                  
    }

    public function add_payment_entry($insert_arr)
    {
       $this->db->insert("payment",$insert_arr); 
       return $paymentID = $this->db->insert_id();
    }

    public function check_payment_history($invoice_id)
    {
        $this->db->where("fk_invoice_id",$invoice_id);
        $result = $this->db->get("payment")->row_array();
        return $result;
    }


}

?>