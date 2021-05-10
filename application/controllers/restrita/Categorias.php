<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class categorias extends CI_Controller {

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

				'titulo' => 'Listagem de categoria',

				
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
				'categorias' =>  $this->core_model->get_all('categorias'),// get all users

			);

	    // 		 echo '<pre>';
			  //  print_r($data['categorias']);
			  // exit();

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/categorias/index');
			$this->load->view('restrita/layout/footer');


		}


		 public function core($categoria_id = NULL){

    $categoria_id = (int)  $categoria_id;


    	if(!$categoria_id) {
          
    		 //Cadastrar.....


    			$this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[2]|max_length[40]|callback_valida_nome_categoria');

    			if($this->form_validation->run()) {
    				// echo '<pre>';
    				// print_r($this->input->post());
    				// exit();

    				$data = elements(
    					array(
    						'categoria_nome',
    						'categoria_ativa',
                            'categoria_pai_id',

    					),$this->input->post()
    					//Definido meta link

    				);

    				$data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

    					$data = html_escape($data);

    					$this->core_model->insert('categorias', $data);
    					redirect('restrita/categorias','refresh');
    				
    			} else {

    				//Erro de validação 


	     $data = array(

				'titulo' => 'Cadastrando novas categoria filha',
                'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1)),
				

			);
     
     		  //echo '<pre>';
			 // print_r($data['categoria_pai']);
			// exit();

			$this->load->view('restrita/layout/header',$data);
			$this->load->view('restrita/categorias/core');
			$this->load->view('restrita/layout/footer');
    				
    			}




    	}else{

if (!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
    			$this->session->set_flashdata('erro', 'Esssa categoria filha não existe!');
    			redirect('restrita/categorias','refresh');
    			
    		}else{
    				//Editando.... 

    $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[2]|max_length[40]');

    			if($this->form_validation->run()) {

    		// 		echo '<pre>';
				 	// print_r($this->input->post());
			  	// 	exit();

    				$data = elements(
    					array(
    						'categoria_nome',
    						'categoria_ativa',
                            'categoria_pai_id',

    					),$this->input->post()
    					//Definido meta link

    				);

    	$data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);
    	$data = html_escape($data);
    	$this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));
    			redirect('restrita/categorias','refresh');
    				
    			} else {

    				//Erro de validação 


			     $data = array(

					'titulo'     => 'Editar categoria filha',
                    'categoria' => $categoria,
					'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1)),
                

					);
     
     //          echo '<pre>';
				 // print_r($data['categoria']);
			  // exit();

			$this->load->view('restrita/layout/header',$data);
			$this->load->view('restrita/categorias/core');
			$this->load->view('restrita/layout/footer');
    				
    			}
    		}
  	  	}

 	}

 	public function delete($categoria_id = NULL){

	$categoria_id = (int) $categoria_id;

if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
		$this->session->set_flashdata('erro','Categoria filha não foi encontrado');
	redirect('restrita/categorias');
   }
	//Aqui não deixo ela apagar se ela  estiver ativa 
if($this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id, 'categoria_ativa' => 1))){
		$this->session->set_flashdata('erro','Não e possivel excluir uma categoria filha ativa');
	redirect('restrita/categorias');

    }
	$this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
	redirect('restrita/categorias');


}

 	public function valida_nome_categoria($categoria_nome){

         $categoria_id = $this->input->post('categoria_id');

         if (!$categoria_id) {

         	//cadastrando..

  if($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome))) {
				
				$this->form_validation->set_message('valida_nome_categoria', 'Essa nome de categoria filha já existe cadastrando!');

         		return false;
         		
         	}else{

         		return true;
         	}


         	
         }else{


           //Editando ...


         	if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_pai_id !=' => $categoria_pai_id))) {
				
				$this->form_validation->set_message('valida_nome_categoria', 'Esse nome de categoria filha já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}

         }


	}
}