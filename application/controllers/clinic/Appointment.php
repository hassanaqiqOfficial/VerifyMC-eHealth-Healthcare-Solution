<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class Appointment extends MY_Clinic_Controller
 {
    public function __construct()
	{
		parent::__construct();
          $this->load->library('session');
          $this->load->model("clinic/Clinic_appointment_model","appointment");
          $this->load->model("clinic/Clinic_Patient_model","patient");
          $this->load->model("clinic/Clinic_Doctor_model","doctors");
          
    }
		
    public function index()
    {
        $data = array();
        $clinic_id = $this->session->userdata('id');

        $data['doctors'] = $this->doctors->get_doctors($clinic_id); 
        $data['active'] = "appointments";
        $data['active_page'] = "appointments";

        view('clinic.appointment.appointment',$data);
    }

    public function calendar($doctor_id ="")
    {
        $clinic_id = $this->session->userdata('id');
        
        if($doctor_id != "")
        {
            $data['doctor_id'] = $doctor_id;
            $data["categories"]  = $this->appointment->get_app_category_all($doctor_id);
            $data['calender_view'] = $this->load->view('clinic/appointment/calendar_appointment',$data,true);
        }
        else
        {   
            $data['doctors'] = $this->doctors->get_doctors($clinic_id);
            $data['calender_view'] = $this->load->view('clinic/appointment/calendar_physician',$data,true);
        }
        
        $data['active'] = "appointments";
        $data['active_page'] = "calendar";

        view('clinic.appointment.calendar',$data); 
    }

    public function availability()
    {
        $data = array();
        $clinic_id = $this->session->userdata('id');

        $data['doctors'] = $this->doctors->get_doctors($clinic_id); 
        $data['active'] = "availability";
        
        view('clinic.appointment.availablity',$data);
    }

    public function manage_availability($doctor_id)
    {
       $data = array();
       $clinic_id = $this->session->userdata('id'); 

       if($this->input->post())
       {
            $this->appointment->save_availability($doctor_id);
            redirect(base_url('clinic/appointment/manage_availability/'.$doctor_id));
       }

       $get_availability = $this->appointment->get_availability($doctor_id);

       $data['availability'] = $get_availability;

       if($get_availability == 0)
       { 

        $data["monday"] = $this->appointment->get_time_slot(1 , $doctor_id);
        $data["tuesday"] = $this->appointment->get_time_slot(2 , $doctor_id);
        $data["wednesday"] = $this->appointment->get_time_slot(3 , $doctor_id);
        $data["thursday"] = $this->appointment->get_time_slot(4 , $doctor_id);
        $data["friday"] = $this->appointment->get_time_slot(5 , $doctor_id);
        $data["saturday"] = $this->appointment->get_time_slot(6 , $doctor_id);
        $data["sunday"] = $this->appointment->get_time_slot(7 , $doctor_id);
  
          $data['doctor_id']  = $doctor_id;
          $time_slots = $this->load->view("clinic/appointment/availabilty_week",$data,true);
       }
       else
       {
          $data['doctor_id']  = $doctor_id; 
          $time_slots = $this->load->view("clinic/appointment/availabilty_day",$data,true);
       }
       $data["slots_view"] = $time_slots;
       $data['doctor_id']  = $doctor_id;
       $data['active'] = "availability";
       
       view('clinic.appointment.manage_availablity',$data);
    } 

    public function add_availability($manage_type,$doctor_id)
    {
        $clinic_id = $this->session->userdata('id');
        $data =array();
        {
            $clinic_id = $this->session->userdata("id");
        }

        if ($this->input->post()) 
        {
            $app_type = $this->input->post("app_type");
            $month_date =  $this->input->post("month_date");

            if ($app_type == 0) {
             
               if($month_date)
               {
                  foreach ($month_date as $month)
                  {
                      $insrt_arr = array(
                          "doctor_id" => $doctor_id,
                          "title" => $this->input->post("title"),
                          "start_time" => $this->input->post("start_time"),
                          "end_time" => $this->input->post("end_time"),
                          "no_space" => $this->input->post("no_space"),
                          "app_type" => $app_type,
                          "day_type" => $this->input->post("day_type"),
                          "manage_type" => $this->input->post("manage_type"),
                          "month_date" => date("Y-m-d", strtotime($month))
                      );
                      $this->appointment->add_time_slot($insrt_arr);
                      
                  }
               }
               else
               {
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

            } 
      else {
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
                for ($i = $start_seconds; $i < $end_seconds;) {
                    $start_point = get_time($i);

                    $end_point_seconds = $i + $every_hour ; 
                    $end_point = get_time($end_point_seconds);

                    $i = $time_between + $end_point_seconds;

                    if($month_date)
                    {
                        foreach ($month_date as $month1)
                        {
                            $inser_arr = array(
                                "doctor_id" => $doctor_id,
                                "title" => $this->input->post("title"),
                                "start_time" => $start_point,
                                "end_time" => $end_point,
                                "no_space" => $this->input->post("no_space"),
                                "app_type" => $app_type,
                                "day_type" => $this->input->post("day_type"),
                                "manage_type" => $this->input->post("manage_type"),
                                "month_date" => date("Y-m-d", strtotime($month1))
                            );

                            $this->appointment->add_time_slot($inser_arr);
                        }
                    }
                    else
                    {
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

            }
            $this->session->set_flashdata('Message',"Time Slot has been added successfully.");
            //redirect(base_url("index.php?doctor/manage_time_slot"));
        }
          $data['type'] = $manage_type;
          $data['active'] = "availability";
          
          view('clinic.appointment.add_availability',$data);  
    }

    public function get_time_slot()
    {
        $doctor_id = $this->input->post("doctor_id");
        $doctor_info = $this->doctor->get_single_doctor($doctor_id);
        $timeslot_manage = $this->appointment->get_timeslot_manage_type($doctor_id);
        
        $date = $this->input->post("date_start");
        
        if ($timeslot_manage["value"] == 0) {
            $day = date("D", strtotime($date));
        }
        $date_new = date("Y-m-d", strtotime($date));

        
        if($timeslot_manage["value"] == 0)
        {
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

       }
       else 
        {
            $day_data = $this->appointment->get_time_slot_month($doctor_id, $date_new);
        }

        $exist = false;
        $curr_time = date("H:i:00");
        //echo $curr_time;exit;
        
        $curr_date = date("Y-m-d");
        //echo $curr_date; exit;
        
        if ($day_data) {

            $counter = 0;
            foreach ($day_data as $data) {

               if($curr_date == $date_new)
                {
                   
                  if($curr_time > $data["start_time"])
                   {
                       continue;
                   }
                }

                
                $class = 'btn-info book';

                if ($data["count_app"] > 0){

                    if ($counter == 0) 
                    {
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

    public function appointment($doctor_id)
    {
       $data = array(); 

       $data['doctor_id'] = $doctor_id; 
       $data['active'] = "appointments";
       $data['active_page'] = "appointments";

       view('clinic.appointment.manage_appointment',$data);
    }

    public function add_appointment($doctor_id)
    {

        $data = array();
        $clinic_id = $this->session->userdata("id");
        
        if($this->input->post())
        {
              $post = $this->input->post();
              $patient_type = $this->input->post("patient_type");

              if($patient_type == 0)
              {
                  $patient_id = $this->patient->add_patient_appointment();
              }
              else
              {
                  $patient_id = $this->input->post("patient_id");

                  if($this->input->post("email_exist") != "" || $this->input->post("phone_exist") != "")
                  {
                     $update_arr = array(
                         "patient_email" => $this->input->post("email_exist"),
                         "patient_phone" => $this->input->post("phone_exist")
                     );
                     $this->patient->update_patient_fields($patient_id,$update_arr);
                  }


              }

          $appointment_id = $this->appointment->add_appointment($doctor_id,$patient_id);

          if(isset($post['patient_notify_email']) && $post['patient_notify_email'] == 1 )
          {
              $notify_type = $post['patient_notify_email'];
              $priorities = $this->input->post('patient_schedule_prior');

              if($priorities)
              {
                  foreach($priorities as $priority)
                  {
                     $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,0);
                  }
              }

          }

          if(isset($post['patient_notify_sms']) && $post['patient_notify_sms'] == 0)
          {
                $notify_type = $post['patient_notify_sms'];
                $priorities = $this->input->post('patient_schedule_prior');

                if($priorities)
                {
                    foreach($priorities as $priority)
                    {
                        $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,0);
                    }
                }
          }

          if(isset($post['physician_notify_email']) && $post['physician_notify_email'] == 1 )
          {
                $notify_type = $post['physician_notify_email'];
                $priorities = $this->input->post('physician_schedule_prior');

                if($priorities)
                {
                    foreach($priorities as $priority)
                    {
                        $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,1);
                   }
                }

          }

          if(isset($post['physician_notify_sms']) && $post['physician_notify_sms'] == 0)
          {
                $notify_type = $post['physician_notify_sms'];
                $priorities = $this->input->post('physician_schedule_prior');
                if($priorities)
                {
                    foreach($priorities as $priority)
                    {
                        $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,1);
                    }
                }
          }

          $this->session->set_flashdata('success',"Your appointment has been added successfully");
          redirect("clinic/appointment/");
        }

        $data['time_slot_manage'] = $this->appointment->get_timeslot_manage_type($doctor_id);
        $data['categories']  = $this->appointment->get_app_category_all($doctor_id);
        if($data['time_slot_manage'])
        {
            $data['disable_day'] = $this->appointment->get_disable_day($doctor_id,$data['time_slot_manage']["value"]);
        }
        $data['disable_days'] = $this->appointment->get_disable_days($doctor_id);
        $data['enable_day'] = $this->appointment->get_enable_day($doctor_id);
        
        $data['doctor_id'] = $doctor_id;
        $data['title'] = "Add Appointment"; 
        $data['active'] = "appointments";
        $data['active_page'] = "appointments_add";

        view('clinic.appointment.add_appointment',$data);
      
    }

    public function edit_appointment($appointment_id,$doctor_id)
    {
       $clinic_id = $this->session->userdata("id");
       $data = array();

       if($this->input->post()){

          $post = $this->input->post();
          $patient_id  = $post['patient_id'];
          $this->appointment->update_appointment($appointment_id,$doctor_id);

          if(isset($post['patient_notify_email']) && $post['patient_notify_email'] == 1 )
          {
              $notify_type = $post['patient_notify_email'];
              $priorities = $this->input->post('patient_schedule_prior');

              if($priorities)
              {
                  foreach($priorities as $priority)
                  {
                     $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,0);
                  }
              }

          }

          if(isset($post['patient_notify_sms']) && $post['patient_notify_sms'] == 0)
          {
                $notify_type = $post['patient_notify_sms'];
                $priorities = $this->input->post('patient_schedule_prior');

                if($priorities)
                {
                    foreach($priorities as $priority)
                    {
                        $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,0);
                    }
                }
          }

          if(isset($post['physician_notify_email']) && $post['physician_notify_email'] == 1 )
          {
                $notify_type = $post['physician_notify_email'];
                $priorities = $this->input->post('physician_schedule_prior');

                if($priorities)
                {
                    foreach($priorities as $priority)
                    {
                        $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,1);
                   }
                }

          }

          if(isset($post['physician_notify_sms']) && $post['physician_notify_sms'] == 0)
          {
                $notify_type = $post['physician_notify_sms'];
                $priorities = $this->input->post('physician_schedule_prior');
                if($priorities)
                {
                    foreach($priorities as $priority)
                    {
                        $this->appointment->appointment_scheduler($doctor_id,$patient_id,$appointment_id,$notify_type,$priority,1);
                    }
                }
          }

          $this->session->set_flashdata('success',"Your appointment has been updated successfully");
          redirect("clinic/appointment/");
        }



       $data['time_slot_manage'] = $this->appointment->get_timeslot_manage_type($doctor_id);
       $data['disable_day'] = $this->appointment->get_disable_day($doctor_id,$data['time_slot_manage']["value"]);
       $data['disable_days'] = $this->appointment->get_disable_days($doctor_id);
       $data['enable_day'] = $this->appointment->get_enable_day($doctor_id);
       $data['categories']  = $this->appointment->get_app_category_all($doctor_id);

       $data['scheduled_notifications'] = $this->appointment->get_appointment_scheduled_notification($appointment_id);
       $data['appointment'] = $this->appointment->get_appointment($appointment_id,$doctor_id);

       $data['doctor_id'] = $doctor_id;
       $data['title'] = "Edit Appointment";
       $data['active'] = "appointments";
       $data['active_page'] = "appointments";

       view('clinic.appointment.edit_appointment',$data);
    }

    public function calendar_appointment($doctor_id)
    {

        $clinic_id = $this->session->userdata('id');
      
        $query = $this->db->query("SELECT * FROM `appointment` 
		LEFT JOIN patient ON (appointment.patient_id = patient.patient_user_id)
        LEFT JOIN doctor ON (appointment.doctor_id = doctor.doctor_user_id) 
        LEFT JOIN app_category ON (appointment.fk_app_categoryid = app_category.pk_app_categoryid) 
        WHERE appointment.doctor_id = $doctor_id");

        $result = $query->result_array();
        
        foreach($result as $row)
        {    
             $cat_color = strstr($row['app_cat_color'],"_",true);
             $description  = "<b>Physician Name :</b> ".$row['doctor_name']."<br>";
             $description .= "<b>Patient Name :</b> ".$row['patient_user_name']."<br>";
             $description .= "<b>Patient Email :</b> ".$row['patient_email']."<br>";
             $description .= "<b>Patient Phone :</b> ".$row['patient_phone']."<br>";
             $description .= "<b>Appointment Date/Time :</b> ".$row['appointment']."<br>";


             $link  = '<a href="'.base_url("clinic/appointment/appointment/".$doctor_id).'">Manage Appointment</a><br>';
             $link .= '<a href="'.base_url("clinic/appointment/edit_appointment/".$row['pk_appointment_id'].'/'.$doctor_id).'">Edit Appointment</a><br>';
             $link .= '<a href="'.base_url("clinic/appointment/delete_appointment/".$row['pk_appointment_id']).'">Cancel Appointment</a><br>';
             $link_patient  = '<a href="'.base_url("clinic/patient/").'">Manage Patient</a><br>';
             $link_patient .= '<a href="'.base_url("clinic/patient/edit/".$row['patient_user_id']).'">Edit Patient</a><br>';
             $link_patient .= '<a href="'.base_url("clinic/patient/edit/".$row['patient_user_id']).'">View Patient</a><br>';


        $_appointments[] = array(

               "pk_appointment_id" => $row['pk_appointment_id'],
               "fk_app_category_id" => $row['fk_app_categoryid'],
               "fkslotid" => $row['fkslotid'],
               "app_cat_color" => $cat_color,
               "doctor_id" => $row['doctor_id'],
               "patient_id" => $row['patient_id'],
               "appointment" => $row['appointment'],
               "description" => $description,
               "link" => $link,
               "link_patient" => $link_patient,
               "patient_email" => $row['patient_email'],
               "patient_name" => $row['patient_fname'].''.$row['patient_lname'],
               "title" => date("h:i a", strtotime($row['appointment'])),
               "start" => str_replace(" ", "T", date("Y-m-d H:i:s", strtotime($row['appointment']))),
               "allDay" => false,
               "bordercolor" => "#f4f4f4",
               "textColor" => '#333',
               "background" => '#d5d8de'
              
            );

        }

       echo json_encode($_appointments);
        
    }

    public function list_appointment($doctor_id)
    {

        $clinic_id = $this->session->userdata('id');
        $this->load->library('Datatable');

        $joinQuery = " FROM patient INNER JOIN doctor_patient ON(patient.patient_user_id = doctor_patient.fkpatient_id)
         WHERE doctor_patient.fkdoctor_id = $doctor_id ";

        $joinQuery = " FROM `appointment` 
		LEFT JOIN patient ON (appointment.patient_id = patient.patient_user_id)
        LEFT JOIN doctor ON (appointment.doctor_id = doctor.doctor_user_id) 
        LEFT JOIN app_category ON (appointment.fk_app_categoryid = app_category.pk_app_categoryid) 
        WHERE appointment.doctor_id = $doctor_id ";

        $extraWhere = "";
        $table      = 'appointment';
        $primaryKey = 'pk_appointment_id';
        $columns    = array(

            array('db' => 'pk_appointment_id', 'field' => 'pk_appointment_id', 'formatter' => function($d){

                return "<input type='checkbox' name='checkbox' value='$d'>";
            }),

            array('db' => 'appointment', 'field' => 'appointment'),

            array('db' => 'patient.patient_fname', 'field' => 'patient_fname','formatter' => function($d,$row){

                   return $name = $d.' '.$row['patient_lname'];
            }),

            array('db' => 'app_category.app_cat_color', 'field' => 'app_cat_color', 'formatter' => function($d,$row){

                if($d)
                {
                    $color = strstr($d,'_',true);
                    $label =  "<label class='label btn btn-md pv5 br2 fs13' style='background-color:$color;color:#1a1a1a;'>".$row['name']."</label>";
                }
                else
                {
                    $label =  "<label class='label btn btn-md pv5 br2 fs13' style='background-color:#fff;color:#1a1a1a;'>None</label>";

                }
                
                return $label;
            }),

            array('db' => 'status_appointment', 'field' => 'status_appointment','formatter' => function($d){

                if($d == 1)
                {
                   $status = "Active";
                }
                else
                {
                    $status = "Pending";
                }
                return $status;
            }),

            array('db'  => 'pk_appointment_id', 'field' => 'pk_appointment_id', 'formatter' => function( $d, $row ) {

                return  '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="'.base_url().'clinic/appointment/edit_appointment/'.$d.'/'.$row['doctor_user_id'].'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this Appointment?\',\''.base_url().'clinic/appointment/delete_appointment/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
                            </div>
                            </div>
                         </div>';
             }),

            array('db' => 'app_category.name', 'field' => 'name', "show" => 'no'),

            array('db' => 'patient.patient_lname', 'field' => 'patient_lname', "show" => 'no'),

            array('db' => 'doctor.doctor_user_id', 'field' => 'doctor_user_id', "show" => 'no')
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

    public function delete_appointment($appointment_id)
    {
       $this->appointment->delete_appointment($appointment_id);
       $this->session->set_flashdata('success','Appointment has been deleted successfully');
       redirect('clinic/appointment');
    }

    public function delete_appointment_notification($id,$appointment_id)
    {
       $this->appointment->delete_appointment_notification($id);
       redirect('clinic/appointment/edit_appointment/'.$appointment_id);
    }

    public function time_slots_data($doctor_id)
    {

      $start = $this->input->get("start");
      $end = $this->input->get("end");
      
      $time_slots = $this->db->query(
          "select * from time_slots where  month_date >= '$start' && month_date <= '$end' && doctor_id = $doctor_id && day_type = -1 && manage_type = 1")->result_array();
      
      foreach ($time_slots as $row) {
          $date_time_start = $row['month_date'] . $row['start_time'];
          $date_time_end = $row['month_date'] . $row['end_time'];
          $color = '#f4f4f4';
          $time_slot[] = array(
              "pkslotid" => $row["pkslotid"],
              "title" => date("h:i a", strtotime($date_time_start)) . "-" . date("h:i a", strtotime($date_time_end)),
              "start" => str_replace(" ", "T", date("Y-m-d H:i:s", strtotime($date_time_start))),
              "description" => '<div class="col-md-12 p6" style="border: 1px solid #DDD;background-color: #F5F5F5;">
                <span class="fw600" style="color:black">' . date("h:i a", strtotime($date_time_start)) . ' - ' . date("h:i a", strtotime($date_time_end)) . '</span><a class="removeEvent" data-id="' . $row["pkslotid"] . '" style="color:red; float:right;cursor: pointer;">X</a><br /><span class="fw600" style="color: #8E8E8E;">' . $row["no_space"] . ' spaces available</span></div>',
              "allDay" => false,
              "bordercolor" => "#f4f4f4",
              "textColor" => '#666',
              "background" => '#f4f4f4'
              
          );

      }
      echo json_encode($time_slot);
    }

    public function clear_time_slots($day_type,$doctor_id)
    {
      $this->appointment->clear_time_slot($day_type);
      redirect(base_url('clinic/appointment/manage_availability/'.$doctor_id));
      exit; 
    }
    
    public function delete_time_slot($doctor_id,$slot_id)
    { 
      $this->appointment->delete_time_slot($slot_id);
      redirect(base_url('clinic/appointment/manage_availability/'.$doctor_id));
    }

    public function manage_appointment_category()
    { 
      $data = array();
      $data['active'] = "appointment_cat";
      $data['active_page'] = "appointment_cat";
      
      view('clinic.appointment.manage_appointment_category',$data);
    }

    public function add_appointment_category()
    {
      $data = array();
      $clinic_id = $this->session->userdata('id');
      $data['doctors'] = $this->doctors->get_doctors($clinic_id); 
     
            if($this->input->post())
            {
              $insert_data = array(
                "doctor_id"     => $this->input->post('doctor_id'),
                "name"          => $this->input->post('app_category_name'),
                "app_cat_color" => $this->input->post('app_cat_color')

                );
                
              $this->appointment->add_app_category($insert_data);
              $this->session->set_flashdata('success','Successfully added appointment category');
              redirect(base_url('clinic/appointment/manage_appointment_category'));
            }

        $data['active'] = "appointment_cat";
        $data['active_page'] = "appointment_cat_add";

        view('clinic.appointment.add_appointment_category',$data);
     
    }
 
    public function edit_appointment_category($id)
    { 
      $data = array(); 
      $clinic_id = $this->session->userdata("id");
      $data['doctors'] = $this->doctors->get_doctors($clinic_id);  
      
          if($this->input->post())
          {
            $insert_data = array(
               
                "doctor_id"     => $this->input->post('doctor_id'),
                "name"          => $this->input->post('app_category_name'),
                "app_cat_color" => $this->input->post('app_cat_color')
           );
            
            $this->appointment->edit_app_category($id,$insert_data);
            $this->session->set_flashdata('success','Successfully updated appointment category');
            redirect(base_url('clinic/appointment/manage_appointment_category'));
          }



        $data['page_title'] = 'Edit Appointment Category';
        $data['category'] = $this->appointment->get_app_category($id);
        $data['active'] = "appointment_cat";
        $data['active_page'] = "appointment_cat";

        view('clinic.appointment.edit_appointment_category',$data);  
    }

    public function list_category()
    {
         $doctor_id = $this->session->userdata('id');
         $this->load->library('Datatable');


         $joinQuery = "";
         $extraWhere = "";


         $table      = 'app_category';
         $primaryKey = 'pk_app_categoryid';
         $columns    = array(

             array('db' => 'app_cat_color', 'field' => 'app_cat_color','formatter' => function ($d,$row){

                 $color = strstr($d,"_",true);

                 return '<a href="'.base_url().'clinic/appointment/edit_appointment_category/'.$row['pk_app_categoryid'].'"><label class="btn btn-lg pv5 br2 fs13 update_status" style="background-color: '.$color.';color:#333;">'.$row['name'].'</label></a>';
            }),

             array('db' => 'name', 'field' => 'name'),

             array('db'  => 'pk_app_categoryid', 'field' => 'pk_app_categoryid', 'formatter' => function( $d, $row ) {

                return  '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="'.base_url().'clinic/appointment/edit_appointment_category/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this  Appointment Category?\',\''.base_url().'clinic/appointment/delete_app_category/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
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

    public function  delete_app_category($id)
    {
        $this->appointment->delete_app_category($id);
        $this->session->set_flashdata('success','Successfully appointment has been deleted');
        redirect(base_url('clinic/appointment/manage_appointment_category'));
    
    } 

    public function update_appointment_category()
    {
        if($this->input->post())
        {
            $this->appointment->update_appointment_category();
        }
    } 
   
    
      
}

    
?>    