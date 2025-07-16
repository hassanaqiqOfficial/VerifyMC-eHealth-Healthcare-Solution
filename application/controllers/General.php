<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function upload_files()
	{
		$response = $this->upload_image("uploadFile");
        /*echo "<pre>";
        print_r($response);*/
        if($response["error"] == 0)
		{

			echo json_encode(array($response["upload_data"]["file_name"],$response["upload_data"]["client_name"]));	
		}
	}
	public function upload_files_fileup()
	{
		$response = $this->upload_image("filedata");

        if($response["error"] == "0")
		{

			echo json_encode(array($response["upload_data"]["file_name"],$response["upload_data"]["client_name"]));
		}
	}

	public function imagecroperupload($file ="", $rotate = "")
    {
        $options = array(
            'upload_dir' => 'uploads/tmp/',
            'upload_url' => base_url('uploads/tmp/'),
            // Image versions:
            'versions' => array(
                'bg' => array(
                    'max_width' => 1024,
                    'max_height' => 800
                ),

            ),
            'load' => function ($instance) {
                //return 'avatar.jpg';
            },
            'delete' => function ($filename, $instance) {
                return true;
            },
            'upload_start' => function ($image, $instance) {
                $image->name = time() . '-bg.' . $image->type;
            },
            'upload_complete' => function ($image, $instance) {
            },
            'crop_start' => function ($image, $instance) {
                $image->name = time() . 'cbg.' . $image->type;
            },
            'crop_complete' => function ($image, $instance) {

            }
        );
        if ($file != "") {
            $_GET["action"] = "preview";
            $_GET["file"] = $file;
            $_GET["width"] = 800;
            if ($rotate != "") {
                $_GET["rotate"] = $rotate;
            }
        }

        $this->load->library('ImgPicker',$options);
    }
  
  
   
   
  
	
}

?>