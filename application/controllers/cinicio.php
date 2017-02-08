<?php

/**
 *
 */
class Cinicio extends CI_controller
{

  function __construct()
  {
    parent::__construct();
    # code...paren
  }

  public function index(){
  #  $this->load->helper('url');
   // $this->load->view('vlogin');
   // if($this->session->userdata('id') == false)
     //   {
            redirect('/cusuario/vlogin');
		//	return true;
        //}
	//	return false;
  }
}




 ?>
