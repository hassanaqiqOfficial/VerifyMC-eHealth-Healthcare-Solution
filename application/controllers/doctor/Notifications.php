<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends MY_Doctor_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('doctor/Doctor_notification_model', 'notification');
    }

    public function index()
    {
        $this->customize_patient_notification();
    }

    public function customize_patient_notification($task = "", $type = "")
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");
        
        $data['active'] = "settings";
        $data['active_page'] = "notifications";
        $data['active_mini_sidebar'] = "customize_patient_notification";


        if ($task != "" && $type != "") {

            if ($type == 0) {
                if ($this->input->post()) {
                    
                    $array = array(
                        "subject" => $this->input->post('subject'),
                        "body" => $this->input->post('body'),
                        "is_notification" => $this->input->post('is_notify_email')
                    );

                    $this->notification->update_email_template($array, $doctor_id, $task, $type);
                    $this->session->set_flashdata('success', 'You have successfully updated patient email template');
                    redirect('doctor/notifications/customize_patient_notification/');
                }


                $email_template = $this->notification->get_default_email_template($task, $type,2);
                $user_email_template = $this->notification->get_email_template($doctor_id, $task, $type);
                if (!empty($user_email_template)) {
                    $email_template["subject"] = $user_email_template["subject"];
                    $email_template["body"] = $user_email_template["body"];
                    $email_template["is_notification"] = $user_email_template["is_notification"];
                }
                $data['email_template'] = $email_template;

                view('doctor.settings.notifications.patient.customize_patient_email_notification', $data);
            } else {
                if ($this->input->post()) {
                    $array = array(
                        "body" => $this->input->post('body'),
                        "is_notification" => $this->input->post('is_notify_sms')
                    );


                    $this->notification->update_email_template($array, $doctor_id, $task, $type);
                    $this->session->set_flashdata('success', 'You have successfully updated patient SMS template');
                    redirect('doctor/notifications/customize_patient_notification/');
                }


                $sms_template = $this->notification->get_default_email_template($task, $type,2);
                $user_sms_template = $this->notification->get_email_template($doctor_id, $task, $type);

                if (!empty($user_sms_template)) {
                    $sms_template["body"] = $user_sms_template["body"];
                    $sms_template["is_notification"] = $user_sms_template["is_notification"];
                }
                $data['sms_template'] = $sms_template;

                view('doctor.settings.notifications.patient.customize_patient_sms_notification', $data);
            }

        } 
        else 
        {
            $data["default_templates"] = $this->notification->get_default_templates('patient');
            //echo $this->db->last_query(); exit;
            view('doctor.settings.notifications.patient.customize_patient_notification', $data);
        }


    }

    public function customize_doctor_notification($task = "", $type = "")
    {
        $doctor_id = $this->session->userdata("id");
        $data = array();
        $data['active'] = "settings";
        $data['active_page'] = "notifications";
        $data['active_mini_sidebar'] = "customize_doctor_notification";

        if ($task && $type != "") {

            if ($type == 0) {
                if ($this->input->post()) {

                    $array = array(

                        "subject" => $this->input->post('subject'),
                        "body" => $this->input->post('body'),
                        "is_notification" => $this->input->post('is_notify_email')
                    );

                    $this->notification->update_email_template($array, $doctor_id, $task, $type);
                    $this->session->set_flashdata('success', 'You have successfully updated doctor email template');
                    redirect('doctor/notifications/customize_doctor_notification/');
                }


                $email_template = $this->notification->get_default_email_template($task, $type,1);
                $user_email_template = $this->notification->get_email_template($doctor_id, $task, $type);
                if (!empty($user_email_template)) {
                    $email_template["subject"] = $user_email_template["subject"];
                    $email_template["body"] = $user_email_template["body"];
                    $email_template["is_notification"] = $user_email_template["is_notification"];
                }
                $data['email_template'] = $email_template;

                view('doctor.settings.notifications.doctor.customize_doctor_email_notification', $data);
            } else {
                if ($this->input->post()) {
                    $array = array(
                        "body" => $this->input->post('body'),
                        "is_notification" => $this->input->post('is_notify_sms')
                    );

                    $this->notification->update_email_template($array, $doctor_id, $task, $type);
                    $this->session->set_flashdata('success', 'You have successfully updated doctor SMS template');
                    redirect('doctor/notifications/customize_doctor_notification/');
                }



                $sms_template = $this->notification->get_default_email_template($task, $type,1);
                $user_sms_template = $this->notification->get_email_template($doctor_id, $task, $type);

                if (!empty($user_sms_template)) {
                    $sms_template["body"] = $user_sms_template["body"];
                    $sms_template["is_notification"] = $user_sms_template["is_notification"];
                }
                $data['sms_template'] = $sms_template;

                view('doctor.settings.notifications.doctor.customize_doctor_sms_notification', $data);
            }

        } else {

            $data["default_templates"] = $this->notification->get_default_templates('doctor');
            view('doctor.settings.notifications.doctor.customize_doctor_notification', $data);
        }


    }

    public function update_notification_status()
    {
        $doctor_id = $this->session->userdata('id');

        $task = $this->input->post("task");
        $type = $this->input->post("type");
        $user_type = $this->input->post("user_type");
        $checkStatus = $this->input->post("checkStatus");

        $option = $this->db->get_where('email_template', array('doctor_id' => $doctor_id, 'task' => $task, "type" => $type))->row_array();
        if($option)
        {
            $data_arr['is_notification'] = $checkStatus;
            $this->notification->update_email_template($data_arr,$doctor_id,$task,$type);
        }
        else
        {
            $default_template = $this->notification->get_default_email_template($task,$type,$user_type);
            
            if($type == 0)
            {
                $data_arr = array(
                    "subject" => $default_template['subject'],
                    "body" => $default_template['body'],
                    "is_notification" => $checkStatus
                );  
            }
            else
            {
                $data_arr = array(
                    "body" => $default_template['body'],
                    "is_notification" => $checkStatus
                );
            }

            $this->notification->update_email_template($data_arr,$doctor_id,$task,$type);
        }
    }

    public function custom_email()
    {
        $data = array();

        $data['active'] = "settings";
        $data['active_page'] = "notifications";
        $data['active_mini_sidebar'] = "custom_email";

        view('doctor.settings.notifications.manage_custom_email', $data);
    }

    public function custom_sms()
    {
        $data = array();

        $data['active'] = "settings";
        $data['active_page'] = "notifications";
        $data['active_mini_sidebar'] = "custom_sms";

        view('doctor.settings.notifications.manage_custom_sms', $data);
    }

    public function add_custom_email($id = "")
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");
    
        $this->notification->set_table('custom_email');
        $this->notification->set_fkid("ID");

        if ($this->input->post()) {
            $post = $this->input->post();
            
            $array = array(
                            "title" => $post['template_title'],
                            "subject" => $post['subject'],
                            "body" => $post['body'],
                            "type" => 1,
                            "doctor_id" => $doctor_id
                          );

            if ($id != '') {
                $this->notification->update_custom_email($id,$doctor_id, $array);
                $this->session->set_flashdata('success', 'You have successfully updated custom email template');
                redirect('doctor/notifications/custom_email');
            } else {
                $this->notification->add_custom_email($array);
                $this->session->set_flashdata('success', 'You have successfully added custom email template');
                redirect('doctor/notifications/custom_email');
            }

        }
        if ($id != "") {
            $data['custom_email'] = $this->notification->get_custom_email($id,$doctor_id);
            $data['fkid'] = $id;
        } else {
            $data['custom_email'] = array("title" => '', "subject" => '', "body" => '');
        }



        $data['active'] = "settings";
        $data['active_page'] = "notifications";
        $data['active_mini_sidebar'] = "custom_email";

        view('doctor.settings.notifications.custom_email_notification', $data);
    }

    public function add_custom_sms($id = "")
    {
        $doctor_id = $this->session->userdata("id");
        $data = array();
        $this->notification->set_table('custom_sms');
        $this->notification->set_fkid("ID");

        if ($this->input->post()) {
            $post = $this->input->post();

            $array = array(
                "title" => $post['template_title'],
                "body" => $post['body'],
                "type" => 0,
                "doctor_id" => $doctor_id
                );

            if ($id != '') {
                $this->notification->update_custom_sms($id,$doctor_id, $array);
                $this->session->set_flashdata('success', 'You have successfully updated custom sms template');
                redirect('doctor/notifications/custom_sms');
            } else {
                $this->notification->add_custom_sms($array);
                $this->session->set_flashdata('success', 'You have successfully added custom sms template');
                redirect('doctor/notifications/custom_sms');
            }

        }

        if ($id != "") {
            $data['custom_sms'] = $this->notification->get_custom_sms($id,$doctor_id);
            $data['fkid'] = $id;
        } else {
            $data['custom_sms'] = array("title" => '', "body" => '');
        }



        $data['active'] = "settings";
        $data['active_page'] = "notifications";
        $data['active_mini_sidebar'] = "custom_sms";

        view('doctor.settings.notifications.custom_sms_notification', $data);
    }

    public function list_custom_email()
    {
        $doctor_id = $this->session->userdata("id");
        $this->load->library('Datatable');

        $joinQuery = "";
        $extraWhere = "doctor_id = $doctor_id && type = 1";


        $table = 'custom_email_sms';
        $primaryKey = 'ID';
        $columns = array(

            array('db' => 'title', 'field' => 'title'),

            array('db' => 'subject', 'field' => 'subject'),

            array('db' => 'ID', 'field' => 'ID', 'formatter' => function ($d, $row) {


                return '<div class="list-icons">
                        <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                            <i class="icon-menu9"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="' . base_url() . 'doctor/notifications/add_custom_email/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                            <a onclick="confirmbox(\'Are you sure you want to delete this custom email?\',\'' . base_url() . '/doctor/notifications/delete_email/'.$d.'/'.$row['type']. '\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                        </div>
                        </div>
                      </div>';

            }),

            array('db' => 'type', 'field' => 'type','show' => 'no'),
        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;

    }

    public function list_custom_sms()
    {
        $doctor_id = $this->session->userdata("id");
        $this->load->library('Datatable');

        $joinQuery = "";
        $extraWhere = "doctor_id = $doctor_id && type = 0";

        $table = 'custom_email_sms';
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'title', 'field' => 'title'),

            array('db' => 'ID', 'field' => 'ID', 'formatter' => function ($d,$row) {

                return '<div class="list-icons">
                        <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                            <i class="icon-menu9"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="' . base_url() . 'doctor/notifications/add_custom_sms/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                            <a onclick="confirmbox(\'Are you sure you want to delete this custom sms?\',\'' . base_url() . '/doctor/notifications/delete_sms/'.$d.'/'.$row['type'].'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                        </div>
                        </div>
                       </div>';
            }),

            array('db' => 'type', 'field' => 'type','show' => 'no')
        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        // /echo $this->datatable->sql; exit;
    }

    public function delete_email($id,$type)
    {
        $doctor_id = $this->session->userdata("id");
        $this->notification->delete_custom_email_sms($id,$doctor_id,$type);
        $this->session->set_flashdata('success', 'Custom email notification has been deleted successfully.');
        redirect('doctor/notifications/custom_email/');
    }

    public function delete_sms($id,$type)
    {
        $doctor_id = $this->session->userdata("id");
        $this->notification->delete_custom_email_sms($id,$doctor_id,$type);
        $this->session->set_flashdata('success', 'Custom sms notification has been deleted successfully.');
        redirect('doctor/notifications/custom_sms/');
    }

    
}

?>