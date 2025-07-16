<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_clinic_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_clinic()
    {
        $post = $this->input->post();
        $data['clinic_name'] = $post['name'];
        $data['clinic_email'] = $post['email'];
        $data['clinic_user_pass'] = sha1($post['password']);
        $data['clinic_status'] = $post['status'];
        $data['clinic_phone'] = $post['phone'];
        $data['clinic_website'] = $post['website'];
        $data['clinic_country'] = $post['country'];
        $data['clinic_state'] = $post['state'];
        $data['clinic_city'] = $post['city'];
        $data['clinic_address'] = $post['address'];
        $data['clinic_profile_info'] = $post['profile_info'];
        $data['clinic_timezone'] = $post['timezone'];
        $data['clinic_zip'] = $post['zip'];
        $data['clinic_controlled_license'] = $post['controlled_license'];
        $data['clinic_reg_no'] = $post['reg_no'];
        $data['clinic_date_added'] = gmdate('Y-m-d H:i:s');

        $this->db->insert("clinic", $data);
        $clinic_id = $this->db->insert_id();

        $clinic_id_dir = "uploads/clinic/clinic_" . md5($clinic_id);
        if (!is_dir($clinic_id_dir)) {
            mkdir($clinic_id_dir, 0777, true);
        }

    }

    public function edit_clinic($id)
    {


        $post = $this->input->post();
        if (isset($post['password']) && $post['password'] != "") {
            $data['clinic_user_pass'] = sha1($post['password']);
        }
        $data['clinic_name'] = $post['name'];
        $data['clinic_email'] = $post['email'];
        $data['clinic_status'] = $post['status'];
        $data['clinic_phone '] = $post['phone'];
        $data['clinic_website'] = $post['website'];
        $data['clinic_country'] = $post['country'];
        $data['clinic_state'] = $post['state'];
        $data['clinic_city'] = $post['city'];
        $data['clinic_address'] = $post['address'];
        $data['clinic_profile_info'] = $post['profile_info'];
        $data['clinic_timezone'] = $post['timezone'];
        $data['clinic_zip'] = $post['zip'];
        $data['clinic_controlled_license'] = $post['controlled_license'];
        $data['clinic_reg_no'] = $post['reg_no'];
        $data['clinic_date_update'] = gmdate('Y-m-d H:i:s');


        $this->db->where("clinic_user_id", $id);
        $this->db->update("clinic", $data);

        //$clinic_id = $this->db->insert_id();


        $clinic_id_dir = "uploads/clinic/clinic_" . md5($id);

    }

    public function delete_clinic($id)
    {
        $this->db->where("clinic_user_id", $id);
        $query = $this->db->delete("clinic");
        return $query;
    }

    public function get_single_clinic($clinic_id)
    {
        $this->db->where("clinic_user_id", $clinic_id);
        $query = $this->db->get("clinic");
        return $query->row_array();
    }

    public function get_clinics()
    {
        $query = $this->db->get("clinic");
        $result = $query->result_array();
        return $result;
    }

   
}

?>