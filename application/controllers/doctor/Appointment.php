<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment extends MY_Doctor_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("doctor/Doctor_appointment_model", "appointment");
        $this->load->model("doctor/Doctor_Patient_model", "patient");
        $this->load->model("doctor/Doctor_setting_model", "settings");
        $this->load->model("doctor/Doctor_model", "doctor");
        $this->load->library('session');
    }

    public function index()
    {
    }

    public function manage($type = 3)
    {
        $data = array();
        $data['active'] = "appointments";
        
        if($type == 3)
        {
            $data['title'] = "All Appointments";
            $data['active_page'] = "appointments";
            $data['type'] = $type;
            $data['where'] = 'appointment.status_appointment != 2';
        }
        elseif($type == 0)
        {
            $data['title'] = "Pending Appointments";
            $data['active_page'] = "pending";
            $data['type'] = $type;
            $data['where'] = 'appointment.status_appointment = 0';
        }
        elseif($type == 1)
        {
            $data['title'] = "Active Appointments";
            $data['active_page'] = "active";
            $data['type'] = $type;
            $data['where'] = 'appointment.status_appointment = 1';
        }
        elseif($type == 2)
        {
            $data['title'] = "Cancel Appointments";
            $data['active_page'] = "cancelled";
            $data['type'] = $type;
            $data['where'] = 'appointment.status_appointment = 2';

        }
        
        view('doctor.appointment.manage_appointment', $data);
    }

    public function calendar()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');

        $data["categories"] = $this->appointment->get_app_category_all($doctor_id);
        $data['active'] = "appointments";
        $data['active_page'] = "appointments_calendar";

        view('doctor.appointment.calendar_appointment', $data);
    }

    public function availability()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $data['doctor_id'] = $doctor_id;

        $data["monday"] = $this->appointment->get_time_slot(1, $doctor_id);
        $data["tuesday"] = $this->appointment->get_time_slot(2, $doctor_id);
        $data["wednesday"] = $this->appointment->get_time_slot(3, $doctor_id);
        $data["thursday"] = $this->appointment->get_time_slot(4, $doctor_id);
        $data["friday"] = $this->appointment->get_time_slot(5, $doctor_id);
        $data["saturday"] = $this->appointment->get_time_slot(6, $doctor_id);
        $data["sunday"] = $this->appointment->get_time_slot(7, $doctor_id);

        $data['active'] = "appointments";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "manage_availability";



        view('doctor.appointment.set_availablity', $data);
    }

    public function manage_holidays()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $data['doctor_id'] = $doctor_id;


        $allHoliday = $this->appointment->get_AllHoliday($doctor_id);
        $holidays = array();

        if($allHoliday)
        {
            foreach ($allHoliday as $single_holiday)
            {
                if($single_holiday["repeat_year"] == 0)
                {
                    $holidays[] = array(
                        "day" => $single_holiday["day"],
                        "month" => $single_holiday["month"],
                        "year" => $single_holiday["year"]
                    );
                }
                else
                {
                    $holidays[] = array(
                        "day" => $single_holiday["day"],
                        "month" => $single_holiday["month"],
                        "year" => 0
                    );
                }

            }

        }

        $data['active'] = "appointments";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "manage_holidays";
        $data['holidays'] = $holidays;



        view('doctor.appointment.set_holiday', $data);

    }

    public function add_availability($manage_type)
    {
        $doctor_id = $this->session->userdata('id');
        $data = array();
        
        if ($this->input->post()) 
        {
            
             $app_type = $this->input->post("app_type");
             $month_date = $this->input->post("month_date");

             if($app_type == 0){
               
                    $insrt_arr = array(
                        "doctor_id" => $doctor_id,
                        "title" => $this->input->post("title"),
                        "start_time" => $this->input->post("start_time"),
                        "end_time" => $this->input->post("end_time"),
                        "no_space" => $this->input->post("no_space"),
                        "app_type" => $app_type,
                        "day_type" => $this->input->post("day_type"),
                        "manage_type" => $this->input->post("manage_type"),
                        "month_date" => "0000-00-00"
                    );
                    $this->appointment->add_time_slot($insrt_arr);
                
             }
             else 
             {
                $time_between = $this->input->post("time_between");
                $every_hour = $this->input->post("every_hour");
                $start_time = $this->input->post("start_time");

                sscanf($start_time, "%d:%d", $hours, $minutes);
                $start_seconds = $hours * 60 * 60 + $minutes * 60;

                $end_time = $this->input->post("end_time");
                sscanf($end_time, "%d:%d", $ehours, $eminutes);
                $end_seconds = $ehours * 60 * 60 + $eminutes * 60;

                $time = mktime(0, 0, 0, 1, 1);
                $next_step_start = 0;
                for ($i = $start_seconds; $i < $end_seconds;) 
                {
                    $start_point = get_time($i);

                    $end_point_seconds = $i + $every_hour;
                    $end_point = get_time($end_point_seconds);

                    $i = $time_between + $end_point_seconds;

                        $inser_arr = array(
                            "doctor_id" => $doctor_id,
                            "title" => $this->input->post("title"),
                            "start_time" => $start_point,
                            "end_time" => $end_point,
                            "no_space" => $this->input->post("no_space"),
                            "app_type" => $app_type,
                            "day_type" => $this->input->post("day_type"),
                            "manage_type" => $this->input->post("manage_type"),
                            "month_date" => "0000-00-00"
                        );
                        $this->appointment->add_time_slot($inser_arr);
                   
                }

             }

            $this->session->set_flashdata('Message',"Time Slot has been added successfully.");
        }

        $data['active'] = "availability";
        $data['type'] = $manage_type;

        view('doctor.appointment.add_availability', $data);
    }

    public function get_time_slot()
    {
        $doctor_id = $this->input->post("doctor_id");
        $doctor_info = $this->doctor->get_single_doctor($doctor_id);
        //$timeslot_manage = $this->appointment->get_timeslot_manage_type($doctor_id);

        $date = $this->input->post("date_start");
        $day = date("D", strtotime($date));
        $date_new = date("Y-m-d", strtotime($date));


        
            if ($day == "Mon") {
                $day_data = $this->appointment->get_time_slot_appointment(1, $doctor_id, $date_new);

            } elseif ($day == "Tue") {
                $day_data = $this->appointment->get_time_slot_appointment(2, $doctor_id, $date_new);

            } elseif ($day == "Wed") {
                $day_data = $this->appointment->get_time_slot_appointment(3, $doctor_id, $date_new);
            } elseif ($day == "Thu") {
                $day_data = $this->appointment->get_time_slot_appointment(4, $doctor_id, $date_new);
            } elseif ($day == "Fri") {
                $day_data = $this->appointment->get_time_slot_appointment(5, $doctor_id, $date_new);
            } elseif ($day == "Sat") {
                $day_data = $this->appointment->get_time_slot_appointment(6, $doctor_id, $date_new);
            } elseif ($day == "Sun") {
                $day_data = $this->appointment->get_time_slot_appointment(7, $doctor_id, $date_new);
            }

        $exist = false;
        $curr_time = date("H:i:00");
        $curr_date = date("Y-m-d");
        
        if($day_data){

            $counter = 0;
            foreach ($day_data as $data) {

                if ($curr_date == $date_new) {

                    if ($curr_time > $data["start_time"]) {
                        continue;
                    }
                }


                $class = 'btn-info book';

                if ($data["count_app"] > 0) {

                    if ($counter == 0) {
                        echo $html_head = '<div class="col-md-12"><span class="fw600 fs14">Available Appointment Times:&nbsp; <span class="fw400">' . date("M d, Y", strtotime($date)) . '</span></span><a class="remove_selected" data-class="btn ' . $class . '" style="float: right;font-size: 12px;color: #3bafda;
                   font-weight: 700;margin-right: 4px;padding-left: 7px;padding-right: 8px;padding-top: 2px;padding-bottom: 2px;cursor: pointer;text-decoration: none;">X Clear</a><hr style="margin-top: 5px;margin-bottom: 15px;"></div>';
                        $counter++;
                    }

                    $exist = true;

                    echo $html = '<div class="col-md-12">
                     <span class="fw600" style="color:black">' . date("h:i A", strtotime($data["start_time"])) . '-' . date("h:i A", strtotime($data["end_time"])) . '</span><a class="btn ' . $class . '" data-class="btn ' . $class . '" style="float:right; border-radius:5px;" 
                     data-time="' . date("h:i A", strtotime($data["start_time"])) . '-' . date("h:i A", strtotime($data["end_time"])) . '" 
                     data-hours="' . date("h", strtotime($data["start_time"])) . '" 
                     data-minutes="' . date("i", strtotime($data["start_time"])) . '" 
                     data-daynight="' . date("A", strtotime($data["start_time"])) . '"
                     data-pkslotid="' . $data["pkslotid"] . '"> Book Now </a><br /><span class="fw600" style="color: #8E8E8E;">' . $data["count_app"] . ' spaces available</span><hr style="margin-top: 15px;margin-bottom: 15px;"></div>';
                }

            }
        }

        if (!$exist) {
            echo $html_head = '<div class="col-md-12"><span class="fw600 fs14">No Appointments Slot Available on <span style="color:red;">' . date("M d, Y", strtotime($date)) . '</span></span><hr style="margin-top: 5px;margin-bottom: 15px;"><span class="fs12" style="font-weight: 700;">This day does not have any avaliable appointment slots set up for it.</span><br><a href="' . base_url("doctor/appointment/manage_availability/") . '" class="fs12" style="color:#3BAFDA;font-weight: 700;cursor:pointer;text-decoration:none;"> >&nbsp;Manage Availability Here</a></div>';
        }


    }

    public function add_appointment($patientID = "")
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");
        
        $settings = $this->settings->get_settings($doctor_id);
        $settings_arr['date_selected_color'] = isset($settings['date_selected_color']) ? $settings['date_selected_color'] : '';
        $settings_arr['date_selected_text_color'] = isset($settings['date_selected_text_color']) ? $settings['date_selected_text_color'] : '';
        $settings_arr['date_selected_custom_text'] = isset($settings['date_selected_custom_text']) ? $settings['date_selected_custom_text'] : '';
        $settings_arr['date_available_color'] = isset($settings['date_available_color']) ? $settings['date_available_color'] : '';
        $settings_arr['date_available_text_color'] = isset($settings['date_available_text_color']) ? $settings['date_available_text_color'] : '';
        $settings_arr['date_available_custom_text'] = isset($settings['date_available_custom_text']) ? $settings['date_available_custom_text'] : '';        
        $settings_arr['calendar_color_all'] = isset($settings['calendar_color_all']) ? $settings['calendar_color_all'] : '';
        $settings_arr['calendar_text_color_all'] = isset($settings['calendar_text_color_all']) ? $settings['calendar_text_color_all'] : '';
        $settings_arr['calendar_text_custom_all'] = isset($settings['calendar_text_custom_all']) ? $settings['calendar_text_custom_all'] : '';
        
        
        $data['settings'] = $settings_arr;
        $data['patient'] = $this->patient->get_patient($patientID);

        if ($this->input->post()) {
            $post = $this->input->post();
           
                $patient_type = $this->input->post("patient_type");
                $patient_id = $this->input->post("patient_id");
                
                if ($patient_type == 0)
                {
                    $patient_id = $this->patient->add_patient_appointment();
                } 
                else 
                {
                    if ($this->input->post("email_exist") != "" || $this->input->post("phone_exist") != "")
                    {
                        if($post["email_exist"] != "")
                        {
                             $update_arr['patient_email'] = $post["email_exist"];
                        }
                        if($post["phone_exist"] != "")
                        {
                             $update_arr['patient_phone'] = $post["phone_exist"];
                        }

                        $this->patient->update_patient_fields($patient_id,$update_arr);
                    }
                }
            
            $appointment_id = $this->appointment->add_appointment($doctor_id, $patient_id);

            if (isset($post['patient_notify_email']) && $post['patient_notify_email'] == 1) {
                $notify_type = $post['patient_notify_email'];
                $priorities = $this->input->post('patient_schedule_prior');

                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 0);
                    }
                }

            }

            if (isset($post['patient_notify_sms']) && $post['patient_notify_sms'] == 0) {
                $notify_type = $post['patient_notify_sms'];
                $priorities = $this->input->post('patient_schedule_prior');

                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 0);
                    }
                }
            }

            if (isset($post['physician_notify_email']) && $post['physician_notify_email'] == 1) {
                $notify_type = $post['physician_notify_email'];
                $priorities = $this->input->post('physician_schedule_prior');

                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 1);
                    }
                }

            }

            if (isset($post['physician_notify_sms']) && $post['physician_notify_sms'] == 0) {
                $notify_type = $post['physician_notify_sms'];
                $priorities = $this->input->post('physician_schedule_prior');
                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 1);
                    }
                }
            }

            $this->session->set_flashdata('success', "Your appointment has been added successfully");
            redirect("doctor/appointment/manage/3");
        }

        $data['categories'] = $this->appointment->get_app_category_all($doctor_id);
        $data['disable_day'] = $this->appointment->get_disable_day($doctor_id);
        $data['holidays'] = $this->appointment->get_enabled_holidays($doctor_id);
        $data['disable_days'] = $this->appointment->get_disable_days($doctor_id);
        $data['services'] = $this->appointment->get_services();
       
        $data['doctor_id'] = $doctor_id;
        $data['patientID'] = $patientID;
        $data['title'] = "Add Appointment";
        $data['active'] = "appointments";
        $data['active_page'] = "appointment_add";

        view('doctor.appointment.add_appointment', $data);

    }

    public function edit_appointment($appointment_id)
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");

        $settings = $this->settings->get_settings($doctor_id);
        $settings_arr['date_selected_color'] = isset($settings['date_selected_color']) ? $settings['date_selected_color'] : '';
        $settings_arr['date_selected_text_color'] = isset($settings['date_selected_text_color']) ? $settings['date_selected_text_color'] : '';
        $settings_arr['date_selected_custom_text'] = isset($settings['date_selected_custom_text']) ? $settings['date_selected_custom_text'] : '';
        $settings_arr['date_available_color'] = isset($settings['date_available_color']) ? $settings['date_available_color'] : '';
        $settings_arr['date_available_text_color'] = isset($settings['date_available_text_color']) ? $settings['date_available_text_color'] : '';
        $settings_arr['date_available_custom_text'] = isset($settings['date_available_custom_text']) ? $settings['date_available_custom_text'] : '';        
        $settings_arr['calendar_color_all'] = isset($settings['calendar_color_all']) ? $settings['calendar_color_all'] : '';
        $settings_arr['calendar_text_color_all'] = isset($settings['calendar_text_color_all']) ? $settings['calendar_text_color_all'] : '';
        $settings_arr['calendar_text_custom_all'] = isset($settings['calendar_text_custom_all']) ? $settings['calendar_text_custom_all'] : '';
        
        
        $data['settings'] = $settings_arr;

        if ($this->input->post()) 
        {

            $post = $this->input->post();
            $patient_id = $post['patient_id'];
            
            $this->appointment->update_appointment($appointment_id, $doctor_id);

            if (isset($post['patient_notify_email']) && $post['patient_notify_email'] == 1) {
                $notify_type = $post['patient_notify_email'];
                $priorities = $this->input->post('patient_schedule_prior');

                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 0);
                    }
                }

            }

            if (isset($post['patient_notify_sms']) && $post['patient_notify_sms'] == 0) {
                $notify_type = $post['patient_notify_sms'];
                $priorities = $this->input->post('patient_schedule_prior');

                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 0);
                    }
                }
            }

            if (isset($post['physician_notify_email']) && $post['physician_notify_email'] == 1) {
                $notify_type = $post['physician_notify_email'];
                $priorities = $this->input->post('physician_schedule_prior');

                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 1);
                    }
                }

            }

            if (isset($post['physician_notify_sms']) && $post['physician_notify_sms'] == 0) {
                $notify_type = $post['physician_notify_sms'];
                $priorities = $this->input->post('physician_schedule_prior');
                if ($priorities) {
                    foreach ($priorities as $priority) {
                        $this->appointment->appointment_scheduler($doctor_id, $patient_id, $appointment_id, $notify_type, $priority, 1);
                    }
                }
            }

            $this->session->set_flashdata('success', "Your appointment has been updated successfully");
            redirect("doctor/appointment/manage/3");
        }


        $data['disable_day'] = $this->appointment->get_disable_day($doctor_id);
        $data['holidays'] = $this->appointment->get_enabled_holidays($doctor_id);
        $data['disable_days'] = $this->appointment->get_disable_days($doctor_id);
        $data['categories'] = $this->appointment->get_app_category_all($doctor_id);

        $data['scheduled_notifications'] = $this->appointment->get_appointment_scheduled_notification($appointment_id);
        $appointment = $this->appointment->get_appointment($appointment_id, $doctor_id);
        $data['patient'] = $this->patient->get_patient($appointment['patient_id']);
        $data['appointment'] = $appointment;
        $data['services'] = $this->appointment->get_services();

        $data['doctor_id'] = $doctor_id;
        $data['title'] = "Edit Appointment";
        $data['active'] = "appointments";
        $data['active_page'] = "appointments";

        view('doctor.appointment.edit_appointment', $data);
    }

    public function calendar_appointment()
    {
        $doctor_id = $this->session->userdata('id');

        $query = $this->db->query("SELECT * FROM `appointment` 
		LEFT JOIN patient ON (appointment.patient_id = patient.patient_user_id)
        LEFT JOIN doctor ON (appointment.doctor_id = doctor.doctor_user_id) 
        LEFT JOIN app_category ON (appointment.fk_app_categoryid = app_category.pk_app_categoryid) 
        WHERE appointment.doctor_id = $doctor_id");

        $result = $query->result_array();

        foreach ($result as $row) {
            $cat_color = strstr($row['app_cat_color'], "_", true);

            $status_appointment = $row["status_appointment"];
            if($status_appointment == 0)
            {
                $appointment_color = "text-danger";
                $appointment_status = "Pending";

            }
            else
            {
                $appointment_color = "text-success";
                $appointment_status = "Active";
            }



            $_appointments[] = array(
                "doctor_id" => $row['doctor_id'],
                "patient_id" => $row['patient_id'],
                "appointment_date" => date("M d, Y", strtotime($row['appointment'])),
                "appointment_time" => date("h:i A", strtotime($row['appointment'])),

                "title" => date("h:i a", strtotime($row['appointment'])),

                "patient_name" => $row['patient_fname'] . '' . $row['patient_lname'],
                "patient_email" => $row['patient_email'],
                "patient_phone" => $row['patient_phone'],


                "pk_appointment_id" => $row['pk_appointment_id'],
                "fk_app_category_id" => $row['fk_app_categoryid'],
                "fkslotid" => $row['fkslotid'],
                "app_cat_color" => $cat_color,





                "start" => str_replace(" ", "T", date("Y-m-d H:i:s", strtotime($row['appointment']))),
                "allDay" => false,
                'appointment_status'=>$appointment_status,
                'appointment_color'=>$appointment_color


            );

        }

        echo json_encode($_appointments);

    }

    public function list_appointment()
    {
        $doctor_id = $this->session->userdata('id');
        $this->load->library('Datatable');

        $Where = '';
        if (isset($_POST["extra_where"]) && $_POST["extra_where"] != "") {
            $Where .= $_POST["extra_where"];
        }
        
        $joinQuery = " FROM `appointment` 
		LEFT JOIN patient ON (appointment.patient_id = patient.patient_user_id)
        LEFT JOIN doctor ON (appointment.doctor_id = doctor.doctor_user_id) 
        LEFT JOIN app_category ON (appointment.fk_app_categoryid = app_category.pk_app_categoryid) 
        WHERE $Where && appointment.doctor_id = $doctor_id ";

        $extraWhere = "";
        $table = 'appointment';
        $primaryKey = 'pk_appointment_id';
        $columns = array(


            array('db' => 'appointment', 'field' => 'appointment', 'formatter' => function ($d, $row) {

                return date("M d, Y", strtotime($d));
            }),
            array('db' => 'appointment', 'field' => 'appointment', 'formatter' => function ($d, $row) {

                return date("h:i A", strtotime($d));
            }),
            array('db' => 'patient.patient_fname', 'field' => 'patient_fname', 'formatter' => function ($d, $row) {

                return $name = $d . ' ' . $row['patient_lname'];
            }),

            array('db' => 'app_category.app_cat_color', 'field' => 'app_cat_color', 'formatter' => function ($d, $row) {

                if ($d) {
                    $color = explode('_', $d);
                    $label = "<label class='px-2 py-1 m-0 rounded' style='background-color:$color[0];color:$color[1];'>" . $row['name'] . "</label>";

                } else {
                    $label = '<label class="border-1 m-0 px-2 py-1 rounded">Add Category</label>';

                }

                return $label;
            }),

            array('db' => 'status_appointment', 'field' => 'status_appointment', 'formatter' => function ($d,$row) {

                $status = '';
                
                if($d == 0) 
                {
                    $status = "Pending";                    
                } 
                elseif($d == 1)
                {
                    $status = "Active";
                }
                elseif($d == 2)
                {
                    $status = "Cancelled";
                }

                $status_btn = '<button type="button" data-appointment='.$row['pk_appointment_id'].' data-status='.$d.' class="btn btn-default status_btn">'.$status.'</button>';

                return $status_btn;
            }),

            array('db' => 'pk_appointment_id', 'field' => 'pk_appointment_id', 'formatter' => function ($d, $row) {
            
            $actions = '';
            $actions .= '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">';
                                
                            if($row['status_appointment'] != 2)
                            {
                        
                            $actions         .='<a href="' . base_url() . 'doctor/appointment/edit_appointment/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                                <a onclick="confirmbox(\'Are you sure you want to cancel this Appointment?\',\'' . base_url() . 'doctor/appointment/cancel_appointment/' . $d . '\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Cancel</a>';
                            }                
                            else
                            {
                            $actions         .= '<a onclick="confirmbox(\'Are you sure you want to restore this Appointment?\',\'' . base_url() . 'doctor/appointment/restore_appointment/' . $d . '\')" class="dropdown-item"><i class="fa fa-undo" ></i>Restore</a>';   
                            }
                            
            $actions        .= '</div>
                            </div>
                         </div>';

            return $actions;
                         
            }),

            array('db' => 'app_category.name', 'field' => 'name', "show" => 'no'),

            array('db' => 'patient.patient_lname', 'field' => 'patient_lname', "show" => 'no')
        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;
    }

    public function cancel_appointment($appointment_id)
    {
        $this->appointment->update_appointment_fields($appointment_id,array("status_appointment" => 2));
        $this->session->set_flashdata('success', 'Appointment has been cancelled successfully');
        redirect('doctor/appointment/manage/3');
    }

    public function restore_appointment($appointment_id)
    {
        $this->appointment->update_appointment_fields($appointment_id,array("status_appointment" => 1));
        $this->session->set_flashdata('success', 'Appointment has been restored successfully');
        redirect('doctor/appointment/manage/2');
    }

    public function delete_appointment_notification($id, $appointment_id)
    {
        $this->appointment->delete_appointment_notification($id);
        redirect('doctor/appointment/edit_appointment/' . $appointment_id);
    }

    public function clear_time_slots($day_type)
    {
        $this->appointment->clear_time_slot($day_type);
        redirect(base_url('doctor/appointment/availability/'));
        exit;
    }

    public function delete_time_slot($slot_id = "")
    {
        $this->appointment->delete_time_slot($slot_id);
        redirect(base_url('doctor/appointment/availability'));
    }

    public function manage_appointment_category()
    {
        $data = array();
        
        $data['active'] = "appointment";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "appointment_cat";

        view('doctor.appointment.manage_appointment_category', $data);
    }

    public function add_appointment_category()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');

        if ($this->input->post()) {

                $insert_data = array(
                    "doctor_id" => $doctor_id,
                    "name" => $this->input->post('app_category_name'),
                    "app_cat_color" => $this->input->post('app_cat_color')
                );
            $this->appointment->add_app_category($insert_data);
            $this->session->set_flashdata('success', 'Successfully added appointment category');
            redirect(base_url('doctor/appointment/manage_appointment_category'));
        }

        $data['active'] = "appointment";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "appointment_cat";

        view('doctor.appointment.add_appointment_category', $data);
    }

    public function edit_appointment_category($id)
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");

        if ($this->input->post()) {
            $update_data = array(
                "doctor_id" => $doctor_id,
                "name" => $this->input->post('app_category_name'),
                "app_cat_color" => $this->input->post('app_cat_color')
            );
            $this->appointment->edit_app_category($id,$update_data);
            $this->session->set_flashdata('success', 'Successfully updated appointment category');
            redirect(base_url('doctor/appointment/manage_appointment_category'));
        }


        $data['active'] = "appointment";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "appointment_cat";

        $data['page_title'] = 'Edit Appointment Category';
        $data['category'] = $this->appointment->get_app_category($id);

        view('doctor.appointment.edit_appointment_category', $data);
    }

    public function list_category()
    {
        $doctor_id = $this->session->userdata('id');
        $this->load->library('Datatable');


        $joinQuery = "";
        $extraWhere = "";


        $table = 'app_category';
        $primaryKey = 'pk_app_categoryid';
        $columns = array(

            
            array('db' => 'name', 'field' => 'name'),

            array('db' => 'pk_app_categoryid', 'field' => 'pk_app_categoryid', 'formatter' => function ($d, $row) {

                return '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="' . base_url() . 'doctor/appointment/edit_appointment_category/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this Appointment Category?\',\'' . base_url() . 'doctor/appointment/delete_app_category/' . $d . '\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                            </div>
                            </div>
                          </div>';
            })
        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));

        //echo $this->datatable->sql;
    }


    public function delete_app_category($id)
    {
        $this->appointment->delete_app_category($id);
        $this->session->set_flashdata('success', 'Successfully appointment has been deleted');
        redirect(base_url('doctor/appointment/manage_appointment_category'));

    }

    public function update_appointment_category()
    {
        if ($this->input->post()) {
            $this->appointment->update_appointment_category();
        }
    }

    public function get_holiday()
    {
        $doctor_id = $this->session->userdata('id');

        $selectedDate = date("Y-m-d", strtotime($_GET['cdate']));
        $holiday = $this->appointment->get_holiday($doctor_id, $selectedDate);

        $content_str = "<form method='post' id='form'>
                                <div class='form-group mb-0 ml-2 mt-3'>
                                    <label for='holiday'>";

        $content_str .=  $holiday != "" ? "<input type='checkbox' name='holiday' value='1' class='mr-2' id='holiday' checked>I am not working on this day." : "<input type='checkbox' name='holiday' value='1' class='mr-2' id='holiday'>I am not working on this day.";


        $content_str .= "</div>
                                 <div class='form-group mb-0 ml-4'> 
                                    <label for='repeat'>";

        $content_str .= isset($holiday['repeat_year']) && $holiday['repeat_year'] == 1 ? "<input type='checkbox' name='repeat' value='1' class='mr-2' id='repeat' checked>Repeat Every Year</label>" : "<input type='checkbox' name='repeat' value='1' class='mr-2' id='repeat'>Repeat Every Year</label>";


        $content_str .= $holiday != "" ? "<input type='hidden' name='is_holiday_set' value='" . $holiday['pkid'] . "'>" : "<input type='hidden' name='is_holiday_set' value='0'>";

        $content_str .= "</div>
                            </form>";


        header('Content-Type: application/json');

        echo json_encode(array("content" => $content_str));
        exit;
    }

    public function set_holiday()
    {
        header('Content-Type: application/json');
        $doctor_id = $this->session->userdata('id');
        $holiday = date("Y-m-d", strtotime($_POST['currentDate']));
        $formData = array();
        parse_str($_POST['form'], $formData);

        $is_holiday = $formData['is_holiday_set'];
        $is_repeat = isset($formData['repeat']) ? $formData['repeat'] : 0;
        $set_holiday = isset($formData['holiday']) ? $formData['holiday'] : 0;

        if ($is_holiday == 0) {
            $insert_arr = array(
                "doctor_id" => $doctor_id,
                "holiday_date" => $holiday,
                "repeat_year" => $is_repeat
            );

            $this->appointment->set_holiday($insert_arr);
        } else {
            if ($set_holiday == 1) {
                $update_arr = array(
                    "doctor_id" => $doctor_id,
                    "repeat_year" => $is_repeat
                );

                $this->appointment->update_holiday($is_holiday, $update_arr);
            } else {
                $this->appointment->delete_holiday($is_holiday);
            }
        }


        $allHoliday = $this->appointment->get_AllHoliday($doctor_id);
        $holidays = array();
        if($allHoliday)
        {
            foreach ($allHoliday as $single_holiday)
            {
                if($single_holiday["repeat_year"] == 0)
                {
                    $holidays[] = array(
                        "day" => $single_holiday["day"],
                        "month" => $single_holiday["month"],
                        "year" => $single_holiday["year"]
                    );
                }
                else
                {
                    $holidays[] = array(
                        "day" => $single_holiday["day"],
                        "month" => $single_holiday["month"],
                        "year" => 0
                    );
                }

            }

        }
        echo json_encode($holidays);
        exit;

    }

    public function services()
    {
       $data = array();
       
       $data['active'] = "appointments";
       $data['active_page'] = "appointment_settings";
       $data['active_mini_sidebar'] = "services";
       
       view('doctor.appointment.manage_services', $data);
    }

    public function list_services()
    {
      
        $doctor_id = $this->session->userdata('id');
        $this->load->library('Datatable');

        $joinQuery = "FROM services LEFT JOIN app_category ON (services.fk_category_id = app_category.pk_app_categoryid)
                      WHERE services.doctor_id = $doctor_id";

        $extraWhere = "";


        $table = 'services';
        $primaryKey = 'pk_service_id';
        $columns = array(

           
            array('db' => 'title', 'field' => 'title'),
 
            array('db' => 'name', 'field' => 'name'),
 
            array('db' => 'price', 'field' => 'price'),

            array('db' => 'pk_service_id', 'field' => 'pk_service_id', 'formatter' => function ($d, $row) {

                return '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="' . base_url() . 'doctor/appointment/edit_service/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this service?\',\'' . base_url() . 'doctor/appointment/delete_service/' . $d . '\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                            </div>
                            </div>
                          </div>';
            })
        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));
        //echo $this->datatable->sql;
    }

    public function add_service()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $data['categories'] = $this->appointment->get_app_category_all();

        if ($this->input->post()) {
           
            $insert_data = array(

                "title" => $this->input->post('title'),
                "fk_category_id" => $this->input->post('category'),
                "color" => $this->input->post('color'),
                "price" => $this->input->post('price'),
                "info" => $this->input->post('info'), 
                "doctor_id" => $doctor_id
            );

            $this->appointment->add_service($insert_data);
           
            $this->session->set_flashdata('success', 'Successfully added service');
            redirect(base_url('doctor/appointment/services'));
        }

        $data['active'] = "appointments";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "services";
        
        view('doctor.appointment.add_service', $data);

    }

    public function edit_service($id)
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $data['categories'] = $this->appointment->get_app_category_all();
        $data['service'] = $this->appointment->get_service($id);

        if ($this->input->post()) {
           
            $update_data = array(

                "title" => $this->input->post('title'),
                "fk_category_id" => $this->input->post('category'),
                "color" => $this->input->post('color'),
                "price" => $this->input->post('price'),
                "info" => $this->input->post('info'), 
                "doctor_id" => $doctor_id
            );

            $this->appointment->edit_service($id,$update_data);
           
            $this->session->set_flashdata('success', 'Successfully updated service');
            redirect(base_url('doctor/appointment/services'));
        }

        $data['active'] = "appointments";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "services";

        view('doctor.appointment.edit_service', $data);
    }

    public function delete_service($id)
    {
        $this->appointment->delete_service($id);
        $this->session->set_flashdata('success', 'Successfully deleted service');
        redirect(base_url('doctor/appointment/services'));
    }

    public function extra_services()
    {
        $data = array();
        
        $data['active'] = "appointments";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "extra_services";

        view('doctor.appointment.manage_extra_services', $data);
    }

    public function list_extra_services()
    {
        $doctor_id = $this->session->userdata('id');
        $this->load->library('Datatable');


        $joinQuery = "";
        $extraWhere = "doctor_id = $doctor_id";


        $table = 'extra_services';
        $primaryKey = 'pk_extra_service_id';
        $columns = array(

            array('db' => 'name', 'field' => 'name'),

            array('db' => 'price', 'field' => 'price'),
            
            array('db' => 'info', 'field' => 'info'),
           
            array('db' => 'pk_extra_service_id', 'field' => 'pk_extra_service_id', 'formatter' => function ($d, $row) {

                return '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="' . base_url() . 'doctor/appointment/edit_extra_service/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this extra service?\',\'' . base_url() . 'doctor/appointment/delete_extra_service/' . $d . '\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                            </div>
                            </div>
                          </div>';
            })
        );


        $c = array();
        foreach ($columns as $key => $value) {
            $value["dt"] = $key;
            $c[] = $value;
        }
        echo json_encode($this->datatable->simple($_POST, $table, $primaryKey, $c, $joinQuery, $extraWhere));
        //echo $this->datatable->sql;
    }

    public function add_extra_service()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $data['services'] = $this->appointment->get_services();

        if ($this->input->post()) {

            $insert_data = array(

                "name" => $this->input->post('title'),
                "price" => $this->input->post('price'),
                "info" => $this->input->post('info'), 
                "doctor_id" => $doctor_id
            );

            $this->appointment->add_extra_service($insert_data);

           

            $this->session->set_flashdata('success', 'Successfully added service category');
            redirect(base_url('doctor/appointment/extra_services'));
        }

        $data['active'] = "appointments";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "extra_services";

        view('doctor.appointment.add_extra_service', $data);

    }

    public function edit_extra_service($id)
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");
        $data['services'] = $this->appointment->get_services();
        $data['extra_service'] = $this->appointment->get_extra_service($id);

        $multipleServices = $this->appointment->get_extra_service_linking($id);
        $data['multiple_services'] = array();
        if ($multipleServices)
        {
            foreach($multipleServices as $service)
            {
                $data['multiple_services'][] = $service['fk_service_id'];
            }
        }
       
        if ($this->input->post()) {

            $update_data = array(

                "name" => $this->input->post('title'),
                "price" => $this->input->post('price'),
                "info" => $this->input->post('info'), 
                "doctor_id" => $doctor_id
            );

            $this->appointment->edit_extra_service($id,$update_data);
           

            $this->session->set_flashdata('success','Successfully updated service category');
            redirect(base_url('doctor/appointment/extra_services'));
        }


        $data['active'] = "appointments";
        $data['active_page'] = "appointment_settings";
        $data['active_mini_sidebar'] = "extra_services";
       
        view('doctor.appointment.edit_extra_service', $data);
    }

    public function delete_extra_service($id)
    {
        $this->appointment->delete_extra_service($id);
       
        $this->session->set_flashdata('success', 'Successfully deleted extra service');
        redirect(base_url('doctor/appointment/extra_services'));
    }

    public function get_status_content($appointment_id,$status)
    {
        $content = '';
        $content .= '<form method="POST">
                       
                       <div class="row">
                         <div class="col-md-12 col-lg-12 col-sm-12">
                           
                         <div class="form-group">
                           <label for="select_status">Select Status</label>
                           <select name="status" class="form-control status" >';
                
                $class = $status == 1 ? 'selected' : '';
                
                    $content .= '<option value="1" '.$class.'>Active</option>';
                
                $class = $status == 0 ? 'selected' : '';
               
                    $content .= '<option value="0" '.$class.'>Pending</option>';
                
                $class = $status == 2 ? 'selected' : '';
                
                    $content .= '<option value="2" '.$class.'>Cancelled</option>';    

            $content .= '</select>
                         </div>';
        
            // $class = $status != 1 ? 'hidden' : '';             
          
            // $content .=      '<div class="notify_div '.$class.'">
            //                 <div class="form-group">
            //                 <div class="custom-control custom-checkbox">
            //                     <input type="checkbox" class="custom-control-input send_approve_email" name="is_email" value="1" id="send_approve_email ">
            //                     <label class="custom-control-label" for="send_approve_email ">Send "Approved" Patient Email</label>
            //                 </div>
            //                 <div class="custom-control custom-checkbox">
            //                     <input type="checkbox" class="custom-control-input send_approve_sms" name="is_sms" value="1" id="send_approve_sms ">
            //                     <label class="custom-control-label" for="send_approve_sms ">Send "Approved" Patient SMS Text</label>
            //                 </div>
            //                 </div>
            //              </div>';
       
        
        $content .=     '<hr class="solid">
                          <div class="form-group>
                            <button type="button" class="btn btn-light"></button><button type="button" data-appointment='.$appointment_id.' class="btn btn-primary btn-sm pull-right status_update">Update</button>
                          </div>

                         </div>
                       </div>
        
                     </form>';

        
        $content_arr = array(
                  
                    "title" => "Update Appointment Status",
                    "appointment_id" => $appointment_id,
                    "status" => $status,
                    "html" => $content
        );             

        echo json_encode($content_arr);             
    }

    public function update_appointment_status()
    {
        if($this->input->post())
        {
            $patient_id = $this->input->post('appointment_id');
            $status = $this->input->post('status');
            $this->appointment->update_appointment_fields($patient_id,array("status_appointment" => $status));
        }
    }



}


?>    