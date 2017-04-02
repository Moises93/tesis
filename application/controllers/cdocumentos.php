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
        $this->load->library('Pdf');
        $this->load->model('model_usuario');
        $this->load->model('model_admin');
        $this->load->model('model_documentos');
        $this->load->model('model_pasantia');
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
    public function biblioteca(){

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
        $this->load->view('documentos/biblioteca');
        $this->load->view('documentos/footerDocumentos');

    }

    public function cargar_archivo() {
        
        
        $titulo=$this->input->post('descripcion');
        $login=$this->session->userdata('Login');
        $idUser=$this->session->userdata('id');
        $archivo = 'archivo';
        $config['upload_path'] = "biblioteca/";
       // $config['file_name'] = $login.$titulo;
        $config['allowed_types'] = "pdf|doc";
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
        $name=$data['uploadSuccess']['raw_name'];
     //   print_r($data['uploadSuccess']);
      //  echo $data['uploadSuccess']['raw_name'];
      //  exit();
       $datas = array(
            'size' =>$size,
            'formato' =>$tipo,
            'nombredoc' =>$name,
            'id_usuario'=>$idUser
        );
    //    print_r($datas);
        $valor=$this->model_documentos->existeDocumento($name); 
       if($valor == true){
           $this->model_documentos->actualizarDocumentoBiblioteca($datas);
       }else{ 
            $this->model_documentos->guardarDocumentoBiblioteca($datas);
       }
        redirect('/cdocumentos/subir_documentos', 'refresh');


    }
    public function cargarMultiplesArchivos() {


        $titulo=$this->input->post('descripcion');
        $login=$this->session->userdata('Login');
        $idUser=$this->session->userdata('id');
        $archivo = 'archivo';
        $config['upload_path'] = "biblioteca/";
       // $config['file_name'] = $login.$titulo;
        $config['allowed_types'] = "pdf|doc";
        $config['overwrite']=true; //sobreescrie archivos
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']); //userfile nombre del input en la vista
        for($i=0; $i<$cpt; $i++)
        {
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];

            $this->upload->initialize($config);
            $this->upload->do_upload();
            if (!$this->upload->do_upload())
            {
                $errors = $this->upload->display_errors();
                flashMsg($errors);
            }
            else
            {
                $data['uploadSuccess'] = $this->upload->data();
                $tipo= $data['uploadSuccess']['file_type'];
                $size= $data['uploadSuccess']['file_size'];
                $name=$data['uploadSuccess']['raw_name'];
                //   print_r($data['uploadSuccess']);
                //  echo $data['uploadSuccess']['raw_name'];
                //  exit();
                $datas = array(
                    'size' =>$size,
                    'formato' =>$tipo,
                    'nombredoc' =>$name,
                    'id_usuario'=>$idUser
                );
                //    print_r($datas);
                $valor=$this->model_documentos->existeDocumento($name);
                if($valor == true){
                    $this->model_documentos->actualizarDocumentoBiblioteca($datas);
                }else{
                    $this->model_documentos->guardarDocumentoBiblioteca($datas);
                }

            }
        }

       redirect('/cdocumentos/subir_documentos', 'refresh');


    }

    public function visualizarDocumentos($name){
        $filename = "test.pdf";
        $route = base_url().'biblioteca/'.$name;
        if(file_exists ('biblioteca/'.$name)){
            header('Content-type: application/pdf');
            readfile($route);
            // echo 'ahora si ';
        }else{
            // echo $route;
            //Mejorar creando una pagina de errores que redireccione al dasboard del usuario ( obteniendo los datos con la variable sseion)
            echo "Este Archivo no se encuentra";
        }


    } 
    public function verRequisito($name){
        $filename = "test.pdf";
        $route = base_url().'documentos/'.$name;
        if(file_exists ('documentos/'.$name)){
            header('Content-type: application/pdf');
            readfile($route);
            // echo 'ahora si ';
        }else{
            // echo $route;
            //Mejorar creando una pagina de errores que redireccione al dasboard del usuario ( obteniendo los datos con la variable sseion)
            echo "Este Archivo no se encuentra";
        }


    }
    public function generarConstancia($id){
        //$ide['ide']=$id;
        $datos['info']=$this->model_pasantia->obtenerPasantiaActiva($id);
        //echo $ide;
        if($datos['info']['estatus'] <5){
            echo 'Esta Pasantia aun no esta aprobada';
        }else{
            $this->load->view('documentos/constancia',$datos);
        }
        
    }

    public function generar()
    {
        $this->load->library('Pdf');
        ini_set("session.auto_start", 0);
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Israel Parra');
        $pdf->SetTitle('Ejemplo de provincías con TCPDF');
        $pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        // ---------------------------------------------------------
        // establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

        // Establecer el tipo de letra

        //Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 14, '', true);

        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

        //fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // Establecemos el contenido para imprimir
        //$provincia = $this->input->post('provincia');
        //$provincias = $this->pdfs_model->getProvinciasSeleccionadas($provincia);
        $provincias =array(
            'p.provincia' =>'h',
            'l.localidad' =>'h',
            'l.id' =>'h',

        );
        /*foreach($provincias as $fila)
        {
        $prov = $fila['p.provincia'];
        }*/
        $prov='ehe';
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h2>Localidades de " . $prov . "</h2><h4>Actualmente: " . count($provincias) . " localidades</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Id localidad</th><th>Localidades</th></tr>";

        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
       /* foreach($provincias as $fila)
        {
         $id = $fila['l.id'];
        $localidad = $fila['l.localidad'];
        $html .= "<tr><td class='id'>" . $id . "</td><td class='localidad'>" . $localidad . "</td></tr>";
        }*/
        $html .= "</table>";

        // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidades de " . $prov . ".pdf");
       // ob_end_clean();
        $nombre='holabb';
      //  $pdf->Output($nombre_archivo, 'I');
       // $pdf->Output($nombre_archivo, 'F');
      //  echo ($_SERVER['DOCUMENT_ROOT'].'tesis/application/documentos');
        ///require "/path/to/file";
        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'tesis/application/documentos/'.$nombre.'.pdf', 'F');
        //ob_end_flush();
    }

    public function obtenerDocumentos(){
        $dato = $this->model_documentos->obtenerDocumentos();
       // header('Content-Type: application/json'); no sirve en el servidor
        echo json_encode($dato);
    }

    public function valorarLibros(){
        $iddoc = $this->input->post('iddoc');
        $valor = $this->input->post('valor');
        $idUser=$this->session->userdata('id');

        $existe=$this->model_documentos->consultarValoracion($idUser,$iddoc);
        if(count($existe)>0){
            $this->model_documentos->actualizarValoracionLibros($iddoc,$valor,$idUser);
        }else{
            $this->model_documentos->guardarValoracionLibros($iddoc,$valor,$idUser);
        }
      $this->actualizarRating($iddoc);
    }

    public function actualizarRating($iddoc){
        $dato=$this->model_documentos->consultarRating($iddoc);
        $this->model_documentos->actualizarRating($dato,$iddoc);
      //  print_r($dato);
    }
}




?>
