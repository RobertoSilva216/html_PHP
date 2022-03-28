<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores extends CI_Controller {
	function __construct(){
        parent::__construct();
		
		$this->session->set_flashdata('url_redirect','colaboradores');
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
			$this->load->model('Colaboradores_model','Colaboradores');
			$data['colaboradores']= $this->Colaboradores->getAll();

			$data['js']=array('assets/js/pages/colaboradores/colaboradores.js');
			$data['page_incluir']='colaboradores/colaboradores';
			$data['title']='Colaboradores';
			$this->load->view('render',$data);
		}
	}
	public function novo(){
		if($this->usuario_logado['colaborador_tipo'] !== 'master'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$data['js']=array('assets/js/pages/colaboradores/novo.js');

			$data['page_incluir']='colaboradores/novo';
			$data['title']='Cadastro de colaborador';
			$this->load->view('render',$data);
		}
	}
	public function editar(){
		if($this->usuario_logado['colaborador_tipo'] !== 'master'){
			$data['page_incluir']='acesso-negado';
			$data['title']='Acesso negado';
			$this->load->view('render',$data);
		}else{
			$colaborador_id= $this->uri->segment(3) ?? 0;

			if($colaborador_id!=='' && $colaborador_id!==0){
				$this->load->model('Colaboradores_model','Colaboradores');
				$data['colaborador']= $this->Colaboradores->get($colaborador_id);
			}

			$data['js']=array('assets/js/pages/colaboradores/editar.js');

			$data['page_incluir']='colaboradores/editar';
			$data['title']='Edição de colaborador';
			$this->load->view('render',$data);
		}	
	}

	public function altera_status(){
			if($this->usuario_logado['colaborador_tipo'] !== 'master'){
				print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
				exit;
			}

			$colaborador_id= $this->input->post('colaborador_id', TRUE);

			if(!is_null($colaborador_id) && $colaborador_id!==''){
				$this->load->model('Colaboradores_model','Colaboradores');
				$atual= $this->Colaboradores->getCampo('colaborador_status',$colaborador_id);
				if($atual==1){$status=0;}else{$status=1;}
				$colaborador=array(
					'colaborador_status' => $status
				);
				$retorno= $this->Colaboradores->update($colaborador_id,$colaborador);
				if($retorno['retorno']==TRUE){
					$this->session->set_flashdata('aviso_modal',array(
						'mensagem' => 'Status alterado com sucesso!',
						'imagem' => 'ok.png',
						'botao' => 'OK'
					));
					location_page('colaboradores');
				}else{
					print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
				}
			}else{
				print_js('modal_aviso("Colaborador não identificado.<br>Atualize a página!","atencao.png","OK");');
			}
	}

	public function novo_do(){

			if($this->usuario_logado['colaborador_tipo'] !== 'master'){
				print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
				exit;
			}

			$colaborador_tipo = $this->input->post('colaborador_tipo', TRUE);
			$colaborador_login = $this->input->post('colaborador_login', TRUE);
			$colaborador_nome = $this->input->post('colaborador_nome', TRUE);
			$colaborador_senha = $this->input->post('colaborador_senha', TRUE);

			//VALIDAÇÕES MANUAIS
			if(is_null($colaborador_tipo) || $colaborador_tipo==''){
				print_js('modal_aviso("Tipo de colaborador inválido!","erro-x.png","OK");');
				exit;
			}
			if(is_null($colaborador_login) || $colaborador_login==''){
				print_js('modal_aviso("Informe o nome do colaborador!","erro-x.png","OK");');
				exit;
			}
			if(is_null($colaborador_senha) || $colaborador_senha==''){
				print_js('modal_aviso("Digite uma senha válida!","erro-x.png","OK");');
				exit;
			}else{
				$colaborador_senha= md5($colaborador_senha);
			}
			if(is_null($colaborador_nome) || $colaborador_nome==''){
				$colaborador_nome= $colaborador_login;
				$colaborador_nick= $colaborador_login;
			}else{
				$colaborador_nick= explode(' ',$colaborador_nome);
				$colaborador_nick= $colaborador_nick[0];
			}

			//VALIDAÇÕES MANUAIS

			$colaborador= array(
				'colaborador_tipo' => $colaborador_tipo,
				'colaborador_login' => $colaborador_login,
				'colaborador_nome' => $colaborador_nome,
				'colaborador_nick' => $colaborador_nick,
				'colaborador_senha' => $colaborador_senha,
				'colaborador_status' => $this->input->post('colaborador_status', TRUE) ?? 0,
				'colaborador_datatime_criado' => date('Y-m-d H:i:s')
			);

			$this->load->model('Colaboradores_model','Colaboradores');
			$retorno= $this->Colaboradores->insert($colaborador);
			if($retorno['retorno']==TRUE){
				$this->session->set_flashdata('aviso_modal',array(
					'mensagem' => 'Colaborador cadastrado com sucesso!',
					'imagem' => 'ok.png',
					'botao' => 'OK'
				));
				location_page('colaboradores');
			}else{
				print_js('modal_aviso("'.$retorno['message'].'","erro-db.png","OK");');
			}
	}

	public function editar_do(){

		if($this->usuario_logado['colaborador_tipo'] !== 'master'){
			print_js('modal_aviso("Seu usuário não tem acesso a está página, peça ajuda a um administrador.!","atencao.png","OK");');
			exit;
		}

			$colaborador_id= $this->input->post('colaborador_id', TRUE);
			if(!is_null($colaborador_id) && $colaborador_id!==''){

				$this->load->model('Colaboradores_model','Colaboradores');

				$status= $this->Colaboradores->getCampo('colaborador_status',$colaborador_id);
				if($status==0){
					print_js('modal_aviso("Colaborador inativo, não é possível alterar os dados!","erro-x.png","OK");');
					exit;
				}

				$colaborador_tipo = $this->input->post('colaborador_tipo', TRUE);
				$colaborador_login = $this->input->post('colaborador_login', TRUE);
				$colaborador_nome = $this->input->post('colaborador_nome', TRUE);
				$colaborador_senha = $this->input->post('colaborador_senha', TRUE);

				//VALIDAÇÕES MANUAIS
				if(is_null($colaborador_tipo) || $colaborador_tipo==''){
					print_js('modal_aviso("Tipo de colaborador inválido!","erro-x.png","OK");');
					exit;
				}
				if(is_null($colaborador_login) || $colaborador_login==''){
					print_js('modal_aviso("Informe o login do colaborador!","erro-x.png","OK");');
					exit;
				}
				

				//VALIDAÇÕES MANUAIS

				$colaborador= array(
					'colaborador_tipo' => $colaborador_tipo,
					'colaborador_login' => $colaborador_login,
					'colaborador_nome' => $colaborador_nome,
					'colaborador_status' => $this->input->post('colaborador_status', TRUE) ?? 0
				);
				if(!is_null($colaborador_senha) && $colaborador_senha!==''){
					$colaborador_senha= md5($colaborador_senha);
					$colaborador= array_merge($colaborador,array('colaborador_senha' => $colaborador_senha));
				}

				$retorno= $this->Colaboradores->update($colaborador_id,$colaborador);
				if($retorno['retorno']==TRUE){
					$this->session->set_flashdata('aviso_modal',array(
						'mensagem' => 'Colaborador editado com sucesso!',
						'imagem' => 'ok.png',
						'botao' => 'OK'
					));
					location_page('colaboradores');
				}else{
					print_js('modal_aviso("'.format_error_bd($retorno['message']).'","erro-db.png","OK");');
				}
			}else{
				print_js('modal_aviso("Colaborador não identificado.<br>Atualize a página!","atencao.png","OK");');
			}
	}



}
