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
        $this->db->insert('documentos', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

}
