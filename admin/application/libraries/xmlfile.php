<?php

	/**
	* Classe respons�vel por formatar conte�dos em arquivos XMl
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
		* Vari�vel com o nome do sistema
		* O nome do sistema � o root do documento xml
		* Por padr�o define o sistema definido no arquivo de configura��o
		* @access Private
		* @name $_nome_sistema
		*/
		private $_nome_sistema = "root";

		/**
		* Vari�vel com o tipo de codifica��o
		* @access Private
		* @name $_nome_sistema
		*/
		private $_codificacao = 'UTF-8';

		/**
		* Vers�o do documento de sa�da
		* @access Private
		* @name $_versao_xml
		*/
		private $_versao_xml = '1.0';

		/**
		* Objeto de constru��o do arquivo XML
		* @access Private
		* @name $_obj_xml
		*/
		private $_obj_xml;

		/**
		* M�todo construtor.
		* Inicia o objeto e cria o root com o nome do sistema especificado no arquivo de configura��o
		* @access Public
		* @param String $_nome_sistema possibilita definir outro nome ao root do documento diferente do informado no arquivo de configura��o do sistema
		* @param String $_codificacao possibilita definir outro tipo de codifica��o. O padr�o � UTF-8
		* @param String $_versao_xml possibilita alterar a vers�o de sa�da do arquivo XML. Por padr�o, vers�o 1.0
		* @return bool
		*/
		public function __construct($_nome_sistema = FALSE, $_codificacao = FALSE, $_versao_xml = FALSE)
		{
			// caso  tenha sido passado um nome para o sistema, define o mesmo
			if(isset($_nome_sistema) AND "" != $_nome_sistema)
				$this->_nome_sistema = $_nome_sistema;

			// caso  tenha sido passado a codifica��o do sistema, define o mesmo
			if(isset($_codificacao) AND "" != $_codificacao)
				$this->_codificacao = $_codificacao;

			// caso  tenha sido passado vers�o de sa�da do arquivo xml, define o mesmo
			if(isset($_versao_xml) AND "" != $_versao_xml)
				$this->_versao_xml = $_versao_xml;

			// inicia o objeto XmlWriter
			$this->_obj_xml = new XmlWriter();
			// inicia a mem�ria
			$this->_obj_xml->openMemory();
			// inicia o documento passando como par�metro a vers�o do documento xml e o tipo de codifica��o que ser� usada
			$this->_obj_xml->startDocument($this->_versao_xml, $this->_codificacao);

			// cria a raiz do documento com o nome do sistema
			$this->_obj_xml->startElement($this->_nome_sistema);
			// habilita a identa��o do documento
			$this->_obj_xml->setIndent(TRUE);
			// define 3 espa�os para serem utilizados como identa��o afim de ficar mais claro no debug
			$this->_obj_xml->setIndentString("   ");

			return true;
		}

		/**
		* M�todo para adicionar conte�do ao XML
		* Inicia o objeto e cria o root com o nome do sistema especificado no arquivo de configura��o
		* @access Public
		* @param String $_array_dados Array de forma associativa com dados a serem inseridos no objeto XML
		* @return bool
		*/
		public function addContent($_arr_dados, $_str_indice = FALSE)
		{
			// verifica se foi passado um array v�lido
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

					// insere elementos que n�o contenham mais filhos
					@$this->_obj_xml->writeElement($chave, ($valor) );
				}

				return true;
			}
			else
			{
				// debug
				// array inv�lido
			}
		}

		/**
		* M�todo para retornar o arquivo XML gerado
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