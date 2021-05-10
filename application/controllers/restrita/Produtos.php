<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Produtos extends CI_Controller {

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

				'titulo' => 'Listagem de produtos',

				
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
				'produtos' =>  $this->produtos_model->get_all(),// get all users

			);

	    // 		 echo '<pre>';
			  //  print_r($data['produtos']);
			  // exit();

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/produtos/index');
			$this->load->view('restrita/layout/footer');


		}


public function core($produto_id = NULL){

	   $produto_id = (int) $produto_id;

       if (!$produto_id) {
       	//cadastrando um produto.....


       			//Editando....
       			$this->form_validation->set_rules('produto_nome', 'Nome do produto', 'trim|required|min_length[5]|max_length[250]|callback_nome_produto');

       		$this->form_validation->set_rules('produto_categoria_id', 'categoria do produto', 'trim|required');

				$this->form_validation->set_rules('produto_marca_id', 'marca do produto', 'trim|required');
       			
       			$this->form_validation->set_rules('produto_valor', 'Valor de venda do produto', 'trim|required');
       			
       			$this->form_validation->set_rules('produto_peso', 'Peso do produto', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_altura', 'Altura do produto', 'trim|required|integer');
       			$this->form_validation->set_rules('produto_largura', 'Largura do produto', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_comprimento', 'Comprimento do produto', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade  em estoque', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade  em estoque', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_descricao', 'Descição  do produto', 'trim|max_length[5000]');

       			//Obrigar cadastro tem fotos //
       			$fotos_produtos = $this->input->post('fotos_produtos');

       			if(! $fotos_produtos){

       		$this->form_validation->set_rules('fotos_produtos', 'Imagem do produto', 'required');

       			}

       			if ($this->form_validation->run()) {

       				// echo '<pre>';
       				// print_r($this->input->post());
       				// exit();

       				$data = elements(

       					array(

       						'produto_nome',
       						'produto_categoria_id',
       						'produto_marca_id',
       						'produto_valor',
       						'produto_peso',
       						'produto_peso',
       						'produto_altura',
       						'produto_largura',
       						'produto_comprimento',
       						'produto_ativo',
       						'produto_quantidade_estoque',
       						'produto_destaque',
       						'produto_controlar_estoque',
       						'produto_descricao',

       					), $this->input->post()


       				);

       				/* Remove virgula do valor */

       				$data['produto_valor'] = str_replace(',', '', $data['produto_valor']);

       				//criando metalink do produto //
       				$data['produto_meta_link '] = url_amigavel($data['produto_nome']);

       				//Código gerado no cadastro de produtos//

       				$data['produto_codigo'] = $this->input->post('produto_codigo');

       				$data = html_escape($data);


       				$this->core_model->insert('produtos', $data, TRUE);


       				//Recupera últimos id inserido //
       				$produto_id = $this->session->userdata('last_id');


       				
       				//Recuperar do post se veio fotos
       				$fotos_produtos = $this->input->post('fotos_produtos');

       				 if($fotos_produtos){

       				 	$tota_fotos = count($fotos_produtos);

       				for($i = 0; $i < $tota_fotos; $i++){

       					$data = array(

       						'foto_produto_id' => $produto_id,
       						'foto_caminho' => $fotos_produtos[$i],

       					);

       					//insere a foto do produtos na tabela produtos_fotos
       					$this->core_model->insert('produtos_fotos', $data);
       				}
       		 }

      redirect('restrita/produtos','refresh');

       			}else{
       				
       				//Erro de validação /// 

	     $data = array(

				'titulo' => 'Cadastrar produto',

				
			'styles' =>array(
					'jquery-upload-file/css/uploadfile.css',					
				),

			'scripts' =>array(
				'jquery-upload-file/js/jquery.uploadfile.min.js',
				'js/page/sweetalert2.all.min.js',
				'jquery-upload-file/js/produtos.js',
				'js/page/jquery.mask.min.js',
				'js/page/custom.js'
			),
				//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
		
		'codigo_gerado' => $this->core_model->generate_unique_code('produtos', 'numeric', 8, 'produto_codigo'),
		'categorias' =>  $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),// get a
		'marcas' =>  $this->core_model->get_all('marcas', array('marca_ativa' => 1)),// get a

			);

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/produtos/core');
			$this->load->view('restrita/layout/footer');


       			}



       }else{

     	  	if(!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {

     	  		$this->session->set_flashdata('erro', 'Esse produto não foi encontrado!');
     	  		redirect('restrita/produtos','refresh');

       		}else{


       			//Editando....
       			$this->form_validation->set_rules('produto_nome', 'Nome do produto', 'trim|required|min_length[5]|max_length[250]|callback_nome_produto');

       		$this->form_validation->set_rules('produto_categoria_id', 'categoria do produto', 'trim|required');

				$this->form_validation->set_rules('produto_marca_id', 'marca do produto', 'trim|required');
       			
       			$this->form_validation->set_rules('produto_valor', 'Valor de venda do produto', 'trim|required');
       			
       			$this->form_validation->set_rules('produto_peso', 'Peso do produto', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_altura', 'Altura do produto', 'trim|required|integer');
       			$this->form_validation->set_rules('produto_largura', 'Largura do produto', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_comprimento', 'Comprimento do produto', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade  em estoque', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade  em estoque', 'trim|required|integer');
       			
       			$this->form_validation->set_rules('produto_descricao', 'Descição  do produto', 'trim|max_length[5000]');



       			if ($this->form_validation->run()) {

       				$data = elements(

       					array(

       						'produto_nome',
       						'produto_categoria_id',
       						'produto_marca_id',
       						'produto_valor',
       						'produto_peso',
       						'produto_peso',
       						'produto_altura',
       						'produto_largura',
       						'produto_comprimento',
       						'produto_ativo',
       						'produto_quantidade_estoque',
       						'produto_destaque',
       						'produto_controlar_estoque',
       						'produto_descricao',

       					), $this->input->post()


       				);

       				/* Remove virgula do valor */

       				$data['produto_valor'] = str_replace(',', '', $data['produto_valor']);

       				//criando metalink do produto //
       				$data['produto_meta_link '] = url_amigavel($data['produto_nome']);

       				$data = html_escape($data);
       				$this->core_model->update('produtos', $data, array('produto_id' => $produto_id));

       				//Excluir as imagens antigas do produtos//
       				$this->core_model->delete('produtos_fotos', array('foto_produto_id' => $produto_id));
       				//Recuperar do post se veio fotos
       				$fotos_produtos = $this->input->post('fotos_produtos');

       				 if($fotos_produtos){

       				 	$tota_fotos = count($fotos_produtos);

       				for($i = 0; $i < $tota_fotos; $i++){

       					$data = array(

       						'foto_produto_id' => $produto_id,
       						'foto_caminho' => $fotos_produtos[$i],

       					);

       					//insere a foto do produtos na tabela produtos_fotos
       					$this->core_model->insert('produtos_fotos', $data);
       				}
       		 }

      redirect('restrita/produtos','refresh');

       			}else{
       				
       				//Erro de validação /// 

	     $data = array(

				'titulo' => 'Editando  produto',

				
			'styles' =>array(
					'jquery-upload-file/css/uploadfile.css',					
				),

			'scripts' =>array(
				'jquery-upload-file/js/jquery.uploadfile.min.js',
				'js/page/sweetalert2.all.min.js',
				'jquery-upload-file/js/produtos.js',
				'js/page/jquery.mask.min.js',
				'js/page/custom.js'
			),
				//'sistemas' =>  $this->core_model->get_by_id('sistema', array('sistema_id' => 1)); // get all users
		'produto' =>  $produto,// get all users
		'fotos_produto' =>  $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id)),// get all users
		'categorias' =>  $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),// get a
		'marcas' =>  $this->core_model->get_all('marcas', array('marca_ativa' => 1)),// get a

			);

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/produtos/core');
			$this->load->view('restrita/layout/footer');


       			}

       		}

       }


}


///Exclusão do arquivos 



	public function nome_produto($produto_nome){


         $produto_id = $this->input->post('produto_id');

         if (!$produto_id) {

         	//cadastrando..

         	if ($this->core_model->get_by_id('produtos', array('produto_nome' => $produto_nome))) {
				
				$this->form_validation->set_message('nome_produto', 'Esse nome de produtos já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}


         	
         }else{


           //Editando ...


         	if ($this->core_model->get_by_id('produtos', array('produto_nome' => $produto_nome, 'produto_id !=' => $produto_id))) {
				
				$this->form_validation->set_message('nome_produto', 'Esse nome de produtos já existe!');

         		return false;
         		
         	}else{

         		return true;
         	}

         }


	}


 public function upload(){
  $config['upload_path'] = './uploads/produtos/';
  $config['allowed_types'] = 'jpg|png|jpeg';
  $config['max_size']  = '2048'; // max 2mb
  $config['max_width']  = '3000';
  $config['max_height']  = '1000';
  
  $config['encrypt_name']  = TRUE;
  $config['max_filename']  = '2000';
  $config['file_ext_tolower']  = TRUE;
  
  $this->load->library('upload', $config);


  
  if ($this->upload->do_upload('foto_produto')){
  	//$error = array('error' => $this->upload->display_errors());

  	$data = array(

  		'uploaded_data' =>  $this->upload->data(),
  		'mensagem' => 'Imagem enviada com sucesso',
	  	'foto_caminho' => $this->upload->data('file_name'),

	  	'erro' => 0

  	);

    //Resize imagem  configurantion 

    $config['image_library']  = 'gd2';
	$config['source_image']   = './uploads/produtos/' .$this->upload->data('file_name');
	$config['new_image']      = './uploads/produtos/small/' .$this->upload->data('file_name'); 
	$config['width']          = 300;
	$config['height']         = 300;

//chama a biblioteca 
$this->load->library('image_lib', $config);


// Faz o risizer 
//$this->load->library('image_lib', $config);


if (!$this->image_lib->resize()) {

	$data['erro'] = $this->image_lib->display_errors();
	# code...
}



  }else{
  	$data = array(

  		'mensagem' => $this->upload->display_errors(),

  		'erro' => 5,

  	);
  	
  }

  echo json_encode($data);

}



public function delete($produto_id = NULL){

	$produto_id = (int) $produto_id;

  if(!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))){
   	$this->session->set_flashdata('erro', 'Produto não encontrado!');
   	redirect('restrita/produtos','refresh');
   }

   	if($this->core_model->get_by_id('produtos', array('produto_id' => $produto_id, 'produto_ativo' => 1))){
   	$this->session->set_flashdata('erro', 'Não e permitido excluir um produto ativo!');
   	redirect('restrita/produtos','refresh');

   }
   
   //recuperação de fotos produto antes da exclusão do banco de dados //
   $fotos_produto = $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id));

   //Excluir produtos//
   $this->core_model->delete('produtos', array('produto_id' => $produto_id));

   //Elimina a fotos do produtos 
   if($fotos_produto){

   		foreach ($fotos_produto as $foto) {

   			unlink(FCPATH."uploads/produtos/".$foto->foto_caminho);
   			unlink(FCPATH."uploads/produtos/small/".$foto->foto_caminho);

   			//$foto_grande = FCPATH .'uploads/produtos/'. $foto->foto_caminho;
   			//$foto_pequena = FCPATH .'uploads/produtos/small'. $foto->foto_caminho;

   			//Excluir as imagens

   			//if(file_exists($foto_grande) && file_exists($foto_pequena)) {

   				//unlink função nativa do php para exlusão//
   				//unlink($foto_grande);
   				//unlink($foto_pequena);
   			//}
   	
      }

   }

   	redirect('restrita/produtos','refresh');

}


}