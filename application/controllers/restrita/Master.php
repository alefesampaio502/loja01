<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Master extends CI_Controller {

		public function __construct()
	        {
	            parent::__construct();
	                // sessão de login
	             if (!$this->ion_auth->logged_in())
				    {
				      redirect('restrita/login');
				    }
	        }
	public function index(){
	     $data = array(

				'titulo' => 'Listagem de categoria master',

				
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
				
				'master' =>  $this->core_model->get_all('categorias_pai'),// get all users

			);
     
     // 			  echo '<pre>';
				 // print_r($data['master']);
			  //   exit();

			$this->load->view('restrita/layout/header',$data);
			$this->load->view('restrita/master/index');
			$this->load->view('restrita/layout/footer');
           }



 public function core($categoria_pai_id = NULL){

    $categoria_pai_id = (int)  $categoria_pai_id;


    	if(!$categoria_pai_id) {
          
    		 //Cadastrar.....


    			$this->form_validation->set_rules('categoria_pai_nome', 'Nome da categoria', 'trim|required|min_length[2]|max_length[40]|callback_valida_nome_categoria');

    			if($this->form_validation->run()) {

    			

    				// echo '<pre>';
    				// print_r($this->input->post());
    				// exit();

    				$data = elements(
    					array(
    						'categoria_pai_nome',
    						'categoria_pai_ativa',

    					),$this->input->post()
    					//Definido meta link

    				);

    				$data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

    					$data = html_escape($data);

    					$this->core_model->insert('categorias_pai', $data);
    					redirect('restrita/master','refresh');
    				
    			} else {

    				//Erro de validação 


	     $data = array(

				'titulo' => 'Cadastrando novas categoria master',
				

			);
     
     		  //echo '<pre>';
			 // print_r($data['categoria_pai']);
			// exit();

			$this->load->view('restrita/layout/header',$data);
			$this->load->view('restrita/master/core');
			$this->load->view('restrita/layout/footer');
    				
    			}




    	}else{

if (!$categoria_pai = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))) {

    			$this->session->set_flashdata('erro', 'Esssa categoria master não existe!');
    			redirect('restrita/master','refresh');
    			
    		}else{
    				//Editando.... 

    			$this->form_validation->set_rules('categoria_pai_nome', 'Nome da categoria', 'trim|required|min_length[2]|max_length[40]');


                   // echo '<pre>';
                   //  print_r($this->input->post());
                   //  exit();




    			if($this->form_validation->run()) {

                  
    				if ($this->input->post('categoria_pai_ativa') == 0) {
    					
    					//Definir proibição desativação depois quando tabela categoria filha for criada se ela fou ligada a filha jamais deve ser desativa 
    					//fazer depois //

    					if($this->core_model->get_by_id('categorias', array('categoria_pai_id' => $categoria_pai_id))){

    					$this->session->set_flashdata('erro','Existe uma categoria filha vinculada essa categoria pai não sendo possível desativar!');
						redirect('restrita/master');

						}

    				}

    			
    				$data = elements(
    					array(
    						'categoria_pai_nome',
                            'categoria_pai_ativa',

    					),$this->input->post()
    					//Definido meta link

    				);

    			$data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

    					$data = html_escape($data);

    		//$this->core_model->update('categorias_pai', $data, array('categoria_pai_id' => $categoria_pai_id));
            $this->core_model->update('categorias_pai', $data, array('categoria_pai_id' => $categoria_pai_id));
    		redirect('restrita/master','refresh');
    				
    			} else {

    				//Erro de validação 


	     $data = array(

				'titulo' => 'Editar categoria master',
				'categoria_pai' => $categoria_pai,// get all users

			);
     
     //          echo '<pre>';
				 // print_r($data['categoria_pai']);
			  // exit();

			$this->load->view('restrita/layout/header',$data);
			$this->load->view('restrita/master/core');
			$this->load->view('restrita/layout/footer');
    				
    			}

    		}


    	}

 }



	///Deletar o 
public function delete($categoria_pai_id = NULL){

	$categoria_pai_id = (int) $categoria_pai_id;

if(!$categoria_pai_id || !$this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))){
		$this->session->set_flashdata('erro','Categoria master não foi encontrado');
	redirect('restrita/master');
   }
	//Aqui não deixo ela apagar se ela  estiver ativa 
if($this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id, 'categoria_pai_ativa' => 1))){
		$this->session->set_flashdata('erro','Não e possivel excluir uma categoria master ativa');
	redirect('restrita/master');

    }
	$this->core_model->delete('categorias_pai', array('categoria_pai_id' => $categoria_pai_id));
	redirect('restrita/master');

   


}

  public function valida_nome_categoria($categoria_pai_nome){

         $categoria_pai_id = $this->input->post('categoria_pai_id');

         if (!$categoria_pai_id) {

         	//cadastrando..

  if($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome))) {
				
				$this->form_validation->set_message('valida_nome_categoria', 'Essa nome de categoria já existe cadastrando!');

         		return false;
         		
         	}else{

         		return true;
         	}


         	
         }else{


           //Editando ...


         	if ($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome, 'categoria_pai_id !=' => $categoria_pai_id))) {
				
				$this->form_validation->set_message('valida_nome_categoria', 'Esse nome de categoria já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}

         }


	}

		}
