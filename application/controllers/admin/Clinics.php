<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clinics extends MY_Admin_Controller
{
    public function __construct()
		{
			      parent::__construct();
            $this->load->model("admin/Admin_clinic_model", "clinic");
            $this->load->model("admin/Admin_doctor_model", "doctor");
            
		}
		
   public function index()
   {
       $data = array();
       $data["active"] = 'clinics';
       $data["active_page"] = 'clinics';
       view('admin.clinics.manage',$data);
   }

    public function list_clinic()
    {
        $admin_id = $this->session->userdata('id');
        $this->load->library('Datatable');

        
        $joinQuery = "";
        $extraWhere = "";

        
        $table = 'clinic';
        $primaryKey = 'clinic_user_id';
        $columns = array(

              array('db'  => 'clinic_logo', 'field' => 'clinic_logo', 'formatter' => function( $d, $row ){

                if ($d != "") 
                {
                    $clinic_id_dir = base_url().$d;
                    $image_url = $clinic_id_dir;
                } 
                else 
                {
                    $image_url = base_url().'assets/img/placeholder.png';
                }
                return '<a href="'.base_url().'admin/clinics/edit/'.$row["clinic_user_id"].'"><img src="' . $image_url . '" style="width:35px; height:35px;border-radius: 150px;"></a>';
                }),
           
              array('db'  => 'clinic_name', 'field' => 'clinic_name', 'formatter' => function( $d, $row ) {
                return '<a href="'.base_url().'admin/clinics/edit/'.$row["clinic_user_id"].'">'.$d.'</a>';
                }),
           
              array('db' => 'clinic_email', 'field' => 'clinic_email'),

              array('db' => 'clinic_phone', 'field' => 'clinic_phone'),

              array('db'  => 'clinic_user_id', 'field' => 'clinic_user_id', 'formatter' =>function( $d, $row ){

                   return  '<div class="list-icons">
                           <div class="dropdown">
                             <a href="#" class="list-icons-item" data-toggle="dropdown">
                               <i class="icon-menu9"></i>
                             </a>
       
                             <div class="dropdown-menu dropdown-menu-right">
                               <a href="'.base_url().'admin/clinics/edit/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                               <a onclick="confirmbox(\'Are you sure you want to delete this Clinic?\',\''.base_url().'admin/clinics/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
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

        if($this->input->post())
        {   
            $this->clinic->add_clinic();
            $this->session->set_flashdata('success', 'Clinic User Has Been Added Successfully.');
            redirect(base_url("admin/clinics/"));
        }

        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();
        $data["active"] = 'clinics';
        $data["active_page"] = 'clinics_add';
        view('admin.clinics.add',$data);

    }

    public function edit($id)
    {
        $data = array();

        if($this->input->post())
        {
            $this->clinic->edit_clinic($id);
            $this->session->set_flashdata('success', 'Clinic User Has Been Edited Successfully.');
            redirect(base_url("admin/clinics/"));
        }

        $data['clinic_data'] = $this->clinic->get_single_clinic($id);
        $data['countries']   = $this->countries();
        $data['timezones']   = $this->timezone();

        $data["active"] = 'clinics';
        $data["active_page"] = 'clinics';
        view('admin.clinics.edit',$data);

    }

     public function delete($id)
    {
          
       $this->clinic->delete_clinic($id);
       $this->session->set_flashdata('success', 'Clinic User Has Been Deleted Successfully.');
       redirect(base_url("admin/clinics/"));

       view('admin.clinics.manage');
    }
 
 }

?>