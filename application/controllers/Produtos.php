<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {
	function __construct(){
        parent::__construct();

		$this->session->set_flashdata('url_redirect','produtos');
		verificar_login();

		$this->load->model('Colaboradores_model','Colaboradores');
		$this->usuario_logado= $this->Colaboradores->get($this->session->userdata('sessao_id_user'));
    }
	public function index(){
		if($this->usuario_logado['colaborador_tipo'] !== 'master'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$this->load->model('Produtos_model','Produtos');
			$data['produtos']= $this->Produtos->getAll();

			$data['js']=array('assets/js/pages/produtos/produtos.js');
			$data['page_incluir']='produtos/produtos';
			$data['title']='Produtos';
			$this->load->view('render',$data);
		}
	}
	public function novo(){
		if($this->usuario_logado['colaborador_tipo'] !== 'master'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{

			$data['js']=array('assets/js/pages/produtos/novo.js');
			$data['page_incluir']='produtos/novo';
			$data['title']='Novo produto';
			$this->load->view('render',$data);
		}
	}
	public function novo_do(){

		$produto_cod = $this->input->post('produto_codigo', TRUE);
		$produto_descricao = $this->input->post('produto_descricao', TRUE);
		$produto_preco = $this->input->post('produto_preco', TRUE);

		//VALIDAÇÕES MANUAIS
		if(is_null($produto_cod) || $produto_cod==0){
			print_js('modal_aviso("Código do produto inválido!","erro-x.png","OK");');
			exit;
		}
		if(is_null($produto_descricao) || $produto_descricao==''){
			print_js('modal_aviso("Informe a descrição do produto!","erro-x.png","OK");');
			exit;
		}
		if(is_null($produto_preco) || $produto_preco <= 0){
			print_js('modal_aviso("Preço do produto inválido!","erro-x.png","OK");');
			exit;
		}
		//VALIDAÇÕES MANUAIS

		$produto= array(
			'produto_cod' => $produto_cod,
			'produto_descricao' => $produto_descricao,
			'produto_preco' => $produto_preco,
			'produto_status' => $this->input->post('produto_status', TRUE) ?? 0
		);

		$this->load->model('Produtos_model','Produtos');
		$retorno= $this->Produtos->insert($produto);
		if($retorno['retorno']==TRUE){
			$this->session->set_flashdata('aviso_modal',array(
				'mensagem' => 'Produto cadastrado com sucesso!',
				'imagem' => 'ok.png',
				'botao' => 'OK'
			));
			location_page('produtos');
		}else{
			print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
		}
	}
	public function edicao(){
		if($this->usuario_logado['colaborador_tipo'] !== 'master'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$produto_id= $this->uri->segment(3) ?? 0;

			if($produto_id!=='' && $produto_id!==0){
				$this->load->model('Produtos_model','Produtos');
				$data['produto']= $this->Produtos->get($produto_id);
			}

			$data['js']=array('assets/js/pages/produtos/editar.js');
			$data['page_incluir']='produtos/editar';
			$data['title']='Edição de produto';
			$this->load->view('render',$data);
		}
	}
	public function editar_do(){

		$produto_id= $this->input->post('produto_id', TRUE);
		if(!is_null($produto_id) && $produto_id!==''){

			$this->load->model('Produtos_model','Produtos');

			$status= $this->Produtos->getCampo('produto_status',$produto_id);
			if($status==0){
				print_js('modal_aviso("Produto inativo, não é possível alterar os dados!","erro-x.png","OK");');
				exit;
			}

			$produto_cod = $this->input->post('produto_codigo', TRUE);
			$produto_descricao = $this->input->post('produto_descricao', TRUE);
			$produto_preco = $this->input->post('produto_preco', TRUE);

			//VALIDAÇÕES MANUAIS
			if(is_null($produto_cod) || $produto_cod==0){
				print_js('modal_aviso("Código do produto inválido!","erro-x.png","OK");');
				exit;
			}
			if(is_null($produto_descricao) || $produto_descricao==''){
				print_js('modal_aviso("Informe a descrição do produto!","erro-x.png","OK");');
				exit;
			}
			if(is_null($produto_preco) || $produto_preco <= 0){
				print_js('modal_aviso("Preço do produto inválido!","erro-x.png","OK");');
				exit;
			}
			//VALIDAÇÕES MANUAIS

			$produto= array(
				'produto_cod' => $produto_cod,
				'produto_descricao' => $produto_descricao,
				'produto_preco' => $produto_preco,
				'produto_status' => $this->input->post('produto_status', TRUE) ?? 0
			);

			$retorno= $this->Produtos->update($produto_id,$produto);
			if($retorno['retorno']==TRUE){
				$this->session->set_flashdata('aviso_modal',array(
					'mensagem' => 'Produto editado com sucesso!',
					'imagem' => 'ok.png',
					'botao' => 'OK'
				));
				location_page('produtos');
			}else{
				print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
			}
		}else{
			print_js('modal_aviso("Produto não identificado.<br>Atualize a página!","atencao.png","OK");');
		}
	}

	public function view(){
		$produto_id= $this->uri->segment(3) ?? 0;

		if($produto_id!=='' && $produto_id!==0){
			$this->load->model('Produtos_model','Produtos');
			$data['produto']= $this->Produtos->get($produto_id);
		}
		$data['page_incluir']='produtos/view';
		$data['title']='Ver produto';
        $this->load->view('render',$data);
	}

	public function altera_status(){
		$produto_id= $this->input->post('produto_id', TRUE);

		if(!is_null($produto_id) && $produto_id!==''){
			$this->load->model('Produtos_model','Produtos');
			$atual= $this->Produtos->getCampo('produto_status',$produto_id);
			if($atual==1){$status=0;}else{$status=1;}
			$produto=array(
				'produto_status' => $status
			);
			$retorno= $this->Produtos->update($produto_id,$produto);
			if($retorno['retorno']==TRUE){
				$this->session->set_flashdata('aviso_modal',array(
					'mensagem' => 'Status alterado com sucesso!',
					'imagem' => 'ok.png',
					'botao' => 'OK'
				));
				location_page('produtos');
			}else{
				print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
			}
		}else{
			print_js('modal_aviso("Produto não identificado.<br>Atualize a página!","atencao.png","OK");');
		}
	}
}
