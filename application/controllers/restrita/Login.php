<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
                // sessão de login
        }

	public function index()
	{
		$data = array(

			'titulo' => 'Login do site',


			//'usuarios' =>  $this->ion_auth->users()->result(), // get all users

		);


		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/login/index');
		$this->load->view('restrita/layout/footer');

	}

	public function auth(){

		  $identity = $this->input->post('email');
          $password = $this->input->post('password');
          $remember = ($this->input->post('remember' ? TRUE : FALSE)); // fix uma checagem de setado 
   //  ;

          if ($this->ion_auth->login($identity, $password, $remember)) {

          	$this->session->set_flashdata('sucesso', 'Seja muito bem vindos');
          	redirect('restrita','refresh');
             }else{
          		$this->session->set_flashdata('erro', 'Acesso não autorizado');
          	redirect('restrita/login','refresh');

          }

	}

	public function logout(){

		$this->ion_auth->logout();
		redirect('restrita/login','refresh');


	}

}