<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor extends MY_Clinic_Controller
{
    public function __construct()
	{
			parent::__construct();
            $this->load->model("clinic/Clinic_Doctor_model", "clinic");
	}
		
   
    public function index()
    {
       $data = array();

       $data["active"] = 'doctors';
       $data["active_page"] = 'doctors';
       view('clinic.doctor.manage',$data);
    }


    public function list_doctor()
    {
        $admin_id = $this->session->userdata('id');
        $this->load->library('Datatable');

        
        $joinQuery = "";
        $extraWhere = "";

        
        $table      = 'doctor';
        $primaryKey = 'doctor_user_id';
        $columns    = array(

              array('db' => 'doctor_image', 'field' => 'doctor_image', 'formatter' => function( $d, $row ) {
                if ($d != "") 
                {
                    $doctor_id_dir = base_url().$d;
                    $image_url = $doctor_id_dir;
                } 
                else 
                {
                    $image_url = base_url().'assets/img/placeholder.png';
                }
                return '<a href="'.base_url().'clinic/doctor/edit/'.$row["doctor_user_id"].'"><img src="' . $image_url . '" style="width:35px; height:35px;border-radius: 150px;"></a>';
              }),

              array('db' => 'doctor_name', 'field' => 'doctor_name', 'formatter' => function( $d, $row ) {
                 return '<a href="'.base_url().'clinic/doctor/edit/'.$row["doctor_user_id"].'">'.$d.'</a>'; 
              }),
              array('db' => 'doctor_email', 'field' => 'doctor_email'),
              array('db' => 'doctor_phone', 'field' => 'doctor_phone'),
              array('db' => 'doctor_status', 'field' => 'doctor_status'),

              array('db'  => 'doctor_user_id', 'field' => 'doctor_user_id', 'formatter' => function( $d, $row ) {

                return  '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="'.base_url().'clinic/doctor/edit/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this Doctor?\',\''.base_url().'clinic/doctor/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
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
            $this->clinic->add_doctor();
            $this->session->set_flashdata('success', 'Doctor User Has Been Added Successfully.');
            redirect(base_url("clinic/doctor/"));
        }

        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();

        $data["active"] = 'doctors';
        $data["active_page"] = 'doctors_add';

        view('clinic.doctor.add',$data);

    }

    public function edit($id)
    {
        $data = array();

        if($this->input->post())
        {
            $this->clinic->edit_doctor($id);
            $this->session->set_flashdata('success', 'Doctor Has Been Edited Successfully.');
            redirect(base_url("clinic/doctor/"));
        }

        $data['doctor_data'] = $this->clinic->get_single_doctor($id);
        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();

        $data["active"] = 'doctors';
        $data["active_page"] = 'doctors';
        view('clinic.doctor.edit',$data);

    }

    public function delete($id)
    {
       $this->clinic->delete_doctor($id);
       $this->session->set_flashdata('success', 'Doctor Has Been Deleted Successfully.');
       redirect(base_url("clinic/doctor/"));

       view('clinic.doctor.manage');
    }


 
  }

?>