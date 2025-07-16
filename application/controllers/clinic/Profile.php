<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Clinic_Controller
{
    public function __construct()
	{
			parent::__construct();
            $this->load->library("session");
            $this->load->model("Profile_model","profile");
	}
		
    public function index()
    {
        $data = array();
        $id = $this->session->userdata("id");
        $this->profile->get_table("clinic");
        $this->profile->get_fkid("clinic_user_id");

        $data['clinic_data'] = $this->profile->get($id);
        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();
        
        if($this->input->post())
        {
            $post = $this->input->post();
           
            $update['clinic_name'] = $post['name'];
            $update['clinic_email'] = $post['email'];
            $update['clinic_status'] = $post['status'];
            $update['clinic_phone '] = $post['phone'];
            $update['clinic_website'] = $post['website'];
            $update['clinic_country'] = $post['country'];
            $update['clinic_state'] = $post['state'];
            $update['clinic_city'] = $post['city'];
            $update['clinic_address'] = $post['address'];
            $update['clinic_profile_info'] = $post['profile_info'];
            $update['clinic_timezone'] = $post['timezone'];
            $update['clinic_zip'] = $post['zip'];
            $update['clinic_controlled_license'] = $post['controlled_license'];
            $update['clinic_reg_no'] = $post['reg_no'];
            $update['clinic_date_update'] = gmdate('Y-m-d H:i:s');
             
            $this->profile->update($id,$update);
  
            $doctor_id_dir = "uploads/clinic/clinic_" . md5($id);
            if (!is_dir($doctor_id_dir)) 
            {
                mkdir($doctor_id_dir, 0777, true);
            }

            if (isset($post['patient_files']))
            {
                    
                $value = $post['patient_files'];
                if (copy("uploads/tmp/" . $value, $doctor_id_dir . '/' . $value))
                {
                    unlink("uploads/tmp/" . $value);
                    $file_array = array(
                        "doctor_image" => $doctor_id_dir . '/' . $value,
                    );
     
                    $this->profile->update($id,$file_array);
                }
             }

             $this->session->set_flashdata('success','Clinic Profile Has Been Updated Successfully.');
             redirect(base_url('clinic/profile/')); 
        }

        view('clinic.profile',$data);
    }

    public function update_password()
    {
        $data = array();
        $id = $this->session->userdata("id");
        $this->profile->get_table("clinic");
        $this->profile->get_fkid("clinic_user_id");
        
        if($this->input->post('password') && $this->input->post('password') != "")
        { 
            $password = $this->input->post('password');
            $password = sha1($password);
            
                $password_arr = array(
                    "clinic_user_pass" => $password
                );

            $this->profile->update_password($id,$password_arr);
            $this->session->set_flashdata('success', 'Account Password Has Been Changed Successfully.');
            redirect(base_url('clinic/profile/'));
        }

       view('clinic.profile',$data);
    }
 
 }
 
?>   