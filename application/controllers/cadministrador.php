<?php
/**
 * Created by PhpStorm.
 * User: eheredia
 * Date: 18/01/2017
 * Time: 1:06 PM
 */

class cadministrador extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        # code...paren
    }


    public function mantenimiento_usuarios()
    {
        $this->load->view('layout/header');
        $this->load->view('contenido/menuAdmin');
        $this->load->view('contenido/vmantenimiento_usuarios');
        $this->load->view('contenido/footerAdmin');
        
    }



}