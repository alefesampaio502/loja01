<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//$this->load->helper('text');
	}

	
public function index(){

	  $this->form_validation->set_rules('cep', 'CEP destino ', 'trim|required|exact_length[9]');
	  $this->form_validation->set_rules('produto_id', 'Produto ID ', 'trim|required');

$retorno = array();
 	if($this->form_validation->run() ) {

	$produto_id = (int) $this->input->post('produto_id');
	

		if (!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
			
			$retorno['erro'] = 3;
    		$retorno['retorno_endereco'] = 'Não encontramos o produto em nossa loja!';
    		echo json_encode($retorno);
    		exit();
		}else{

			//inicio a consulata ao web server via cep

		//sucesso produto existem continua  a compra ou processamento
			$cep_destino = str_replace('-', '', $this->input->post('cep'));


	//montando URL para consulta o endereço //
			$url_endereco = 'https://viacep.com.br/ws/';
			$url_endereco .= $cep_destino;
			$url_endereco .= '/json/';
			$curl = curl_init();

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url_endereco);

    $resultado = curl_exec($curl);

    $resultado = json_decode($resultado);


    if(isset($resultado->erro)){

    	$retorno['erro'] = 3;
    	$retorno['mensagem'] = 'CEP não foi encontrado!';
    	$retorno['retorno_endereco'] = 'CEP não foi encontrado!';
    }else{

	  	$retorno['erro'] = 0;
	  	$retorno['mensagem'] = 'Sucesso';	
	  	$retorno['retorno_endereco'] = ' '.$resultado->logradouro . ', '.
	  	$resultado->bairro. ', '.$resultado->localidade.' - '.$resultado->uf. ', '.$resultado->cep;
    }

   //
    //Final da consulta web server via cep  //
/*

//inicio da consulata ao web server dos correios

montando a url para os correios exibirem o valor do frete
http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=08082650&sDsSenha=564321&sCepOrigem=70002900&sCepDestino=04547000&nVlPeso=1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nCdServico=04510&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3
*/

	
		///infomações do cep de origem da loja  com tabela config_do correios coreios no banco de dados 
     $config_correios = $this->core_model->get_by_id('config_correios', array('config_id' => 1));
     
     // echo '<pre>';
     // print_r($config_correios);
     // exit();
     //cep do destino sendo recuperado do post() esse cep e para onde vai o produto 
     $cep_destino = $this->input->post('cep');


    $url_correios = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?';
	$url_correios .= 'nCdEmpresa=08082650';
	$url_correios .= '&sDsSenha=564321';
	$url_correios .= '&sCepOrigem='. str_replace('-', '', $config_correios->config_cep_origem);
	$url_correios .= 'sCepDestino='. str_replace('-', '', $cep_destino);
	$url_correios .= '&nVlPeso='. $produto->produto_peso;
	$url_correios .= '&nCdFormato=1';
	$url_correios .= '&nVlComprimento='. $produto->produto_comprimento;
	$url_correios .= '&nVlAltura='. $produto->produto_altura;
	$url_correios .= '&nVlLargura='. $produto->produto_largura;
	$url_correios .= '&sCdMaoPropria=n';
	$url_correios .= '&nVlValorDeclarado=0'. $config_correios->config_valor_declarado;
	$url_correios .= '&sCdAvisoRecebimento=n';
	$url_correios .= '&nCdServico='. $config_correios->config_codigo_pac;
	$url_correios .= '&nCdServico='. $config_correios->config_codigo_sedex;
	$url_correios .= '&nVlDiametro=0';
	$url_correios .= '&StrRetorno=xml';
	$url_correios .= '&nIndicaCalculo=3';

  
  		echo json_encode($url_correios);
	 	exit();
 
	$xml = simplexml_load_file($url_correios);
	$xml = json_encode($xml);

}

 	 }else{

  	// Erro na validação 
	  	$retorno['erro'] = 5;
	  	$retorno['retorno_endereco'] = validation_errors(); 

	  	$consulta  = json_decode($xml);

	  	//Garantido que over consulta ao web dos correios
       
          // if ($consulta->cServico[0]->valor == '0,00') {
          
          // 	//faz alguma coisa
          // 	# code...
          // }else{

          // 	//Sucesso

          // }


       


   	 }

	//echo json_encode($retorno);

    }

}