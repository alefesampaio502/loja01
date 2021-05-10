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
                        <h4 class="mt-3 text-white"><i class="fa fa-rocket mr-2" aria-hidden="true"></i><?= $titulo;?></h4>
                      </div>
                      <?php echo form_open('restrita/sistema/correios'); ?>                      
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
          <div class="col-sm-2 mb-3 mt-2">
              <label>CEP de origem </label>
              <input type="text" name="config_cep_origem" class="form-control 

              form-control-user cep" value="<?php echo (isset($correio) ? $correio->config_cep_origem : set_value('config_cep_origem')); ?>">

              <?php echo form_error('config_cep_origem','<small class="form-text text-danger">','</small>');?>
          </div>
            <div class="col-sm-2 mb-3 mt-2">
              <label>Código do PAC </label>
              <input type="text" name="config_codigo_pac" class="form-control 

              form-control-user codigo_servico_correios " value="<?php echo (isset($correio) ? $correio->config_codigo_pac : set_value('config_codigo_pac')); ?>">

              <?php echo form_error('config_codigo_pac','<small class="form-text text-danger">','</small>');?>
          </div>
            <div class="col-sm-2 mb-3 mt-2">
              <label>Código do SEDEX </label>
              <input type="text" name="config_codigo_sedex" class="form-control 
              form-control-user codigo_servico_correios" value="<?php echo (isset($correio) ? $correio->config_codigo_sedex : set_value('config_codigo_sedex')); ?>">
              <?php echo form_error('config_codigo_sedex','<small class="form-text text-danger">','</small>');?>
          </div>
           <div class="col-sm-3 mb-3 mt-2">
              <label>Valor a ser somado ao frete </label>
              <input type="text" name="config_somar_frete" class="form-control 
              form-control-user money2" value="<?php echo (isset($correio) ? $correio->config_somar_frete : set_value('config_somar_frete')); ?>">
              <?php echo form_error('config_somar_frete','<small class="form-text text-danger">','</small>');?>
          </div>
            <div class="col-sm-3 mb-3 mt-2">
              <label>Valor declarado</label>
              <input type="text" name="config_valor_declarado" class="form-control 
              form-control-user money2" value="<?php echo (isset($correio) ? $correio->config_valor_declarado : set_value('config_valor_declarado')); ?>">
              <?php echo form_error('config_valor_declarado','<small class="form-text text-danger">','</small>');?>
          </div>
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

