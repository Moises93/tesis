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
        $array = array(
            "aceptacion" => $aceptacion,
            "actividades" => $actividades,
            "cv" => $cv
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

   public function actualizarDocumentoR($requisito,$size,$tipo,$nombre,$idUser){
       $datas = array(

           'size' =>$size,
           'formato' =>$tipo,
           'nombre_archivo' =>$nombre

       );
        $this->db->where('id_usuario', $idUser);
        $this->db->where('requisito', $requisito);
        return $this->db->update('documentos_requeridos', $datas);
    }
        

}
