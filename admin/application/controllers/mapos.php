<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include("baseController.php");
class Mapos extends BaseController {
	
    public $view = 'mapos/painel';
    public function __construct() {
        parent::__construct(false, true);
        $this->load->helper('directory');
        $this->load->helper('file');
        $this->load->helper('security');
    }
    

    public function index() {
        $this->login();
    }

    public function alterarSenha() {
		$this->ValidaLogin();

        $oldSenha = $this->input->post('oldSenha');
        $senha = $this->input->post('novaSenha');
        $result = $this->mapos_model->alterarSenha(do_hash($senha, 'md5'), do_hash($oldSenha, 'md5'),$this->session->userdata('IDCliente'));
        if($result){
            $this->session->set_flashdata('success','Senha Alterada com sucesso!');
            redirect(base_url() . 'index.php/mapos/minhaConta');
        }

        else{
            $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar a senha!');
            redirect(base_url() . 'index.php/mapos/minhaConta');
        }

    }


    public function login(){
    	
    	if ($this->uri->segment(3) == "url") {
			$this->session->set_userdata('LinkOrigem', urldecode($this->input->get("url")));	     	
        }
        $this->load->view('mapos/login');
    }

    public function sair(){
		  
		$logged = $this->session->userdata('logado');
		if (isset($logged) || $logged == true) {
			$this->session->sess_destroy();
		}
		/* 
		//print_r($this->session->all_userdata());
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->session->set_userdata(array('logado' => 'false'));*/

		
		redirect('mapos/login');
    }

    public function verificarLogin(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','valid_email|required|xss_clean|trim');
        $this->form_validation->set_rules('senha','Senha','required|xss_clean|trim');
        $ajax = $this->input->get('ajax');
        if ($this->form_validation->run() == false) {
            if($ajax == true){
                $json = array('result' => false);
                echo json_encode($json);
            }

            else{
                $this->session->set_flashdata('error','Os dados de acesso estão incorretos.');
                redirect('mapos/login');
            }

        } else {
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            $this->load->library('encrypt');   
            $senha = md5($senha);
            
            $this->db->where('Email',$email);
            $this->db->where('Senha',$senha);
            $this->db->where('Status',1);
            $this->db->limit(1);
            $usuario = $this->db->get('cliente')->row();
            if(count($usuario) > 0){
                
                $site['Status'] = $usuario->Status;
                //Empresa
                $site['IDCliente']  = $usuario->IDCliente;
                $site['Nome']  = $usuario->Nome;
                $site['Email'] = $usuario->Email;
                $site['logado'] = true;
                
                $this->session->set_userdata($site);

		    		  redirect('cliente/index/');
            
            
                

            }

            else{
   $this->session->set_flashdata('error','Os dados de acesso estão incorretos.');
                	redirect('mapos/login');

            }

        }

    }
 
}

