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
                'id_usuario'=>$idUser
            );
           // print_r($datas);

            $val=$this->model_documentos->existeRequisito($idUser,$requisito);


            if($val == 1){
                $nombre=$requisito."-".$login;
                $this->model_documentos->actualizarDocumentoR($requisito,$size,$tipo,$nombre,$idUser);

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

       // $data = file_get_contents(base_url().'documentos/'.$name);
        //force_download($name,$data);
       //  header('content-type: application/pdf');
       // readfile(base_url().'documentos/'.$name);

        $filename = "test.pdf";
        $route = base_url().'documentos/'.$name;
        if(file_exists ('documentos/'.$name)){
             header('Content-type: application/pdf');
            readfile($route);
           // echo 'ahora si ';
        }else{
           // echo $route;
            //Mejorar creando una pagina de errores que redireccione al dasboard del usuario ( obteniendo los datos con la variable sseion)
            echo "Este Archivo no existe, solicite una nueva carga del documento";
        }

       
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
        $this->load->view('contenido/footerAdmin');
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

}




?>
