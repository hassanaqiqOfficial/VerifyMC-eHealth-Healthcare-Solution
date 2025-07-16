<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoices extends MY_Doctor_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("doctor/Doctor_model", "doctor");
        $this->load->model("doctor/Doctor_Patient_model", "patient");
        $this->load->model("doctor/Doctor_setting_model", "settings");
        $this->load->model("doctor/Doctor_appointment_model", "appointment");
        $this->load->model("doctor/Doctor_invoices_model", "invoices");
    }

    public function index()
    {
        $data = array();
        $data['active'] = "invoices";
        $data['active_page'] = "invoices";

        view('doctor.invoices.manage_invoices', $data);
    }

    public function add_invoice($patientID = "")
    {
        
        $data = array();
        $doctor_id = $this->session->userdata("id");
        $data['services'] = $this->appointment->get_services();
        $data['patient'] = $this->patient->get_patient($patientID);
        $data['nextIncrementID'] = $this->invoices->get_nextIncrement_Id();
        
        if ($this->input->post()){

            $post = $this->input->post();
            
                $patient_type = $this->input->post("patient");
                $patient_id = $this->input->post("patient_id");
                
                if ($patient_type == "new_patient")
                {
                    $patient_id = $this->patient->add_patient_appointment();
                } 
                else 
                {
                    if ($post["email_exist"] != "" || $post["phone_exist"] != "")
                    {
                        if($post["email_exist"] != "")
                        {
                             $update_arr['patient_email'] = $post["email_exist"];
                        }
                        if($post["phone_exist"] != "")
                        {
                             $update_arr['patient_phone'] = $post["phone_exist"];
                        }
    
                        $this->patient->update_patient_fields($patient_id, $update_arr);
                    }    
                }
            

            $insert_arr = array(

                "fk_patient_id" => $patient_id,
                "doctor_id" => $doctor_id,
                "date_created" => gmdate("Y-m-d", strtotime($post['created_date'])),
                "date_due" => gmdate("Y-m-d", strtotime($post['due_date'])),
                "discount_amount" => $post['discount_amount'],
                "deposit_amount" => $post['deposit_credit'],
                "sub_total" => $post['sub_total'],
                "total_amount" => $post['total'],
            );

            $insert_arr["status"] = $post['payment_option'] == "" ? 0 : 1;
            $invoice_id = $this->invoices->add_invoice($insert_arr);

            if($invoice_id) 
            {

                if ($this->input->post("service_id") != "") 
                {
                    $service_ids = $post["service_id"];
                    foreach ($service_ids as $key => $service_id) 
                    {
                        if ($post["service_description"][$key] != "" && $post["service_amount"][$key] != "") 
                        {
                            $invoice_entry_arr = array(

                                "fk_invoice_id" => $invoice_id,
                                "fk_service_id" => $service_id,
                                "service_text" => $post["service_description"][$key],
                                "service_price" => $post["service_amount"][$key]
                            );

                            $this->invoices->add_service_entries($invoice_entry_arr);
                        }

                    }
                }

                if($post['payment_option'] != "")
                {
                    $invoice_payment_arr = array(

                        "fk_invoice_id" => $invoice_id,
                        "fk_patient_id" => $patient_id,
                        "fk_doctor_id" => $doctor_id,
                        "date_created" => gmdate("Y-m-d"),
                        "totalAmount" => $post['total'],
                        "payment_mode" => $post['payment_option'],
                        "checknumber" => $post['checknumber']
                    );
                
                  
                    $this->invoices->add_payment_entry($invoice_payment_arr);

                }

                
            }

            $this->session->set_flashdata("success","You have successfully added new invoice");
            redirect('doctor/invoices');

        }


        $data['patientID'] = $patientID;
        $data['active'] = "invoices";
        $data['active_page'] = "invoice_add";

        view('doctor.invoices.add_invoice', $data);
    }

    public function edit_invoice($invoice_id)
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");

        $data['services'] = $this->appointment->get_services();
        $invoice = $this->invoices->get_invoice($invoice_id, $doctor_id);
        $data['patient'] = $this->patient->get_patient($invoice['patient_id']);
        $data['invoice'] = $invoice;
        $data['invoice_services'] = $this->invoices->get_invoice_services($invoice_id);


        if ($this->input->post()) {
            $post = $this->input->post();
            $patient_id = $this->input->post("patient_id");

            $update_arr = array(

                "fk_patient_id" => $patient_id,
                "doctor_id" => $doctor_id,
                "date_created" => date("Y-m-d", strtotime($post['created_date'])),
                "date_due" => date("Y-m-d", strtotime($post['due_date'])),
                "discount_amount" => $post['discount_amount'],
                "deposit_amount" => $post['deposit_credit'],
                "sub_total" => $post['sub_total'],
                "total_amount" => $post['total'],
            );

            $update_arr["status"] = $post['payment_option'] == "" ? 0 : 1;
            $ins = $this->invoices->update_invoice($update_arr, $invoice_id);

            if ($ins){

                if ($this->input->post("service_id") != "") 
                {

                    $this->invoices->delete_service_entries($invoice_id);

                    $service_ids = $post["service_id"];
                    foreach ($service_ids as $key => $service_id) 
                    {
                        if ($post["service_description"][$key] != "" && $post["service_amount"][$key] != "")
                        {
                            $invoice_entry_arr = array(

                                "fk_invoice_id" => $invoice_id,
                                "fk_service_id" => $service_id,
                                "service_text" => $post["service_description"][$key],
                                "service_price" => $post["service_amount"][$key]
                            );

                            $this->invoices->add_service_entries($invoice_entry_arr);
                        }
                    }
                }

                if($post['payment_option'] != "")
                {
                    
                    $exist = $this->invoices->check_payment_history($invoice_id);

                    if(!$exist)
                    {
                        $update_payment_arr = array(
    
                            "fk_invoice_id" => $invoice_id,
                            "fk_patient_id" => $patient_id,
                            "fk_doctor_id" => $doctor_id,
                            "date_created" => gmdate("Y-m-d"),
                            "totalAmount" => $post['total'],
                            "payment_mode" => $post['payment_option'],
                            "checknumber" => $post['checknumber']
                        );
                    
                      
                        $this->invoices->add_payment_entry($update_payment_arr);
                    }
                    
                }
                
            }

            $this->session->set_flashdata("success", "You have successfully updated invoice");
            redirect('doctor/invoices');

        }


        $data['active'] = "invoices";
        $data['active_page'] = "invoices";

        view('doctor.invoices.edit_invoice', $data);
    }

    public function list_invoices()
    {
        $doctor_id = $this->session->userdata("id");
        $this->load->library('Datatable');

        $joinQuery = "FROM invoices LEFT JOIN patient ON (invoices.fk_patient_id = patient.patient_user_id) WHERE doctor_id =  $doctor_id && is_delete = 0";
        $extraWhere = "";


        $table = 'invoices';
        $primaryKey = 'pk_invoice_id';

        $columns = array(

            array('db' => 'pk_invoice_id', 'field' => 'pk_invoice_id','formatter' => function($d){
  
                 return $invoice_no = "INV00".$d;
                   
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
                 
                 return  "<button type='button' class='btn btn-light btn-sm' style='border-radius:4px;'>".$stauts."</button>";
               
            }),

            array('db' => 'pk_invoice_id', 'field' => 'pk_invoice_id', 'formatter' => function ($d,$row) {

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

    public function view($invoice_id)
    {
       $data = array();
       $doctor_id = $this->session->userdata("id");

       $invoice = $this->invoices->get_invoice($invoice_id,$doctor_id);
       $data['invoice'] = $invoice;
       $data['invoiceServices'] = $this->invoices->get_invoice_services($invoice_id);
       $data['patient'] = $this->patient->get_patient($invoice['patient_id']);
       $data['doctor'] = $this->doctor->get_single_doctor($doctor_id);
       $data['settings'] = $this->settings->get_settings($doctor_id);



       $data['active'] = "invoices";
       $data['active_page'] = "invoices";

       view('doctor.invoices.view',$data);
    }

    public function delete_invoice($invoice_id)
    {
        $doctor_id = $this->session->userdata('id');
        $result = $this->invoices->delete_invoice($invoice_id,$doctor_id);
        
        if($result == true)
        {
            $this->session->set_flashdata("success", "Successfully invoice has been deleted.");
        }
        else
        {
            $this->session->set_flashdata("error", "Invalid attempt to delete invoice.");
        }
        
        redirect('doctor/invoices');
    }

    public function invoice_payment($invoiceID)
    {
       $data = array();
       $doctor_id = $this->session->userdata("id");

       $invoice = $this->invoices->get_invoice($invoiceID, $doctor_id);
       $data['patient'] = $this->patient->get_patient($invoice['patient_id']);
       $data['invoice'] = $invoice;

        if($this->input->post())
        {
            $post = $this->input->post();
            $exist = $this->invoices->check_payment_history($invoiceID);
            
            if(!$exist)
            {
                $insert_arr = array(
                    
                    "fk_invoice_id" => $invoiceID,
                    "fk_patient_id" => $invoice['patient_id'],
                    "fk_doctor_id" =>  $doctor_id,
                    "date_created" =>  gmdate("Y-m-d"),
                    "totalAmount" =>   $post['total_amount'],
                    "payment_mode" =>  $post['payment_option'],
                    "checknumber" => $post['checknumber'],
                );

               $ins = $this->invoices->add_payment_entry($insert_arr);
               
               if($ins)
               {
                   $this->invoices->update_invoice(array("status" => 1),$invoiceID);
                   $this->session->set_flashdata("success", "You have successfully added invoice payment.");
                   redirect('doctor/invoices');
               }
                
            }
            else
            {
                $this->session->set_flashdata("error", "Restricted duplicate payment entry.");
            }
            
        }


       $data['active'] = "invoices";
       $data['active_page'] = "payments";

       view('doctor.payments.payment',$data);
    }

    public function payments()
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");


        $data['active'] = "invoices";
        $data['active_page'] = "payments";
        view('doctor.payments.manage',$data);
    }

    public function list_payments()
    {
        $doctor_id = $this->session->userdata("id");
        $this->load->library('Datatable');

        $joinQuery = "FROM payment LEFT JOIN patient ON (payment.fk_patient_id = patient.patient_user_id) WHERE fk_doctor_id =  $doctor_id";
        $extraWhere = "";


        $table = 'payment';
        $primaryKey = 'pk_payment_ID';

        $columns = array(

            array('db' => 'fk_invoice_id', 'field' => 'fk_invoice_id','formatter' => function($d){
  
                 return $invoice_no = "INV00".$d;
                   
            }),

            array('db' => 'patient.patient_fname', 'field' => 'patient_fname','formatter' => function($d,$row){

                   return $d.' '.$row['patient_lname'];
            }),

            array('db' => 'date_created', 'field' => 'date_created','formatter' => function($d){

                return $date = date("m/d/Y",strtotime($d));
            }),

            array('db' => 'totalAmount', 'field' => 'totalAmount','formatter' => function($d){
                return "$".$d;
            }),

            array('db' => 'payment_mode', 'field' => 'payment_mode','formatter' => function($d,$row){
         
                 $payment_mode = "";
                 
                 if($d == 1)
                 {
                    $payment_mode = "Pay by Card";
                 }
                 elseif($d == 2)
                 {
                    $payment_mode = "Pay by Cash";
                 }
                 elseif($d == 3)
                 {
                    $payment_mode = "Pay by Check";
                 }
                 
                 return  $payment_mode;
               
            }),

           
            array('db' => 'patient.patient_lname', 'field' => 'patient_lname','show' => 'no')

        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;
    }   

}

?>