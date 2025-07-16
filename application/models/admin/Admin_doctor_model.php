<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_doctor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_doctor()
    {
        $post = $this->input->post();
        $data['doctor_name'] = $post['name'];
        $data['doctor_email'] = $post['email'];
        $data['doctor_user_pass'] = sha1($post['password']);
        $data['doctor_status'] = $post['status'];
        $data['doctor_phone'] = $post['phone'];
        $data['doctor_clinic_id'] = $post['clinic'];
        $data['doctor_website'] = $post['website'];
        $data['doctor_country'] = $post['country'];
        $data['doctor_state'] = $post['state'];
        $data['doctor_city'] = $post['city'];
        $data['doctor_address'] = $post['address'];
        $data['doctor_timezone'] = $post['timezone'];
        $data['doctor_zip'] = $post['zip'];
        $data['doctor_controlled_license'] = $post['controlled_license'];
        $data['doctor_reg_no'] = $post['reg_no'];
        $data['doctor_profile_info'] = $post['profile_info'];
        $data['doctor_date_added'] = gmdate('Y-m-d H:i:s');

        $this->db->insert("doctor", $data);
        $doctor_id = $this->db->insert_id();

        $doctor_id_dir = "uploads/doctor/doctor_" . md5($doctor_id);
        if (!is_dir($doctor_id_dir)) {
            mkdir($doctor_id_dir, 0777, true);
        }


    }

    public function edit_doctor($id)
    {
        $post = $this->input->post();
        if (isset($post['password']) && $post['password'] != "") {
            $data['doctor_user_pass'] = sha1($post['password']);
        }
        $data['doctor_name'] = $post['name'];
        $data['doctor_email'] = $post['email'];
        $data['doctor_status'] = $post['status'];
        $data['doctor_phone '] = $post['phone'];
        $data['doctor_website'] = $post['website'];
        $data['doctor_country'] = $post['country'];
        $data['doctor_state'] = $post['state'];
        $data['doctor_city'] = $post['city'];
        $data['doctor_address'] = $post['address'];
        $data['doctor_profile_info'] = $post['profile_info'];
        $data['doctor_timezone'] = $post['timezone'];
        $data['doctor_zip'] = $post['zip'];
        $data['doctor_controlled_license'] = $post['controlled_license'];
        $data['doctor_reg_no'] = $post['reg_no'];
        $data['doctor_date_update'] = gmdate('Y-m-d H:i:s');


        $this->db->where("doctor_user_id", $id);
        $this->db->update("doctor", $data);

        //$clinic_id = $this->db->insert_id();


        $doctor_id_dir = "uploads/doctor/doctor_" . md5($id);
        if (!is_dir($doctor_id_dir)) {
            mkdir($doctor_id_dir, 0777, true);
        }


    }


    public function get_single_doctor($doctor_id)
    {
        $this->db->where("doctor_user_id", $doctor_id);
        $query = $this->db->get("doctor");

        return $query->row_array();
    }

    public function delete_doctor($id)
    {
        $this->db->where("doctor_user_id", $id);
        $query = $this->db->delete("doctor");
        return $query;
    }


}

?>