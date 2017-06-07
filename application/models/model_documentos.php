<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 25-02-2017
 * Time: 23:15
 */

class Model_documentos extends CI_Model
{
    //constructor predeterminado del modelo
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    public function guardarDocumento($data){
        $this->db->insert('documentos_requeridos', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    public function guardarDocumentoBiblioteca($data){
        $this->db->insert('documentos', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function buscarRequisitos($idUser){

        $this->db->select('CONCAT (doc.nombre_archivo,'.',doc.formato) AS name',false);
        $this->db->where('doc.id_usuario', $idUser);
        $this->db->where("(doc.requisito='cartaAceptacion')",NULL,FALSE);
        $query = $this->db->get('documentos_requeridos doc');


        //OR doc.descripcion='cartaAceptacion' OR doc.descripcion='planActividades')", NULL, FALSE);

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $object) {
                $aceptacion =   $object['name'];
            }
        }else{
            $aceptacion=0;
        }
        $this->db->select('CONCAT (doc.nombre_archivo,'.',doc.formato) AS name',false);
        $this->db->where('doc.id_usuario', $idUser);
        $this->db->where("(doc.requisito='planActividades')",NULL,FALSE);
        $query = $this->db->get('documentos_requeridos doc');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $object) {
                $actividades =   $object['name'];
            }

        }else{
            $actividades=0;
        }

        $this->db->select('CONCAT (doc.nombre_archivo,'.',doc.formato) AS name',false);
        $this->db->where('doc.id_usuario', $idUser);
        $this->db->where("(doc.requisito='cv')",NULL,FALSE);
        $query = $this->db->get('documentos_requeridos doc');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $object) {
                $cv =   $object['name'];
            }
        }else{
            $cv=0;
        }  
        
        $this->db->select('CONCAT (doc.nombre_archivo,'.',doc.formato) AS name',false);
        $this->db->where('doc.id_usuario', $idUser);
        $this->db->where("(doc.requisito='informeFinal')",NULL,FALSE);
        $query = $this->db->get('documentos_requeridos doc');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $object) {
                $if =   $object['name'];
            }
        }else{
            $if=0;
        }

        $this->db->select('CONCAT (doc.nombre_archivo,'.',doc.formato) AS name',false);
        $this->db->where('doc.id_usuario', $idUser);
        $this->db->where("(doc.requisito='cartaPostulacion')",NULL,FALSE);
        $query = $this->db->get('documentos_requeridos doc');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $object) {
                $cp =   $object['name'];
            }
        }else{
            $cp=0;
        }

        $array = array(
            "aceptacion" => $aceptacion,
            "actividades" => $actividades,
            "cv" => $cv,
            "informeFinal" => $if,
            "postulacion" =>$cp
        );
        return $array;

    }
    
    public function existeRequisito($idUser,$requisito){
    
        $this->db->where('doc.id_usuario', $idUser);
        $this->db->where('doc.requisito=',$requisito);
        $query = $this->db->get('documentos_requeridos doc');
        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function existeDocumento($name){

        $this->db->where('nombredoc=',$name);
        $query = $this->db->get('documentos doc');
        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

   public function actualizarDocumentoR($requisito,$size,$tipo,$nombre,$idUser,$titulo){
       $datas = array(

           'size' =>$size,
           'formato' =>$tipo,
           'nombre_archivo' =>$nombre,
           'titulo' =>$titulo

       );
        $this->db->where('id_usuario', $idUser);
        $this->db->where('requisito', $requisito);
        return $this->db->update('documentos_requeridos', $datas);
   }
    public function actualizarDocumentoBiblioteca($datas){
   
        $this->db->where('nombredoc', $datas['nombredoc']);
        return $this->db->update('documentos', $datas);
    }

    public function requisitosPasante($pasId){
        $this->db->select('dre.docrId');
        $this->db->from('documentos_requeridos dre ');
        $this->db->join('usuario usu', 'dre.id_usuario = usu.id_usuario');
        $this->db->join('pasante pas', 'pas.id_usuario=usu.id_usuario');
        $this->db->where('pas.pas_id', $pasId);
        return $this->db->get()->result();
    }

    public function obtenerDocumentos(){
        $this->db->select('*');
        $this->db->from('documentos');
        return $this->db->get()->result();
    }
    public function obtenerDocumentosLineas(){
        $this->db->select('*');
        $this->db->from('documentos doc');
        $this->db->join('linea_investigacion linv', 'doc.id_linea = linv.id_linea');
         $this->db->join('escuela esc', 'linv.id_escuela = esc.id_escuela','left');
        return $this->db->get()->result();
    }
    public function obtenerInformes(){
        $this->db->select('*');
        $this->db->from('documentos_requeridos dre');
        $this->db->join('usuario usu', 'dre.id_usuario = usu.id_usuario');
        $this->db->join('pasante pas', 'pas.id_usuario=usu.id_usuario');
        $this->db->where('dre.requisito', 'informeFinal');
        return $this->db->get()->result();
    }

    function consultarValoracion($idUser,$iddoc){
        $data=array();
        $this->db->select('valor');
        $this->db->from('valoracion_libros');
        $this->db->where('iddoc',$iddoc);
        $this->db->where('id_usuario',$idUser);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }

     //Funcion usada en la recomendacion
    //return  IdDoc de los documentos valorados por usuarios de esa empresa
      function getDocEmpresa($empId){
        $this->db->distinct();
        $this->db->select('val.iddoc');
        $this->db->from('valoracion_libros val');
        $this->db->join('pasante pas', 'pas.id_usuario=val.id_usuario');
        $this->db->join('pasantia pa', 'pas.pas_id=pa.pas_id');
        $this->db->where('pa.emp_id', $empId);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                //echo $row;
                $data[] = $row['iddoc'];
            }
            return $data;
        
          
        }
        else{
            return 0;
        }

    }
//busco un documento visto en especifico
    function consultarDocumentoVisto($idUser,$iddoc){
        $data=array();
        $this->db->select('*');
        $this->db->from('documentos_vistos');
        $this->db->where('id_usuario',$idUser);
        $this->db->where('iddoc',$iddoc);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }
    //obtengo todos los documentos vistos
    function obtenerDocumentoVistos($idUser){
        $data=array();
        $this->db->select('iddoc');
        $this->db->from('documentos_vistos dcv');
        $this->db->where('dcv.id_usuario', $idUser);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                //echo $row;
                $data[] = $row['iddoc'];
            }
            return $data;
        
          
        }
        else{
            return 0;
        }
       
    }

    function obtenerDocsLinea($idLinea){
        $data=array();
        $this->db->select('iddoc');
        $this->db->from('documentos doc');
        $this->db->where('doc.id_linea', $idLinea);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                //echo $row;
                $data[] = $row['iddoc'];
            }
            return $data;
        
          
        }
        else{
            return 0;
        }
       
    }
    function obtenerDocsLineaGeneral(){
        $data=array();
        $this->db->select('doc.iddoc');
        $this->db->from('documentos doc');
        $this->db->join('linea_investigacion inv', 'doc.id_linea=inv.id_linea');
        $this->db->where('inv.id_escuela', 6);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                //echo $row;
                $data[] = $row['iddoc'];
            }
            return $data;
        
          
        }
        else{
            return 0;
        }
       
    }
    function eliminarDocumentoVisto($iddoc,$idUser){
        $this->db->where('id_usuario',$idUser);
        $this->db->where('iddoc',$iddoc);
        $this->db->delete('documentos_vistos');
    }

    function actualizarValoracionLibros($iddoc,$valor,$idUser)
    {
        $data = array(
            'valor' => $valor
        );

        $this->db->where('iddoc', $iddoc);
        $this->db->where('id_usuario', $idUser);
        $this->db->update('valoracion_libros', $data);
    }
    
    function guardarValoracionLibros($iddoc,$valor,$idUser){
        $data = array(
            'iddoc' => $iddoc,
            'id_usuario' => $idUser,
            'valor' => $valor
        );
        return $this->db->insert('valoracion_libros',$data);
    }

      function guardarDocumentoVisto($iddoc,$idUser){
        $data = array(
            'iddoc' => $iddoc,
            'id_usuario' => $idUser,
        );
        return $this->db->insert('documentos_vistos',$data);
    }

    function consultarRating($iddoc){

        $this->db->select('AVG(valor) promedio, count(iddoc) votos');
        $this->db->from('valoracion_libros');
        $this->db->where('iddoc',$iddoc);
        $query = $this->db->get();
        $rating = round($query->row()->promedio,1);
        $votos=$query->row()->votos;
        $data=array(
            'rating' => $rating,
            'votos' =>$votos
        );
        return $data;
    }
    function actualizarRating($dato,$iddoc){
        $this->db->where('iddoc', $iddoc);
        $this->db->update('documentos', $dato);
    }
    function librosRecomendados($iddocs){
        $sql = "SELECT * from documentos where iddoc in($iddocs)";
        //$sql = $sql . " where iddoc in('.$iddocs.')";
        $query = $this->db->query($sql);
        //echo $sql;
        if ($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return array();
        }



        /*$this->db->select('*');
        $this->db->from('documentos');
        $this->db->where('iddoc IN','('.$iddocs.')');
        return $this->db->get()->result();*/

    }

    function usuarios(){
        $this->db->distinct();
        $this->db->select('id_usuario');
        $this->db->from('valoracion_libros');
        return $this->db->get()->result();
      //  $query=$this->db->get();
       // return $query->result();
    }
    //esta funcion la uso para llenar la matriz en k-vecinos 
    function usuariosValoracion($idUsu){
        $this->db->select('*');
        $this->db->from('valoracion_libros');
        $this->db->where('id_usuario',$idUsu);
        $query = $this->db->get();
        return $query->result();
    }
    //esta funcion la uso en la recomendacion para validaciones
    function usuarioValoracion($idUsu){
        $data=array();
        $this->db->select('iddoc');
        $this->db->from('valoracion_libros');
        $this->db->where('id_usuario',$idUsu);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                //echo $row;
                $data[] = $row->iddoc;
            }
            return $data;
            
        }
        else{
            return 0;
        }
    }

}
