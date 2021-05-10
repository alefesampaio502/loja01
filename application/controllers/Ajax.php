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


  
$retono = array();


 	if($this->form_validation->run() ) {
  	# code...
 		//sucesso

  	$retono['erro'] = 0;
  	$retono['mensagem'] = 'Sucesso';


  }else{

  	// Erro na validação 
  	$retono['erro'] = 5;
  	$retono['mensagem'] = validation_errors(); 
    }

	echo json_encode($retono);

    }

}