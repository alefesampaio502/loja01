<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Loja_model extends CI_Model{

public function get_grandes_marcas(){


  $this->db->select([

  	'marcas.*',
  	'marcas.marca_nome',


  ]);

   //Bucar somente marcas ativas
  $this->db->where('marca_ativa', 1);

  $this->db->join('produtos', 'produtos.produto_marca_id = marcas.marca_id');

 // $this->db->group_by('marca_nome');

$this->db->DISTINCT('marca_nome');
  return $this->db->get('marcas')->result(); 


}

//categoria pai nav bar
public function get_categorias_pai(){

	$this->db->select([
		'categorias_pai.*',
		'produtos.produto_nome',

	]);

	$this->db->where('categoria_pai_ativa', 1);

	$this->db->join('categorias', 'categorias.categoria_pai_id = categorias_pai.categoria_pai_id','left');

	//Retoorna  produtos com categoria ativa//,
	$this->db->join('produtos', 'produtos.produto_categoria_id = categorias.categoria_id');
	//$this->db->group_by('categorias_pai.categoria_pai_nome');
	$this->db->DISTINCT('categorias_pai.categoria_pai_nome');

	return $this->db->get('categorias_pai')->result();

}

//Categorias filhas 
public function get_categorias_filhas($categorias_pai_id = NULL){

	$this->db->select([
		'categorias.*',
		'produtos.produto_nome',

	]);

	$this->db->where('categorias.categoria_pai_id', $categorias_pai_id);
	$this->db->where('categorias.categoria_ativa', 1);

	//Retoorna  produtos com categoria ativa//,
	$this->db->join('produtos', 'produtos.produto_categoria_id = categorias.categoria_id');

	//$this->db->group_by('categorias.categoria_nome');
	//$this->db->DISTINCT('categorias.categoria_nome');

	return $this->db->get('categorias')->result();

  }


   //Produtos em destaque 
  function get_produtos_destaques($num_produtos_destaques = NULL){

  		$this->db->select([
		'produtos.*',
		'produtos.produto_id',
		'produtos.produto_nome',
		'produtos.produto_valor',
		'produtos.produto_meta_link',
		'produtos_fotos.foto_caminho',

	]);

	//Destaque de produtos em //
  	   $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = produtos.produto_id');

  	    $this->db->where('produtos.produto_destaque', 1);
  	    $this->db->where('produtos.produto_ativo', 1);

  	    $this->db->limit($num_produtos_destaques);

  	    //$this->db->group_by('produtos.produto_id');

  	    $this->db->DISTINCT('produtos.produto_id');

  	    return $this->db->get('produtos')->result();





  }

}
