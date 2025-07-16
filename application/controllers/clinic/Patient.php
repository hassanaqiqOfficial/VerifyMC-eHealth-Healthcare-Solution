<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends MY_Clinic_Controller
{
    public function __construct()
	{
			parent::__construct();
            $this->load->model("/clinic/Clinic_Patient_model", "patient");
            $this->load->model("/clinic/Clinic_Doctor_model", "doctor");
	}
		
   
    public function index()
    {
       $data = array();

       $data["active"] = 'patients';
       $data["active_page"] = 'patients';
       view('clinic.patient.manage',$data);
    }

    public function list_patient()
    {
        $admin_id = $this->session->userdata('id');
        $this->load->library('Datatable');

        
        $joinQuery = "";
        $extraWhere = "";

        
        $table      = 'patient';
        $primaryKey = 'patient_user_id';
        $columns    = array(

             array('db' => 'patient_photo', 'field' => 'patient_photo', 'formatter' => function ($d, $row) {
                if ($d == "") {
                    return '<img src="' . base_url("assets/img/placeholder.png") . '" style="width: 50px; height: 50px;border-radius: 150px;">';
                } else {
                   return '<img src="' . base_url($d) . '" style="width: 50px; height: 50px;border-radius: 150px;">';
                }

            }),

             array('db' => 'patient_fname', 'field' => 'patient_fname', 'formatter' => function( $d, $row ) {
                 return '<a href="'.base_url().'clinic/patient/edit/'.$row["patient_user_id"].'">'.$d.'</a>'; 
              }),
              array('db' => 'patient_email', 'field' => 'patient_email'),
              array('db' => 'patient_phone', 'field' => 'patient_phone'),
              array('db' => 'patient_init_visit', 'field' => 'patient_init_visit', 'formatter' => function ($d, $row) {
                return date("m/d/y", strtotime($d));
            }),
              array('db' => 'patient_status', 'field' => 'patient_status'),

              array('db'  => 'patient_user_id', 'field' => 'patient_user_id', 'formatter' => function( $d, $row ) {

                return  '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="'.base_url().'clinic/patient/edit/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this Patient?\',\''.base_url().'clinic/patient/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                            </div>
                            </div>
                         </div>';

              })
          );
        

        $c = array();
        foreach ($columns as $key => $value) 
        {
          $value["dt"] = $key;
          $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));
        
        //echo $this->datatable->sql;
     }

      public function add()
      {
        $data = array();
        $clinic_id = $this->session->userdata("id");

        if($this->input->post())
        {
          $post = $this->input->post();
          $doctor_id = $post['doctor_id'];
           
          $clinic_dir = 'uploads/clinic/clinic_'.md5($clinic_id);
          $doctor_dir = $clinic_dir.'/doctor_'.md5($doctor_id);
          

          $is_email = 0;
          if(isset($post["is_email"]) && $post["is_email"] != "")
          {
            $is_email = $post["is_email"];
          }

          $is_sms = 0;
          if(isset($post["is_sms"]) &&  $post["is_sms"] != "")
          {
            $is_sms = $post["is_sms"];
          }

          $insert_arr = array(

                  "patient_fname" => $post['fname'],
                  "patient_mname" => $post['mname'],
                  "patient_lname" => $post['lname'],
                  "patient_email" => $post['email'],
                  "patient_phone" => $post['phone'],
                  "patient_dob" => $post['date_of_birth'],
                  "patient_address1" => $post['address1'],
                  "patient_address2" => $post['address2'],
                  "patient_country" => $post['country'],
                  "patient_state" => $post['state'],
                  "patient_city" => $post['city'],
                  "patient_timezone" => $post['timezone'],
                  "patient_zip" => $post['zip'],
                  "patient_status" => $post['status'],
                  "patient_user_pass" => sha1($post['password']),
                  "patient_social_sec" => $post['social_security'],
                  "patient_init_visit" => $post['initial_visit'],
                  "patient_user_name" => $post['user_name'],
                  "patient_weigth" => $post['weigth'],
                  "patient_height" => $post['height'],
                  "patient_sex" => $post['sex'],
                  "is_email" => $is_email,
                  "is_sms"  => $is_sms,
                  "patient_guardian" => $post['guardian']
            
            );                   

        $patient_id = $this->patient->add_patient($insert_arr,$doctor_id);

        $patient_dir = $doctor_dir.'/'.md5($patient_id);
        if(!is_dir($patient_dir))
        {
            mkdir($patient_dir,0777,true);
        }

        $update_patient = array();
        if(isset($post['patient_photo']) && $post['patient_photo'] != "")
        {

            if(copy("uploads/tmp/".$post['patient_photo'],$patient_dir.'/'.$post['patient_photo']))
            {
                unlink("uploads/tmp/".$post['patient_photo']);
            }

            $update_patient['patient_photo'] = $patient_dir.'/'.$post['patient_photo'];

        }

        if(isset($post['idcard_url_front']) && $post['idcard_url_front'] != "")
        {

            if(copy("uploads/tmp/".$post['idcard_url_front'],$patient_dir.'/'.$post['idcard_url_front']))
            {
                unlink("uploads/tmp/".$post['idcard_url_front']);
            }

            $update_patient['idcard_url_front'] = $patient_dir.'/'.$post['idcard_url_front'];
        }

        if(isset($post['idcard_url_back']) && $post['idcard_url_back'] != "")
        {
            if(copy("uploads/tmp/".$post['idcard_url_back'],$patient_dir.'/'.$post['idcard_url_back']))
            {
                unlink("uploads/tmp/".$post['idcard_url_back']);
            }

            $update_patient['idcard_url_back'] = $patient_dir.'/'.$post['idcard_url_back'];
        }

        if($update_patient)
        {
          $this->patient->edit_patient($update_patient,$patient_id);
        }

        $this->session->set_flashdata('success','You have been Added Patient Successufully');
        redirect(base_url("clinic/patient/"));
       
       }


       $data['doctors'] = $this->doctor->get_doctors($clinic_id);
       $data['countries'] = $this->countries();
       $data['timezones'] = $this->timezone();

       $data["active"] = 'patients';
       $data["active_page"] = 'patients_add';
       
       view('clinic.patient.add',$data);
   

    }

    public function edit($id)
    {
        $data = array();
        $clinic_id = $this->session->userdata("id");
       
        if($this->input->post())
        {
          $post = $this->input->post();
          $doctor_id = $post['doctor_id'];
           
          $clinic_dir = 'uploads/clinic/clinic_'.md5($clinic_id);
          $doctor_dir = $clinic_dir.'/doctor_'.md5($doctor_id);
          

          $is_email = 0;
          if(isset($post["is_email"]) && $post["is_email"] != "")
          {
            $is_email = $post["is_email"];
          }

          $is_sms = 0;
          if(isset($post["is_sms"]) &&  $post["is_sms"] != "")
          {
            $is_sms = $post["is_sms"];
          }

          $update_arr = array(

                  "patient_fname" => $post['fname'],
                  "patient_mname" => $post['mname'],
                  "patient_lname" => $post['lname'],
                  "patient_email" => $post['email'],
                  "patient_phone" => $post['phone'],
                  "patient_dob" => $post['date_of_birth'],
                  "patient_address1" => $post['address1'],
                  "patient_address2" => $post['address2'],
                  "patient_country" => $post['country'],
                  "patient_state" => $post['state'],
                  "patient_city" => $post['city'],
                  "patient_timezone" => $post['timezone'],
                  "patient_zip" => $post['zip'],
                  "patient_status" => $post['status'],
                  "patient_user_pass" => sha1($post['password']),
                  "patient_social_sec" => $post['social_security'],
                  "patient_init_visit" => $post['initial_visit'],
                  "patient_user_name" => $post['user_name'],
                  "patient_weigth" => $post['weigth'],
                  "patient_height" => $post['height'],
                  "patient_sex" => $post['sex'],
                  "is_email" => $is_email,
                  "is_sms"  => $is_sms,
                  "patient_guardian" => $post['guardian']
            
            );

            $patient_dir = $doctor_dir.'/'.md5($id);
            
            if(!is_dir($patient_dir))
            {
                mkdir($patient_dir,0777,true);
            }

            if(isset($post['patient_photo']) && $post['patient_photo'] != "")
            {
                if($post['patient_photo'] == "delete")
                {
                    $update_arr['patient_photo'] = '';
                    unlink($post['patient_photo_old']);
                }
                else
                {

                    if(copy("uploads/tmp/".$post['patient_photo'],$patient_dir.'/'.$post['patient_photo']))
                    {
                        @unlink("uploads/tmp/".$post['patient_photo']);
                    }

                    $update_arr['patient_photo'] = $patient_dir.'/'.$post['patient_photo'];
                }
            }
            
            if(isset($post['idcard_url_front']) && $post['idcard_url_front'] != "")
            { 

                if($post['idcard_url_front'] == "delete")
                {
                    $update_arr['idcard_url_front'] = '';
                    unlink($post['idcard_url_front_old']);
                }
                else
                {

                    if(copy("uploads/tmp/".$post['idcard_url_front'],$patient_dir.'/'.$post['idcard_url_front']))
                    {
                        unlink("uploads/tmp/".$post['idcard_url_front']);
                    }

                    $update_arr['idcard_url_front'] = $patient_dir.'/'.$post['idcard_url_front'];
                }
              
              
            }
           
            if(isset($post['idcard_url_back']) && $post['idcard_url_back'] != "")
            {
                if($post['idcard_url_back'] == "delete")
                {
                    $update_arr['idcard_url_back'] = '';
                    unlink($post['idcard_url_back_old']);
                }
                else
                {
                    if(copy("uploads/tmp/".$post['idcard_url_back'],$patient_dir.'/'.$post['idcard_url_back']))
                    {
                        unlink("uploads/tmp/".$post['idcard_url_back']);
                    }

                    $update_arr['idcard_url_back'] = $patient_dir.'/'.$post['idcard_url_back'];
                }
            }  
        
        
      if(isset($post['password']) && $post['password'] != "")
      { 
        $update_arr['patient_user_pass'] = sha1($post['password']);
      }              

      $this->patient->edit_patient($update_arr,$id,$doctor_id);
      $this->session->set_flashdata('success','You have been Edited Patient Successufully');
      redirect(base_url("clinic/patient/"));
       
    }
       $data['doctors'] = $this->doctor->get_doctors($clinic_id);
       $data['patient'] = $this->patient->get_patient($id);
       $data['countries'] = $this->countries();
       $data['timezones'] = $this->timezone();

       $data["active"] = 'patients';
       $data["active_page"] = 'patients';
       view('clinic.patient.edit',$data);
    }

    public function delete($id)
    {
        
       $this->patient->delete_patient($id);
       $this->session->set_flashdata('success','You have been deleted patient Successfully');
       redirect(base_url("clinic/patient/"));

       $data = array();
       view('clinic.patient.manage',$data);
    }

    public function search_patient()
    {
       $doctor_id = $this->input->post('doctor_id');  
       $values = $this->input->post('p');
       $clinic_id = $this->session->userdata("id");
       
       $patients = $this->patient->search_patient($doctor_id,$values);
       
       echo json_encode($patients); 
        
    }


  }
  
?>     