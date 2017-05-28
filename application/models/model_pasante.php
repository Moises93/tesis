<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 02-02-2017
 * Time: 22:24
 */
class Model_pasante extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

/*mejorar con inner para traerme datos de usuario*/
    function getEstudiantes() {
        $this->db->select('*');
        $this->db->from('pasante pas ');
        $this->db->join('usuario usu', 'pas.id_usuario = usu.id_usuario');
        $this->db->join('escuela esc', 'esc.id_escuela = pas.id_escuela');
        return $this->db->get()->result();
       /* $data = array();
        $query = $this->db->get('pasante');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;*/
    }
    /*busco aquellos que no aparezcan en la tabla pasantia y me traigo datos de usuario para el login*/
    function getPostulados($limit, $offset) {
       /* $this->db->select('pas.pas_id,pas.pas_nombre,pas.pas_apellido,usu.usu_login');
        $this->db->from('pasante pas');
        $this->db->join('usuario usu', 'pas.id_usuario = usu.id_usuario','left');
        $this->db->join('pasantia pa', 'pas.pas_id = pa.pas_id','left');
        $this->db->where('pas.pas_id IS NULL',null,false);
        $this->db->get()->result();*/
        $sql = "SELECT pas.pas_id, pas.pas_cedula, pas.pas_nombre,pas.pas_apellido ,pas.pas_sexo, pas.id_usuario, es.esc_nombre as Escuela ,us.id_usuario, us.usu_correo, us.usu_foto, us.usu_estatus, us.usu_login from pasante as pas";
        $sql = $sql . " join escuela es on pas.id_escuela = es.id_escuela ";
        $sql = $sql . " left join usuario us on us.id_usuario = pas.id_usuario";
        $sql = $sql . " left join pasantia pasan on pas.pas_id = pasan.pas_id";
        $sql = $sql . " where pasan.pas_id is null and us.usu_estatus = 1 LIMIT $offset, $limit";

// Ejecuta Consulta
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return array();
        }
    }


    function getPostuladosEstudiantes($escuela) {
         $this->db->select('pas.pas_id,pas.pas_nombre,pas.pas_apellido,usu.usu_login');
         $this->db->from('pasante pas');
         $this->db->join('usuario usu', 'pas.id_usuario = usu.id_usuario','left');
         $this->db->join('pasantia pa', 'pas.pas_id = pa.pas_id','left');
         $this->db->join('escuela esc', 'pas.id_escuela = esc.id_escuela');
         $this->db->where('pa.pas_id IS NULL',null,false);
         $this->db->where('pas.id_escuela',$escuela);
        $query= $this->db->get()->result();
        return $query;
    }
 /*busco aquellos que no aparezcan en la tabla pasantia y me traigo datos de usuario para el login*/
    function getCountPostulados() {
       /* $this->db->select('pas.pas_id,pas.pas_nombre,pas.pas_apellido,usu.usu_login');
        $this->db->from('pasante pas');
        $this->db->join('usuario usu', 'pas.id_usuario = usu.id_usuario','left');
        $this->db->join('pasantia pa', 'pas.pas_id = pa.pas_id','left');
        $this->db->where('pas.pas_id IS NULL',null,false);
        $this->db->get()->result();*/
        $sql = "SELECT count(pas.pas_id) as Total from pasante as pas";
        $sql = $sql . " join escuela es on pas.id_escuela = es.id_escuela ";
        $sql = $sql . " left join usuario us on us.id_usuario = pas.id_usuario";
        $sql = $sql . " left join pasantia pasan on pas.pas_id = pasan.pas_id";
        $sql = $sql . " where pasan.pas_id is null and us.usu_estatus = 1";

// Ejecuta Consulta
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return array();
        }

    }

     function getPasantesporEmpresa($id) {
        $sql = "SELECT pas.pas_id, pas.pas_cedula, pas.pas_nombre,pas.pas_apellido ,pas.pas_sexo, pas.id_usuario, es.esc_nombre as Escuela ,us.id_usuario, us.usu_correo, us.usu_foto, us.usu_estatus, us.usu_login
             from pasante as pas";
        $sql = $sql . " join escuela es on pas.id_escuela = es.id_escuela ";
        $sql = $sql . " left join usuario us on us.id_usuario = pas.id_usuario";
        $sql = $sql . " left join pasantia pasan on pas.pas_id = pasan.pas_id";
        $sql = $sql . " where pasan.pas_id is not null and us.usu_estatus = 1 and pasan.emp_id = $id ";
        // Ejecuta Consulta
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return array();
        }
    }
    
    function esPasante($idPas){
        $this->db->select('*');
        $this->db->from('pasante pas ');
        $this->db->join('pasantia pa', 'pas.pas_id=pa.pas_id');
        $this->db->where('pa.pas_id', $idPas);
        return $this->db->get()->result();

    }
    function obtenerIdEscuela($idUser){
        $this->db->select('id_escuela');
        $this->db->from('pasante pas ');
        $this->db->where('pas.id_usuario', $idUser);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
             return $query->row()->id_escuela;
        }
        else{
            return 0;
        }
       
    }
      function obtenerIdPasante($idUser){
        $this->db->select('pas_id');
        $this->db->from('pasante pas ');
        $this->db->where('pas.id_usuario', $idUser);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
             return $query->row()->pas_id;
        }
        else{
            return 0;
        }
       
    }

    function getIdLinea($idPas){
        $this->db->select('id_linea,emp_id');
        $this->db->from('pasantia');
        $this->db->where('pas_id', $idPas);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
             return $query->row();
        }
        else{
            return 0;
        }
       
    }
    

    function actualizar_telefono($pas_id,$pas_telefono){
        $data = array(
            'pas_telefono' => $pas_telefono
        );
        if(!empty($data))
        {
            $this->db->where('pas_id', $pas_id);
            $this->db->update('pasante', $data);
            return TRUE;
        }
        return FALSE;
    }



    function actualizar_pasante($id_usuario,$data){
            $this->db->where('id_usuario', $id_usuario);
            return $this->db->update('pasante', $data);
    }

    function actualizarLineaPasantia($idPas,$linea){
         $data = array(
            'id_linea' => $linea
        );
            $this->db->where('pas_id', $idPas);
            return $this->db->update('pasantia', $data);
    }

   /* function getIdPasante($idUsuario){
        $this->db->select('pas_id');
        $this->db->from('pasante');
        $this->db->where('id_usuario', $idUsuario);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
             return $this->db->get()->result();
        }
        else{
            return 0;
        }
    }*/



    public function getRecomendadosEmpresa($id){
        $sql = "SELECT pas.pas_id, count(*) as Total, 
             pas.pas_cedula, pas.pas_nombre,pas.pas_apellido 
             ,pas.pas_sexo, pas.id_usuario
             ,es.esc_nombre as Escuela ,us.id_usuario,
             us.usu_correo, us.usu_foto, us.usu_estatus,
             us.usu_login 
             from pasante as pas";

        $sql = $sql . " join escuela es on pas.id_escuela = es.id_escuela ";
        $sql = $sql . " left join usuario us on us.id_usuario = pas.id_usuario";
        $sql = $sql . " left join pasantia pasan on pas.pas_id = pasan.pas_id";
        $sql = $sql . " left join habilidad_pasante hp on pas.pas_id = hp.pas_id";
        $sql = $sql . " where pasan.pas_id is null and us.usu_estatus = 1";
        $sql = $sql . " and hp.id_habilidad in (
                        select id_habilidad from habilidad_empresa
                        where emp_id = $id
                        ) group by pas.pas_id
                         order by Total DESC
                         LIMIT 0, 3";
        // Ejecuta Consulta
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return array();
        }
    }
}
