<?php
/**
 * Created by PhpStorm.
 * User: eheredia
 * Date: 23/02/2017
 * Time: 11:39 AM
 */
class Cpasante extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        # code...paren
        $this->load->model('model_usuario');
        $this->load->model('model_pasante');
    }

    public function get_pasantes(){
        $dato = $this->model_pasante->getPasante();
        echo json_encode($dato);
    }

}




?>
