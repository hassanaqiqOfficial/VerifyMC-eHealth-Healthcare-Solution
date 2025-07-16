<?php
defined('BASEPATH') or exit('No direct script access allowed');
class View extends MY_Doctor_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("doctor/Doctor_Patient_model", "patient");
        $this->load->model("doctor/Doctor_view_model", "view");
        $this->load->library('session');
    }

    public function index($patient_id)
    {
        $data = array();

        $this->view->get_table("patient");
        $this->view->get_fkid("patient_user_id");
        $patient = $this->view->get($patient_id);

        $data['patient'] = $patient;
        $data['patient_id'] = $patient_id;
        $data['active'] = "patients";
        $data['active_page'] = "patients";

        view('doctor.patient.view', $data);
    }

    public function patient($patient_id)
    {
        $this->view->get_table("patient");
        $this->view->get_fkid("patient_user_id");
        $patient = $this->view->get($patient_id);

        $patient_detail = '<div class="row">
                           <div class="col-md-6 col-lg-6">
                              <table class="table table-borderless">
                               <tbody class="line-height-1">
                               <tr><td><b>Name :</b>  </td><td><a href class="text-dark">' . $patient['patient_fname'] . '' . $patient['patient_lname'] . '</a></td></tr>
                               <tr><td><b>Phone :</b>  </td><td><a href class="text-dark">' . $patient['patient_phone'] . '</a></td></tr>
                               <tr><td><b>Email :</b>  </td><td><a href class="text-dark">' . $patient['patient_email'] . '</a></td></tr>
                               <tr><td><b>Gender :</b>  </td><td><a href class="text-dark">' . $patient['patient_sex'] . '</a></td></tr>
                               <tr><td><b>Country :</b> </td><td><a href class="text-dark">' . $patient['patient_country'] . '</a></td></tr>
                               <tr><td><b>State :</b>  </td><td><a href class="text-dark">' . $patient['patient_state'] . '</a></td></tr>
                               <tr><td><b>City :</b>  </td><td><a href class="text-dark">' . $patient['patient_city'] . '</a></td></tr>
                               <tr><td><b>Zip Code :</b>  </td><td><a href class="text-dark">' . $patient['patient_zip'] . '</a></td></tr>
                               <tr><td><b>Timezone :</b>  </td><td><a href class="text-dark">' . $patient['patient_timezone'] . '</a></td></tr>
                               </tbody>
                              </table> 
                            </div>
                           <div class="col-md-6 col-lg-6">
                             <table class="table table-borderless">
                               <tbody class="line-height-1">
                                <tr><td><b>DOB :</b>  </td><td><a href class="text-dark">' . $patient['patient_dob'] . '</a></td></tr>
                                <tr><td><b>Initial visit :</b>  </td><td><a href class="text-dark">' . $patient['patient_init_visit'] . '</a></td></tr>
                                <tr><td><b>Status :</b>  </td><td><a href class="text-dark">' . $patient['patient_status'] . '</a></td></tr>
                                <tr><td><b>Weight :</b>  </td><td><a href class="text-dark">' . $patient['patient_weigth'] . '</a></td></tr>
                                <tr><td><b>Height :</b>  </td><td><a href class="text-dark">' . $patient['patient_height'] . '</a></td></tr>
                                <tr><td><b>Social Security :</b>  </td><td><a href class="text-dark">' . $patient['patient_social_sec'] . '</a></td></tr>
                                <tr><td><b>Guardian :</b>  </td><td><a href class="text-dark">' . $patient['patient_guardian'] . '</a></td></tr>
                                <tr><td><b>Address 1 :</b>  </td><td><a href class="text-dark">' . $patient['patient_address1'] . '</a></td></tr>
                                <tr><td><b>Address 2 :</b>  </td><td><a href class="text-dark">' . $patient['patient_address2'] . '</a></td></tr> 
                               </tbody>
                             </table>
                           </div>
                          </div>';

        echo $patient_detail;

    }

    public function delete_image($type)
    {
        $patient_id = $this->input->post('patientId');
        $field = $type == 1 ? 'idcard_url_front' : 'idcard_url_back';

        $url = $this->patient->get_field($patient_id,$field);
        
        @unlink(ROOTDIR.$url);
        $this->patient->update_field($patient_id,$field, '');
    }

    public function update_idCard_images($type)
    {
        header('Content-Type: application/json');

        $doctor_id = $this->session->userdata('id');
        $patient_id = $this->input->post('patientId');

        $doctor_dir = "uploads/doctor/doctor_" . md5($doctor_id);
        $patient_dir = $doctor_dir . '/' . md5($patient_id);

        $this->view->get_table("patient");
        $this->view->get_fkid("patient_user_id");

        if  ($type == 1) {
            
            $fileName = $this->input->post('fileName');
            if (copy('uploads/tmp/' . $fileName, $patient_dir . '/' . $fileName)) 
            {
                @unlink('uploads/tmp/' . $fileName);
            }
            $idcard_uri = $patient_dir . '/' . $fileName;
            $this->patient->update_field($patient_id,"idcard_url_front", $idcard_uri);

            $response = array("image" => base_url($idcard_uri));
            echo json_encode($response);


        } else {

            $fileName = $this->input->post('fileName');
            if (copy('uploads/tmp/' . $fileName, $patient_dir . '/' . $fileName)) {
                @unlink('uploads/tmp/' . $fileName);
            }

            $idcard_uri = $patient_dir . '/' . $fileName;
            $this->patient->update_field($patient_id,"idcard_url_back", $idcard_uri);

            $response = array("image" => base_url($idcard_uri));
            echo json_encode($response);



        }

    }

    public function list_patient_files($patient_id)
    {


        $doctor_id = $this->session->userdata('id');
        session_write_close();

        $this->load->library('Datatable');

        $joinQuery = "";

        $extraWhere = "fkpatientid = $patient_id && delete_file = 0";


        $table = 'patient_files';
        $primaryKey = 'id';
        $columns = array(

            array('db' => 'uploaded', 'field' => 'uploaded','formatter' => function ($d, $row) {
                return date("m/d/Y h:i a",strtotime($d));
            }),

            array('db' => 'name', 'field' => 'name'),

            array('db' => 'id', 'field' => 'id', 'formatter' => function ($d,$row) {

                return '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="' . base_url() . 'doctor/view/edit_file/' . $d . '" class="dropdown-item edit_file"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="deleteconfirm(\'Are you sure you want to delete this file?\',\'' . base_url() . 'doctor/view/delete_file/' . $d . '\',\'patient_files_datatable\')" class="dropdown-item delete_file"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                              </div>
                            </div>
                          </div>';

            }),

            array('db' => 'delete_file', 'field' => 'delete_file', 'show' => 'no')
        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));
        //echo $this->datatable->sql;
    }


    public function upload_patientfiles($patient_id)
    {
        $doctor_id = $this->session->userdata('id');


        $doctor_dir = "uploads/doctor/doctor_" . md5($doctor_id);
        $patient_dir = $doctor_dir . '/' . md5($patient_id);
        $response = $this->upload_image("patient_files",$patient_dir);


        if($response["error"] === 0)
        {
            $insert_data = array(
                "fkpatientid" => $patient_id,
                "name" => $response["upload_data"]["client_name"],
                "contenttype" => $response["upload_data"]["file_type"],
                "size" => $response["upload_data"]["file_size"],
                "dir_filename" => $response["upload_data"]["file_name"],
                "dir_url" => $patient_dir.'/'.$response["upload_data"]["file_name"],
                "type" => 0,
                "uploaded" => date("Y-m-d H:i:s"),
                "upload_by" => $doctor_id

            );
            $this->patient->patient_file_add($insert_data);
            return $this->output
                ->set_content_type('Content-Type: application/json')
                ->set_output(json_encode($response));
        }
        else
        {
            $this->output->set_status_header(400);
            return $this->output
                ->set_content_type('Content-Type: application/json')
                ->set_output(json_encode($response));
        }

    }

    public function edit_file($file_id)
    {
        $fileName = $this->input->post("fileName");
        $this->patient->update_patient_file($file_id,array("name" => $fileName));
    }

    public function delete_file($file_id)
    {
       $update_arr = array("delete_file" => 1, "delete_date" => date("Y-m-d")); 
       $this->patient->delete_patient_file($file_id,$update_arr);
    }


    public function list_patient_appointment($patient_id)
    {

        $doctor_id = $this->session->userdata('id');
        session_write_close();

        $this->load->library('Datatable');


        $joinQuery = " FROM `appointment` 
		LEFT JOIN doctor ON (appointment.doctor_id = doctor.doctor_user_id) 
        LEFT JOIN app_category ON (appointment.fk_app_categoryid = app_category.pk_app_categoryid)";

        $_POST["default_order"] = "(CASE WHEN DATE(appointment) < '".date("Y-m-d")."'
              THEN 1
              ELSE 0
         END) asc, appointment ASC  ";

        $extraWhere = "appointment.doctor_id = $doctor_id && appointment.patient_id = $patient_id";
        $table = 'appointment';
        $primaryKey = 'pk_appointment_id';
        $columns = array(

            array('db' => 'appointment', 'field' => 'appointment','formatter' => function ($d, $row) {
                return date("M d,Y",strtotime($d));
            }),
            array('db' => 'appointment', 'field' => 'appointment','formatter' => function ($d, $row) {
                return date("h:i A",strtotime($d));
            }),
            array('db' => 'status_appointment', 'field' => 'status_appointment', 'formatter' => function ($d) {

                if ($d == 1) {
                    $status = "Active";
                } else {
                    $status = "Pending";
                }
                return $status;
            }),
            array('db' => 'app_category.app_cat_color', 'field' => 'app_cat_color', 'formatter' => function ($d, $row) {

                if ($d) {
                    $color = explode("_",$d);
                    $label = '<label class="px-2 py-1 m-0 rounded" style="background-color:'.$color[0].';color:'.$color[1].';">'.$row['name'].'</label>';
                } else {
                    $label = "<label class='border-1 m-0 px-2 py-1 rounded' >Add Category</label>";

                }

                return $label;
            }),

            array('db' => 'pk_appointment_id', 'field' => 'pk_appointment_id', 'formatter' => function ($d, $row) {

                return '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="' . base_url() . 'doctor/appointment/edit_appointment/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="deleteconfirm(\'Are you sure you want to delete this Appointment?\',\'' . base_url() . 'doctor/appointment/delete_appointment/' . $d . '\',\'patient_appointment_datatable\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                            </div>
                            </div>
                         </div>';
            }),
            array('db' => 'app_category.name', 'field' => 'name', "show" => 'no'),

        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;
    }

    public function list_patient_invoices($patient_id)
    {
        $doctor_id = $this->session->userdata("id");
        $this->load->library('Datatable');

        $joinQuery = "FROM invoices LEFT JOIN patient ON (invoices.fk_patient_id = patient.patient_user_id) WHERE invoices.fk_patient_id =  $patient_id  && doctor_id =  $doctor_id && is_delete = 0";
        $extraWhere = "";


        $table = 'invoices';
        $primaryKey = 'pk_invoice_id';

        $columns = array(

            array('db' => 'pk_invoice_id', 'field' => 'pk_invoice_id','formatter' => function($d){
  
                 return $invoice_no = "INV 00".$d;
                   
            }),

            array('db' => 'patient.patient_fname', 'field' => 'patient_fname'),

            array('db' => 'invoices.date_created', 'field' => 'date_created','formatter' => function($d){

                return $date = date("m/d/Y",strtotime($d));
            }),

            array('db' => 'date_due', 'field' => 'date_due','formatter' => function($d){

                  return $date = date("m/d/Y",strtotime($d));
            }),

            array('db' => 'total_amount', 'field' => 'total_amount','formatter' => function($d){
                return "$".$d;
            }),

            array('db' => 'status', 'field' => 'status','formatter' => function($d,$row){
         
                 $stauts = "";
                 
                 if($d == 0)
                 {
                    $stauts = "Unpaid";
                 }
                 else
                 {
                    $stauts = "Paid";
                 }
                
                 return $stauts;
               
            }),

            array('db' => 'pk_invoice_id', 'field' => 'pk_invoice_id', 'formatter' => function ($d, $row) {

                $dropdown = '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                            <a href="' . base_url() . 'doctor/invoices/view/'.$d.'" class="dropdown-item"><i class="fa fa-file-o"></i>View</a>';
                if($row['status'] != 1)
                {
                
                    $dropdown      .='<a href="' . base_url() . 'doctor/invoices/invoice_payment/'.$d.'" class="dropdown-item"><i class="fa fa-dollar"></i>Paid</a>
                                    <a href="' . base_url() . 'doctor/invoices/edit_invoice/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>';
                }
                $dropdown .=    '<a onclick="confirmbox(\'Are you sure you want to delete this Invoice?\',\'' . base_url() . 'doctor/invoices/delete_invoice/' . $d . '\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                                </div>
                                </div>
                            </div>';

                return  $dropdown; 
            }),

            array('db' => 'invoices.fk_patient_id', 'field' => 'fk_patient_id','show' => 'no')

        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;
    }

    public function get_note()
    {
        $doctor_id = $this->session->userdata("id");
        $note_id = $this->input->post("NoteID");
        $note = $this->view->get_quick_note($doctor_id,$note_id);
        
        echo $note['description'];
    } 

    public function get_patient_note()
    {
       
        $patientID = $this->input->post("patientID");
        $note_id = $this->input->post("NoteID");

        $note = $this->view->get_patient_note($patientID,$note_id);
        
        echo json_encode($note);
    } 

    public function load_notes()
    {
        $doctor_id = $this->session->userdata("id");
        $notes = $this->view->get_quick_notes($doctor_id);
      
        if ($notes)
        {   
            echo "<option value='' selected='selected'>quick Notes</option>";
            foreach($notes as $note)
            {
              echo "<option value=".$note['pk_note_id'].">".$note['title']."</option>";
            }
        }
    }

    public function add_note()
    {
       $doctor_id = $this->session->userdata('id');
       
       if($this->input->post())
       {
             $post = $this->input->post(); 
             extract($post);
            
               $insert_arr  = array(

                        "fk_patient_id" => $patient_id,
                        "fk_doctor_id" => $doctor_id,
                        "date_added" => date("Y-m-d",strtotime($date)),
                        "note_description" => $description
                );

            if($post['noteID'] != "")
            {
               $this->view->update_note($post['noteID'],$insert_arr);
               redirect('doctor/view/index/'.$patient_id);
            }
            else
            {
                $ins = $this->view->add_note($insert_arr); 
                if($ins)
                {
                    redirect('doctor/view/index/'.$patient_id);
                }
            }    
            
       }
    }

   public function list_patient_notes()
   {
    $doctor_id = $this->session->userdata("id");
    $patient_id  = $this->input->post('patientID');

    $this->load->library('Datatable');

    $joinQuery = "";
    $extraWhere = "fk_doctor_id = $doctor_id && fk_patient_id = $patient_id ";


    $table = 'patient_notes';
    $primaryKey = 'pk_noteID ';

    $columns = array(

        array('db' => 'date_added', 'field' => 'date_added',"formatter" => function($d){
             return $date = date("m/d/Y",strtotime($d));
        }),

        array('db' => 'note_description', 'field' => 'note_description'),

        array('db' => 'pk_noteID ', 'field' => 'pk_noteID', 'formatter' => function ($d, $row) {

        return '<div class="list-icons">
                  <div class="dropdown">
                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                      <i class="icon-menu9"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a onclick="popupModal('.$d.')" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                      <a onclick="deleteconfirm(\'Are you sure you want to delete this note?\',\'' . base_url() . 'doctor/view/delete_note/'.$d.'/'.$row['fk_patient_id'].'\',\'patient_notes_datatable\')" class="dropdown-item">
                      <i class="fa fa-trash" style="color:red;"></i>Delete</a>
                    </div>
                  </div>
                </div>';
        }),

        array('db' => 'fk_patient_id ', 'field' => 'fk_patient_id','show' => 'no')
    );


    $c = array();
    foreach ($columns as $key => $value) 
    {
        $value["dt"] = $key;
        $c[] = $value;
    }

    echo json_encode($this->datatable->simple($_POST,$table,$primaryKey,$c,$joinQuery,$extraWhere));
    //echo $this->datatable->sql;

   }

   public function delete_note($note_id,$patient_id)
   {
     $this->view->delete_note($note_id);
     $this->session->set_flashdata("success","Successfully deleted patient Note.");
     redirect('doctor/view/index/'.$patient_id);
   }

   public function list_custom_scheduled_email()
   {
        $doctor_id = $this->session->userdata("id");
        $patient_id  = $this->input->post('patientID');

        $this->load->library('Datatable');

        $joinQuery = "";
        $extraWhere = "fkdoctor_id = $doctor_id && fkpatient_id = $patient_id && Notification_type = 1 && scheduler_type = 0";


        $table = 'custom_email_sms_scheduler';
        $primaryKey = 'pk_scheduler_ID ';

        $columns = array(

            array('db' => 'title', 'field' => 'title'),

            array('db' => 'sendDateTime', 'field' => 'sendDateTime','formatter' => function($d){
                return $date = gmdate("m/d/Y",strtotime($d));
            }),

            array('db' => 'sendDateTime', 'field' => 'sendDateTime','formatter' => function($d){
                return $date = gmdate("h:i A",strtotime($d));
            }),

            array('db' => 'pk_scheduler_ID ', 'field' => 'pk_scheduler_ID', 'formatter' => function ($d, $row) {

            return '<div class="list-icons">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="popupModalEmail('.$d.')" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                        <a onclick="deleteconfirm(\'Are you sure you want to delete this custom scheduled email?\',\'' . base_url() . 'doctor/view/delete_scheduled_notification/'.$d.'/'.$row['Notification_type'].'/'.$row['fkpatient_id'].'\',\'scheduled_custom_email\')" class="dropdown-item">
                        <i class="fa fa-trash" style="color:red;"></i>Delete</a>
                        </div>
                    </div>
                    </div>';
            }),

            array('db' => 'Notification_type ', 'field' => 'Notification_type','show' => 'no'),
            array('db' => 'fkpatient_id ', 'field' => 'fkpatient_id','show' => 'no')

        );


        $c = array();
        foreach ($columns as $key => $value) 
        {
            $value["dt"] = $key;
            $c[] = $value;
        }

        echo json_encode($this->datatable->simple($_POST,$table,$primaryKey,$c,$joinQuery,$extraWhere));
        //echo $this->datatable->sql;
   }

   public function list_custom_scheduled_sms()
   {
        $doctor_id = $this->session->userdata("id");
        $patient_id  = $this->input->post('patientID');

        $this->load->library('Datatable');

        $joinQuery = "";
        $extraWhere = "fkdoctor_id = $doctor_id && fkpatient_id = $patient_id  && Notification_type = 0 && scheduler_type = 0";


        $table = 'custom_email_sms_scheduler';
        $primaryKey = 'pk_scheduler_ID ';

        $columns = array(

            array('db' => 'title', 'field' => 'title'),

            array('db' => 'sendDateTime', 'field' => 'sendDateTime','formatter' => function($d){
                return $date = gmdate("m/d/Y",strtotime($d));
            }),

            array('db' => 'sendDateTime', 'field' => 'sendDateTime','formatter' => function($d){
                return $date = gmdate("h:i A",strtotime($d));
            }),

            array('db' => 'pk_scheduler_ID ', 'field' => 'pk_scheduler_ID', 'formatter' => function ($d, $row) {

            return '<div class="list-icons">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="popupModalSMS('.$d.')" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                        <a onclick="deleteconfirm(\'Are you sure you want to delete this custom scheduled sms?\',\'' . base_url() . 'doctor/view/delete_scheduled_notification/'.$d.'/'.$row['Notification_type'].'/'.$row['fkpatient_id'].'\',\'scheduled_custom_sms\')" class="dropdown-item">
                        <i class="fa fa-trash" style="color:red;"></i>Delete</a>
                        </div>
                    </div>
                    </div>';
            }),

            array('db' => 'Notification_type ', 'field' => 'Notification_type','show' => 'no'),
            array('db' => 'fkpatient_id ', 'field' => 'fkpatient_id','show' => 'no')
        );


        $c = array();
        foreach ($columns as $key => $value) 
        {
            $value["dt"] = $key;
            $c[] = $value;
        }

        echo json_encode($this->datatable->simple($_POST,$table,$primaryKey,$c,$joinQuery,$extraWhere));
        //echo $this->datatable->sql;
   }

   public function schedule_custom_email_sms()
   {   
         $doctor_id = $this->session->userdata("id");
         
         if($this->input->post())
         {
            $post = $this->input->post();
            
            $notificationID = $post['fk_custom_notificationID'];
            $notification_temlate = $this->view->get_custom_notification($doctor_id,$notificationID,$post['type']);
            
            $dateTime = gmdate("Y-m-d H:i:s",strtotime($post['date'].' '.$post['time']));

            $insert = array(
               
                "fkdoctor_id" => $doctor_id,
                "fkpatient_id" => $post['patient_id'],
                "fk_notification_id" => $notificationID,
                "scheduler_type" => 0,
                "status" => 0,
                "title" =>  $notification_temlate['title'],
                "body" =>  $notification_temlate['body'],
                "send_to" => 0,
                "sendDateTime" => $dateTime,
            );

            if($post['action'] == "Update")
            {
                $insert['Notification_type'] = $post['type'] == 1 ? 1 : 0 ; 
                $insert['subject'] = $post['type'] == 1 ? $notification_temlate['subject'] : "" ;
                
                $this->view->update_schedule_notification($insert,$post['pkSchedulerID'],$doctor_id);
                $this->session->set_flashdata("success","Successfully updated scheduled custom notification");
                redirect('doctor/view/index/'.$post['patient_id']);
            }
            else
            {  
                $insert['Notification_type'] = $post['type'] == 1 ? 1 : 0 ; 
                $insert['subject'] = $post['type'] == 1 ? $notification_temlate['subject'] : "" ;
                
                $this->view->add_schedule_notification($insert);
                $this->session->set_flashdata("success","Successfully added scheduled custom notification");
                redirect('doctor/view/index/'.$post['patient_id']);
            }    
            
              
         }
   }

   public function get_scheduled_notification()
   {
        $doctor_id = $this->session->userdata("id");
        $notificationID = $this->input->post("notificationid");
        $type = $this->input->post("type");
        
        $email_template = $this->view->get_scheduled_notification($doctor_id,$type,$notificationID);
        echo json_encode($email_template);
    }

   public function get_custom_notifications()
   {
       $doctor_id = $this->session->userdata("id");
       $type = $this->input->post("type");

       $templates = $this->view->get_custom_notifications($doctor_id,$type);

       if($templates)
       {
           echo "<option value=''>Select Option</option>";
           foreach($templates as $template)
           {
               echo "<option value=".$template['ID'].">".$template['title']."</option>";
           }
       }
   }

   public function get_default_email_notifications()
   {
        $type = $this->input->post("type");
        $templates = $this->view->get_default_email_notifications($type,2);

        if($templates)
        {
            echo "<option value=''>Select Option</option>";
            foreach($templates as $template)
            {
                echo "<option value=".$template['id'].">".$template['title']."</option>";
            }
        }
   }

   public function get_notification()
   {
       $doctorid = $this->session->userdata("id");
       
       $table = $this->input->post("table");
       $pkid = $this->input->post("pkid");
       $type = $this->input->post("type");
       $notificationID = $this->input->post("notificationId");
       $doctor_id = $table == "custom_email_sms" ? $doctorid : "" ;


       $this->view->get_table($table);
       $this->view->get_pkid($pkid);
       $template = $this->view->get_notification($notificationID,$type,$doctor_id);
       
       echo json_encode($template);
   }

   public function delete_scheduled_notification($notify_id,$type,$patient_id)
   {
       $doctor_id = $this->session->userdata("id");
       $this->view->delete_notification($notify_id,$type,$doctor_id);
       $this->session->set_flashdata("success","Successfully added scheduled custom notification");
       redirect('doctor/view/index/'.$patient_id);
    }

   public function add_contact_notification()
   {
        $doctor_id = $this->session->userdata("id");
       
        if($this->input->post())
        {
           $insert_arr = array(

                "fkdoctor_id" => $doctor_id,
                "fkpatient_id" => $this->input->post("patient_id"),
                "fk_notification_id" => 0,
                "scheduler_type" => 2,
                "Notification_type" => $this->input->post("type"),
                "status" => 0,
                "title" => "Title",
                "subject" => $this->input->post("subject"),
                "body" => $this->input->post("body"),
                "send_to" => 0,
                "sendDateTime" => gmdate("Y-m-d h:i:s")
           );

           $this->view->add_schedule_notification($insert_arr);
        }  
   }

   

}
?>