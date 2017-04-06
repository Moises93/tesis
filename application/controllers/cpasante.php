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
        $this->load->model('model_documentos');
        $this->load->model('model_pasantia');
        $this->load->helper('download');
        $this->load->library('pagination');
    }
   /*obtengo todos los estudiantes pasantes y no pasantes*/
    public function getEstudiantes(){
        $dato = $this->model_pasante->getEstudiantes();
        echo json_encode($dato);
    }
    /*obtengo todos los estudiantes que aun no han empezado pasantias*/
    public function getPostulados(){
        $dato = $this->model_pasante->getPostulados();
        echo json_encode($dato);
    }
    /*obtengo todos los estudiantes que aun no han empezado pasantias*/
    public function getPostuladosEstudiantes(){
        $escuela=$this->input->post('escuelaid');
        $dato = $this->model_pasante->getPostuladosEstudiantes($escuela);

        echo json_encode($dato);
    }
    /*obtengo todos los estudiantes que  han empezado pasantias*/
    public function getPasantes(){
       // $dato = $this->model_pasante->getPostulados();
      //  echo json_encode($dato);
    }

    public function requisitos(){
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        $re=$this->model_documentos->buscarRequisitos($idUser);

       /* print_r($re);
        exit();*/
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('pasante/vrequisitos',$re);
        $this->load->view('contenido/footerAdmin');
    }

    public function cargar_requisito() {

        $requisito=$this->input->post('requisito');
        $validador=$this->input->post('validaror');
        $titulo=$this->input->post('titulo');
      //  if(isset($titulo)){
          //  echo 'hola' ;
       /// }

       // print_r($titulo);
        //exit();
        $idUser=$this->session->userdata('id');
        $login=$this->session->userdata('Login');



        $archivo = 'requisitos';
        $config['upload_path'] = "documentos/";
        $config['file_name'] = $requisito."-".$login;
        $config['allowed_types'] = "*";
        $config['overwrite']=true; //sobreescrie archivos
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);



        if (!$this->upload->do_upload($archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
         //   echo $this->upload->display_errors();
           $info=$data['uploadError'] ;

        }else{

            $data['uploadSuccess'] = $this->upload->data();
            $info= 1;
            $tipo= $data['uploadSuccess']['file_ext'];
            $size= $data['uploadSuccess']['file_size'];
           // $name= $data['uploadSuccess']['orig_name'];
           //print_r($data['uploadSuccess']);
            // echo $data['uploadSuccess']['file_size'];

            $datas = array(
                'requisito' => $requisito,
                'size' =>$size,
                'formato' =>$tipo,
                'nombre_archivo' =>$requisito."-".$login,
                'id_usuario'=>$idUser,
                'titulo' =>$titulo
            );
           // print_r($datas);

            $val=$this->model_documentos->existeRequisito($idUser,$requisito);


            if($val == 1){
                $nombre=$requisito."-".$login;
                $this->model_documentos->actualizarDocumentoR($requisito,$size,$tipo,$nombre,$idUser,$titulo);

            }else {

                $this->model_documentos->guardarDocumento($datas);
                 if($requisito =='planActividades'){
                     $valo=$this->model_pasantia->existePasantia($idUser);
                     if(count($valo)>0) {
                         $idPas=$valo[0]->id_pasantia;
                         $estatusActual=$valo[0]->estatus;
                         /*En caso de que ya exista el registro en pasantia debo verificar su estatus si es 1 aumento a 2 de lo contrario
                         dejo el estatus actual,valido: para el caso en que el estudiante cambie el plan de actividades despues de haber
                         avanzado con el informe u evaluaciones*/
                         if($estatusActual<2){
                             $estatus=2;
                         }else{$estatus=$estatusActual;}
                         $this->model_pasantia->actualizarEstatusPasantia($idPas, $estatus); //validar si existe la pasantia,en caso que exista validar que eñ estatus sea menor a 2
                     }
                 }
            }


        //redirect('/cdocumentos/subir_documentos', 'refresh');
        }

        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        $re=$this->model_documentos->buscarRequisitos($idUser);
        $re['mensaje']=$info;
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('pasante/vrequisitos',$re);
        $this->load->view('contenido/footerAdmin');

    }

    public function downloads($name){
        $data = file_get_contents(base_url().'documentos/'.$name);
        force_download($name,$data);
       //  header('content-type: application/pdf');
       // readfile(base_url().'documentos/'.$name);

      //  $filename = "test.pdf";
      //  $route = base_url().'documentos/'.$name;
      //  if(file_exists ('documentos/'.$name)){
          //   header('Content-type: application/pdf');
       //     readfile($route);
           // echo 'ahora si ';
     //   }else{
           // echo $route;
            //Mejorar creando una pagina de errores que redireccione al dasboard del usuario ( obteniendo los datos con la variable sseion)
       //     echo "Este Archivo no existe, solicite una nueva carga del documento";
      //  }
    }


    public function esPasante(){
        $idPas= $this->input->post('estudiante');
        $resul=$this->model_pasante->esPasante($idPas);
        if (isset($resul)){
           return 1;
        }else{
            return 0;
        }
    }

    public function listarEstudiantes(){
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /* print_r($re);
         exit();*/
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('pasante/estudiantes');
        $this->load->view('contenido/footerAdmin');
    }

    public function pasantia(){
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /* print_r($re);
         exit();*/
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('pasante/pasantia');
        $this->load->view('pasante/footerPasante');
    }

    public function updEstudiante(){
        $idUsu=$this->input->post('usuario');
        $correo =$this->input->post('correo');
        
        $telefono =$this->input->post('telefono');
        $idpas =$this->input->post('idpas');


        $usu=$this->model_usuario->actualizar_correo($idUsu,$correo);
        $pas=$this->model_pasante->actualizar_telefono($idpas,$telefono);

        if ($usu != FALSE && $pas != FALSE){
            echo('Actualización Exitosa!!');
        }else{
            echo('Ocurrio un error');
        }
    }


    public function miPasantia(){
        $resultado=array();
        $tutorE=array();
        $idUser=$this->session->userdata('id');
        /*Si es tipo prfesor muestro solo sus pasantes y si es usauario admin traigo todos*/

          
        
            $idPas=$this->model_pasantia->obtenerPasnatiaDeEstudiante($idUser); //obtener Id-pasante


            $result=$this->model_pasantia->obtenerPasantiaActiva($idPas);
            $idPa=$result['pas_id'];
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

            );

           // $requisitos=$this->model_pasantia->consultarRequisitos($idPa);
            $integrantes =  $this->model_pasantia->getIntegrantesPas($idPas);
           /* if(count($requisitos)>0) {
           //     $pasantia['requisitos']=$requisitos;
           // }*/
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

        echo json_encode($resultado);

    }

    function listarEstudiante(){
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
        $userData = array(
            'user' => $rsu
        );

        //Deberiamos separa estas secciones en funciones mas pequeñas.
        //Configuracion Paginacion
        $total = $this->model_pasante->getCountPostulados();
        $config = array();
        $config["base_url"] = base_url() . "cpasante/listarEstudiante";
        $config["total_rows"] = $total[0]->Total;
        $config["per_page"] = 9;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 4;
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (int)($this->uri->segment(3))-1 ;
            $page *= $config["per_page"];
        }
        else{
            $page = 1;
        }
        //Fin Configuracion Paginacion
        //Traer Postulados Paginados
        $rsul =$this->model_pasante->getPostulados($config["per_page"], $page);
        $str_links = $this->pagination->create_links();

        //Fin de Traer Postulados Paginados
        $quiz['preguntas']=$this->model_pasantia->obtenerPreguntas();
        $quiz['respuestas']=$this->model_pasantia->obtenerRespuestas();
        $principal=0;
        $pasantes = array(
            'Pasantes' => $rsul,
            'preguntas' => $quiz['preguntas'],
            'respuestas' => $quiz['respuestas'],
            'principal' =>$principal
        );
        $pasantes['links'] = explode('&nbsp;',$str_links);

        $data['menu'] =$this->model_usuario->menuPermisos($idUser);
        $data['user'] = $rsu;
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$data);
        $this->load->view('empresa/dashboardEmpresa',$pasantes);
        $this->load->view('empresa/footerEmpresa');

    }


}




?>
