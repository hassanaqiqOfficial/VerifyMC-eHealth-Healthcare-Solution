<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patients extends MY_Doctor_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("doctor/Doctor_Patient_model", "patient");
        $this->load->library('session');
    }

    public function index()
    {
    }

    public function manage($type = 3)
    {
        $data = array();
        $data["active"] = 'patients';
        
        if($type == 3)
        {
            $data["active_page"] = 'patients';
            $data['title'] = "All Patients";
            $data['type'] = $type;
            $data['where'] = 'patient.is_deleted = 0';
        }
        elseif($type == 0)
        {
            $data["active_page"] = 'pending';
            $data['title'] = "Pending Patients";
            $data['type'] = $type;
            $data['where'] = 'patient.is_deleted = 0 && patient.patient_status = 2';
        }
        elseif($type == 1)
        {
            $data["active_page"] = 'approved';
            $data['title'] = "Approved Patients";
            $data['type'] = $type;
            $data['where'] = 'patient.is_deleted = 0 && patient.patient_status = 0';          
        }
        elseif($type == 2)
        {
            $data["active_page"] = 'unapproved';
            $data['title'] = "Unapproved Patients";
            $data['type'] = $type;
            $data['where'] = 'patient.is_deleted = 0 && patient.patient_status = 1';
        }
        elseif($type == 4)
        {
            $data["active_page"] = 'deleted';
            $data['title'] = "Deleted Patients";
            $data['type'] = $type;
            $data['where'] = 'patient.is_deleted = 1';
        }
        
        
        view('doctor.patient.manage', $data);
    }

    public function add()
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");
       
        if ($this->input->post()) {
            
            $doctor_dir = "uploads/doctor/doctor_".md5($doctor_id);    
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

            $patient_id = $this->patient->add_patient($insert_arr, $doctor_id);

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

            $this->session->set_flashdata('success','You have been Added Patient Successfully');
            redirect(base_url("doctor/patients/manage/3"));

        }

        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();

        $data["active"] = 'patients';
        $data["active_page"] = 'patients_add';

        view('doctor.patient.add', $data);
    }

    public function edit($id)
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");   

        if ($this->input->post()) 
        {
            $user_dir = "uploads/doctor/doctor_".md5($doctor_id);  
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
                "patient_address1" => $post['address1'],
                "patient_address2" => $post['address2'],
                "patient_country" => $post['country'],
                "patient_state" => $post['state'],
                "patient_city" => $post['city'],
                "patient_timezone" => $post['timezone'],
                "patient_zip" => $post['zip'],
                "patient_status" => $post['status'],
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

            $patient_dir = $user_dir.'/'.md5($id);
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


            
            if (isset($post['password']) && $post['password'] != "") 
            {
                $update_arr['patient_user_pass'] = sha1($post['password']);
            }

            $this->patient->edit_patient($update_arr,$id);
            $this->session->set_flashdata('success', 'You have been Edited Patient Successufully');
            redirect(base_url("doctor/patients/manage/3"));

        }


        $data['patient'] = $this->patient->get_patient($id);
        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();
        $data["active"] = 'patients';
        $data["active_page"] = 'patients';

        view('doctor.patient.edit', $data);
    }

    public function delete($patient_id)
    {
        $this->patient->update_patient_fields($patient_id,array("is_deleted" => 1));
        $this->session->set_flashdata('success', 'You have been deleted patient Successfully');
        redirect(base_url("doctor/patients/manage/3"));
    }

    public function restore($patient_id)
    {
        $this->patient->update_patient_fields($patient_id,array("is_deleted" => 0));
        $this->session->set_flashdata('success', 'You have been restored patient Successfully');
        redirect(base_url("doctor/patients/manage/4"));
    }

    public function list_patient()
    {
        $this->load->library('Datatable');

        $doctor_id = $this->session->userdata('id');
        
        $Where = "";
        if (isset($_POST["extra_where"]) && $_POST["extra_where"] != "") {
            $Where .= $_POST["extra_where"];
        }
        
        $joinQuery =  "FROM patient INNER JOIN doctor_patient ON(patient.patient_user_id = doctor_patient.fkpatient_id) WHERE $Where && doctor_patient.fkdoctor_id = $doctor_id";
        $extraWhere = "";

        $table = 'patient';
        $primaryKey = 'patient_user_id';
        $columns = array(
            array('db' => 'patient_photo', 'field' => 'patient_photo', 'formatter' => function ($d, $row) {
                if ($d == "") {
                    return '<img src="' . base_url("assets/img/placeholder.png") . '" style="width: 50px; height: 50px;border-radius: 150px;">';
                } else {
                   return '<img src="' . base_url($d) . '" style="width: 50px; height: 50px;border-radius: 150px;">';
                }

            }),

            array('db' => 'patient_user_id', 'field' => 'patient_user_id','formatter' => function($d){
                   
                 return "MRN 00".$d;

            }),
            array('db' => 'patient_fname', 'field' => 'patient_fname', 'formatter' => function ($d, $row) {
                return '<a href="' . base_url() . 'doctor/view/index/' . $row["patient_user_id"] . '">' . $d . '</a>';
            }),
            array('db' => 'patient_email', 'field' => 'patient_email'),
            
            array('db' => 'patient_init_visit', 'field' => 'patient_init_visit', 'formatter' => function ($d, $row) {
                return date("m/d/y", strtotime($d));
            }),
            array('db' => 'patient_status', 'field' => 'patient_status',"formatter" => function($d,$row){
                
                $status = '';

                if($d == 1)
                {
                    $status = 'Approved';
                }
                elseif($d == 2)
                {
                    $status = 'Unapproved';
                }
                elseif($d == 0)
                {
                    $status = 'Pending';
                }

                $status_btn = '<button type="button" data-patient='.$row['patient_user_id'].' data-status='.$d.' class="btn btn-default status_btn">'.$status.'</button>';
                
                return $status_btn;
            }),
            
            array('db' => 'patient_user_id', 'field' => 'patient_user_id', 'formatter' => function ($d,$row) {

            $action = '';
            $action .=  '<div class="list-icons">
                           <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">';
                            if($row['is_deleted'] != 1)
                            {
                                $action .= '<a href="'.base_url().'doctor/patients/edit/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                            <a onclick="confirmbox(\'Are you sure you want to delete this Patient?\',\''.base_url().'doctor/patients/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>';
                            }
                            else
                            {
                                $action .= '<a onclick="confirmbox(\'Are you sure you want to restore this Patient?\',\''.base_url().'doctor/patients/restore/'.$d.'\')" class="dropdown-item"><i class="fa fa-undo"></i>Restore</a>';
                            }            
                       
                    $action .= '</div>
                            </div>
                         </div>';

                return $action; 

            }),

            array('db' => 'is_deleted', 'field' => 'is_deleted','show' => 'no')

        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;
    }

    public function validate_username($username)
    {
       $result = $this->patient->validate_username($username);
       
       if($result)
       {
           return false;
       }else
       {
           return true;  
       }
    }

    public function search_patient()
    {
       $doctor_id = $this->session->userdata("id");
       
       $values = $this->input->post('p');
       $patients = $this->patient->search_patient($doctor_id,$values);
       
       echo json_encode($patients); 
        
    }

    public function get_status_content($patient_id,$status)
    {
        $content = '';
        $content .= '<form method="POST">
                       
                       <div class="row">
                         <div class="col-md-12 col-lg-12 col-sm-12">
                           
                         <div class="form-group">
                           <label for="select_status">Select Status</label>
                           <select name="status" class="form-control status" onchange="show_div(this.value);">';
                
                $class = $status == 1 ? 'selected' : '';
                
                    $content .= '<option value="1" '.$class.'>Approved</option>';
                
                $class = $status == 2 ? 'selected' : '';
                
                    $content .= '<option value="2" '.$class.'>Unapproved</option>';
               
                $class = $status == 0 ? 'selected' : '';
               
                    $content .= '<option value="0" '.$class.'>Pending</option>';
            
            $content .= '</select>
                         </div>';
        
            $class = $status != 1 ? 'hidden' : '';             
          
            $content .=      '<div class="notify_div '.$class.'">
                            <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input send_approve_email" name="is_email" value="1" id="send_approve_email ">
                                <label class="custom-control-label" for="send_approve_email ">Send "Approved" Patient Email</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input send_approve_sms" name="is_sms" value="1" id="send_approve_sms ">
                                <label class="custom-control-label" for="send_approve_sms ">Send "Approved" Patient SMS Text</label>
                            </div>
                            </div>
                         </div>';
       
        
        $content .=     '<hr class="solid">
                          <div class="form-group>
                            <button type="button" class="btn btn-light"></button><button type="button" data-patient='.$patient_id.' class="btn btn-primary btn-sm pull-right status_update">Update</button>
                          </div>

                         </div>
                       </div>
        
                     </form>';

        
        $content_arr = array(
                  
                    "title" => "Update Patient Status",
                    "patient_id" => $patient_id,
                    "status" => $status,
                    "html" => $content
        );             

        echo json_encode($content_arr);             
    }

    public function update_patient_status()
    {
        if($this->input->post())
        {
            $patient_id = $this->input->post('patient_id');
            $status = $this->input->post('status');
            $this->patient->update_patient_fields($patient_id,array("patient_status" => $status));
        }
    }


}

?>     