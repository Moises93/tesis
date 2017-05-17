<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 02-02-2017
 * Time: 22:24
 */
class Model_admin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function getMenu() {
        $data = array();
        $query = $this->db->get('menu');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }
    function obtenerPadres(){
        $data = array();
        $this->db->select('m.id_menu,m.nombre');
        $this->db->from('menu m');
        $this->db->where('id_padre',"0");
        $query= $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }
    function obtenerIdPadres($url){
        $data = array();
        $this->db->select('m.id_padre');
        $this->db->from('menu m');
        $this->db->where('m.url',$url);
        $query= $this->db->get();

        if ($query->num_rows() > 0) {
             return $query->row()->id_padre;
        }else{

            return 0;
        }
       
    }

    function obtenerHijosDePadre($id_menu){
  
        $data = array();
        $this->db->select('m.id_menu,m.nombre');
        $this->db->from('menu m');
        $this->db->where('id_padre',$id_menu);
        $query= $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
    
         return $data;
    }



    function actualizar_menu($id_menu,$nombre,$id_padre,$url,$clase){
        $data = array(
            'id_padre' => $id_padre,
            'nombre' => $nombre,
            'url' => $url,
            'clase' => $clase
        );
        $this->db->where('id_menu', $id_menu);
        return $this->db->update('menu', $data);

    }

    function crearMenu($nombre,$id_padre,$url,$clase){


        $data = array(
            'id_padre' => $id_padre,
            'nombre' => $nombre,
            'url' => $url,
            'clase' => $clase

        );
         return $this->db->insert('menu',$data);
    }
    function eliminarMenu($id_menu){
        $this->db->where('id_menu', $id_menu);
        return $this->db->delete('menu');

    }
    function menuEnUso($id_menu){
        $data = array();
        $this->db->select('per.id_menu,per.id_usuario');
        $this->db->from('permiso_usuario per');
        $this->db->where('id_menu',$id_menu);
        $query= $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }
    function eliminarPermisos($id_user){
    
        $this->db->where('id_usuario', $id_user);
        return $this->db->delete('permiso_usuario');

    }
    function quitarPermiso($idUser,$menu){

        $this->db->where('id_usuario', $idUser);
        $this->db->where('id_menu', $menu);
        return $this->db->delete('permiso_usuario');

    }
    function obtenerMenuId($clave){
        $this->db->select('id_menu');
        $this->db->from('menu');
        $this->db->where('clave',$clave);
        $query = $this->db->get();
        return $query->row();
    }


    function consultarTipoUsuario($tipo){
        $this->db->select('id_tipo');
        $this->db->from('tipos_usuarios');
        $this->db->where('tipo',$tipo);
        $query = $this->db->get();
        return $query->row();
    }


    function guardarPermisos($id_usuario,$id_menu){
        $data = array(
            'id_menu' => $id_menu,
            'id_usuario' => $id_usuario
            
        );
        return $this->db->insert('permiso_usuario',$data);


    }

    function getRequisitos() {
        
        $this->db->select('*');
        $this->db->from('documentos_requeridos docr ');
        $this->db->join('usuario usu', 'docr.id_usuario = usu.id_usuario');
        return $this->db->get()->result();
        
       
    }

    public function getTodasEscuela(){
        $sql = "SELECT * FROM escuela";
        $rs = $this->db->query($sql);
        if($rs->num_rows() > 0){
            return $rs->result();
        }
        else{
            return array();
        }
    }


    function actualizar_usuario_admin($id_usuario,$data){
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario_administrador', $data);
    }

}
