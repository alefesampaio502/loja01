
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
                        <h4 class="mt-3 text-white"><?= $titulo;?></h4>
                      </div>
                      <?php echo form_open('restrita/sistema'); ?>                      
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
        <div class="form-row">
         
          <div class="col-sm-3 mb-3 mt-2">
              <label>Razão social</label>
              <input type="text" name="sistema_razao_social" class="form-control form-control-user" value="<?php echo $sistema->sistema_razao_social ?>">
              <?php echo form_error('sistema_razao_social','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-3 mt-2">
              <label>Nome fantasia </label>
              <input type="text" name="sistema_nome_fantasia" class="form-control form-control-user" value="<?php echo $sistema->sistema_nome_fantasia ?>">
              <?php echo form_error('sistema_nome_fantasia','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-3 mb-3 mt-2">
              <label>CNPJ</label>
              <input type="text" name="sistema_cnpj" class="form-control form-control-user cnpj" value="<?php echo $sistema->sistema_cnpj ?>">
              <?php echo form_error('sistema_cnpj','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-3 mt-2">
              <label>Inscrição Estadual</label>
              <input type="text" name="sistema_ie" class="form-control form-control-user" value="<?php echo $sistema->sistema_ie ?>">
              <?php echo form_error('sistema_ie','<small class="form-text text-danger">','</small>'); ?>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-3 mb-3 mt-2">
              <label>Telefone</label>
              <input type="text" name="sistema_telefone_fixo" class="form-control form-control-user phone_with_ddd" value="<?php echo $sistema->sistema_telefone_fixo ?>">
              <?php echo form_error('sistema_telefone_fixo','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-3 mt-2">
              <label>Celular</label>
              <input type="text" name="sistema_telefone_movel" class="form-control form-control-user phone_with_ddd" value="<?php echo $sistema->sistema_telefone_movel ?>">
              <?php echo form_error('sistema_telefone_movel','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-3 mb-3 mt-2">
              <label>Email</label>
              <input type="email" name="sistema_email" class="form-control form-control-user" value="<?php echo $sistema->sistema_email ?>">
              <?php echo form_error('sistema_email','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-3 mt-2">
              <label>Site</label>
              <input type="text" name="sistema_site_url" class="form-control form-control-user" value="<?php echo $sistema->sistema_site_url ?>">
              <?php echo form_error('sistema_site_url','<small class="form-text text-danger">','</small>'); ?>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-4 mt-2">
              <label>Endereço</label>
              <input type="text" name="sistema_endereco" class="form-control form-control-user" value="<?php echo $sistema->sistema_endereco ?>">
              <?php echo form_error('sistema_endereco','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-2 mb-3 mt-2">
              <label>CEP</label>
              <input type="text" name="sistema_cep" class="form-control form-control-user cep" value="<?php echo $sistema->sistema_cep ?>">
              <?php echo form_error('sistema_cep','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-2 mt-2">
              <label>Número</label>
              <input type="text" name="sistema_numero" class="form-control form-control-user" value="<?php echo $sistema->sistema_numero ?>" placeholder="Número">
              <?php echo form_error('sistema_numero','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-2 mb-3 mt-2 ">
              <label>Cidade</label>
              <input type="text" name="sistema_cidade" class="form-control form-control-user" value="<?php echo $sistema->sistema_cidade ?>">
              <?php echo form_error('sistema_cidade','<small class="form-text text-danger">','</small>'); ?>
          </div>
          <div class="col-sm-2 mt-2">
              <label>Estado</label>
              <input type="text" name="sistema_estado" class="form-control form-control-user uf" value="<?php echo $sistema->sistema_estado ?>">
              <?php echo form_error('sistema_estado','<small class="form-text text-danger">','</small>'); ?>
          </div>

           <div class="col-sm-3 mt-2">
              <label>Quantidade de produto em destaque</label>
              <input type="number" name="sistema_produtos_destaques" class="form-control form-control-user uf" value="<?php echo $sistema->sistema_produtos_destaques ?>">
              <?php echo form_error('sistema_produtos_destaques','<small class="form-text text-danger">','</small>'); ?>
              </div>
                  <div class="form-group col-md-9 mt-2">
                                    <label>Descrições da empresa</label>
                   <textarea name="sistema_texto" class="form-control form-control-user">
                    <?php echo $sistema->sistema_texto ;?></textarea>   
                    <?php echo form_error('sistema_texto','<small class="form-text text-danger">','</small>'); ?>             

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

