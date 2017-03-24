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
        $this->load->model('model_documentos');
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
        $orgaca= $this->input->post('orgaca');
        $escuela= $this->input->post('escuela');
        $estudiante= $this->input->post('estudiante');
        $fechaIni= $this->input->post('fechaIni');
        $fechaFin= $this->input->post('fechaFin');

        $requisitos=$this->model_documentos->requisitosPasante($estudiante);

        if(count($requisitos)>2) {
            $estatus=2; //requisitos, carta Aceptacion, actividades y cv listos.
        }else{
            $estatus=1; //por defecto inserto estatus 1 =iniciada
        }

        if($empresa < 0 ){
            $empresa=null;
        }
        return $this->model_pasantia->agregarPasantia($modalidad,$empresa,$orgaca,$escuela,
        $estudiante,$fechaIni,$fechaFin,$estatus);

       
    }
    
    public function getPasantia(){
        $dato = $this->model_pasantia->getPasantia();
        
        echo json_encode($dato);
    }

    public function getIntegrantesPasantia(){

        $integrantesPas=array();
        $cont=0;
        $pasantias = $this->model_pasantia->getPasantiaActiva();

        foreach($pasantias as $result) {

            $pasantia =array(
                'id_pasantia'    => $result['id_pasantia'],
                'modalidad'      => $result['modalidad'],
                'estatus'        => $result['estatus'],
                'fecha_inicio'   => $result['fecha_inicio'],
                'fecha_final'    => $result['fecha_final'],
                'cedula'         => $result['pas_cedula'],
                'sexo'           => $result['pas_sexo'],
                'nombre'         => $result['pas_nombre'],
                'apellido'       => $result['pas_apellido'],
                'telefono'       => $result['pas_telefono'],
                'login'          => $result['usu_login'],
                'correo'         => $result['usu_correo'],
                'foto'           => $result['usu_foto'],
                'escuela'        => $result['esc_nombre'],
                'orgaca'         => $result['orgaca'],
                'universidad'    => 'Universidad de Carabobo',
                'empresa_id'     => $result['emp_id'],
                'empresa'        => $result['emp_nombre'],
                'id_escuela'     => $result['id_escuela'],
                'integrantes'    => null,
                'requisitos'     => null

            );
            /*Consulto los Requisitos de la tabla Documentos Requeridos*/
            $idPa=$result['pas_id'];
            $requisitos=$this->model_pasantia->consultarRequisitos($idPa);
            /*Consulto los Integrantes o Tutores de la Pasantia*/
            $idPas = $result['id_pasantia'];
            $integrantes =  $this->model_pasantia->getIntegrantesPas($idPas);
            /*agrego los requisitos al array pasantia*/
            if(count($requisitos)>0) {
                $pasantia['requisitos']=$requisitos;
            }
            /*agrego los Integrantes al array pasantia*/
            if( count($integrantes) > 0){
                $pasantia['integrantes']=$integrantes;
            }
            /*esto lo hago para que l aprimera vez que se ejecute no sobreescriba y agregue en la primera posicion*/
            if($cont>0){
                array_push($integrantesPas, $pasantia);
            }else{
                $integrantesPas[$cont] =$pasantia;
            }

            $cont= $cont+1;

        }


      /*   print_r($integrantesPas);
         exit();*/

        echo json_encode($integrantesPas);
    }

    public function actualizarPasantia(){
        
        $empresa= $this->input->post('empresa');
        $orgaca=  $this->input->post('orgaca');
        $fechaIni= $this->input->post('fechaIni');
        $fechaFin= $this->input->post('fechaFin');
        $pasantia= $this->input->post('idPasantia');
        if($empresa < 0 ){
            $empresa=null;
        }
        
        $pas=$this->model_pasantia->actualizarPasantia($pasantia,$empresa,$orgaca,$fechaIni,$fechaFin);

        if ($pas != FALSE){
            echo('Actualización Exitosa!!');
        }else{
            echo('Ocurrio un error');
        }
    }
    public function  aprobarPasantia(){

        $idPas= $this->input->post('idPasantia');
        $estatus=  $this->input->post('estatus');
        
        if($estatus>3){
            $pas=$this->model_pasantia->actualizarEstatusPasantia($idPas,5);
        }else{
            $pas=FALSE;
        }
        if ($pas != FALSE){
            echo('Actualización Exitosa!!');
        }else{
            echo('Ocurrio un error');
        }
    }
}
?>
