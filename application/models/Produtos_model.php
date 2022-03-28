<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos_model extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function getAll(){
        return $this->db->order_by('produto_descricao')->get('produtos')->result_array(); 
    }
    public function get($produto_id=0){
        $res=$this->db->where('produto_id',$produto_id)
                        ->get('produtos')
                        ->result_array();
        if(isset($res[0])){return $res[0];}else{return false;}
    }
    public function getWhereLike($where,$like){
        return $this->db->where($where)
                        ->like($like)
                        ->order_by('produto_descricao')
                        ->get('produtos')
                        ->result_array();
    }
    public function getCampo($campo,$produto_id){
        $res= $this->db->select($campo)
                        ->where('produto_id',$produto_id)
                        ->get('produtos')
                        ->result_array(); 

        if(isset($res[0][$campo])){
            return $res[0][$campo];
        }else{
            return false;
        }
    }
    public function update($produto_id,$produto=array()){
        $this->db->set($produto);
        $this->db->where('produto_id', $produto_id);
        if($this->db->update('produtos')){
            $retorno=array(
                'retorno' => TRUE
            );
        }else{
            $error = $this->db->error();
            if(isset($error) && $error['code']==1062){
                $msg_erro='Já existe um produto com o mesmo código, use outro!';
            }else{
                $msg_erro= $error['message'] ?? 'Erro desconhecido';
            }
            $retorno=array(
                'retorno' => FALSE,
                'message' => $msg_erro
            );
        }
        return $retorno;
    }
    public function insert($produto){
        if($this->db->insert('produtos',$produto)){
            $retorno=array(
                'retorno' => TRUE
            );
        }else{
            $error = $this->db->error();
            if(isset($error) && $error['code']==1062){
                $msg_erro='Já existe um produto com o mesmo código, use outro!';
            }else{
                $msg_erro= $error['message'] ?? 'Erro desconhecido';
            }
            $retorno=array(
                'retorno' => FALSE,
                'message' => $msg_erro
            );
        }
        return $retorno;
    }
}
