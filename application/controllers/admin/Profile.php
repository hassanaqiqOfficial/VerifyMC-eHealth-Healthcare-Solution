<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Profile_model","profile");
	}


	public function index()
	{
	    $data = array();
		$user_id = $this->session->userdata("id");
		
		$this->profile->get_table("admin");
		$this->profile->get_fkid("admin_user_id");
        $data['admin'] = $this->profile->get($user_id);

		
		if($this->input->post()) 
		{   
			$post = $this->input->post();
			
			$this->profile->update($user_id, array("admin_user_name" => $post['user_name']) );
			
			if(isset($post["password"]) && $post["password"] != "")
			{
				$this->profile->update_password($user_id, array("admin_user_pass" => sha1($post['password'])) );
			}

			$this->session->set_flashdata('success', 'Account has been updated successfully.');
            redirect(base_url('admin/profile/'));
		
		}

       view('admin.profile',$data);
	}
	
}

?>