<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Profesor extends CI_controller
{

    function __construct()
    {
      parent::__construct();
      $this->load->library('Excel');
      $this->load->model('model_ubicacion');
      $this->load->model('model_habilidades');
      $this->load->model('model_empresa');
      $this->load->model('model_usuario');
      $this->load->model('model_tipoprofesor');
      $this->load->model('model_profesor');
      $this->load->model('model_admin');
      $this->load->model('model_pasantia');

    }
    public function gestionProfesor() {
      /*Esto siempre lo hago para cargar el menu dinamico a la vista*/
      $idUser=$this->session->userdata('id');
      $tipo =$this->session->userdata('tipo');
      $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
      $userData = array(
       'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
      );
    /*****************************************************************/
    $profesores = $this->model_usuario->obtener_Profesores();
    $cant = count($profesores);
        $data = array(
           'Profesores' => $profesores,
           'Cantidad' =>$cant
         );
        $data["message"] = NULL;
        @$data["message"]=$this->uri->segment(2);
        $datas['hijo']='profesor/gestionProfesor';
        $datas['padre']=$this->model_admin->obtenerIdPadres($datas['hijo']);

        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('profesor/vprofesor');
        $this->load->view('profesor/footerProfesor');
    }
   /*Actualizada el 18-02-2017*/
    public function get_profesores(){
         $dato = $this->model_usuario->obtener_Profesores();
         header('Content-Type: application/json');
    
         echo json_encode($dato);
    }
    /*esta funcion cambia el estatus de un profesor de tutor a coordinador
    valida ademas que no se encuentre otro coordinador activo */
    public function asignarCoordinador(){
        /*El profesor coordinador tiene permiso para asignar tutores academicos los agrego automaticamente*/
        $clave='tutAcad'; //la clave es unica no debe cambiar en la BD
        $idEscuela = $this->input->post('idEscuela');
        $idPro = $this->input->post('idPro');
        $idUser = $this->input->post('idUser');

        $dato = $this->model_profesor->buscarCoordinadorActivo($idEscuela); //valido que no haya otro coordinador activo
        if(count($dato)==0) {
            $this->model_profesor->asignarCoordinador($idPro);
            $idMen=$this->model_admin->obtenerMenuId($clave); //consulto el idMenu por la clave
            $menu=$idMen->id_menu;
            $this->model_admin->guardarPermisos($idUser,$menu);
           // echo "Operación exitosa";
            echo "true";
        }else{
            echo "false";
           // echo "Ya Existe un coordinador activo para esta escuela";
        }
       
    }
   public function quitarCoordinador(){
        $clave='tutAcad'; //la clave es unica no debe cambiar en la BD
        $idPro = $this->input->post('idPro');
        $idUser = $this->input->post('idUser');

        $this->model_profesor->desasignarCoordinador($idPro);
        $idMen=$this->model_admin->obtenerMenuId($clave); //consulto el idMenu por la clave
        $menu=$idMen->id_menu;
        $this->model_admin->quitarPermiso($idUser,$menu);
        echo "Operación exitosa";

    }


    public function getProfesor($pro_id){
        $dato = $this->model_profesor->getProfesor($pro_id);
        echo json_encode($dato);
    }
    public function obtProfesorPorEscuela(){
        $idEscuela = $this->input->post('idEscuela');
        $dato = $this->model_profesor->obtProfesorPorEscuela($idEscuela);
        echo json_encode($dato);
    }

  public function get_tipoProfesor(){
        $dato = $this->model_tipoprofesor->obtenerTiposProfesor();
         echo json_encode($dato); 
  }

    public function get_ProfesoresTipo(){
        $idEscuela = $this->input->post('idEscuela');
        $idTipo = $this->input->post('idTipo');
        $dato = $this->model_profesor->get_ProfesoresTipo($idEscuela,$idTipo);
        echo json_encode($dato);
    }

   public function crearProfesor(){
      $cedula = $this->input->post('cedula');
      $nombre = $this->input->post('nombre');
      $apellido = $this->input->post('apellido');
      $sexo = $this->input->post('sexo');
      $escuela = $this->input->post('escuela');
      $tipo = $this->input->post('tipo');
      $email = $this->input->post('email');
      $login = $this->input->post('login');
      $password = $this->input->post('password');
      $idUser = $this->model_usuario->insertar2($login,$password,3,$email);
      $data = array(
        'pro_cedula' => $cedula,
        'pro_nombre' => $nombre,
        'pro_apellido' => $apellido,
        'pro_sexo' =>$sexo,
        'id_usuario' =>$idUser,
        'id_escuela' =>$escuela,
        'id_tipo'=>$tipo
        );
        $actualizar = $this->model_profesor->crearProfesor($data);
        if($actualizar)
        {
            return 1;
        }
   }

   public function update_profesor(){
      
    $columna = $_POST["column"];
    $valor = $_POST["editval"];
    $id = $_POST["id"];
    
    $this->model_profesor->updateProfesor($columna,$valor,$id);
     /*if($resultado){
         redirect('/profesor/gestionProfesor/ok');
      }else{
         redirect('/profesor/gestionProfesor/fail');
      }*/
   }

   public function profesor_list_csv(){
       
        $l_profesores = array();
        $l_profesores = $this->model_usuario->obtener_Profesores();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet()->setCellValue('B1','NOMBRE');
        $objPHPExcel->getActiveSheet()->setCellValue('C1','APELLIDO');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'CEDULA');
        $objPHPExcel->getActiveSheet()->setCellValue('E1','SEXO');
        $objPHPExcel->getActiveSheet()->setCellValue('F1','ESCUELA');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'TIPO');
        $objPHPExcel->getActiveSheet()->setCellValue('H1','EMAIL');
        $objPHPExcel->getActiveSheet()->setCellValue('I1','STATUS');
        
        $j = 2;
        for($i=0 ; $i < count($l_profesores); $i++) {
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$j, $l_profesores[$i]->pro_id );
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $l_profesores[$i]->pro_nombre);
             $objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $l_profesores[$i]->pro_apellido);
             $objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $l_profesores[$i]->pro_cedula );
             $objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $l_profesores[$i]->pro_sexo);
             $objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $l_profesores[$i]->esc_nombre);
             $objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $l_profesores[$i]->pro_tipo );
             $objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $l_profesores[$i]->usu_correo);
             $objPHPExcel->getActiveSheet()->setCellValue('I'.$j, $l_profesores[$i]->usu_estatus);
             $j = $j + 1;
       }

        $objPHPExcel->getActiveSheet()->setTitle('Profesores');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Profesores.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
       $objWriter->save('php://output');

       $this->load->view('profesor/index');

   }

    public function actualizarProfesor(){
        $idUsu=$this->input->post('usuario');
        $correo =$this->input->post('correo');
    
        $telefono =$this->input->post('telefono');
        $idpro =$this->input->post('idpro');
    
    
        $usu=$this->model_usuario->actualizar_correo($idUsu,$correo);
        $pas=$this->model_profesor->actualizar_telefono($idpro,$telefono);
    
        if ($usu != FALSE && $pas != FALSE){
            echo('Actualización Exitosa!!');
        }else{
            echo('Ocurrio un error');
        }
    }

    public function evaluarPasantes(){
        $resultado=array();
        $resul=array(
            'id_pasantia' => null,
            'pas_nombre' => null,
            'pas_apellido' => null,
            'emp_nombre' => null,
            'orgaca' => null,
            'estatus' => null,
            'pas_id' => null,
            'requisitos' => null
        );
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        /*Si es tipo prfesor muestro solo sus pasantes y si es usauario admin traigo todos*/
        if($tipo == 3){
          $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
          $idPro= $rsu[0]->pro_id;

          $pas=$this->model_pasantia->obtenerPasantiasAcademicas($idPro);
        }else if ($tipo==1){
            $pas=$this->model_pasantia->getPasantia();
        }
        foreach ($pas as $pas => $row){
            $idPas=$row->pas_id;
            $requisitos=$this->model_pasantia->consultarRequisitos($idPas);
            $resul['id_pasantia']=$row->id_pasantia;
            $resul['pas_nombre']=$row->pas_nombre;
            $resul['pas_apellido']=$row->pas_apellido;
            $resul['emp_nombre']=$row->emp_nombre;
            $resul['orgaca']=$row->orgaca;
            $resul['estatus']=$row->estatus;
            $resul['pas_id']=$row->pas_id;
            if(count($requisitos)>0) {
                $resul['requisitos']=$requisitos;
            }
            array_push($resultado, $resul);
        }
        echo json_encode($resultado);
       /* if(count($pas)>0) {
            echo json_encode($pas);
        }else{
            echo 'Usted no tiene pasantes asignados ';
        }*/


    }
 /* Esta funcion me retorna las pasantias especificas a los que el profesor en tutor*/
    public function obtenerPasantesDeTutor(){
        $resultado=array();
        $tutorE=array();
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        /*Si es tipo prfesor muestro solo sus pasantes y si es usauario admin traigo todos*/
        if($tipo == 3){
            $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
            $idPro= $rsu[0]->pro_id;

            $pas=$this->model_pasantia->obtenerPasantiasAcademicas($idPro);

            $emp=$this->model_pasantia->obtenerPasantiasEmpresariales($idPro);
            if( count($emp) > 0){
                foreach ($emp as $row){
                    array_push($pas, $row);
                    array_push($tutorE, $row['id_pasantia']);
                }

                //$tutorEmpresarial=$emp
            }
           // print_r($pas);
            //print_r($tutorE);
        }else if ($tipo==1){
            $pas=$this->model_pasantia->getPasantiaActiva(); //buscar un metodo mas optimo que traiga solo id

        }
        foreach ($pas as $pas => $row){
            $idPa=$row['pas_id']; //obtener Id-pasante
            $idPas=$row['id_pasantia'];  //obtener Id_Pasantia
            $result=$this->model_pasantia->obtenerPasantiaActiva($idPas);
            $pasantia =array(
                'id_pasantia'    => $result['id_pasantia'],
                'modalidad'      => $result['modalidad'],
                'estatus'        => $result['estatus'],
                'fecha_inicio'   => $result['fecha_inicio'],
                'fecha_final'    => $result['fecha_final'],
                'cedula'         => $result['pas_cedula'],
                'pas_id'         => $result['pas_id'],
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
                'TutorEmp'       => 0,
                'integrantes'    => null,
                'requisitos'     => null

            );

            $requisitos=$this->model_pasantia->consultarRequisitos($idPa);
            $integrantes =  $this->model_pasantia->getIntegrantesPas($idPas);
            if(count($requisitos)>0) {
                $pasantia['requisitos']=$requisitos;
            }
            if(count($tutorE)>0) {
                foreach ($tutorE as $val){
                    if($result['id_pasantia']==$val){
                        $pasantia['TutorEmp']=$val;
                        /*$acumulador = $val s eme ocurre ir gaurdando en un acumulador y validar que ya no este  no me acuerdo(hasta ahora sirve)
                    */
                    }
                    
                }

            }
            if( count($integrantes) > 0){
                $pasantia['integrantes']=$integrantes;
            }
            array_push($resultado, $pasantia);
        }
       echo json_encode($resultado);

    }

    public function evaluar(){
        $this->load->model('model_pasantia');
        /*Esto siempre lo hago para cargar el menu dinamico a la vista*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        $datas['hijo']='profesor/evaluar';
        $datas['padre']=$this->model_admin->obtenerIdPadres($datas['hijo']);
        /*****************************************************************/
        $profesores = $this->model_usuario->obtener_Profesores();
        $cant = count($profesores);
        $data = array(
            'Profesores' => $profesores,
            'Cantidad' =>$cant
        );
        $quiz['preguntas']=$this->model_pasantia->obtenerPreguntas();
        $quiz['respuestas']=$this->model_pasantia->obtenerRespuestas();
        //print_r($quiz);
        //exit();
        $data["message"] = NULL;
        @$data["message"]=$this->uri->segment(2);
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('profesor/evaluar',$quiz);
        $this->load->view('profesor/footerProfesor');
    }




}

?>