<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Widgets extends MY_Doctor_Controller
{
    public function __construct()
    {
        parent::__construct();
            $this->load->model("doctor/Doctor_model", "doctor");
            $this->load->model("doctor/Doctor_widget_model", "widget");
            $this->load->library('session');
    }

    public function index()
    {
        $data = array();
        $data['active'] = "widgets";
        $data['active_page'] = "widgets";

        view('doctor.widget.manage', $data);
    }

    public function list_widgets()
    {
        $doctor_id = $this->session->userdata('id');
        $this->load->library('Datatable');


        $joinQuery = "";
        $extraWhere = "doctor_id = $doctor_id ";


        $table = 'widgets';
        $primaryKey = 'pk_widget_id';
        $columns = array(
            
            array('db' => 'title', 'field' => 'title'),
           
            array('db' => 'pk_widget_id', 'field' => 'pk_widget_id', 'formatter' => function ($d, $row) {

                return  '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="'.base_url().'doctor/widgets/edit/'.$d.'" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this widget?\',\''.base_url().'doctor/widgets/delete/'.$d.'\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
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

    public function add()
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");
        $next_widget_id = $this->widget->get_next_incremented_id();
        
        if($this->input->post())
        {
            $post  = $this->input->post();
            
            $title = $post['title'];
            $steps = explode("&",$post['steps_str']);
            unset($post['steps_str'],$post['title'],$post['widget_url'],$post['widget_embed_code']);
          
            if($steps != "")
            {
                $strSteps = array();
                foreach($steps as $key => $step)
                {
                    $strSteps[$key] = strstr($step,"[",true); 
                }

                $steps_encoded = json_encode($strSteps);
            }
            
            
            $insert = array(

                 "doctor_id"  => $doctor_id,
                 "title" => $title,
                 "steps" => $steps_encoded,
            );

            $widget_id = $this->widget->add_widget($insert);

            if($post['additional_information'] && $post['additional_information'] != "")
            {
                $questions_info_arr = $post['additional_information'];
                unset($post['additional_information']);

                $questions_str = array();
                foreach($questions_info_arr as $question_arr)
                {
                    $questions_str[] = serialize($question_arr);
                }
                if($questions_str)
                {
                    $post["custom_question_str"] = json_encode($questions_str);
                }               
            }

            foreach($post as $key => $value)
            {
                $insert = array(

                    "doctor_id"  => $doctor_id,
                    "fk_widget_id" => $widget_id,
                    "key" => $key,
                    "value" => $value
               );
               $this->widget->add_widget_settings($insert);
            }
            

            $this->session->set_flashdata("success","Successfully added new widget");
            redirect('doctor/widgets');

        }

        $data['active'] = "widgets";
        $data['active_page'] = "add_widget";
        $data['next_widget_id'] = $next_widget_id;

        view('doctor.widget.add', $data); 
    }

    public function edit($id)
    {
        $data = array();
        $doctor_id = $this->session->userdata("id");
       
        $widget = $this->widget->get_widget($doctor_id,$id); 
        $settings = $this->widget->get_widget_settings($doctor_id,$id); 

        $questions = "";
        if(isset($settings['custom_question_str']))
        {
             $custom_questions = json_decode($settings['custom_question_str']);
        
            if($custom_questions)
            {
                $questions = array();
                foreach($custom_questions as $question)
                {
                    $questions[] = unserialize($question);
                }
            }
        }
       
        if($widget['steps'] != "")
        {
           $steps_arr = json_decode($widget['steps']);
        }
        
        if($this->input->post())
        {
            $post  = $this->input->post();
           
            $title = $post['title'];
            $stepsStr = $post['steps_str'];
            unset($post['steps_str'],$post['title'],$post['widget_url'],$post['widget_embed_code']);

            if($stepsStr != "")
            {
                $steps = explode("&",$stepsStr);
                $strSteps = array();
                foreach($steps as $key => $step)
                {
                    $strSteps[$key] = strstr($step,"[",true); 
                }

                $steps_encoded = json_encode($strSteps);
            }
            
            
            $update_widget = array(

                 "doctor_id"  => $doctor_id,
                 "title" => $title,
            );

            if($stepsStr != "")
            {
                 $update_widget['steps'] =  $steps_encoded;
            }
           
            $this->widget->edit_widget($id,$update_widget,$doctor_id);
            
            if($post['additional_information'] && $post['additional_information'] != "")
            {
                $questions_info_arr = $post['additional_information'];
                unset($post['additional_information']);

                $questions_str = array();
                foreach($questions_info_arr as $question_arr)
                {
                    $questions_str[] = serialize($question_arr);
                }
                if($questions_str)
                {
                    $post["custom_question_str"] = json_encode($questions_str);
                }               
            }

            if($post != "")
            {
                $this->widget->delete_widget_settings($id);

                foreach($post as $key => $value)
                {
                    $update_settings = array(
                        "doctor_id"  => $doctor_id,
                        "fk_widget_id" => $id,
                        "key" => $key,
                        "value" => $value
                    );
    
                   $this->widget->add_widget_settings($update_settings);
                }
            }

            $this->session->set_flashdata("success","Successfully update widget");
            redirect('doctor/widgets');

        }

        $data['widget_id'] =  $widget['pk_widget_id'];
        $data['title'] = $widget['title'];
        $data['steps'] = $steps_arr;
        $data['settings'] = $settings;
        $data['questions'] = $questions;
        $data['active'] = "widgets";
        $data['active_page'] = "widgets";

        view('doctor.widget.edit', $data); 
    }

    public function delete($id)
    {
        $doctor_id = $this->session->userdata("id");
        $this->widget->delete_widget($id,$doctor_id);
        $this->session->set_flashdata("success","successfully deleted widget");
        redirect('doctor/widgets');
    }



}

?>