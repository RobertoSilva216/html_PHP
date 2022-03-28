<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Colaboradores_model');

        if(isset($_SESSION['sessao_logado'])){
            print_js('window.location.replace("'.base_url().'");');
        }

    }
	public function index(){
		$this->load->view('login/login');
    }

    public function logar(){

        $page_redirect=$this->session->flashdata('url_redirect');
        if($page_redirect =='' || is_null($page_redirect)){
            $page_redirect='home';
        }
        $this->session->set_flashdata('url_redirect',$page_redirect);

        $senha= $this->input->post('senha', TRUE);
        if(is_null($senha) || $senha==''){
			print_js('alertDivRetorno(divRetorno,"danger","Digite sua senha!");btnBlock(btnLogin,false);');
			exit;
		}else{
			$senha= md5($senha);
		}

        $dados= array(
            'senha' => $senha,
            'usuario'=> $this->input->post('usuario', TRUE)
        );
        
        $confere= $this->Colaboradores_model->login($dados);
       
        if($confere['retorno']==TRUE){
            $userdata = array(
                'sessao_id_user'  => $confere['user']['colaborador_id'],
                'sessao_usuario'  => $confere['user']['colaborador_login'],
                'sessao_nome' => $confere['user']['colaborador_nome'],
                'sessao_user_nick' => $confere['user']['colaborador_nick'],
                'sessao_user_tipo' => $confere['user']['colaborador_tipo'],
                'sessao_logado' => TRUE
            );
            $this->session->set_userdata($userdata);
            $msg='Dados aceitos '.$confere['user']['colaborador_nick'].'!<br>Direcionando...<br>';

            location_page($page_redirect);
            print_js('alertDivRetorno(divRetorno,"success","'.$msg.'");btnBlock(btnLogin,false);'); //pra caso o refresh demore
            
        }else{
            print_js('alertDivRetorno(divRetorno,"danger","'.$confere['erro'].'");btnBlock(btnLogin,false);');
        }

    }
    public function recuperarSenha(){
        $email= $this->input->post('email', TRUE);
        echo 'email: '.$email;
    }
    public function sair(){
        $userdata= array('sessao_usuario','sessao_id_user','sessao_nome','sessao_user_nick','sessao_logado');
	    $this->session->unset_userdata($userdata);
	    location_page('home');
    }
   
}