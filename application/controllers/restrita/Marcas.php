	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Marcas extends CI_Controller {

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

				'titulo' => 'Listagem de marcas',

				
			'styles' =>array(
					'bundles/datatables/datatables.min.css',
					'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',

				),

			'scripts' =>array(
				'bundles/datatables/datatables.min.js',
				'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
				'bundles/jquery-ui/jquery-ui.min.js',
				'js/page/datatables.js'

			),
				//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
				'marcas' =>  $this->core_model->get_all('marcas'),// get all users

			);

	    //  echo '<pre>';
				 // print_r($data['marcas']);
			  // exit();

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/marcas/index');
			$this->load->view('restrita/layout/footer');


		}

		public function core($marca_id = NULL){

			//$marca_id = (int) $marca_id;

			if(!$marca_id){

	        //cadastra uma marca

				$this->form_validation->set_rules('marca_nome', 'Nome da marcas', 'trim|required|min_length[2]|max_length[40]|callback_nome_marca');


				// $this->form_validation->set_rules('marca_meta_link', 'Link ', 'trim|required|min_length[3]|max_length[240]');
				// $this->form_validation->set_rules('marca_ativa', 'Ativo', 'trim|required|min_length[3]|max_length[240]');

				if($this->form_validation->run()){

					// echo '<pre>';
	    //        		 print_r($this->input->post());
					// exit();

					$data = elements(
						  array(
						  	'marca_nome',
						  	'marca_ativa',
						  	
						  ),
						   $this->input->post()

					);

					//Esse aqui tranforma tudo em link //
					$data['marca_meta_link'] = url_amigavel($data['marca_nome']);

					$data = html_escape($data);

					//cadastra marcas 
					$this->core_model->insert('marcas', $data);
					
					redirect('restrita/marcas','refresh');


				} else {
					
					//erro de validaçãos 


				$data = array(

				'titulo' => 'Cadastra marcas',

				//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
				

			);

	    //  echo '<pre>';
				 // print_r($data['marcas']);
			   //exit();

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/marcas/core');
			$this->load->view('restrita/layout/footer');

				}

			


		}else{

			if (!$marcas = $this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {
				
				$this->session->set_flashdata('erro', 'A marca não foi encontrada');
				redirect('restrita/marcas','refresh');
			}else{
	           
	           // editar marcas...

				$this->form_validation->set_rules('marca_nome', 'Nome da marcas', 'trim|required|min_length[2]|max_length[40]|callback_nome_marca');


				// $this->form_validation->set_rules('marca_meta_link', 'Link ', 'trim|required|min_length[3]|max_length[240]');
				// $this->form_validation->set_rules('marca_ativa', 'Ativo', 'trim|required|min_length[3]|max_length[240]');

				if($this->form_validation->run()) {

					// echo '<pre>';
	    //        		 print_r($this->input->post());
					// exit();

					$data = elements(
						  array(
						  	'marca_nome',
						  	'marca_ativa',
						  	
						  ),
						   $this->input->post()

					);

					//Esse aqui tranforma tudo em link //
					$data['marca_meta_link'] = url_amigavel($data['marca_nome']);

					$data = html_escape($data);

					//Atualiza marcas 
					$this->core_model->update('marcas', $data, array('marca_id' => $marca_id));
					redirect('restrita/marcas','refresh');


				} else {
					
					//erro de validaçãos 


				$data = array(

				'titulo' => 'Atualizando marcas',

				//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
				'marcas' =>  $marcas, //// get all users

			);

	    //  echo '<pre>';
				 // print_r($data['marcas']);
			  // exit();

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/marcas/core');
			$this->load->view('restrita/layout/footer');

				}

			}
		}

	}
///Deletar o 
public function delete($marca_id = NULL){

if(!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))){
		$this->session->set_flashdata('erro','Marca não foi encontrado');
	redirect('restrita/marcas');
   }
	//Aqui não deixo se ele estiver ativo 
if($this->core_model->get_by_id('marcas', array('marca_id' => $marca_id, 'marca_ativa' => 1))){
		$this->session->set_flashdata('erro','Não e possivel exluir uma marca ativa');
	redirect('restrita/marcas');

    }
	$this->core_model->delete('marcas', array('marca_id' => $marca_id));
	redirect('restrita/marcas');

   

}

	public function nome_marca($marca_nome){


         $marca_id = $this->input->post('marca_id');

         if (!$marca_id) {

         	//cadastrando..

         	if ($this->core_model->get_by_id('marcas', array('marca_nome' => $marca_nome))) {
				
				$this->form_validation->set_message('nome_marca', 'Esse nome de marca já existe cadastrando!');

         		return false;
         		
         	}else{

         		return true;
         	}


         	
         }else{


           //Editando ...


         	if ($this->core_model->get_by_id('marcas', array('marca_nome' => $marca_nome, 'marca_id !=' => $marca_id))) {
				
				$this->form_validation->set_message('nome_marca', 'Esse nome de marca já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}

         }


	}

	}