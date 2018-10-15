<?php

	/**
	* Classe responsável por formatar conteúdos em arquivos XMl
	*
	* @author Marcos Timm Rossow <marcos@marcos.blog.br>
	* @version 0.1
	* @copyright Interwise
	* @access Public
	* @package ADM
	*/
	class XmlFile
	{
		/**
		* Variável com o nome do sistema
		* O nome do sistema é o root do documento xml
		* Por padrão define o sistema definido no arquivo de configuração
		* @access Private
		* @name $_nome_sistema
		*/
		private $_nome_sistema = "root";

		/**
		* Variável com o tipo de codificação
		* @access Private
		* @name $_nome_sistema
		*/
		private $_codificacao = 'UTF-8';

		/**
		* Versão do documento de saída
		* @access Private
		* @name $_versao_xml
		*/
		private $_versao_xml = '1.0';

		/**
		* Objeto de construção do arquivo XML
		* @access Private
		* @name $_obj_xml
		*/
		private $_obj_xml;

		/**
		* Método construtor.
		* Inicia o objeto e cria o root com o nome do sistema especificado no arquivo de configuração
		* @access Public
		* @param String $_nome_sistema possibilita definir outro nome ao root do documento diferente do informado no arquivo de configuração do sistema
		* @param String $_codificacao possibilita definir outro tipo de codificação. O padrão é UTF-8
		* @param String $_versao_xml possibilita alterar a versão de saída do arquivo XML. Por padrão, versão 1.0
		* @return bool
		*/
		public function __construct($_nome_sistema = FALSE, $_codificacao = FALSE, $_versao_xml = FALSE)
		{
			// caso  tenha sido passado um nome para o sistema, define o mesmo
			if(isset($_nome_sistema) AND "" != $_nome_sistema)
				$this->_nome_sistema = $_nome_sistema;

			// caso  tenha sido passado a codificação do sistema, define o mesmo
			if(isset($_codificacao) AND "" != $_codificacao)
				$this->_codificacao = $_codificacao;

			// caso  tenha sido passado versão de saída do arquivo xml, define o mesmo
			if(isset($_versao_xml) AND "" != $_versao_xml)
				$this->_versao_xml = $_versao_xml;

			// inicia o objeto XmlWriter
			$this->_obj_xml = new XmlWriter();
			// inicia a memória
			$this->_obj_xml->openMemory();
			// inicia o documento passando como parâmetro a versão do documento xml e o tipo de codificação que será usada
			$this->_obj_xml->startDocument($this->_versao_xml, $this->_codificacao);

			// cria a raiz do documento com o nome do sistema
			$this->_obj_xml->startElement($this->_nome_sistema);
			// habilita a identação do documento
			$this->_obj_xml->setIndent(TRUE);
			// define 3 espaços para serem utilizados como identação afim de ficar mais claro no debug
			$this->_obj_xml->setIndentString("   ");

			return true;
		}

		/**
		* Método para adicionar conteúdo ao XML
		* Inicia o objeto e cria o root com o nome do sistema especificado no arquivo de configuração
		* @access Public
		* @param String $_array_dados Array de forma associativa com dados a serem inseridos no objeto XML
		* @return bool
		*/
		public function addContent($_arr_dados, $_str_indice = FALSE)
		{
			// verifica se foi passado um array válido
			if(is_array($_arr_dados) AND 0 < count($_arr_dados))
			{
				// percorre os elementos do array
				foreach($_arr_dados as $chave => $valor)
				{
					// verifica se existem filhos para este array
					if(is_array($valor))
					{
						// abre o elemento
						$this->_obj_xml->startElement($_str_indice);
						// define o primeiro valor como atributo
						//$this->_obj_xml->writeAttribute("id", $valor[key($valor)]);

						// retira a chave
						//array_shift($valor);

						// recursividade para inserir um elemento interno
						$this->addContent($valor);

						// finaliza o elemento
						$this->_obj_xml->endElement();

						// continua percorrendo o array
						continue;
					}

					// insere elementos que não contenham mais filhos
					@$this->_obj_xml->writeElement($chave, ($valor) );
				}

				return true;
			}
			else
			{
				// debug
				// array inválido
			}
		}

		/**
		* Método para retornar o arquivo XML gerado
		* @access Public
		* @return string
		*/
		public function showXML()
		{

			// finaliza o objeto
			$this->_obj_xml->setIndent(true);
			$this->_obj_xml->endElement();

			// retorna o XML gerado
			return $this->_obj_xml->outputMemory(true);
		}
	}
?>