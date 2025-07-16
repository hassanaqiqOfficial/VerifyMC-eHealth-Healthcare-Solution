<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Doctor_Controller
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
        $this->profile->get_table("doctor");
        $this->profile->get_fkid("doctor_user_id");
        
        if($this->input->post())
        {
            $post = $this->input->post();
           
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
             
            $this->profile->update($id,$data);
  
            $doctor_id_dir = "uploads/doctor/doctor_" . md5($id);
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

             $this->session->set_flashdata('success','Doctor Profile Has Been Updated Successfully.');
             redirect(base_url('doctor/profile/')); 
        }

        $data['doctor_data'] = $this->profile->get($id);
        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();

        view('doctor.profile',$data);
    }

    public function update_password()
    {
        $data = array();
        $id = $this->session->userdata("id");
        $this->profile->get_table("doctor");
        $this->profile->get_fkid("doctor_user_id");
        
        if($this->input->post('password') && $this->input->post('password') != "")
        {  
            $password = $this->input->post('password');
            $password = sha1($password);
                
                $password_arr = array(
                    
                    "doctor_user_pass" => $password
                
                );
            
            $this->profile->update_password($id,$password_arr);
            $this->session->set_flashdata('success', 'Account Password Has Been Changed Successfully.');
            redirect(base_url('doctor/profile/'));
        }

       view('doctor.profile',$data);
    }
 
 }
 
?>   