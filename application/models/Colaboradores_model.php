<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores_model extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function getAll(){
        return $this->db->get('colaboradores')->result_array(); 
    }
    public function get($colaborador_id=0){
        $res=$this->db->where('colaborador_id',$colaborador_id)
                        ->get('colaboradores')
                        ->result_array();
        if(isset($res[0])){return $res[0];}else{return false;}
    }
    public function getWhere($where){
        return $this->db->where($where)
                        ->get('colaboradores')
                        ->result_array();
    }
    public function getLogin($usuario_login=0){
        $res=$this->db->where('colaborador_login',$usuario_login)
                        ->get('colaboradores')
                        ->result_array();
        if(isset($res[0])){return $res[0];}else{return false;}
    }
    public function getCampo($campo,$colaborador_id){
        $res= $this->db->select($campo)
                        ->where('colaborador_id',$colaborador_id)
                        ->get('colaboradores')
                        ->result_array(); 

        if(isset($res[0][$campo])){
            return $res[0][$campo];
        }else{
            return false;
        }
    }
    public function update($colaborador_id,$colaborador){
        $this->db->set($colaborador);
        $this->db->where('colaborador_id', $colaborador_id);
        if($this->db->update('colaboradores')){
            $retorno=array(
                'retorno' => TRUE
            );
        }else{
            $error = $this->db->error();
            if(isset($error) && $error['code']==1062){
                $msg_erro='Já existe um colaborador com o mesmo login, use outro!';
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

    public function insert($colaborador){
        if($this->db->insert('colaboradores',$colaborador)){
            $retorno=array(
                'retorno' => TRUE
            );
        }else{
            $error = $this->db->error();
            if(isset($error) && $error['code']==1062){
                $msg_erro='Já existe um colaborador com o mesmo login, use outro!';
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

    public function login($usuario){
        if($usuario_dados= $this->getLogin($usuario['usuario'] ?? '')){
            if($usuario_dados['colaborador_status'] == 1){
                if($usuario_dados['colaborador_senha']==$usuario['senha']){
                    $retorno = array(
                        'retorno' => TRUE,
                        'user' => $usuario_dados
                    );
                }else{
                    $retorno = array(
                        'retorno' => FALSE,
                        'erro' => 'E-mail e/ou senha incorretos.'
                    );
                }
            }else{
                $retorno = array(
                    'retorno' => FALSE,
                    'erro' => 'Seu usuário está inativo, peça um outro usuário para ativar.'
                );
            }
        }else{
            $retorno = array(
                'retorno' => FALSE,
                'erro' => 'E-mail e/ou senha incorretos.'
            );
        }

        return $retorno;
    }
}
