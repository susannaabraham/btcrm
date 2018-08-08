<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->helper('url');
			$this->load->library('session');
			$this->load->helper('cookie');
       }

	

		
	public function index()
	{		
		$data['url']=base_url();
	    $this->load->view('admin/login',$data);	
	}
	

}
