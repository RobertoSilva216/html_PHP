<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_model extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function getAll(){
        return $this->db->select('pedidos.*, colaborador_nome as fornecedor_nome')
                        ->from('pedidos')
                        ->join('colaboradores',"colaborador_id=pedido_fornecedor")
                        ->where("pedido_status='finalizado' OR pedido_status='entregue'")
                        ->get()
                        ->result_array(); 
    }
    public function getAllFornecedor($fornecedor_id=0){
        return $this->db->select('pedidos.*, colaborador_nome as fornecedor_nome')
                        ->from('pedidos')
                        ->join('colaboradores',"colaborador_id=pedido_fornecedor")
                        ->where("pedido_fornecedor='$fornecedor_id' AND (pedido_status='finalizado' OR pedido_status='entregue')")
                        ->get()
                        ->result_array(); 
    }
    public function get($pedido_id=0){
        $res=$this->db->where('pedido_id',$pedido_id)
                        ->get('pedidos')
                        ->result_array();
        if(isset($res[0])){return $res[0];}else{return false;}
    }

    public function getItens($pedido_id=0){
        return $this->db->where('pedido_produto_pedido',$pedido_id)
                        ->get('pedido_produtos')
                        ->result_array();
    }

    public function insert($pedido,$itens){
        $db_debug = $this->db->db_debug; //save setting
        $this->db->trans_begin();
        $rollback=false;
        $erro_msg='';

        if($this->db->insert('pedidos',$pedido)){
            $pedido_id= $this->db->insert_id();

            $total_pedido=0;
            foreach($itens as $item){
                $this->load->model('Produtos_model','Produtos');
                $produtoData= $this->Produtos->get($item[0]);
                if(isset($produtoData['produto_id'])){
                    $produto=array(
                        'pedido_produto_pedido' => $pedido_id,
                        'pedido_produto_produto' => $item[0],
                        'pedido_produto_descricao' => $produtoData['produto_descricao'],
                        'pedido_produto_codigo'=> $produtoData['produto_cod'],
                        'pedido_produto_quant' => $item[4],
                        'pedido_produto_preco' => $produtoData['produto_preco']
                    );

                    if(!$this->db->insert('pedido_produtos',$produto)){
                        $rollback=true;
                        $erro=$this->db->error();
                        $erro_msg=$erro['message'];
                        goto RETORNO;
                    }
                    $total_pedido= $total_pedido + ($produtoData['produto_preco'] * $item[4]);
                }else{
                    $rollback=true;
                    $erro_msg='Produto com ID '.$item[0].' não encontrado';
                    goto RETORNO;
                }
            }

            $pedido_att=array(
                'pedido_total' => $total_pedido
            );
            if(! $this->db->set($pedido_att)->where('pedido_id', $pedido_id)->update('pedidos')){
                $rollback=true;
                $erro=$this->db->error();
                $erro_msg=$erro['message'];
            }
        }else{
            $rollback=true;
            $erro=$this->db->error();
            $erro_msg=$erro['message'];
        }

RETORNO:
        if($this->db->trans_status()=== TRUE && $rollback==false){
                $this->db->trans_commit();
                $retorno= array(
                    'retorno'=> true,
                    'pedido_id' => $pedido_id
                );
        }else{
                $this->db->trans_rollback();
                $retorno= array(
                    'retorno'=> false,
                    'message'=> $erro_msg
                );
        }
        $this->db->db_debug = $db_debug; //restore setting
        return $retorno;
    }


    public function updateInfoPedido($pedido_id,$pedido){
        $this->db->set($pedido);
        $this->db->where('pedido_id', $pedido_id);
        if($this->db->update('pedidos')){
            $retorno=array(
                'retorno' => TRUE
            );
        }else{
            $error = $this->db->error();
            $msg_erro= $error['message'] ?? 'Erro desconhecido';
            $retorno=array(
                'retorno' => FALSE,
                'message' => $msg_erro
            );
        }
        return $retorno;
    }

    public function update($pedido_id,$pedido,$itens){
        $db_debug = $this->db->db_debug; //save setting
        $this->db->trans_begin();
        $rollback=false;
        $erro_msg='';

            if(! $this->db->where(array('pedido_produto_pedido' => $pedido_id))->delete('pedido_produtos')){
                $rollback=true;
                $erro=$this->db->error();
                $erro_msg=$erro['message'];
                goto RETORNO;
            }

            $total_pedido=0;
            foreach($itens as $item){
                $this->load->model('Produtos_model','Produtos');
                $produtoData= $this->Produtos->get($item[0]);
                if(isset($produtoData['produto_id'])){
                    $produto=array(
                        'pedido_produto_pedido' => $pedido_id,
                        'pedido_produto_produto' => $item[0],
                        'pedido_produto_descricao' => $produtoData['produto_descricao'],
                        'pedido_produto_codigo'=> $produtoData['produto_cod'],
                        'pedido_produto_quant' => $item[4],
                        'pedido_produto_preco' => $produtoData['produto_preco']
                    );

                    if(!$this->db->insert('pedido_produtos',$produto)){
                        $rollback=true;
                        $erro=$this->db->error();
                        $erro_msg=$erro['message'];
                        goto RETORNO;
                    }
                    $total_pedido= $total_pedido + ($produtoData['produto_preco'] * $item[4]);
                }else{
                    $rollback=true;
                    $erro_msg='Produto com ID '.$item[0].' não encontrado';
                    goto RETORNO;
                }
            }

            $pedido_att=array(
                'pedido_total' => $total_pedido
            );
            if(! $this->db->set($pedido_att)->where('pedido_id', $pedido_id)->update('pedidos')){
                $rollback=true;
                $erro=$this->db->error();
                $erro_msg=$erro['message'];
            }

RETORNO:
        if($this->db->trans_status()=== TRUE && $rollback==false){
                $this->db->trans_commit();
                $retorno= array(
                    'retorno'=> true
                );
        }else{
                $this->db->trans_rollback();
                $retorno= array(
                    'retorno'=> false,
                    'message'=> $erro_msg
                );
        }
        $this->db->db_debug = $db_debug; //restore setting
        return $retorno;
    }

}