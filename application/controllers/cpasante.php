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
            echo $val;

            if($val == 1){
                $nombre=$requisito."-".$login;
                $this->model_documentos->actualizarDocumentoR($requisito,$size,$tipo,$nombre,$idUser);
            }else {
                $this->model_documentos->guardarDocumento($datas);
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

    }

}




?>
