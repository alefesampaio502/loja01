<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Core_model extends CI_Model
{

public function get_all($tabela = NULL, $condicoes = NUll){

	if ($tabela && $this->db->table_exists($tabela)) {

		if (is_array($condicoes)) {
			$this->db->where($condicoes);
		}
		return $this->db->get($tabela)->result();

	}else{

	return false;
 }

}

public function get_by_id($tabela = NULL, $condicoes = NUll){

if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes)) {

		

			$this->db->where($condicoes);
		    $this->db->limit(1);

		return $this->db->get($tabela)->row();

	}else{

	return false;
 }


}

   public function insert($tabela = NULL, $data = NUll, $get_last_id = NUll){


   	if ($tabela && $this->db->table_exists($tabela) && is_array($data)) {

   		
          $this->db->insert($tabela, $data);

            if ($get_last_id) {
          $this->session->set_userdata('last_id', $this->db->insert_id());
        }


   			if ($this->db->affected_rows() > 0) {

   				$this->session->set_flashdata('sucesso', 'Dados salvo com sucesso!');
   				
   			}else{

   				$this->session->set_flashdata('erro', 'Dados não foi salvo!');
   			}

      }else{

      		return false;

      }


   }

   public function update($tabela = NULL, $data = NUll, $condicoes = NUll){

   		if ($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)) {

         if ($this->db->update($tabela, $data, $condicoes)) {

         	$this->session->set_flashdata('sucesso', 'Dados salvo com sucesso!');
        	
         }else{

   		     $this->session->set_flashdata('erro', 'Dados não foi salvo!');
         }
   	 }else{
   	 		return false;

   	 }

   }


   public function delete($tabela = NULL, $condicoes = NUll){
   	if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes)){

   	if ($this->db->delete($tabela, $condicoes)) {

         	$this->session->set_flashdata('sucesso', 'Dados apagado  com sucesso!');
        	
         }else{

   		     $this->session->set_flashdata('erro', 'Dados não foi apagado!');
         }


    }else{
    		return false;

    }

   }

  public function generate_unique_code($tabela = NULL, $tipo_codigo = NULL, $tamanho_codigo, $campo_procura = NULL) {

        do {
            $codigo = random_string($tipo_codigo, $tamanho_codigo);
            $this->db->where($campo_procura, $codigo);
            $this->db->from($tabela);
        } while ($this->db->count_all_results() >= 1);

        return $codigo;
    }
}