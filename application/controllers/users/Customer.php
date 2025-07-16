<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  This is a test class to show you how to work with Slice-Library!
 */
class Customer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		view('add_form');
	}


}
