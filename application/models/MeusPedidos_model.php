<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeusPedidos_model extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function getAll($colaborador_id){
        return $this->db->select('pedidos.*, colaborador_nome as fornecedor_nome')
                        ->from('pedidos')
                        ->join('colaboradores',"colaborador_id=pedido_fornecedor")
                        ->where(array('pedido_colaborador'=> $colaborador_id))
                        ->get()
                        ->result_array(); 
    }
    public function get($pedido_id=0,$colaborador_id=0){
        $res=$this->db->where(array(
                                'pedido_id' => $pedido_id,
                                'pedido_colaborador'=> $colaborador_id
                            ))
                        ->get('pedidos')
                        ->result_array();
        if(isset($res[0])){return $res[0];}else{return false;}
    }
}