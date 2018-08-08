<?php

class Member_Controller extends CI_Controller {


    function __construct()
    {

        parent::__construct();

        $this->load->helper('url');
		$this->load->library('session');
		$lad=$this->session->userdata('login_member_id');
		if(empty($lad)){
			redirect('/member/login',301);
		}
    }

}

?>