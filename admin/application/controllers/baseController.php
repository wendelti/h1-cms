<?php
class BaseController extends CI_Controller{
    
    //Site
    protected $Status;
    protected $Nome;
    protected $Email;
    protected $AcessoLimitado = false;
    
    //Propriedades da classe
    protected $view;
    protected $view_cadastro;
    
    protected $controller;
    protected $model;
    
    protected $busca;
    protected $Ordenar;
    protected $limit = 20;
    
    protected $data;
    protected $registro;
    
    protected $IDTabela;
    
    protected $este;
    protected $menuLabel;
    protected $titleLabel;
    protected $dadosAssociados;
    

    public function BaseController(
            $validateLogin = true){
		parent::__construct();
		if($validateLogin){
                    $this->ValidaLogin();
		}
        //Site
        $this->Status      = $this->session->userdata('Status');
        $this->IDCliente   = $this->session->userdata('IDCliente');
        $this->Nome        = $this->session->userdata('Nome');
        $this->Email       = $this->session->userdata('Email');
        
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->library('fn');
        // load helper
        $this->load->helper('url');
        
        $this->data['__PAGINA__'] = $this->view;
        $this->data['controller'] = $this->controller;
        //Dados do Site
        $this->data['AcessoLimitado'] = false;
        $this->data['__Nome__'] = $this->Nome;
        $this->data['IDCliente'] = $this->IDCliente;
        $this->data['__Modal__'] = $this->uri->segment(3) == "Modal" ? true : false;
        $this->data['custom_error'] = '';
        $this->data['menu'] = $this->menuLabel;
        $this->data['title'] = $this->titleLabel;
        $this->data['IDTabela'] = $this->IDTabela;
        $this->data['este'] = $this->este;
        $this->data['dadosAssociados'] = $this->dadosAssociados;
    }
	public function ValidaAcessoRestrito(){
        $AcessoLimitado = $this->session->userdata('AcessoLimitado');
        if (!isset($AcessoLimitado) || $AcessoLimitado) {
			redirect('mapos/verificarLogin');
            die;
        }        
	}
	public function ValidaLogin(){
        $logged = $this->session->userdata('logado');
        if (!isset($logged) || $logged != true) {
			redirect('mapos/verificarLogin');
            die;
        }      
	}
    public function index($offset = 0){
    	$this->ValidaAcessoRestrito();	
        $this->busca = NULL;
        $this->session->set_userdata('busca', NULL);
        
        $this->Ordenar = NULL;
        $this->session->set_userdata('Ordenar', NULL);
        
        $this->getLista();
        $this->data['registro'] = NULL;
        $this->data['acao'] = 'save';
        $this->load->view('template',$this->data);
    }
    public function busca(){
    	$this->ValidaAcessoRestrito();	
        if($this->input->post('busca') != NULL){
            $this->busca = $this->input->post('busca');
            $this->session->set_userdata('busca',$this->input->post('busca'));
        	if($this->input->post('Ordenar') != NULL && $this->input->post('Ordenar') <> ''){
        		$this->Ordenar = $this->input->post('Ordenar');
            	$this->session->set_userdata('Ordenar',$this->input->post('Ordenar'));
			}
        }else{
            $this->busca = $this->session->userdata('busca');
            $this->Ordenar = $this->session->userdata('Ordenar');
        }
        $this->getLista();
        $this->data['registro'] = NULL;
        $this->data['acao'] = 'save';
        $this->load->view('template',$this->data);
    }
    protected function getLista(){
    	$this->ValidaAcessoRestrito();	
		// offset
		$offset = $this->uri->segment(4);
        // load data
        if($this->input->post('ExibirTodos') == '1')
        	$this->limit = 0;
        if($this->Ordenar != null && $this->Ordenar != '')
        	$this->model->orderby = $this->Ordenar;
		$paginas = $this->model->get_paged_list($this->limit, $offset, $this->busca)->result();
		// generate pagination
		$config['base_url'] = site_url($this->controller.'/busca/pagination/');
 		$config['total_rows'] = $this->model->count_all($this->busca);
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
        $this->data['data_table'] = $paginas ;
    }
    public function save($redirect = true, $validaRestrito = true){
    	if($validaRestrito)
    		$this->ValidaAcessoRestrito();	
    	if ($this->form_validation->run($this->controller) == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
	        $this->id = $this->model->save($this->registro);
	        if($redirect){
	    		if($this->data['__Modal__']){
	    			echo "<script>window.parent.fechaModal()</script>;";
	    		}else{
	    		  redirect($this->controller.'/index/');
	            }
	        }
        }
        $this->data['__PAGINA__'] = $this->view_cadastro;
        $this->data['registro'] = null;
        $this->data['acao'] = 'save';
        $this->load->view('template',$this->data);
    }
    public function update($redirect = true, $validaRestrito = true){
    	if($validaRestrito)
    		$this->ValidaAcessoRestrito();	
		if ($this->form_validation->run($this->controller) == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
	        $this->id = $this->input->post($this->IDTabela);
	        $this->model->update($this->id,$this->registro);
	        if($redirect) redirect($this->controller.'/index/');
	    }
        $this->data['__PAGINA__'] = $this->view_cadastro;
        $pagina = $this->model->get_by_id($this->uri->segment(3))->row() ;
        $this->data['ID_Editado'] = $this->uri->segment(3);
        $this->data['registro'] = $pagina;
        $this->data['acao'] = 'update';
        $this->load->view('template',$this->data);
    }
    public function see($redirect = true){
    	$this->ValidaAcessoRestrito();	
        $this->data['__PAGINA__'] = $this->view_cadastro;
        $pagina = $this->model->get_by_id($this->uri->segment(3))->row() ;
        $this->data['ID_Editado'] = $this->uri->segment(3);
        $this->data['registro'] = $pagina;
        $this->data['acao'] = 'see';
        $this->load->view('template',$this->data);
    }
    public function delete($redirect = true){
    	$this->ValidaAcessoRestrito();	
    	$id = $this->input->post($this->IDTabela);
    	if($id <> "")
			$this->model->delete($id);
		else
			$this->model->delete($this->uri->segment(3));
		if($redirect) redirect($this->controller.'/index/');
	}
    function get(){
      $this->ValidaAcessoRestrito();	
      return $this->model->get_by_site();
    }
    function get_list(){
    	$this->ValidaAcessoRestrito();	
      $key = $_POST['key'];
      $val = $_POST['val'];
      $list = array();
      $result = $this->model->get_by_site(); 
      if($result){
        foreach ($result->result() as $item) {
            $list[$item->$key] = $item->$val;
        }
		$this->output
		     ->set_content_type('application/json')
		     ->set_output(json_encode($list));
        return $this->output->get_output();;
      }else{
        return FALSE;
      }
    }
    public function getJson(){
    	$this->ValidaAcessoRestrito();	
		$ID = $this->uri->segment(3);
		$ret = $this->model->get_by_id($ID)->result();
        return $this->JsonEncode($ret);
    }
    public function JsonEncode($obj){
        // load data
		$this->output
		     ->set_content_type('application/json')
		     ->set_output(json_encode($obj));
        return $this->output->get_output();
    }
	public function DoUpload($caminho){
    	$this->ValidaAcessoRestrito();	
		$config['upload_path'] = $caminho;
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$data = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
		return $data;
	}
}
?>