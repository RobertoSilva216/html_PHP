<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
        parent::__construct();

		$this->session->set_flashdata('url_redirect','home');
		verificar_login();

		$this->load->model('Colaboradores_model','Colaboradores');
		$this->usuario_logado= $this->Colaboradores->get($this->session->userdata('sessao_id_user'));
    }
	public function index(){
		$data['page_incluir']='home';
		$data['title']='Home';
        $this->load->view('render',$data);
	}
}
