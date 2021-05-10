<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
                // sessão de login
             if (!$this->ion_auth->logged_in())
			    {
			      redirect('restrita/login');
			    }
        }

	public function index()
	{
		$data = array(

			'titulo' => 'Informações  da loja',

			
				
		'scripts' =>array(
			
			'js/page/datatables.js',		
			'js/page/jquery.mask.min.js',
			'js/page/custom.js'


		),
			//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
			'sistema' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),// get all users

		);

			// echo '<pre>';
			// print_r($data['sistema']);
			// exit();

//validação dos campos form//
			$this->form_validation->set_rules('sistema_razao_social','','trim|required|min_length[5]|max_length[145]');
			$this->form_validation->set_rules('sistema_nome_fantasia','','trim|required|min_length[5]|max_length[145]');
			$this->form_validation->set_rules('sistema_cnpj','','trim|required|exact_length[18]');
			$this->form_validation->set_rules('sistema_ie','','trim|required|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('sistema_telefone_fixo','','trim|required|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('sistema_telefone_movel','','trim|required|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('sistema_email','','trim|required|valid_email|max_length[100]');
			$this->form_validation->set_rules('sistema_site_url','','trim|required|min_length[5]|max_length[100]');
			$this->form_validation->set_rules('sistema_cep','','trim|required|max_length[25]');
			$this->form_validation->set_rules('sistema_endereco','','trim|required|max_length[145]');
			$this->form_validation->set_rules('sistema_numero','','trim|required|max_length[25]');
			$this->form_validation->set_rules('sistema_cidade','','trim|required|min_length[5]|max_length[45]');
			$this->form_validation->set_rules('sistema_estado','','trim|required|max_length[2]');
			$this->form_validation->set_rules('sistema_produtos_destaques','','trim|required');
			$this->form_validation->set_rules('sistema_texto','','trim|required|max_length[700]');


			if($this->form_validation->run()){
						$data = elements(
								array(
									'sistema_razao_social',
									'sistema_nome_fantasia',
									'sistema_cnpj',
									'sistema_ie',
									'sistema_telefone_fixo',
									'sistema_telefone_movel',
									'sistema_email',
									'sistema_site_url',
									'sistema_endereco',
									'sistema_cep',
									'sistema_numero',
									'sistema_cidade',
									'sistema_estado',
									'sistema_produtos_destaques',
									'sistema_texto'
								), $this->input->post()

							);
 				//xss forma global 
 				$data = html_escape($data);
 				$this->core_model->update('sistema', $data, array('sistema_id' => 1));
 				redirect('restrita/sistema');
			}else{
		//erro na validação 
		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/sistema/index');
		$this->load->view('restrita/layout/footer');
 
	   }

	}


public function correios()
	{
	
//validação dos campos form//
			$this->form_validation->set_rules('config_cep_origem','CEP de origem','trim|required|exact_length[9]');

			$this->form_validation->set_rules('config_codigo_pac','Código do PAC','trim|required|exact_length[5]');
		
			$this->form_validation->set_rules('config_codigo_sedex','Código do SEDEX','trim|required|exact_length[5]');
			
			$this->form_validation->set_rules('config_somar_frete','Valor a ser somado ao frete','trim|required');
			
			$this->form_validation->set_rules('config_valor_declarado','Valor declarado frete','trim|required');
			


			if($this->form_validation->run()){
						$data = elements(
								array(
									'config_cep_origem',
									'config_codigo_pac',
									'config_codigo_sedex',
									'config_somar_frete',
									'config_valor_declarado'

								), $this->input->post()

							);

 				//Remove a virgula;// 
			    $data['config_somar_frete'] = str_replace(',','', $data['config_somar_frete']);
			    $data['config_valor_declarado'] = str_replace(',','', $data['config_valor_declarado']);

			    //xss forma global
 				$data = html_escape($data);


 				$this->core_model->update('config_correios', $data, array('config_id' => 1));
 				redirect('restrita/sistema/correios');
	
	}else{

		$data = array(

			'titulo' => 'Editar Informações dos correios',

			
				
		'scripts' =>array(
			
			'js/page/datatables.js',		
			'js/page/jquery.mask.min.js',
			'js/page/custom.js'


		),
			//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
			'correio' =>  $this->core_model->get_by_id('config_correios', array('config_id' => 1)),// get all users

		);

		//erro na validação 
		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/sistema/correios');
		$this->load->view('restrita/layout/footer');

	}

	}



	public function pagseguro(){
//validação dos campos form//
			$this->form_validation->set_rules('config_email','Email de acesso','trim|required|valid_email');

			$this->form_validation->set_rules('config_token','Token de acesso','trim|required|max_length[200]');
		

			if($this->form_validation->run()){

				// echo '<pre>';
				// print_r($this->input->post());
				// exit();
						$data = elements(
								array(
									'config_email',
									'config_token',
									'config_ambiente',
									

								), $this->input->post()

							);

 				
			    //xss forma global
 				$data = html_escape($data);
    //               echo '<pre>';
				// print_r($this->input->post($data));
				// exit();

 		$this->core_model->update('config_pagseguro', $data, array('config_id' => 1));
 				redirect('restrita/sistema/pagseguro');
	
	}else{

		$data = array(

			'titulo' => 'Editar Informações do pagseguro',

			//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
			'pagseguro' =>  $this->core_model->get_by_id('config_pagseguro', array('config_id' => 1)),// get all users

		);

		//erro na validação 
		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/sistema/pagseguro');
		$this->load->view('restrita/layout/footer');

	}

	}

}