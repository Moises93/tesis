<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 25-02-2017
 * Time: 20:13
 */
class Cdocumentos extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        # code...paren
        $this->load->model('model_usuario');
        $this->load->model('model_admin');
        $this->load->model('model_documentos');
        $this->load->helper('url');
    }

    public function subir_documentos(){

        $data['tipo'] = $this->model_usuario->getTipo();
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
        $this->load->view('documentos/sdocumentos');
        $this->load->view('contenido/footerAdmin');

    }

    public function cargar_archivo() {
        
        
        $titulo=$this->input->post('descripcion');
        $login=$this->session->userdata('Login');
        $idUser=$this->session->userdata('id');
        $archivo = 'archivo';
        $config['upload_path'] = "documentos/";
        $config['file_name'] = $login.$titulo;
        $config['allowed_types'] = "*";
        $config['overwrite']=true; //sobreescrie archivos
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);



        if (!$this->upload->do_upload($archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['uploadSuccess'] = $this->upload->data();
        $tipo= $data['uploadSuccess']['file_type'];
        $size= $data['uploadSuccess']['file_size'];
        print_r($data['uploadSuccess']);
       // echo $data['uploadSuccess']['file_size'];

       $datas = array(
            'titulo' => $this->input->post('titulo'),
            'descripcion' => $this->input->post('descripcion'),
            'tamanio' =>$size,
            'tipo' =>$tipo,
            'nombre_archivo' =>$this->input->post('titulo'),
            'id_usuario'=>$idUser
        );
        print_r($datas);
        $this->model_documentos->guardarDocumento($datas);

        //redirect('/cdocumentos/subir_documentos', 'refresh');


    }
}




?>
