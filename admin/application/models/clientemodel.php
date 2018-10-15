<?php
include_once("basemodel.php");
class ClienteModel extends BaseModel {

	public function ClienteModel(){
    	$this->tabela       = 'cliente';
        $this->IDTabela     = 'IDCliente';
	}



}

?>