<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->helper('text');
		//$this->load->helper('text');
	}
	



public function index($categoria_pai_meta_link = NULL){

	if(!$categoria_pai_meta_link || !$master = $this->core_model->get_by_id('categorias_pai',array('categoria_pai_meta_link' => $categoria_pai_meta_link))){

		redirect('/','refresh');
	}else{


	     $data = array(

	     		'titulo' => 'produtos da categoria '.$master->categoria_pai_nome,
	     		'categoria' => $master->categoria_pai_nome,
				
				'produtos' => $this->produtos_model->get_all_bay(array('categoria_pai_meta_link' => $categoria_pai_meta_link)),
		   );

	     
	}

	// echo '<pre>';
	// print_r($data);
	// exit();
	

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/master');
		$this->load->view('web/layout/footer');


	}

}