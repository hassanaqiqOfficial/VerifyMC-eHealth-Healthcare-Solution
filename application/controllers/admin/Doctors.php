<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctors extends MY_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Admin_doctor_model", "doctor");
        $this->load->model("admin/Admin_clinic_model", "clinic");
    }


    public function index()
    {
        $data = array();
        $data["active"] = 'doctors';
        $data["active_page"] = 'doctors';
        view('admin.doctors.manage', $data);
    }

    public function list_doctor()
    {
        $admin_id = $this->session->userdata('id');
        $this->load->library('Datatable');


        $joinQuery = "";
        $extraWhere = "";


        $table = 'doctor';
        $primaryKey = 'doctor_user_id';
        $columns = array(

            array('db' => 'doctor_name', 'field' => 'doctor_name', 'formatter' => function ($d, $row) {
                return '<a href="' . base_url() . 'admin/doctors/edit/' . $row["doctor_user_id"] . '">' . $d . '</a>';
            }),
            array('db' => 'doctor_email', 'field' => 'doctor_email'),
            array('db' => 'doctor_phone', 'field' => 'doctor_phone'),
            array('db' => 'doctor_status', 'field' => 'doctor_status'),

            array('db' => 'doctor_user_id', 'field' => 'doctor_user_id', 'formatter' => function ($d, $row) {

                return  '<div class="list-icons">
                           <div class="dropdown">
                             <a href="#" class="list-icons-item" data-toggle="dropdown">
                               <i class="icon-menu9"></i>
                             </a>
       
                             <div class="dropdown-menu dropdown-menu-right">
                               <a href="'.base_url().'admin/doctors/edit/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                               <a onclick="confirmbox(\'Are you sure you want to delete this Doctor?\',\''.base_url().'admin/doctors/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                             </div>
                           </div>
                         </div>';

              
            })
        );;


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;
    }


    public function add()
    {

        $data = array();

        if ($this->input->post()) {
            $this->doctor->add_doctor();
            $this->session->set_flashdata("success", "Doctor has been added successfully");
            redirect(base_url("admin/doctors"));
        }


        $results = $this->clinic->get_clinics();
        $data['clinic_data'] = $results;

        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();
        $data["active"] = 'doctors';
        $data["active_page"] = 'doctors_add';
        view('admin.doctors.add', $data);
    }

    public function edit($id)
    {
        $data = array();
        if ($this->input->post()) {
            $this->doctor->edit_doctor($id);
            $this->session->set_flashdata('success', 'Doctor Has Been Edited Successfully.');
            redirect(base_url("admin/doctors/"));
        }

        $data['doctor_data'] = $this->doctor->get_single_doctor($id);
        $data['countries'] = $this->countries();
        $data['timezones'] = $this->timezone();

        $data["active"] = 'doctors';
        $data["active_page"] = 'doctors';
        view('admin.doctors.edit', $data);
    }

    public function delete($id)
    {
        $this->doctor->delete_doctor($id);
        $this->session->set_flashdata('success', 'Doctor Has Been Deleted Successfully.');
        redirect(base_url("admin/doctors/"));

        view('admin.doctors.manage');
    }

}

?>