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
         $this->load->model('model_pasante');
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
        $datas['hijo']='cdocumentos/subir_documentos';
        $datas['padre']=$this->model_admin->obtenerIdPadres($datas['hijo']);
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('documentos/sdocumentos');
        $this->load->view('contenido/footerAdmin');

    }

    public function informesFinales(){

        $data['tipo'] = $this->model_usuario->getTipo();
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
         $datas['hijo']='cdocumentos/informesFinales';
        $datas['padre']=$this->model_admin->obtenerIdPadres($datas['hijo']);
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('documentos/informes');
        $this->load->view('documentos/footerDocumentos');

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
        $datas['hijo']='Cdocumentos/biblioteca';
        $datas['padre']=$this->model_admin->obtenerIdPadres($datas['hijo']);
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('documentos/biblioteca');
        $this->load->view('documentos/footerDocumentos');

    }

    public function cargar_archivo() {
        
        
        $linea=$this->input->post('cbLineas');
        $titulo=$this->input->post('descripcion');
        $login=$this->session->userdata('Login');
        $idUser=$this->session->userdata('id');
        $archivo = 'archivo'; //debe coincidir con el name del input tipe file // este nombre es importante
        $config['upload_path'] = "biblioteca/";
       // $config['file_name'] = $login.$titulo;
        $config['allowed_types'] = "pdf|doc|docx";
        $config['overwrite']=true; //sobreescrie archivos
        $config['max_size'] = "150000";
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
            'id_usuario'=>$idUser,
            'descripcion' =>$titulo,
            'id_linea' =>$linea
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

    public function visualizarInformes($name){
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


    public function obtenerDocumentosLineas(){
        $dato = $this->model_documentos->obtenerDocumentosLineas();
       // header('Content-Type: application/json'); no sirve en el servidor
        echo json_encode($dato);
    }

    public function obtenerInformes(){
        $dato = $this->model_documentos->obtenerInformes();
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
             $esVisto= $this->model_documentos->consultarDocumentoVisto($idUser,$iddoc);
                if(count($esVisto)>0){
                    $this->model_documentos->eliminarDocumentoVisto($iddoc,$idUser);
                }
            $this->model_documentos->guardarValoracionLibros($iddoc,$valor,$idUser);
        }
      $this->actualizarRating($iddoc);
    }
    
    public function libroVisto(){
          $iddoc = $this->input->post('id');
          $idUser= $this->session->userdata('id');
          $existe= $this->model_documentos->consultarValoracion($idUser,$iddoc);
          if(count($existe)<1){
                $esVisto= $this->model_documentos->consultarDocumentoVisto($idUser,$iddoc);
                if(count($esVisto)<1){
                    $this->model_documentos->guardarDocumentoVisto($iddoc,$idUser);
                }
          }
          
    }
    public function actualizarRating($iddoc){
        $dato=$this->model_documentos->consultarRating($iddoc);
        $this->model_documentos->actualizarRating($dato,$iddoc);
      //  print_r($dato);
    }
    
    public function kVecinos(){
        $ids=array();
        $docLineaInvestigacion=0;
        $docValoradosMismaEmpresa=0;
        $iddocs='';
        $idUser=$this->session->userdata('id');

        //echo 'idUser'.$idUser;
        $docVistos=$this->model_documentos->obtenerDocumentoVistos($idUser);
        $idPasante=$this->model_pasante->obtenerIdPasante($idUser);
        //evaluar esta condicion o validar en la funcion fnal
        //if($idPasante!=0){ if(idPasante ==0 recomienda generales  y ya)
        if($idPasante!=0){
            $valores= $this->model_pasante->getIdLinea($idPasante); //consulto linea de investigacion y empresa.
            //print_r($valores);
            if($valores!= null){
                if($valores->id_linea !=0 ){
                  $lineaInvestigacion=$valores->id_linea;
                  $docLineaInvestigacion=$this->model_documentos->obtenerDocsLinea($lineaInvestigacion);  
                }
                
                if($valores->emp_id !=0 ){
                     $empId=$valores->emp_id;
                     $docValoradosMismaEmpresa= $this->model_documentos->getDocEmpresa($empId);
                }
               
            }
        }
    
        $docLineaGeneral=$this->model_documentos->obtenerDocsLineaGeneral();
        $valor=$this->model_documentos->usuarioValoracion($idUser);
        //verifico si el usuario ha hecho valoraciones en caso afirmativo ejecuto el K-vecionos
        if($valor != 0){
            $nn=3; //cantidad de recomendaciones que retornara
            $recAdaptativa= $this->adaptativa($docVistos,$docLineaInvestigacion,$docValoradosMismaEmpresa,$docLineaGeneral,$nn);
        
            $ids=$this->recomendacion();

             /*print_r($recAdaptativa);echo '<br/>';
             print_r($ids);echo'<br/>';   


   
            exit();*/
            foreach ($recAdaptativa as $value) {
                $ids[]=$value;
            }

                for( $x = 0; $x < count($ids); $x++ ){
                    $iddocs .=  $ids[$x]. ',';
                }
                $iddocs= substr($iddocs, 0, -1);
              //  echo $iddocs;

               $documentos=$this->model_documentos->librosRecomendados($iddocs);
               // print_r($documentos);
                echo json_encode($documentos);
       // return $documentos;
        }else{

            $nn=5;
            $recAdaptativa= $this->adaptativa($docVistos,$docLineaInvestigacion,$docValoradosMismaEmpresa,$docLineaGeneral,$nn);
        
                for( $x = 0; $x < count($recAdaptativa); $x++ ){
                    $iddocs .=  $recAdaptativa[$x]. ',';
                }
                $iddocs= substr($iddocs, 0, -1);


               $documentos=$this->model_documentos->librosRecomendados($iddocs);
               // print_r($documentos);
                echo json_encode($documentos);
        }

     
    }
    public function adaptativa($docVistos,$docLineaInvestigacion,$docValoradosMismaEmpresa,$docLineaGeneral,$nn){
        $recomendacion=array();
        $lineas=array();
        $empresa=array();
        $general=array();
        $band=0;
        $vectorDePesos=array();
        $vectorDeDocs=array();
       /* echo "<br/>";
        echo'DOC VISTOS';
        print_r($docVistos);echo "<br/>";
            echo'DOC Linea';
        print_r($docLineaInvestigacion);echo "<br/>";
            echo'DOC Empresa';
        print_r($docValoradosMismaEmpresa);echo "<br/>";
            echo'DOC general';
        print_r($docLineaGeneral);echo "<br/>";
*/


        if($docVistos != 0){
            foreach ($docVistos as $value) {
                $vectorDePesos[]=0.1;
                $vectorDeDocs[]=$value;
            }

        }
       /* echo' Primera Asignacion documentos vistos'.'<br />';
        print_r($vectorDePesos);echo "<br/>";
        print_r($vectorDeDocs);echo "<br/>";*/

        
        if($docLineaInvestigacion!=0){
            if(count($vectorDeDocs>0)){
               // echo 'tamaño recomendaciom'.count($vectorDeDocs);
               // echo 'tamaño line'.count($docLineaInvestigacion);
                for ($i=0; $i <count($docLineaInvestigacion) ; $i++) {
                    for ($j=0; $j <count($vectorDeDocs) ; $j++) { 
                        if($docLineaInvestigacion[$i]== $vectorDeDocs[$j]){
                             $band=1;
                            $vectorDePesos[$j]=$vectorDePesos[$j]+0.3;
                        }
                     } 
                     if($band==0){
                         array_push($vectorDePesos,+0.3);
                         array_push($lineas, $docLineaInvestigacion[$i]);
                      }else{
                        $band=0;
                     }      
                }
            }else{
                foreach ($docLineaInvestigacion as $value) {
                    $vectorDePesos[]=0.3;
                    $vectorDeDocs[]=$value;
                }
            }
            foreach ($lineas as $value) {
                $vectorDeDocs[]=$value;
            }

         
        }
     /*   echo' Segunda Asignacion documentos Linea'.'<br />';
        print_r($vectorDePesos);echo "<br/>";
        print_r($vectorDeDocs);echo "<br/>";*/
      
        if($docValoradosMismaEmpresa!=0){
            if(count($vectorDeDocs>0)){
                for ($i=0; $i < count($docValoradosMismaEmpresa) ; $i++) {
                    for ($j=0; $j <count($vectorDeDocs) ; $j++) { 
                        if($docValoradosMismaEmpresa[$i]== $vectorDeDocs[$j]){
                           $band=1;
                            $vectorDePesos[$j]=$vectorDePesos[$j]+0.3;
                        }  
                     }
                     if($band==0){
                        array_push($vectorDePesos,0.3);
                        $empresa[] =$docValoradosMismaEmpresa[$i];   
                     }else{
                        $band=0;
                     } 
                     
                           
                }
            }else{
                foreach ($docValoradosMismaEmpresa as $value) {
                     $vectorDePesos[]=0.3;
                     $vectorDeDocs[]=$value;
                }
            }
           
            foreach ($empresa as $value) {
                $vectorDeDocs[]=$value;
            }
            // print_r($recomendacion);
        }
     /*  echo' Tercera Asignacion documentos Empresa'.'<br />';
        print_r($vectorDePesos);echo "<br/>";
        print_r($vectorDeDocs);echo "<br/>";*/
        if($docLineaGeneral!=0){
            if(count($vectorDeDocs>0)){
                for ($i=0; $i <count($docLineaGeneral) ; $i++) {
                    for ($j=0; $j <count($vectorDeDocs) ; $j++) { 
                        if($docLineaGeneral[$i]== $vectorDeDocs[$j]){
                            $band=1;
                           $vectorDePesos[$j]=$vectorDePesos[$j]+0.3;
                        }
                        
                     } 
                     if($band==0){
                      array_push($vectorDePesos,0.3);
                            array_push($general, $docLineaGeneral[$i]);
                    }else{
                        $band=0;
                     } 
                           
                }
            }else{
                foreach ($docLineaGeneral as $value){
                    $vectorDePesos[]=0.3;
                    $vectorDeDocs[]=$value;
                }
            }
            foreach ($general as $value) {
                $vectorDeDocs[]=$value;
            }
        }
      /*  echo' cuarta Asignacion documentos Generales'.'<br />';
        print_r($vectorDePesos);echo "<br/>";
        print_r($vectorDeDocs);echo "<br/>";*/

        $resultado=array();
        $resultado=$this->ordenamientoInsercion($vectorDePesos,$vectorDeDocs);
    
        /*echo' Documentos con mayor peso'.'<br />';
        print_r($resultado);echo "<br/>";*/
         /***
         * Nota: Consulto el array de las valoraciones dell usuario para descartar esos documentos
         * ya que no es logico recomendar un documento ya valorado por el usuario
         *
         **/

         $idUser=$this->session->userdata('id');
         $valorados=$this->model_documentos->usuarioValoracion($idUser);
       // print_r($valorados);echo '<br />';
         //print_r($resultado);echo '<br />';
        //exit();
         if($valorados!=0){
            $igual=0;
            $p=0;
              for ($i=0; $i <count($resultado) ; $i++) { 
                 for ($j=0; $j <count($valorados) ; $j++) { 
                    if($valorados[$j]==$resultado[$i]){
                        $igual=1;
                    }
                 }
                 if($igual==0){
                    $recomendacion[$p]=$resultado[$i];
                    $p=$p+1;
                 }else{
                    $igual=0;
                 }
              }
          
         }else{
            $recomendacion=$resultado;
         }
      
    // el array de recomendacion CONTIENE todas las recomendaciones en orden de mayor a menor para el usuarios
          //a efectos de este sistema solo recomendamos 5 posibles opciones entre las que estan las recomendaciones
          //realizadas por K-vecinos, la variable que define el retorno en $nn
        $mejoresResultados=array();
        if($nn>count($recomendacion)){
            return $recomendacion;
        }else{
            for ($i=0; $i <$nn ; $i++) { 
                $mejoresResultados[]=$recomendacion[$i]; 
                         
            }
         /*   foreach ($resultado as $value) {
                $recomendacion[]=floor($value);
            }*/
           /* echo' Recomendación Final'.'<br />';
             print_r($recomendacion);echo "<br/>";*/
            return $mejoresResultados;
        }
      
    }
    public function ordenamientoInsercion($vectorDePesos,$vectorDeDocs){
       $n=count($vectorDePesos);

        for ($i = 1; $i < $n; $i++)
        {
                 $temp1 = $vectorDePesos[$i];
                 $temp2= $vectorDeDocs[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $vectorDePesos[$j] < $temp1)
                 {
                          $vectorDePesos[$j + 1] = $vectorDePesos[$j];
                           $vectorDeDocs[$j + 1] = $vectorDeDocs[$j];
                          $j--;
                 }
 
                 $vectorDePesos[$j + 1] = $temp1;
                 $vectorDeDocs[$j + 1] = $temp2;
        }
        return $vectorDeDocs;
    }

    public function recomendacion(){
        $item=array();
        $fila=0;
        $columna=0;
        $usuarios=array();
        $matriz[][]=-1;
        $documentos=$this->model_documentos->obtenerDocumentos();
        $data=$this->model_documentos->usuarios();
        $filas=count($data);
        $columnas=count($documentos);
       // echo $filas;
        //echo $columnas;
        //inicalizo la matriz de valoraciones
        for($i=0;$i<$filas;$i++){
            for($j=0;$j<$columnas;$j++){
                $matriz[$i][$j]=-1;
            }
        }
        //creo array de items
        foreach ($documentos as $row){
            $item[] = $row->iddoc;
        }
        //creo array de usuarios
        foreach ($data as $row){
            $usuarios[] = $row->id_usuario;
        }

       /*echo '<pre>';
        print_r($matriz);
        echo  '</pre>';
        echo 'USUARIOS';
        echo '<pre>';
        print_r($usuarios);
        echo  '</pre>';*/
        //Lleno la matriz con las valoraciones de los usuarios
        foreach ($usuarios as $dato){
            $valoracion=$this->model_documentos->usuariosValoracion($dato);
            foreach ($valoracion as $row){
                $c=0;
                $band=false;
                $cc=0;
                $bandc=false;
                while($band==false){
                   if($usuarios[$c]==$row->id_usuario){
                       $fila=$c;
                       $band=true;
                   }
                    $c=$c+1;
                }
                while($bandc==false){
                   if($item[$cc]==$row->iddoc){
                       $columna=$cc;
                       $bandc=true;
                   }
                    $cc=$cc+1;
                }

                $matriz[$fila][$columna]=$row->valor;

            }
        }

       /* echo 'MATRIZ DE ENTRADA';
        echo '<pre>';
     print_r($matriz);
     echo  '</pre>';*/

       /*  $filas=6;
      $columnas=12;
      $matriz[0][0]=1;
      $matriz[1][0]=-1;
      $matriz[2][0]=1;
      $matriz[3][0]=-1;
      $matriz[4][0]=2;
      $matriz[5][0]=-1;

      $matriz[0][1]=2;
      $matriz[1][1]=-1;
      $matriz[2][1]=-1;
      $matriz[3][1]=1;
      $matriz[4][1]=-1;
      $matriz[5][1]=-1;

      $matriz[0][2]=-1;
      $matriz[1][2]=1;
      $matriz[2][2]=-1;
      $matriz[3][2]=4;
      $matriz[4][2]=5;
      $matriz[5][2]=5;

      $matriz[0][3]=-1;
      $matriz[1][3]=5;
      $matriz[2][3]=2;
      $matriz[3][3]=4;
      $matriz[4][3]=-1;
      $matriz[5][3]=2;

      $matriz[0][4]=2;
      $matriz[1][4]=-1;
      $matriz[2][4]=-1;
      $matriz[3][4]=-1;
      $matriz[4][4]=1;
      $matriz[5][4]=1;

      $matriz[0][5]=-1;
      $matriz[1][5]=5;
      $matriz[2][5]=1;
      $matriz[3][5]=-1;
      $matriz[4][5]=-1;
      $matriz[5][5]=-1;

      $matriz[0][6]=3;
      $matriz[1][6]=3;
      $matriz[2][6]=-1;
      $matriz[3][6]=3;
      $matriz[4][6]=1;
      $matriz[5][6]=-1;

      $matriz[0][7]=4;
      $matriz[1][7]=1;
      $matriz[2][7]=3;
      $matriz[3][7]=-1;
      $matriz[4][7]=-1;
      $matriz[5][7]=4;

      $matriz[0][8]=-1;
      $matriz[1][8]=-1;
      $matriz[2][8]=4;
      $matriz[3][8]=5;
      $matriz[4][8]=-1;
      $matriz[5][8]=-1;

      $matriz[0][9]=4;
      $matriz[1][9]=5;
      $matriz[2][9]=-1;
      $matriz[3][9]=4;
      $matriz[4][9]=-1;
      $matriz[5][9]=1;

      $matriz[0][10]=1;
      $matriz[1][10]=2;
      $matriz[2][10]=-1;
      $matriz[3][10]=-1;
      $matriz[4][10]=2;
      $matriz[5][10]=-1;

      $matriz[0][11]=-1;
      $matriz[1][11]=1;
      $matriz[2][11]=-1;
      $matriz[3][11]=1;
      $matriz[4][11]=1;
      $matriz[5][11]=2;*/

      $matrizItemsComunes =$this->crearMatrizItemsComunesEntreUsuarios($matriz,$filas,$columnas);
      $matrizMSD=$this->calculoMSD($filas,$matrizItemsComunes,$matriz);
      /*consulto el usuario a quien voy a recomendar en este caso es el de la ssesion*/
            $idUser=$this->session->userdata('id');
            $band=false;
            $c=0;
        //$idUser=3;
      //  echo 'idUSER'.$idUser;
        while($band==false && $c<$filas){
            if($usuarios[$c]==$idUser){
                $posFila=$c;
                $band=true;
            }
            $c=$c+1;
        }
        if($band==false){

      //   echo"HAGO UNA RECOMENDACION ALEATORIA";
            for($x=0;$x<3;$x++){
                $aleatorio=rand(0, $columnas-1);
                $recomendacion[]=$item[$aleatorio];
            }
/**En inspecion ya que puedo validar fuera de este metodo si el usuario valoro o no con una consulta sql asi no recorro una matriz****/
        }else{
            //   $posFila=1;
            /*consulto los vecimos de mayor siilitud del usuario*/
            $vecinos= $this->vecinos($matrizMSD,$posFila);
            $estimacion= $this->Estimacion($matriz,$vecinos,$posFila,$columnas);
            $recomendacion=$this->itemRecomendados($estimacion,$item);
        }

        return $recomendacion;
    }
    
    public function crearMatrizItemsComunesEntreUsuarios($matriz,$filas,$columnas){
       $matrizItemsComunes[][]=0;
        for ($u = 0; $u  < $filas; $u++) {
            for ($j = $u + 1; $j < $filas; $j++) {
                $listaItem = Array();
				for ($i = 0; $i < $columnas; $i++) {
                    $a = $matriz[$u][$i];
					$b = $matriz[$j][$i];
					if ($a != -1)
                        if ($b != -1)
                            $listaItem[]=$i;
                           // añadimos el item que hayan
												// votado ambos usuarios
				}
				if (empty($listaItem)) {
                    $listaItem[]=-1; // si no exiten items que hayan votado
                    // ambos usuarios
                    $matrizItemsComunes[$u][$j] = $listaItem;
                } else{
                    $matrizItemsComunes[$u][$j] = $listaItem;

                }
			}
		}
     /*echo "ITEM COMUNES";
        echo '<pre>';
        print_r($matrizItemsComunes);
        echo  '</pre>';*/
        return $matrizItemsComunes;
    }

    /**
     * Algoritmo que se encarga de calcular el MSD (diferencia media cuadrática)
     */
    public function calculoMSD($filas,$matrizItemsComunes,$matriz) {
        $bxy = 0; // numero de items comunes
        $max = 0;
        $min = 6; // ponemos como minimo este valor porque es mayor que el
            // maximo permitido
        for ($u1 = 0; $u1 < $filas; $u1++) {
            for ($u2 = $u1 + 1; $u2 < $filas; $u2++) {
                $lista = $matrizItemsComunes[$u1][$u2];
                $bxy = count($lista);
                if ($lista[0] != -1) {

                    foreach ($lista as $item) {
                    $puntuacionItemU1 = $matriz[$u1][$item];
                    $puntuacionItemU2 = $matriz[$u2][$item];
                        // vemos el maximo y minimo de los dos
                    $maxAux =max($puntuacionItemU1, $puntuacionItemU2);
                    $minAux = min($puntuacionItemU1, $puntuacionItemU2);
                    $max = max($maxAux, $max);
                    $min = min($minAux, $min);
                    }
                    $sum = 0;
                    foreach ($lista as $item) {
                        $puntuacionItemU1 = $matriz[$u1][$item];
                        $puntuacionItemU2 = $matriz[$u2][$item];
                        $sum = $sum
                            + pow(
                                (($puntuacionItemU1 - $puntuacionItemU2) / ($max - $min)),
                                2.0);
                    }
                    $similitud = 1.0 - ((1.0 / $bxy) * $sum);
                    $matrizMSD[$u1][$u2] = $similitud;
                }else{
                    $matrizMSD[$u1][$u2] = -1; //sino hay concidencio lleno con -1 . y completo la matriz
                }
            }
        }
        $val=count($matrizMSD);
        $val2=$val;
    /*echo "MSD casi COMPLETADA";
        echo '<pre>';
        print_r($matrizMSD);
        echo  '</pre>';*/

        for($i=0;$i<$val;$i++){
            $f=$i+1;
            for($j=0;$j<$val2;$j++){
                $matrizMSD[$f][$i]=$matrizMSD[$i][$f];
                $f=$f+1;
            }
            $val2=$val2-1;
        }

       /* echo "MSD COMPLETADA";
        echo '<pre>';
        print_r($matrizMSD);
        echo  '</pre>';*/
        return $matrizMSD;
        //echo $matrizMSD[1][0];
	}

    /**
     * Ordena la matriz de compatiblidad creando otra
     */

    public function vecinos($matrizMSD,$idUser){
       /* echo "USUARIO A RECOMENDAR";
        echo '<pre>';
        print_r($matrizMSD[$idUser]);
        echo  '</pre>';*/
        $arrayVecinos= $matrizMSD[$idUser];
        for($j=0;$j<2;$j++) {
            $mayor=-10;
            for ($i = 0; $i <= count($arrayVecinos); $i++) {
                  if ($i != $idUser) {
                      if ($arrayVecinos[$i] > $mayor) {
                          $mayor = $arrayVecinos[$i];

                          $pos=$i;
                      }
                  }
              }
            $arrayVecinos[$pos]=-1;
            $vecinos[] = $pos;
        }
        /*echo "USUARIO A RECOMENDAR ordenado";
        echo '<pre>';
        print_r($vecinos);
        echo  '</pre>';
          //arsort($matrizMSD[$idUser]);
       /* echo "USUARIO A RECOMENDAR ordenado";
        echo '<pre>';
        print_r($matrizMSD[$idUser]);
        echo  '</pre>';*/
        return $vecinos;
    }

    public function Estimacion($matriz,$vecinos,$posFila,$columnas){
       $estimaciones=array();
       /* echo "MATRIZ";
        echo '<pre>';
        print_r($matriz);
        echo  '</pre>';*/


       for($i=0;$i<$columnas;$i++){
           $count=0;
           $acumulador=0;
           if($matriz[$posFila][$i] == -1){
               for($j=0;$j< count($vecinos);$j++){
                   $puntuacion=$matriz[$vecinos[$j]][$i];
                   if($puntuacion!=-1){
                      $count=$count+1;
                      $acumulador=$acumulador+$puntuacion;
                   }
               }
           }else{
               //me interesa recomendar documentos a los que el usuario no ha valorado
               //por eso asign -1 para que no tome encuenta valoraciones ya hechas por el usuario
               $acumulador=-1;
                   //$matriz[$posFila][$i];
           }
           if($count==2){
               $estimaciones[]=$acumulador/2;
           }else if($count==1){
               $estimaciones[]=$acumulador;
           }else if($count==0){
               $estimaciones[]=$acumulador;
           }
       }

        /* echo "ESTIMACION DE UN USUARIO DADO";
        echo '<pre>';
        print_r($estimaciones);
        echo  '</pre>';*/
        return $estimaciones;
    }

    public function itemRecomendados($estimacion,$columnas){
        $pos=0;
        $posicionItem=array();
        $recomendacion=array();
        for($j=0;$j<3;$j++) {
            $mayor=0;
            for ($i = 0; $i < count($estimacion); $i++) {

                if ($estimacion[$i] > $mayor) {
                    $mayor = $estimacion[$i];

                    $pos=$i;
                }

            }
            $estimacion[$pos]=-1;
            $posicionItem[] = $pos;
        }

        foreach ($posicionItem as $row){
            $recomendacion[]=$columnas[$row];
        }

      /*  echo "TE RECOMIENDO LOS SIGUIENTES IfTEM";
        echo '<pre>';
        print_r($posicionItem);
        echo  '</pre>';


        echo "ESTOS SON LOS ID";
        echo '<pre>';
        print_r($recomendacion);
        echo  '</pre>';*/
        return $recomendacion;

    }
}


?>
