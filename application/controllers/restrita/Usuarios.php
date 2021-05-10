<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
                // sessão de login
        }

	public function index()
	{
		$data = array(

			'titulo' => 'Listagem de Usuários',

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
           



			'usuarios' =>  $this->ion_auth->users()->result(), // get all users

		);

		// echo '<pre>';
		// 	 print_r($data['usuarios']);
		//   exit();

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/usuarios/index');
		$this->load->view('restrita/layout/footer');
	}


		//começa cadastro e edições
	public function core($usuarios_id = NULL){

		$usuarios_id = (int) $usuarios_id;

		if(!$usuarios_id){

			//cadastrar
			//exit('cadastrar usuarios');
			$this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('last_name', 'sobrenome', 'trim|required|min_length[2]|max_length[45]');

            $this->form_validation->set_rules('email', 'Nome', 'trim|required|min_length[2]|max_length[100]|valid_email|callback_valida_email');
            $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[2]|max_length[50]|callback_valida_usuario');

            $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('confirma', 'Confirmar senha', 'trim|required|matches[password]');

			    if($this->form_validation->run()) {
                $username = $this->input->post('username');
			    $password = $this->input->post('password');
			    $email = $this->input->post('email');
			    $additional_data = array(
	                'first_name' => $this->input->post('first_name'),
	                'last_name' => $this->input->post('last_name'),
	                'active' => $this->input->post('active'),
	                );
                $group = array($this->input->post('perfil')); // Sets user to admin adiçõe ao grupo.

		if($this->ion_auth->register($username, $password, $email, $additional_data, $group)){
                	
			$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!');

                }else{
                	$this->session->set_flashdata('erro', $this->ion_auth->errors());
                    }
                    redirect('restrita/usuarios','refresh');		    	
			    }else{



			    	//Erro de validaçãoes de  cadastro core
			    	// erro de validaçãoe 
              		$data = array(

					'titulo' => 'Cadastrar usuários',					
					'grupos' => $this->ion_auth->groups()->result(),
				);

					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/usuarios/core');
					$this->load->view('restrita/layout/footer'); 


			    }
              


		}else{

			if(!$usuarios = $this->ion_auth->user($usuarios_id)->row()){

              
           $this->session->set_flashdata('erro', 'Usuário não foi encontrado.');
           redirect('restrita/usuarios','refresh');



				//exit('Não existe');



		}else{
     

              $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[3]|max_length[45]');
              $this->form_validation->set_rules('last_name', 'sobrenome', 'trim|required|min_length[2]|max_length[45]');

              $this->form_validation->set_rules('email', 'Nome', 'trim|required|min_length[2]|max_length[100]|valid_email|callback_valida_email');
              $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[2]|max_length[50]|callback_valida_usuario');

              $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('confirma', 'Confirmar senha', 'matches[password]');
              

              	if($this->form_validation->run()) {

              		// // echo '<pre>';
              		// // print_r($this->input->post());
              		// exit();

              		$data = elements(

              			 array(

              			 	'first_name',
              			 	'last_name',
              			 	'email',
              			 	'username',
              			 	'password',
              			 	'active',
              			 	

              			 ), $this->input->post()


              		);

					$password = $this->input->post('password');


					//Não atualizar a senha se a mesma não foi passada//
					if (!$password) {
						
						unset($data['password']);

					}

					//sanetizando o data //
                   $data = html_escape($data);

				/*echo '<pre>';
				 print_r($data);
				 exit();
				*/
                   
    			 //se passou pela validações atualiza tudo ///

    			 if ($this->ion_auth->update($usuarios_id, $data)) {

    			 	$perfil = (int) $this->input->post('perfil');


    			 	if ($perfil) {
    			 		  // removo usuários dos grupos //
        					$this->ion_auth->remove_from_group(NULL, $usuarios_id);
        					
        					$this->ion_auth->add_to_group($perfil, $usuarios_id);
  
    			 		
    			 	}


    			 	 $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!');
    			      }else{
    			      	$this->session->set_flashdata('erro', $this->ion_auth->errors());

    			      }
    			
    			redirect('restrita/Usuarios','refresh');
  

              		
              	}else{

              		// erro de validaçãoe 
              		$data = array(

					'titulo' => 'Editar usuários',
					'usuarios' => $usuarios,	
					'perfil' => $this->ion_auth->get_users_groups($usuarios_id)->row(),
					'grupos' => $this->ion_auth->groups()->result(),

						);
					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/usuarios/core');
					$this->load->view('restrita/layout/footer'); 

              	}

				
			}

		}

	}

	public function valida_email($email){


         $usuario_id = $this->input->post('usuario_id');

         if (!$usuario_id) {

         	//cadastrando..

         	if ($this->core_model->get_by_id('users', array('email' => $email))) {
				
				$this->form_validation->set_message('valida_email', 'Esse email já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}


         	
         }else{


           //Editando ...


         	if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {
				
				$this->form_validation->set_message('valida_email', 'Esse email já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}

         }


	}


public function valida_usuario($username){


         $usuario_id = $this->input->post('usuario_id');

         if (!$usuario_id) {

         	//cadastrando..

         	if ($this->core_model->get_by_id('users', array('username' => $username))) {
				
				$this->form_validation->set_message('valida_usuario', 'Esse Usuário já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}


         	
         }else{


           //Editando ...


         	if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))) {
				
				$this->form_validation->set_message('valida_usuario', 'Esse Usuário já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}

         }


	}


public function delete($usuarios_id = NULL){

	     $usuarios_id = (int) $usuarios_id;

    	if (!$usuarios_id || !$this->ion_auth->user($usuarios_id)->row()) {

    			$this->session->set_flashdata('erro','Usuário não encontrado');
						redirect('restrita/usuarios');

    	}

    	//Cancelando a exlusão do Administrador//
    	if($this->ion_auth->is_admin($usuarios_id)) {

    			$this->session->set_flashdata('erro','Perfil de administrador não poder ser excluido');
						redirect('restrita/usuarios');

    }
     // depois de verificada a perfill no if acima e ele e cliente agora essa podemos proseguir com exclusão //
    if($this->ion_auth->delete_user($usuarios_id)){
    	$this->session->set_flashdata('sucesso','Usuário foi excluido com sucesso');
    	redirect('restrita/usuarios');
    }else{

    	$this->session->set_flashdata('erro','Usuário não foi excluido');
						redirect('restrita/usuarios');


    }
}

}