<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Controller {

	public function __construct()
	{
        parent::__construct();
           $this->load->model('Notification_model','notification');
    }

    public function customize_notification($task ="",$type="")
    {
       $data = array();
       if($task && $type != "")
       {
          
          if($type == 0) 
          {
              if($this->input->post())
              {
                  $array = array(

                    "title" => $this->input->post('template_title'),
                    "subject" => $this->input->post('subject'), 
                    "body" => $this->input->post('body'),
                  );

                $this->notification->update_default_template($array,$task,$type);
                $this->session->set_flashdata('success','You have successfully updated patient email template');
                redirect('notifications/customize_notification/');  
              } 

              $data['email_template'] = $this->notification->get_default_email_template($task,$type);
              $page = $this->load->view('settings/notifications/patient/customize_patient_email_notification',$data,true);
          }
          else
          {  
              if($this->input->post())
              {
                  $array = array(

                    "title" => $this->input->post('template_title'),
                    "body" => $this->input->post('body'),
                  );

                $this->notification->update_default_template($array,$task,$type);
                $this->session->set_flashdata('success','You have successfully updated patient SMS template');
                redirect('notifications/customize_notification/');  
              }  

              $data['sms_template'] = $this->notification->get_default_email_template($task,$type);
              $page = $this->load->view('settings/notifications/patient/customize_patient_sms_notification',$data,true); 
          }
          
       }
       else
       {
          $page = $this->load->view('settings/notifications/patient/customize_patient_notification',$data,true);
       } 
      
       $data['page'] = $page;
       $data['active'] = "notifications";
       $data['active_page'] = "customize_notification";
       
       view('settings.notifications.customize_notfication',$data);
    }

    public function customize_doctor_notification($task ="",$type="")
    {
       $data = array();
       if($task && $type != "")
       {
          
          if($type == 0) 
          {
              if($this->input->post())
              {
                  $array = array(

                    "title" => $this->input->post('template_title'),
                    "subject" => $this->input->post('subject'), 
                    "body" => $this->input->post('body'),
                  );

                $this->notification->update_default_template($array,$task,$type);
                $this->session->set_flashdata('success','You have successfully updated doctor email template');
                redirect('notifications/customize_doctor_notification/');  
              }

              $data['email_template'] = $this->notification->get_default_email_template($task,$type);
              $page = $this->load->view('settings/notifications/doctor/customize_doctor_email_notification',$data,true);
          }
          else
          {  
              if($this->input->post())
              {
                  $array = array(

                    "title" => $this->input->post('template_title'),
                    "body" => $this->input->post('body'),
                  );

                $this->notification->update_default_template($array,$task,$type);
                $this->session->set_flashdata('success','You have successfully updated doctor SMS template');
                redirect('notifications/customize_doctor_notification/');  
              } 

              $data['sms_template'] = $this->notification->get_default_email_template($task,$type);
              $page = $this->load->view('settings/notifications/doctor/customize_doctor_sms_notification',$data,true); 
          }
          
       }
       else
       {
          $page = $this->load->view('settings/notifications/doctor/customize_doctor_notification',$data,true);
       } 
       
       $data['page'] = $page;
       $data['active'] = "notifications";
       $data['active_page'] = "customize_doctor_notification";
       
       view('settings.notifications.customize_notfication',$data); 
    }

 
    public function custom_email()
    {
        $data = array();

        $data['active'] = "notifications";
        $data['active_page'] = "custom_email";
        view('settings.notifications.manage_custom_email',$data);
    }

    public function custom_sms()
    {
        $data = array();

        $data['active'] = "notifications";
        $data['active_page'] = "custom_sms";
        view('settings.notifications.manage_custom_sms',$data);
    }

    public function add_custom_email($id ="")
    {
        $data = array();
        $this->notification->set_table('custom_email');
        $this->notification->set_fkid("ID");

        if($this->input->post())
        {
          $post = $this->input->post();
          $array = array(

               "title" => $post['template_title'], 
               "subject" => $post['subject'],
               "body" => $post['body'],
          );

          if($id != '')
          {
             $this->notification->update($id,$array);
             $this->session->set_flashdata('success','You have successfully updated custom email template');
             redirect('notifications/custom_email');
          }
          else
          {
             $this->notification->insert($array);
             $this->session->set_flashdata('success','You have successfully added custom email template');
             redirect('notifications/custom_email');
          }
         
       }
       if($id != "")
       {
         $data['custom_email'] = $this->notification->get_custom_email($id);
         $data['fkid'] = $id; 
       }
       else
       {
         $data['custom_email'] = array("title" => '', "subject" => '', "body" => '');
       }
       
       $data['active'] = "notifications";
       $data['active_page'] = "custom_email";
       view('settings.notifications.custom_email_notification',$data);
    }

    public function add_custom_sms($id ="")
    {
        $data = array();
        $this->notification->set_table('custom_sms');
        $this->notification->set_fkid("ID"); 

        if($this->input->post())
        {
          $post = $this->input->post();
          
          $array = array("title" => $post['template_title'],"body" => $post['body'],);

          if($id != '')
          {
             $this->notification->update($id,$array);
             $this->session->set_flashdata('success','You have successfully updated custom SMS template');
             redirect('notifications/custom_sms');  
          }
          else
          {
            $this->notification->insert($array);
            $this->session->set_flashdata('success','You have successfully added custom SMS template');
            redirect('notifications/custom_sms');
          }
          
        }

       if($id != "")
       {
         $data['custom_sms'] = $this->notification->get_custom_email($id);
         $data['fkid'] = $id; 
       }
       else
       {
         $data['custom_sms'] = array("title" => '', "body" => '');
       }

       $data['active'] = "notifications";
       $data['active_page'] = "custom_sms";
        view('settings.notifications.custom_sms_notification',$data);
    }


    public function list_custom_email()
    {
        $this->load->library('Datatable');

        $joinQuery = "";
        $extraWhere = "";


        $table = 'custom_email';
        $primaryKey = 'ID';
        $columns = array(
            
            array('db' => 'title', 'field' => 'title'),

            array('db' => 'subject', 'field' => 'subject'),

            array('db' => 'ID', 'field' => 'ID', 'formatter' => function ($d, $row) {

               
              return  '<div class="list-icons">
                        <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                            <i class="icon-menu9"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="'.base_url().'notifications/add_custom_email/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                            <a onclick="confirmbox(\'Are you sure you want to delete this custom email?\',\''.base_url().'clinic/doctor/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
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

    public function list_custom_sms()
    {
        $this->load->library('Datatable');

        $joinQuery = '';
        $extraWhere = '';

        $table = 'custom_sms';
        $primaryKey = 'ID';

        $columns = array(
            
            array('db' => 'title', 'field' => 'title'),

            array('db' => 'ID', 'field' => 'ID', 'formatter' => function ($d){
                   
              return  '<div class="list-icons">
                        <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                            <i class="icon-menu9"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="'.base_url().'notifications/add_custom_sms/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                            <a onclick="confirmbox(\'Are you sure you want to delete this custom sms?\',\''.base_url().'clinic/doctor/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
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

        // /echo $this->datatable->sql; exit;
    }

    
    public function delete($id)
    {
        $this->notification->set_table("");
        $this->notification->delete($id);
        $this->session->set_flashdata('Success','You have successfully deleted');
        redirect_back();
    }
    
 } 

?>