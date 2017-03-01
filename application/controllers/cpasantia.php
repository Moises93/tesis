<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 28-02-2017
 * Time: 11:54
 */
class Cpasantia extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        # code...paren
        $this->load->model('model_usuario');
        $this->load->model('model_admin');
        $this->load->model('model_ubicacion');
        $this->load->model('model_habilidades');
        $this->load->model('model_pasantia');
    }

    public function gestionPasantia(){
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        /*****************************************************************/
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('pasantia/vpasantia');
        $this->load->view('pasantia/footerPasantia');
    }

    public function agregarPasantia()
    {
        $modalidad= $this->input->post('modalidad');
        $empresa= $this->input->post('empresa');
        $tutorE= $this->input->post('tutorE');
        $tutorA= $this->input->post('tutorA');
        $escuela= $this->input->post('escuela');
        $estudiante= $this->input->post('estudiante');
        $fechaIni= $this->input->post('fechaIni');
        $fechaFin= $this->input->post('fechaFin');

        $estatus=1; //por defecto inserto estatus 1 =iniciada

        return $this->model_pasantia->agregarPasantia($modalidad,$empresa,$tutorE,$tutorA,$escuela,
        $estudiante,$fechaIni,$fechaFin,$estatus);

       
    }
    
    public function getPasantia(){
        $dato = $this->model_pasantia->getPasantia();
        echo json_encode($dato);
    }
    
}
?>
