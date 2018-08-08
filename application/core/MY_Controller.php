<?php

class MY_Controller extends CI_Controller {


    function __construct()
    {

        parent::__construct();

        $this->load->helper('url');
		$this->load->library('session');
		$islogedin=$this->session->userdata('admin_login');
			if(!$islogedin){
				redirect('/admin/',301);
				exit();
			}
    }

}


class Domain_Controller extends CI_Controller {


    function __construct()
    {

        parent::__construct();

        $this->load->helper('url');
		$this->load->library('session');
		$lad=$this->session->userdata('user_login');
		if(!($lad)){
			redirect('/',301);
		}
    }

}

?>