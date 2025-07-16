<?php

if(! function_exists('__message'))
{

	function __message(){
			
			$CI =& get_instance();
			$CI->load->library('session');

            $html = "";
			$message = $CI->session->flashdata('error');
            $CI->session->unset_userdata('error');
			if($message)
			{
				$type = "danger";
				$text = 'Error!';
			}
			else
			{

				$message = $CI->session->flashdata('success');
				$CI->session->unset_userdata('success');
				$type = "success";
                $text = 'Success!';
			}

			if(is_array($message) && !empty($message))
			{
				$html = '<div class="alert alert-'.$type.' alert-dismissible">';
				$html .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					foreach($message as $message)
					{
						$html .= '<p><strong>Success!</strong> '.$message.'</p>';
					}


				$html .= '</div>';
			}
			elseif($message != "")
			{
				$html = '<div class="alert alert-'.$type.' alert-dismissible">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>'.$text.'</strong> '.$message.'
						</div>';
			}

			return $html;


	}
}

function get_time($seconds)
{

	$hours = floor($seconds / 3600);
	$timeFormat = gmdate("H:i", $seconds);
	return $timeFormat;
}

function timeZoneConvert($fromTime, $fromTimezone, $toTimezone, $format = 'Y-m-d H:i:s')
{

    $from = new DateTimeZone($fromTimezone);
    $to = new DateTimeZone($toTimezone);

    $orgTime = new DateTime($fromTime, $from);
    $toTime = new DateTime($orgTime->format("c"));

    $toTime->setTimezone($to);

    return $toTime->format($format);

}