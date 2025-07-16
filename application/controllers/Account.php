<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Account_model", "account");
    }

    public function index()
    {
        $data = array();
        $data["login_error"] = "";
        if ($this->session->userdata('login') == 'app_logged_in')
        {
            $level = $this->session->userdata('level');
            if ($level == 1 )
            {
                redirect(base_url("clinic"));
            }
            elseif ($level == 2)
            {
                redirect(base_url("doctor"));
            }
            elseif ($level == 3)
            {
                redirect(base_url("users"));
            }
        }

        if ($this->input->post()) 
        {
            $username = $this->input->post("login_string");
            $pass = $this->input->post("login_pass");
            
            if ($username != "" && $pass != "")
            {
                $login_check_clinic = $this->account->check_clinic_user_pass($username, $pass);
                
                if ($login_check_clinic != "")
                {
                    $user_data = array
                    (
                        'id' => $login_check_clinic["clinic_user_id"],
                        'timezone' => $login_check_clinic['clinic_timezone'],
                        'username' => $login_check_clinic['clinic_name'],
                        'image' => $login_check_clinic['clinic_logo'],
                        'level' => 1,
                        'login' => 'app_logged_in',
                    );
                    $this->session->set_userdata($user_data);
                    redirect(base_url("clinic"));
                }
                else
                {
                    $login_check_doctor = $this->account->check_doctor_user_pass($username, $pass);
                    
                    if ($login_check_doctor != "")
                    {
                        $user_data = array
                        (
                            'id'    =>   $login_check_doctor["doctor_user_id"],
                            'timezone' => $login_check_doctor['doctor_timezone'],
                            'username' => $login_check_doctor['doctor_name'],
                            'image' =>    $login_check_doctor['doctor_image'],
                            'level' => 2,
                            'login' => 'app_logged_in',
                            
                        );
                        $this->session->set_userdata($user_data);
                        redirect(base_url("doctor"));
                    }
                    else
                    {
                        $login_check_patient = $this->account->check_patient_user_pass($username, $pass);
                        
                        if ($login_check_patient != "")
                        {
                            $user_data = array
                            (
                                'id'    =>   $login_check_patient["patient_user_id"],
                                'timezone' => $login_check_patient['patient_timezone'],
                                'username' => $login_check_patient['patient_user_name'],
                                'image' =>    $login_check_patient['patient_photo'],
                                'level' => 3,
                                'login' => 'app_logged_in',
                                
                            );
                            $this->session->set_userdata($user_data);
                            redirect(base_url("users"));
                        }
                        else
                        {
                            $data["login_error"] = true;
                        }
                    }
                }
            }
        }
        view('login',$data);
    }

    public function admin()
    {
        $data = array();
        $data["login_error"] = false;

        if ($this->session->userdata('login') == 'app_logged_in')
        {
            redirect(base_url("admin/"));
        }

        if ($this->input->post()) 
        {
            $username = $this->input->post("login_string");
            $pass = $this->input->post("login_pass");

            if ($username != "" && $pass != "") 
            {
                $login_check = $this->account->check_admin_user_pass($username, $pass);
                
                if ($login_check != "") 
                {
                        $user_data = array(
                        'id' => $login_check["admin_user_id"],
                        'username' => $login_check["admin_user_name"],
                        'level' => 0,
                        'login' => 'app_logged_in',
                        'session_id' => session_id()
                    );
                    $this->session->set_userdata($user_data);
                    redirect(base_url("admin/"));
                } 
                else 
                {
                    $data["login_error"] = true;
                }
             }
         }
        view('login',$data);
    }

    public function logout()
    {
        session_destroy();
        redirect(base_url(),'refresh');
    }
}