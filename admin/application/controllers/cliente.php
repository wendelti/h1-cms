<?php

include("baseController.php");

class Cliente extends BaseController{

    protected $view = 'cliente/cliente_view';
    protected $view_cadastro = 'cliente/cliente_edit';
    protected $controller = 'cliente';

    public function Cliente(){     
        parent::__construct();
        $this->load->model('clienteModel');
        $this->load->helper('security');
        $this->model = $this->clienteModel;
        $this->IDTabela = 'IDCliente';
        $this->registro = array(
            'Nome' => $this->input->post('Nome'),
            'Telefone' => $this->input->post('Telefone'),
            'Email' => $this->input->post('Email'),
            'Senha' => do_hash($this->input->post('Senha'), 'md5'),
            'Status' => $this->input->post('Status') ? $this->input->post('Status') : 1
            );
    }


}
?>