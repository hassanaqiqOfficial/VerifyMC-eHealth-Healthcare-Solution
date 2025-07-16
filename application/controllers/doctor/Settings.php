<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends MY_Doctor_Controller
{
    public function __construct()
    {
        parent::__construct();
        
            $this->load->library('session');
            $this->load->model("doctor/Doctor_setting_model", "settings");

    }

    public function index()
    {
        
    }

    public function payment_gateways()
    {  
        $data = array();
        $doctor_id = $this->session->userdata("id");
        
        if($this->input->post())
        {
            $fields = array(
                "payment_gateways" => $this->input->post("payment_gateways"),
                "application_id" => $this->input->post("application_id"),
                "access_token" => $this->input->post("access_token"),
                "location_id" => $this->input->post("location_id"),
                "api_secret_key" => $this->input->post("api_secret_key"),
                "api_public_key" => $this->input->post("api_public_key"),
                "payment_environment_authorize" => $this->input->post("payment_environment_authorize"),
                "authorizenet_login_id" => $this->input->post("authorizenet_login_id"),
                "authorizenet_transaction_key" => $this->input->post("authorizenet_transaction_key"),
                "payment_environment_paypal" => $this->input->post("payment_environment_paypal"),
                "api_username" => $this->input->post("api_username"),
                "api_password" => $this->input->post("api_password"),
                "api_signature" => $this->input->post("api_signature"),
                "nmi_username" => $this->input->post("nmi_username"),
                "nmi_password" => $this->input->post("nmi_password"),
                
            );


            foreach($fields as $key => $value)
            {
                $this->settings->update_option($key,$value,$doctor_id);
            }

            $this->session->set_flashdata("success","Setting has been updated successfully.");

          
        }

        $data['active'] = "settings";
        $data['active_page'] = "payment_gateways";
       
        view('doctor.settings.payment.payment_gateways',$data);
    }

    public function app_logo()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $settings = $this->settings->get_settings($doctor_id);

        $data['textLogo'] = isset($settings["text_logo"]) ? $settings["text_logo"] : '';
        $data['logo_image'] = isset($settings["logo_image"]) ? $settings["logo_image"] : '';
        $data['logo_type'] = isset($settings["logo_type"]) ? $settings["logo_type"] : '';

        if($this->input->post())
        {
            if($this->input->post("logo_type") == "Image")
            {

                if($this->input->post("logo_image") && $this->input->post("logo_image") != "")
                {
                    $doctor_dir = 'uploads/doctor/doctor_'.md5($doctor_id);
                    $main_dir = $doctor_dir.'/logo';
                    if(!is_dir($main_dir))
                    {
                        mkdir($main_dir,0777,true);
                    }
                    if(copy('uploads/tmp/'.$this->input->post("logo_image"),$main_dir.'/'.$this->input->post("logo_image")))
                    {
                        @unlink('uploads/tmp/'.$this->input->post("logo_image"));
                    }

                    $key = "logo_image";
                    $value = $main_dir.'/'.$this->input->post("logo_image");
                    $this->settings->update_option($key,$value,$doctor_id);
                }

                $key = "logo_type";
                $value = 'Image';
                $this->settings->update_option($key,$value,$doctor_id);
            }
            else
            {
                $key = "text_logo";
                $value = $this->input->post("text_logo");
                $this->settings->update_option($key,$value,$doctor_id);

                $key = "logo_type";
                $value = 'text_logo';
                $this->settings->update_option($key,$value,$doctor_id);
            }



            $this->session->set_flashdata("success","Successfully updated logo setting"); 
            redirect('doctor/settings/app_logo');
        }
            
        $data['active'] = "settings";
        $data['active_page'] = "branding";
        $data['active_mini_sidebar'] = "app_logo";
        $data['doctor_id'] = $doctor_id;
        
        view('doctor.settings.branding.app_logo',$data);
    }

    public function uploadImage()
    {
        $response = $this->upload_image("file",'uploads/tmp/');
       
        if($response["error"] === 0)
        {
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

    public function email_header_setting()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $settings = $this->settings->get_settings($doctor_id);

        $settings_arr['test_email'] = isset($settings['test_email']) ? $settings['test_email'] : '';
        $settings_arr['email_header_setting'] = isset($settings['email_header_setting']) ? $settings['email_header_setting'] : '';
        $settings_arr['email_footer_color'] = isset($settings['email_footer_color']) ? $settings['email_footer_color'] : '';
        $settings_arr['email_text_color'] = isset($settings['email_text_color']) ? $settings['email_text_color'] : '';
        $settings_arr['email_footer_text'] = isset($settings['email_footer_text']) ? $settings['email_footer_text'] : '';
        $settings_arr['footer_setting'] = isset($settings['footer_setting']) ? $settings['footer_setting'] : '';
        
        if($this->input->post())
        {   
            $post = $this->input->post();
            if($post['email_header_setting'] && $post['email_header_setting'] != "")
            {
                $setting = $post['email_header_setting'];
                
                $doctor_dir = 'uploads/doctor/doctor_'.md5($doctor_id);
                $main_dir = $doctor_dir.'/Email_settings';

                if(!is_dir($main_dir))
                {
                    mkdir($main_dir,0777,true);
                }
                if(copy('uploads/tmp/'.$setting,$main_dir.'/'.$setting))
                {
                    unlink('uploads/tmp/'.$setting);
                }
              
                $post['email_header_setting'] = $main_dir.'/'.$setting;
            }
            
            foreach($post as $key => $value)
            {
                $this->settings->update_option($key,$value,$doctor_id);
            }

            $this->session->set_flashdata("success","Successfully updated email header setting."); 
            redirect('doctor/settings/email_header_setting');
        }
 
        $data['active'] = "settings";
        $data['active_page'] = "branding";
        $data['active_mini_sidebar'] = "email_header";

        $data['doctor_id'] = $doctor_id;
        $data['settings'] = $settings_arr;
       
        view('doctor.settings.branding.email_header_setting',$data);
    }

    public function invoice_customization()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $doctor_dir = "uploads/doctor/doctor_".md5($doctor_id);

        $settings = $this->settings->get_settings($doctor_id);

        $settings_arr['invoice-skin'] = isset($settings['invoice-skin']) ? $settings['invoice-skin'] : '';
        $settings_arr['inovice_note'] = isset($settings['inovice_note']) ? $settings['inovice_note'] : '';
        $settings_arr['invoice_logo'] = isset($settings['invoice_logo']) ? $settings['invoice_logo'] : '';
        $settings_arr['invoice_text_logo'] = isset($settings['invoice_text_logo']) ? $settings['invoice_text_logo'] : '';
        $settings_arr['invoice_signature'] = isset($settings['invoice_signature']) ? $settings['invoice_signature'] : '';
        $settings_arr['signImage_url'] = isset($settings['signImage_url']) ? $settings['signImage_url'] : '';
        $settings_arr['signMade_url'] = isset($settings['signMade_url']) ? $settings['signMade_url'] : '';
        $settings_arr['singee_title'] = isset($settings['singee_title']) ? $settings['singee_title'] : '';
        $settings_arr['invoice_logo_url'] = isset($settings['invoice_logo_url']) ? $settings['invoice_logo_url'] : '';

        if($this->input->post())
        {
            $post = $this->input->post();
            
            if($post['invoice_logo'] == 0 ||  $post['invoice_logo'] == 1)
            {
                if($post['invoice_logo'] == 0)
                {
                    $settings = $this->settings->get_settings($doctor_id);
                    foreach($settings as $setting)
                    {
                        $post['invoice_logo_url'] = $setting['key'] == "logo_image" ? $setting['value'] : "";
                    } 
                }
                else
                {
                    if($_FILES && $_FILES['invoice_upload_logo']['name'] != "")
                    {   
                        $main_dir = $doctor_dir."/invoice_logo";
                        if(!is_dir($main_dir))
                        {
                            mkdir($main_dir,0777,true);
                        }

                        $response = $this->upload_image("invoice_upload_logo",$main_dir);
                        if($response['error'] == 0)
                        {
                            $post['invoice_logo_url'] = $main_dir.'/'.$response['upload_data']['file_name'];    
                        }
                        
                    }
                }
            }
            
            if($post['invoice_signature'] == 1 && $post['signImage_url'] != "")
            {
               
                    $main_dir = $doctor_dir."/invoice_signature";
                    if(!is_dir($main_dir))
                    {
                        mkdir($main_dir,0777,true);
                    }
                    if(copy("uploads/tmp/".$post['signImage_url'] ,$main_dir.'/'.$post['signImage_url']))
                    {
                        unlink("uploads/tmp/".$post['signImage_url']);
                    }

                    $post['signImage_url']  = $main_dir.'/'.$post['signImage_url'];
                   
            }

            if($post['invoice_signature'] == 1 && $post['signMade_url'] != "")
            {
                $post['signMade_url'] = $post['signMade_url'];
            }

            foreach($post as $key => $value)
            {
                $this->settings->update_option($key,$value,$doctor_id);
            }
       
            $this->session->set_flashdata("success","Successfully updated invoice settings."); 
            redirect('doctor/settings/invoice_customization'); 

        }

        $data['active'] = "settings";
        $data['active_page'] = "branding";
        $data['active_mini_sidebar'] = "invoice_customization";

        $data['doctor_id'] = $doctor_id;
        $data['settings'] = $settings_arr;

        view('doctor.settings.branding.invoice_customization',$data);
    }

    public function manage_favicon()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        $settings = $this->settings->get_settings($doctor_id);
        
        $data['favicon'] = isset($settings['favicon']) ? $settings['favicon'] : '';


        if($_FILES && $_FILES['favicon']['name'] != "")
        {
              $doctor_dir = "uploads/doctor/doctor_".md5($doctor_id);
              $main_dir = $doctor_dir."/Favicon";
              
              if(!is_dir($main_dir))
              {
                  mkdir($main_dir,0777,true);
              }

              $response = $this->upload_image("favicon",$main_dir);
              if($response['error'] == 0)
              {
                $favicon_url = $main_dir.'/'.$response['upload_data']['file_name'];  
                
                $this->settings->update_option("favicon",$favicon_url,$doctor_id);
                $this->session->set_flashdata("success","Successfully updated favicon settings."); 
                redirect('doctor/settings/manage_favicon');
              }
        }

        $data['active'] = "settings";
        $data['active_page'] = "branding";
        $data['active_mini_sidebar'] = "favicon";
        $data['doctor_id'] = $doctor_id;

        view('doctor.settings.branding.add_favicon',$data);
    }

    public function calendar_customization()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');
        
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

        
        if($this->input->post())
        {
           $post = $this->input->post();
           foreach($post as $key => $value)
           {   
             $this->settings->update_option($key,$value,$doctor_id);
           }
            $this->session->set_flashdata("success","Successfully updated calendar settings."); 
            redirect('doctor/settings/calendar_customization');
        }

        $data['active'] = "settings";
        $data['active_page'] = "branding";
        $data['active_mini_sidebar'] = "calendar_customization";

        $data['doctor_id'] = $doctor_id;
        $data['settings'] = $settings_arr;

        view('doctor.settings.branding.calendar_customization',$data);
    }

    public function quick_notes()
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');

        $data['active'] = "settings";
        $data['active_page'] = "quick_notes";
        $data['doctor_id'] = $doctor_id;

        view('doctor.settings.notes.manage_quick_notes',$data);
    }

    public function list_quick_notes()
    {
        $doctor_id = $this->session->userdata("id");
        $this->load->library('Datatable');

        $joinQuery = "";
        $extraWhere = "doctor_id = $doctor_id";


        $table = 'quick_notes';
        $primaryKey = 'pk_note_id';

        $columns = array(

            array('db' => 'title', 'field' => 'title'),

            array('db' => 'pk_note_id', 'field' => 'pk_note_id', 'formatter' => function ($d, $row) {

                return '<div class="list-icons">
                            <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="' . base_url() . 'doctor/settings/add_quick_note/' . $d . '" class="dropdown-item"><i class="fa fa-pencil"></i>Edit</a>
                                <a onclick="confirmbox(\'Are you sure you want to delete this note?\',\'' . base_url() . 'doctor/settings/delete_quick_note/' . $d . '\')" class="dropdown-item"><i class="fa fa-trash" style="color:red;"></i>Delete</a>
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

    public function add_quick_note($note_id = "")
    {
        $data = array();
        $doctor_id = $this->session->userdata('id');

        if($this->input->post())
        {
            $insert_arr = array(

                 "doctor_id" => $doctor_id,
                 "title" => $this->input->post("note_title"),
                 "description" => $this->input->post("note_description")
            );

            if($note_id != "")
            {
                $this->settings->update_quick_note($doctor_id,$insert_arr,$note_id);
                $this->session->set_flashdata("success","Successfully updated quick note.");
                redirect('doctor/settings/quick_notes');
            }
            else
                { 
                    $this->settings->add_quick_note($insert_arr);
                    $this->session->set_flashdata("success","Successfully added quick note.");
                    redirect('doctor/settings/quick_notes');
                } 
        }

        if($note_id != "")
        {
            $data['note'] = $this->settings->get_note($note_id,$doctor_id);
        }
        else
            {
               $data['note'] = array('title' => '', 'description' => '');
            }

        $data['active'] = "settings";
        $data['active_page'] = "quick_notes";
        $data['doctor_id'] = $doctor_id;

        view('doctor.settings.notes.add_quick_note',$data);
    }


    public function delete_quick_note($note_id)
    {
        $this->settings->delete_quick_note($note_id);
        $this->session->set_flashdata("success","Successfully deleted quick note.");
        redirect('doctor/settings/quick_notes');
    }
 

}
?>    