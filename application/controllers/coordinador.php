<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 04-03-2017
 * Time: 16:51
 */
class Coordinador extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        # code...paren
        $this->load->model('model_usuario');
        $this->load->model('model_pasantia');
        $this->load->helper('download');
    }


    public function gestionCoordinador()
    {

        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('coordinador/gestion');
        $this->load->view('coordinador/footerCoordinador');

    }

    public function asignarTutores()
    {

        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('coordinador/asignarTutores');
        $this->load->view('coordinador/footerCoordinador');

    }

    public function tutorOganizacional()
    {

        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('coordinador/tutorOrganizacional');
        $this->load->view('coordinador/footerCoordinador');

    }
    /*Actualiza e inserta */
    public function agregarTutorA(){
        $idPasantia= $this->input->post('idPasantia');
        $tutorA= $this->input->post('tutorA');
        $tipo= $this->input->post('tipo'); //el tipo me va a diferenciar entre tutor academico y tutor organizacional profesor
        $data = array(
            'pro_id' => $tutorA,
            'id_pasantia'=>$idPasantia,
            'tipo' =>$tipo
        );
        $consulta= $this->model_pasantia->consultarTutor($data);


        if(count($consulta)==0) {
            $val= $this->model_pasantia->insertarTutorA($data);
        }else{
            $val = $this->model_pasantia->actualizarTutorA($data);
        }
        if($val != FALSE)
        {
            echo "Operación exitosa";
        }else{
            echo "Ha ocurrido un error inesperado";
        }
    }
    public function agregarTutorO(){
        $idPasantia= $this->input->post('idPasantia');
        $tutorA= $this->input->post('tutorO');
        $tipo= $this->input->post('tipo'); //el tipo me va a diferenciar entre tutor academico y tutor organizacional profesor
        $data = array(
            'idusuario_empresa' => $tutorA,
            'id_pasantia'=>$idPasantia,
            'tipo' =>$tipo
        );
        $consulta= $this->model_pasantia->consultarTutor($data);


        if(count($consulta)==0) {
            $val= $this->model_pasantia->insertarTutorA($data);
        }else{
            $val = $this->model_pasantia->actualizarTutorA($data);
        }
        if($val != FALSE)
        {
            echo "Operación exitosa";
        }else{
            echo "Ha ocurrido un error inesperado";
        }
    }
    public function insertarTutorProfesor(){
        $idPasantia= $this->input->post('idPasantia');
        $tutorA= $this->input->post('tutorA');
        $tipo= $this->input->post('tipo'); //el tipo me va a diferenciar entre tutor academico y tutor organizacional profesor
        $data = array(
            'pro_id' => $tutorA,
            'id_pasantia'=>$idPasantia,
            'tipo' =>$tipo
        );
        $val = $this->model_pasantia->actualizarTutorA($data);
        if($val != FALSE)
        {
            echo "Operación exitosa";
        }else{
            echo "Ha ocurrido un error inesperado";
        }
    }
    public function downloads(){
        $archivo= $this->input->post('archivo');
        $data = file_get_contents(base_url().'documentos/'.$archivo);
        force_download($archivo,$data);

    }
}




?>