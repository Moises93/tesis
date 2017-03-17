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
        $orgaca= $this->input->post('orgaca');
        $escuela= $this->input->post('escuela');
        $estudiante= $this->input->post('estudiante');
        $fechaIni= $this->input->post('fechaIni');
        $fechaFin= $this->input->post('fechaFin');

        $estatus=1; //por defecto inserto estatus 1 =iniciada
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
                'cedula'         => $result['pas_cedula'],
                'nombre'         => $result['pas_nombre'],
                'apellido'       => $result['pas_apellido'],
                'login'          => $result['usu_login'],
                'escuela'        => $result['esc_nombre'],
                'orgaca'         => $result['orgaca'],
                'empresa_id'     => $result['emp_id'],
                'empresa'        => $result['emp_nombre'],
                'id_escuela'     => $result['id_escuela'],
                'integrantes'    => null

            );
            $idPas = $result['id_pasantia'];
            $integrantes =  $this->model_pasantia->getIntegrantesPas($idPas);
            //echo "hijos";
            //echo '<pre>'; print_r($hijos); echo '</pre>';
            // echo "cantidad de hijos" .count($hijos);
            if( count($integrantes) > 0){
                $pasantia['integrantes']=$integrantes;
            }
            if($cont>0){
                array_push($integrantesPas, $pasantia);
            }else{
                $integrantesPas[$cont] =$pasantia;
            }
            //  echo "menu";
            //echo '<pre>'; print_r($menuUser); echo '</pre>';
            $cont= $cont+1;
            // echo "-".$menu->id_menu;
            //echo "-".$menu->nombre;
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
    
}
?>
