<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MeusPedidos extends CI_Controller {
	function __construct(){
        parent::__construct();

		$this->session->set_flashdata('url_redirect','meus-pedidos');
		verificar_login();
		

		$this->load->model('Colaboradores_model','Colaboradores');
		$this->usuario_logado= $this->Colaboradores->get($this->session->userdata('sessao_id_user'));
    }
	public function index(){
		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$this->load->model('MeusPedidos_model','MeusPedidos');
			$data['pedidos']= $this->MeusPedidos->getAll($this->session->userdata('sessao_id_user'));

			$data['js']=array('assets/js/pages/pedidos/meus-pedidos.js');
			$data['page_incluir']='meus-pedidos/meus-pedidos';
			$data['title']='Meus pedidos de compra';
			$this->load->view('render',$data);
		}
	}
	public function novo(){
		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$this->load->model('Colaboradores_model','Colaboradores');
			$data['fornecedores']= $this->Colaboradores->getWhere(
				array(
					'colaborador_status' => 1,
					'colaborador_tipo' => 'fornecedor'
				)
			);

			$data['js']=array('assets/js/pages/pedidos/meus-pedidos-novo.js');

			$data['page_incluir']='meus-pedidos/novo';
			$data['title']='Novo pedido de compra';
			$this->load->view('render',$data);
		}
	}
	public function novo_do(){

		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
			print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
			exit;
		}
		
		$pedido_status= $this->input->post('pedido_status', TRUE) ?? 'pendente';
		$pedido_fornecedor = $this->input->post('pedido_fornecedor', TRUE);
		$pedido_obs = $this->input->post('pedido_obs', TRUE);
		$itensPedido = json_decode($this->input->post('itensPedido', TRUE),true);

		//VALIDAÇÕES MANUAIS
		if(is_null($pedido_fornecedor) || $pedido_fornecedor==0 || $pedido_fornecedor==''){
			print_js('modal_aviso("Fornecedor inválido!","erro-x.png","OK");');
			exit;
		}
		if(is_null($itensPedido) || count($itensPedido) <1){
			print_js('modal_aviso("Adicione pelo menos um item no pedido!","erro-x.png","OK");');
			exit;
		}
		//VALIDAÇÕES MANUAIS

		$pedido=array(
			'pedido_fornecedor' => $pedido_fornecedor,
			'pedido_obs' => $pedido_obs,
			'pedido_status' => $pedido_status,
			'pedido_colaborador' => $this->session->userdata('sessao_id_user'),
			'pedido_dataHora' => date('Y-m-d H:i:s')
		);
		if($pedido_status=='finalizado'){
			$pedido=array_merge($pedido,array('pedido_dataHoraFin' => date('Y-m-d H:i:s')));
		}

		$this->load->model('Pedidos_model','Pedidos');
		$retorno= $this->Pedidos->insert($pedido,$itensPedido);
		if($retorno['retorno']==true){
			$this->session->set_flashdata('aviso_modal',array(
				'mensagem' => 'Pedido '.$retorno['pedido_id'].' salvo com sucesso!',
				'imagem' => 'ok.png',
				'botao' => 'OK'
			));
			location_page('meus-pedidos');
		}else{
			print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
		}

	}

	public function editar(){
		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$pedido_id= $this->uri->segment(3) ?? 0;

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

			$data['js']=array('assets/js/pages/pedidos/meus-pedidos-editar.js');

			$data['page_incluir']='meus-pedidos/editar';
			$data['title']='Edição pedido de compra';
			$this->load->view('render',$data);
		}
	}

	public function editar_do(){
		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
			print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
			exit;
		}

		$pedido_id= $this->input->post('pedido_id', TRUE);
		$pedido_fornecedor = $this->input->post('pedido_fornecedor', TRUE);
		$pedido_obs = $this->input->post('pedido_obs', TRUE);
		$itensPedido = json_decode($this->input->post('itensPedido', TRUE),true);

		//VALIDAÇÕES MANUAIS
		if(is_null($pedido_id) || $pedido_id==0 || $pedido_id==''){
			print_js('modal_aviso("Pedido não identificado, atualize a página!","erro-x.png","OK");');
			exit;
		}
		if(is_null($pedido_fornecedor) || $pedido_fornecedor==0 || $pedido_fornecedor==''){
			print_js('modal_aviso("Fornecedor inválido!","erro-x.png","OK");');
			exit;
		}
		if(is_null($itensPedido) || count($itensPedido) <1){
			print_js('modal_aviso("Adicione pelo menos um item no pedido!","erro-x.png","OK");');
			exit;
		}
		//VALIDAÇÕES MANUAIS

		$pedido=array(
			'pedido_fornecedor' => $pedido_fornecedor,
			'pedido_obs' => $pedido_obs,
			'pedido_colaborador' => $this->session->userdata('sessao_id_user')
		);

		$this->load->model('Pedidos_model','Pedidos');
		$retorno= $this->Pedidos->update($pedido_id,$pedido,$itensPedido);
		if($retorno['retorno']==true){
			$this->session->set_flashdata('aviso_modal',array(
				'mensagem' => 'Pedido '.$pedido_id.' editado com sucesso!',
				'imagem' => 'ok.png',
				'botao' => 'OK'
			));
			location_page('meus-pedidos');
		}else{
			print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
		}

	}

	public function view(){
		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
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

			$data['js']=array('assets/js/pages/pedidos/meus-pedidos-editar.js');

			$data['page_incluir']='meus-pedidos/view';
			$data['title']='Pedido de compra nº '.$pedido_id;
			$this->load->view('render',$data);
		}
	}

	public function finalizar_pedido(){
		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
			print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
			exit;
		}

		$pedido_id= $this->input->post('pedido_id', TRUE);

		if(!is_null($pedido_id) && $pedido_id!==''){
			$this->load->model('Pedidos_model','Pedidos');
			$pedido=array(
				'pedido_status' => 'finalizado',
				'pedido_dataHoraFin' => date('Y-m-d H:i:s')
			);
			$retorno= $this->Pedidos->updateInfoPedido($pedido_id,$pedido);
			if($retorno['retorno']==TRUE){
				$this->session->set_flashdata('aviso_modal',array(
					'mensagem' => 'Pedido nº '.$pedido_id.' finalizado com sucesso!',
					'imagem' => 'ok.png',
					'botao' => 'OK'
				));
				location_page('meus-pedidos');
			}else{
				print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
			}
		}else{
			print_js('modal_aviso("Pedido não identificado.<br>Atualize a página!","atencao.png","OK");');
		}
	}

	public function filtro_item(){
		if($this->usuario_logado['colaborador_tipo'] == 'fornecedor'){
			print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
			exit;
		}

		$produto_like= $this->input->post('item_add_filtro', TRUE);
		if(!is_null($produto_like) && $produto_like!==''){
			$this->load->model('Produtos_model','Produtos');
			$data['produtos']= $this->Produtos->getWhereLike(
				array(
					'produto_status' => 1
				),
				array(
					'produto_descricao' => $produto_like
				)
			);
		}
		$this->load->view('meus-pedidos/filtro-itens',$data ?? array());
	}
}
