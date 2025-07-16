<?php

    if(! function_exists('save_notification'))
    {
    
        function save_notification()
        {
            $CI =& get_instance();

            $CI->load->database();
            $CI->load->library('session');

            
            
        }


    }

?>