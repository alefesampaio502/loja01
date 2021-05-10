<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->view('restrita/layout/header');
		$this->load->view('restrita/home/index');
		$this->load->view('restrita/layout/footer');
	}
}
