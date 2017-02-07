
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
    function nombrePadre($idPadre){
        $this->db->select('m.nombre');
        $this->db->from('menu m');
        $this->db->where('id_menu',$idPadre);
        $query= $this->db->get();
        return $query->row();
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
}
