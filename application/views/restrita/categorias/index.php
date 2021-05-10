
    <?php $this->load->view('restrita/layout/navbar');?>
    <?php $this->load->view('restrita/layout/sidebar');?>

          <!-- Main Content -->
          <div class="main-content">
            <section class="section">
              <div class="section-body">
                <!-- add content here -->
     <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header d-block">
                        <h4 class="mt-3 mb-3"><?= $titulo;?>
                        <a href="<?php echo base_url('restrita/categorias/core');?>" class="btn btn-primary float-right">Cadastrar</a>
                        </h4>
                      </div>
                      <div class="card-body">
                         <?php if($message = $this->session->flashdata('sucesso')): ?>
                            <div class="alert alert-success alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                            </button>
                          <i class="fas fa-thumbs-up mr-2"></i><strong>Atenção:</strong> <?php echo $message;?>
                          </div>
                        </div>
                      <?php endif;?>

                        <?php if($message = $this->session->flashdata('erro')): ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                            </button>
                          <i class="fas fa-exclamation-triangle mr-2"></i><strong>Atenção:</strong> <?php echo $message;?>
                          </div>
                        </div>
                      <?php endif;?>
                        <div class="table-responsive">
                          <table class="table table-striped data-table" >
                            <thead>
                              <tr>
                                <th class="text-center">
                                  #
                                </th>
                                <th class="nosort">Categoria</th>
                                
                                <th class="nosort">Meta link da categoria</th>
                                <th class="nosort">Data de cadastro</th>
                                
                                <th class="nosort">Status</th>
                                <th class="nosort text-center">Ação</th>
                              </tr>
                            </thead>
                            <tbody>

          <?php foreach($categorias as $categoria):?>
          <tr>
          
            <td>
              <?php echo $categoria->categoria_id;?>
            </td>
           <td><?php echo $categoria->categoria_nome;?></td>
        <td><i data-feather="link-2" class="text-success mr-2"></i><?php echo $categoria->categoria_meta_link;?></td>
       <td><?php echo (formata_data_banco_com_hora($categoria->categoria_data_criacao));?></td>
                                
                                <td>
                                  <?php if($categoria->categoria_ativa == 1) :?>
                                            <div class="badge badge-info badge-shadow">Ativo</div>
                                   <?php else: ?>
                                          	<div class="badge badge-danger badge-shadow">Inativo</div>
                                  <?php endif;?>
                             
                                </td>
                                <td class="text-center"><a href="<?= base_url('restrita/categorias/core/'.$categoria->categoria_id)?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                	<a href="<?php echo base_url('restrita/categorias/delete/'.$categoria->categoria_id);?>" class="btn btn-icon btn-danger delete" data-confirm="Tem certeza da exclusão?"><i class="fas fa-user-times"></i></a></td>                       
                                  </tr>

                           <?php endforeach ;?>
                            </tbody>
                          </table>
                        </div>
                      </div>
              </div>
          </div>

              </div>
            </section>

            <?php $this->load->view('restrita/layout/sidebar_setting');?>

           
          </div>

