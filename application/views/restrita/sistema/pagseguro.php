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
                      <div class="card-header bg-primary">
                        <h4 class="mt-3 text-white"><i class="fas fa-money-check-alt mr-2"></i><?= $titulo;?></h4>
                      </div>
                      <?php echo form_open('restrita/sistema/pagseguro'); ?>                      
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
      <div class="form-group row">        
          <div class="col-sm-4 mb-3 mt-2">
              <label>Email de acesso </label>
              <input type="text" name="config_email" class="form-control 

              form-control-user " value="<?php echo (isset($pagseguro) ? $pagseguro->config_email : set_value('config_email')); ?>">

              <?php echo form_error('config_email','<small class="form-text text-danger">','</small>');?>
          </div>
            <div class="col-sm-6 mb-3 mt-2">
              <label>Token de acesso </label>
              <input type="text" name="config_token" class="form-control 

              form-control-user" value="<?php echo (isset($pagseguro) ? $pagseguro->config_token : set_value('config_token')); ?>">

              <?php echo form_error('config_token','<small class="form-text text-danger">','</small>');?>
          </div>

          <div class="col-sm-6 mb-3 mt-2">
              <label>Ambiente Ativo </label>
              <select class="form-control" name="config_ambiente">

                      <?php if(isset($pagseguro)):?>

                        <option value="1"<?php echo($pagseguro->config_ambiente == 1 ? 'selected' : 'selecione') ?> >Sandbox Ambinte de teste</option>
                        <option value="0"<?php echo($pagseguro->config_ambiente == 0 ? 'selected' : '') ?> >Ambinte de Real</option>
                        <?php endif;?>
                      </select>
              <?php echo form_error('config_ambiente','<small class="form-text text-danger">','</small>');?>
          </div>
          <?php if(isset($pagseguro)):?>
                          <input type="hidden" name="config_id" value="<?php echo $pagseguro->config_id;?>">  
                        <?php endif;?> 
         </div>                      
            <div class="card-footer">
              <div class=" mb-5" style="float:right;">
              <button class="btn btn-primary mr-2 ">Salvar</button>
              <a class="btn btn-dark float-left mr-2" href="<?php echo base_url('restrita');?>">Voltar</a>
              </div>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
     </div>
  </section>
            <?php $this->load->view('restrita/layout/sidebar_setting');?>      
    </div>

