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

        $this->load->model('model_usuario');
    }


    public function mantenimiento_usuarios()
    {
        $this->load->library('table');
        $this->load->library('pagination');
        $dato['results']=$this->model_usuario->consultar_usuarios();
/*echo "<pre>";
    print_r($dato['results']);
        echo "</pre>";
        exit();*/
        $this->load->view('layout/header');
        $this->load->view('contenido/menuAdmin');
        $this->load->view('contenido/vmantenimiento_usuarios',$dato);
        $this->load->view('contenido/footerAdmin');
        
    }

    public function crear_usuario()
    {
    
        $this->load->view('layout/header');
        $this->load->view('contenido/menuAdmin');
        $this->load->view('contenido/vcrear_usuario');
        $this->load->view('contenido/footerAdmin');

    }

    public function insertarU()
    {
        $login= $this->input->post('login');
        $clave= $this->input->post('clave');
        $tipo= $this->input->post('tipo');
        $correo= $this->input->post('email');


        $this->model_usuario->insertar($login,$clave,$tipo,$correo);

        $this->load->view('layout/header');
        $this->load->view('contenido/menuAdmin');
        $this->load->view('contenido/vcrear_usuario');
        $this->load->view('contenido/footerAdmin');
    }



}