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


    function getPasante() {
        $data = array();
        $query = $this->db->get('pasante');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }
   
}
