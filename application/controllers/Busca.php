<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
	}
	



public function index(){

       $busca = html_escape($this->input->post('busca'));

       $data = array(

	     		'titulo' => 'Busca pelo produto '.(!empty($busca) ?  $busca : 'Nenhum termo foi digitado'),
	     		'termo_digitado' => (!empty($busca) ?  $busca : 'Nenhum termo foi digitado'),
	     		
		   );

       //faz a consulta se veio algi do post buscar 

      if($busca){
      	//se veio algo agora eu faço a consulta no banco de dados
      	 if ($produtos = $this->produtos_model->get_all_by_busca($busca)) {

       	$data['produtos'] = $produtos;
   
          }
     }
 
		$this->load->view('web/layout/header', $data);
		$this->load->view('web/busca');
		$this->load->view('web/layout/footer');

	}

}