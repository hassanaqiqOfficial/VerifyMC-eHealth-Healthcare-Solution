<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_users_Controller
{
    public function __construct()
	{
			parent::__construct();
            $this->load->library("session");
            $this->load->model("Profile_model","profile");
            $this->load->model('General_model','general');
	}
		
    public function index()
    {
        $data = array();
        $id = $this->session->userdata("id");
        $doctorID = $this->general->getPatientDoctor($id);

        $this->profile->get_table("patient");
        $this->profile->get_fkid("patient_user_id");
        
        if ($this->input->post()) 
        {
            $doctor_dir = "uploads/doctor/doctor_".md5($doctorID);  
            $post = $this->input->post();

            $is_email = 0;
            if(isset($post['is_email']) && $post['is_email'] != "")
            {
               $is_email = $post['is_email'];
            }

            $is_sms = 0;
            if(isset($post['is_sms']) && $post['is_sms'] != "")
            {
                $is_sms = $post['is_sms'];
            } 

            $update_arr = array(

                "patient_fname" => $post['fname'],
                "patient_mname" => $post['mname'],
                "patient_lname" => $post['lname'],
                "patient_email" => $post['email'],
                "patient_phone" => $post['phone'],
                "patient_dob" => $post['date_of_birth'],
                "patient_address1" => $post['address'],
                "patient_address2" => $post['address2'],
                "patient_country" => $post['country'],
                "patient_state" => $post['state'],
                "patient_city" => $post['city'],
                "patient_timezone" => $post['timezone'],
                "patient_zip" => $post['zip'],
                "patient_status" => $post['status'],
                "patient_social_sec" => $post['social_security'],
                "patient_init_visit" => $post['initial_visit'],
                "patient_weigth" => $post['weigth'],
                "patient_height" => $post['height'],
                //"patient_sex" => $post['sex'],
                "is_email" => 0,
                "is_sms"  => 0,
                //"patient_guardian" => $post['guardian']

            );

            $patient_dir = $doctor_dir.'/'.md5($id);
            if(!is_dir($patient_dir))
            {
                mkdir($patient_dir,0777,true);
            }
            
            if(isset($post['patient_files']) && $post['patient_files'] != "")
            {
                    if(copy("uploads/tmp/".$post['patient_files'],$patient_dir.'/'.$post['patient_files']))
                    {
                        @unlink("uploads/tmp/".$post['patient_files']);
                    }

                    $update_arr['patient_photo'] = $patient_dir.'/'.$post['patient_files'];
            }
            
            $this->profile->update($id,$update_arr);
            $this->session->set_flashdata('success', 'Patient profile has been updated successfully.');
            redirect(base_url("users/profile/"));
        }

        $data['patient'] = $this->profile->get($id);
        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();

        view('user.profile',$data);
    }

    public function update_password()
    {
        $data = array();
        $id = $this->session->userdata("id");
        $this->profile->get_table("patient");
        $this->profile->get_fkid("patient_user_id");
        
        if($this->input->post('password') && $this->input->post('password') != "")
        {  
            $password = $this->input->post('password');
            $password = sha1($password);
                
                $password_arr = array(
                    
                    "patient_user_pass" => $password
                
                );
            
            $this->profile->update_password($id,$password_arr);
            $this->session->set_flashdata('success', 'Account Password Has Been Changed Successfully.');
            redirect(base_url('users/profile/'));
        }

       view('user.profile',$data);
    }
 
 }
 
?>   