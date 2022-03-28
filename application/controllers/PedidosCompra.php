<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PedidosCompra extends CI_Controller {
	function __construct(){
        parent::__construct();

		$this->session->set_flashdata('url_redirect','pedidos-compra');
		verificar_login();

		$this->load->model('Colaboradores_model','Colaboradores');
		$this->usuario_logado= $this->Colaboradores->get($this->session->userdata('sessao_id_user'));
    }
	public function index(){
		if($this->usuario_logado['colaborador_tipo'] == 'usuario'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$this->load->model('Pedidos_model','Pedidos');
			if($this->usuario_logado['colaborador_tipo'] == 'master'){
				$data['pedidos']= $this->Pedidos->getAll();
			}else{
				$data['pedidos']= $this->Pedidos->getAllFornecedor($this->session->userdata('sessao_id_user'));
			}
			$data['js']=array('assets/js/pages/pedidos/pedidos.js');

			$data['page_incluir']='pedidos-compra/pedidos-compra';
			$data['title']='Pedidos de compra';
			$this->load->view('render',$data);
		}
	}
    public function view(){
		if($this->usuario_logado['colaborador_tipo'] == 'usuario'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$pedido_id= $this->uri->segment(2) ?? 0;

			if($pedido_id!=='' && $pedido_id!==0){
				$this->load->model('Pedidos_model','Pedidos');
				$data['pedido']= $this->Pedidos->get($pedido_id);
				$data['itens']= $this->Pedidos->getItens($pedido_id);
				
				$this->load->model('Colaboradores_model','Colaboradores');
				$data['fornecedores']= $this->Colaboradores->getWhere(
					array(
						'colaborador_status' => 1,
						'colaborador_tipo' => 'fornecedor'
					)
				);
			}

			$data['js']=array('assets/js/pages/pedidos/pedidos.js');

			$data['page_incluir']='pedidos-compra/view';
			$data['title']='Pedido de compra nº '.$pedido_id;
			$this->load->view('render',$data);
		}
	}

    public function entregar(){
		if($this->usuario_logado['colaborador_tipo'] == 'usuario'){
			print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
			exit;
		}

		$pedido_id= $this->input->post('pedido_id', TRUE);

		if(!is_null($pedido_id) && $pedido_id!==''){
			$this->load->model('Pedidos_model','Pedidos');
			$pedido=array(
				'pedido_status' => 'entregue',
				'pedido_dataHoraEnt' => date('Y-m-d H:i:s')
			);
			$retorno= $this->Pedidos->updateInfoPedido($pedido_id,$pedido);
			if($retorno['retorno']==TRUE){
				$this->session->set_flashdata('aviso_modal',array(
					'mensagem' => 'Pedido nº '.$pedido_id.' entregue com sucesso!',
					'imagem' => 'ok.png',
					'botao' => 'OK'
				));
				location_page('pedidos-compra');
			}else{
				print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
			}
		}else{
			print_js('modal_aviso("Pedido não identificado.<br>Atualize a página!","atencao.png","OK");');
		}
	}

}