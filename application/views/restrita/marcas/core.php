
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
                    <div class="card-header">
                      <h4><?= $titulo;?></h4>
                    </div>

                    <?php 
                    $atributos = array(
                        'name' => 'form_core',
                    );

                    if(isset($marcas)){

                      $marca_id = $marcas->marca_id;
                    }else{
                      $marca_id  = '';

                    }
                    ?>
                    <?php echo form_open('restrita/marcas/core/'.$marca_id, $atributos, ); ?>
                    
                    <div class="card-body">
                      
                      <div class="form-row">
                       
                       
                         <div class="form-group col-md-4">
                          <label>Nome da marca</label>
                          <input type="text" name="marca_nome" class="form-control" value="<?php echo (isset($marcas) ? $marcas->marca_nome: set_value('marca_nome'));?>">
                          <?php echo form_error('marca_nome','<div class="text-danger">','</div>');?>
                        </div>
                         <?php if (isset($marcas)):?>
                         <div class="form-group col-md-4">
                          <label>Meta link da marca</label>
                          <input type="text" name="marca_meta_link" class="form-control" value="<?php echo (isset($marcas) ? $marcas->marca_meta_link : set_value('marca_meta_link'));?>" readonly="">
                          <?php echo form_error('marca_meta_link','<div class="text-danger">','</div>');?>
                        </div>
                      <?php endif;?>

                           <div class="form-group col-md-4">
                          <label>Ativo</label>
                          <select class="form-control" name="marca_ativa">

                            <?php if(isset($marcas)):?>
                            
                            <option value="1"<?php echo($marcas->marca_ativa == 1 ? 'selected' : 'selecione') ?> >Sim</option>
                            <option value="0"<?php echo($marcas->marca_ativa == 0 ? 'selected' : '') ?> >Não </option>

                            <?php else: ?>

                            <option value="1">Sim</option>
                            <option value="0">Não </option>

                          <?php endif;?>

                          </select>
                        </div>  

                        <?php if(isset($marcas)):?>
                          <input type="hidden" name="marca_id" value="<?php echo $marcas->marca_id;?>">  
                        <?php endif;?> 

                    </div>
                    <div class="card-footer">
                      <div class=" mb-5" style="float:right;">
                      <button class="btn btn-primary mr-2 ">Salvar</button>
                      <a class="btn btn-dark float-left mr-2" href="<?php echo base_url('restrita/marcas/');?>">Voltar</a>

                    </div>
                    </div>
                    <?php echo form_close(); ?>

                  </div>
                  </div>
             </div>
  </section>
          <?php $this->load->view('restrita/layout/sidebar_setting');?>      
  </div>

