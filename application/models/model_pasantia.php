<?php
/**

 * User: Moises
 * Date: 28-02-2017
 * Time: 20:24
 */
class Model_pasantia extends CI_Model
{
    //constructor predeterminado del modelo
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('model_profesor');
        $this->load->model('model_usuarioempresa');
    }

    function agregarPasantia($modalidad,$empresa,$orgaca,$escuela,
                             $estudiante,$fechaIni,$fechaFin,$estatus){
        $data = array(
            'estatus' => $estatus,
            'fecha_inicio' => $fechaIni,
            'fecha_final' => $fechaFin,
            'modalidad' => $modalidad,
            'pas_id' =>$estudiante,
            'emp_id' =>$empresa,
            'orgaca' =>$orgaca,
            'id_escuela' =>$escuela

        );


        return $this->db->insert('pasantia',$data);
    }

    function getPasantia() {
        $this->db->select('*');
        $this->db->from('pasantia pas ');
        $this->db->join('pasante pa', 'pas.pas_id= pa.pas_id');
        $this->db->join('usuario usu', 'usu.id_usuario= pa.id_usuario');
        $this->db->join('empresa emp', 'pas.emp_id=emp.emp_id','left'); //left join pora que traiga lo que aun no tienen tutores
        $this->db->join('escuela esc', 'pas.id_escuela=esc.id_escuela');
        return $this->db->get()->result();
    }

    function existePasantia($idUser){
        $this->db->select('pas.id_pasantia,pas.estatus');
        $this->db->from('pasantia pas ');
        $this->db->join('pasante pa', 'pas.pas_id= pa.pas_id');
        $this->db->join('usuario usu', 'usu.id_usuario= pa.id_usuario');
        $this->db->where('usu.id_usuario',$idUser);
        return $this->db->get()->result();
    }
    /*Consulto las pasantias con estatus ativo , esta funcion la uso para asignar los tutores*/
    function getPasantiaActiva() {
        $data = array();
        $this->db->select('*');
        $this->db->from('pasantia pas ');
        $this->db->join('pasante pa', 'pas.pas_id= pa.pas_id');
        $this->db->join('usuario usu', 'usu.id_usuario= pa.id_usuario');
        $this->db->join('empresa emp', 'pas.emp_id=emp.emp_id','left'); //left join pora que traiga lo que aun no tienen tutores
        $this->db->join('escuela esc', 'pas.id_escuela=esc.id_escuela');
        $this->db->where('pas.estatus',1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    function actualizarTutorA($data){
        if(!empty($data)){
            $this->db->where('id_pasantia', $data['id_pasantia']);
            $this->db->where('tipo', $data['tipo']);
            $this->db->update('integrantes_pasantia', $data);
            return 1;
        }
        return FALSE;
    }
    function insertarTutorA($data){
    
        if(!empty($data)){
            $this->db->insert('integrantes_pasantia',$data);
            return 1;
        }
        return FALSE;
    }
    function consultarTutor($data){
        if(!empty($data)){
            $this->db->select('pro_id,idusuario_empresa');
            $this->db->from('integrantes_pasantia');
            $this->db->where('id_pasantia', $data['id_pasantia']);
            $this->db->where('tipo', $data['tipo']);
            return $this->db->get()->result();
            
        }
        return FALSE;
    }

    function getIntegrantesPas($idPas){
       $data = array(
           'academico' => null,
           'organizacional'=> null
       );
        $this->db->where('int.id_pasantia', $idPas);
        $query = $this->db->get('integrantes_pasantia int');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){

                if($row ['tipo']==1){

                    $academico = array(
                        'pro_id' => $row ['pro_id'],
                        'id_pasantia' => $row ['id_pasantia'],
                        'tipo' =>$row ['tipo'],
                        'info' =>null

                    );
                    if($row['pro_id']>0){
                        //consuto profesor
                        $idPro=$row['pro_id'];
                        $dato = $this->model_profesor->getProfesor($idPro);
                        $academico['info']=$dato;



                    }
                   $data['academico']=$academico;
                }else if ($row['tipo']==2){
                    $organizacional = array(
                        'id_pasantia' => $row ['id_pasantia'],
                        'tipo' =>$row ['tipo'],
                        'info' =>null
                    );
                    if($row['pro_id']>0){
                        //consuto profesor
                        $idPro=$row['pro_id'];
                        $dato = $this->model_profesor->getProfesor($idPro);
                        $info = array(
                            'id' =>$dato['pro_id'],
                            'nombre' =>$dato['pro_nombre'],
                            'apellido' =>$dato['pro_apellido']
                        );
                    }else if($row['idusuario_empresa']>0){
                       $idEmp= $row['idusuario_empresa'];
                        $dato = $this->model_usuarioempresa->obtenerUsuarioE($idEmp);
                        $info = array(
                            'id' =>$dato['idusuario_empresa'],
                            'nombre' =>$dato['uem_nombre'],
                            'apellido' =>$dato['uem_apellido']
                        );
                    }

                    $organizacional['info']=$info;
                    $data['organizacional'] = $organizacional;
                }
            }

           /* print_r($data);
            exit();*/
        }

        return $data;
    }

    function actualizarPasantia($pasantia,$empresa,$orgaca,$fechaIni,$fechaFin){
        $data = array(
            'fecha_inicio' => $fechaIni,
            'fecha_final' => $fechaFin,
            'orgaca' => $orgaca,
            'emp_id' => $empresa
        );
        if(!empty($data))
        {
            $this->db->where('id_pasantia', $pasantia);
            $this->db->update('pasantia', $data);
            return TRUE;
        }
        return FALSE;
    }

    /*Dado el id de un profesor retorna el ID de las pasantias , en la que es tutor academico*/
    public function obtenerPasantiasAcademicas($idPro){
        $resul=array(
        );
        $this->db->select('pa.id_pasantia,pas.pas_nombre,pas.pas_apellido,emp.emp_nombre,pa.orgaca,pa.estatus,pas.pas_id');
        $this->db->from('pasantia pa');
        $this->db->join('integrantes_pasantia ipa', 'ipa.id_pasantia = pa.id_pasantia');
        $this->db->join('pasante pas', 'pa.pas_id = pas.pas_id');
        $this->db->join('empresa emp', 'pa.emp_id = emp.emp_id','left');
        $this->db->where('ipa.pro_id',$idPro);
        $this->db->where('ipa.tipo',1);
        $query= $this->db->get()->result();
        /*foreach ($query as $query => $row){
            $idPas=$row->pas_id;
            $requisitos=$this->consultarRequisitos($idPas);
            array_push($resul, $row);
            if(count($requisitos)>0) {

                array_push($resul, $requisitos);
            }
        }*/
        return $query;
    }
    /*Dado el id de un profesor retorna el ID de las pasantias , en la que es tutor academico*/
    public function obtenerPasantiasEmpresariales($idPro){
        $resul=array();
        $this->db->select('pa.id_pasantia');
        $this->db->from('pasantia pa');
        $this->db->join('integrantes_pasantia ipa', 'ipa.id_pasantia = pa.id_pasantia');
        $this->db->where('ipa.pro_id',$idPro);
        $this->db->where('ipa.tipo',2);
        $query= $this->db->get()->result();
        foreach ($query as $query => $row){

            array_push($resul,$row->id_pasantia);
        }
        return $resul;
    }
    
   
    public  function consultarRequisitos($idPas){
        $resul=array();
        $this->db->select('dre.requisito,dre.nombre_archivo');
        $this->db->from('documentos_requeridos dre');
        $this->db->join('usuario usu', 'usu.id_usuario=dre.id_usuario');
        $this->db->join('pasante pas', 'pas.id_usuario = usu.id_usuario');
        $this->db->where('pas.pas_id',$idPas);
        $query= $this->db->get()->result();
        foreach ($query as $query => $row){

            array_push($resul,$row);
        }
        return $resul;
    }

    function  actualizarEstatusPasantia($idPas,$estatus){
        $data= array(
            'estatus' => $estatus
        );
        $this->db->where('id_pasantia',$idPas);
        $this->db->update('pasantia', $data);

    }
}