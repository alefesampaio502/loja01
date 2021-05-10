
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
                    <a href="<?php echo base_url('restrita/usuarios/core');?>" class="btn btn-success float-right">Cadastrar</a>
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
                            <th class="nosort">Nome Completo</th>
                            <th class="nosort">E-mail</th>
                            
                            <th class="nosort">Perfil</th>
                            <th class="nosort">status</th>
                            <th class="nosort">Ação</th>
                          </tr>
                        </thead>
                        <tbody>

                        	<?php foreach ($usuarios as $usuario):?>
                          <tr>
                          	
                            <td>
                              <?= $usuario->id;?>
                            </td>
                            <td><?= $usuario->first_name;?></td>
                            <td><?= $usuario->email;?></td>
                            
                            <td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Administrador' : 'Clientes');?> </td>
                            <td>
                              <?php if($usuario->active == 1) :?>
                                        <div class="badge badge-success badge-shadow">Ativo</div>
                               <?php else: ?>
                                      	<div class="badge badge-danger badge-shadow">Inativo</div>
                              <?php endif;?>
                         
                            </td>
                            <td><a href="<?= base_url('restrita/usuarios/core/'.$usuario->id)?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                            	<a href="<?php echo base_url('restrita/usuarios/delete/'.$usuario->id);?>" class="btn btn-icon btn-danger delete" data-confirm="Tem certeza da exlusão?"><i class="fas fa-user-times"></i></a></td>                       
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

