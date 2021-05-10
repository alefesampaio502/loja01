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
                  <div class="card-header d-block ">
                    <h4 class="mt-3 mb-3 text-info"><i class="fas fa-align-justify mr-2"></i><?= $titulo;?>
                    <a href="<?php echo base_url('restrita/produtos/core');?>" class="btn btn-primary float-right">Cadastrar</a>
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
                              Código
                            </th>
                            <th class="nosort">Nome do produto</th>
                            <th class="nosort">Marca</th>
                            <th class="nosort">Categoria</th>
                            <th class="nosort">Valor</th>                           
                            <th class="nosort">Status</th>
                            <th class="nosort text-center">Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($produtos as $produto):?>
                          <tr>                         	
                            <td>
                              <?php echo $produto->produto_codigo;?>
                            </td>
                            <td><?php echo $produto->produto_nome;?></td>
                            <td><?php echo $produto->marca_nome;?></td>
                            <td><?php echo $produto->categoria_nome;?></td>
                            <td><?php echo 'R$ &nbsp'.number_format($produto->produto_valor, 2);?></td> 
                             <td>                    
                              <?php if($produto->produto_ativo == 1) :?>
                                        <div class="badge badge-success badge-shadow">Ativo</div>
                               <?php else: ?>
                                      	<div class="badge badge-danger badge-shadow">Inativo</div>
                              <?php endif;?>                        
                            </td>
                            <td class="text-center"><a href="<?= base_url('restrita/produtos/core/'.$produto->produto_id)?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                            	<a href="<?php echo base_url('restrita/produtos/delete/'.$produto->produto_id);?>" class="btn btn-icon btn-danger delete" data-confirm="Tem certeza da exclusão do produto?"><i class="fas fa-user-times"></i></a></td>                       
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

