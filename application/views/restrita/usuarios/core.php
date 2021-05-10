
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
                      <h4 class="text-white"><i class="fa fa-users mr-2" aria-hidden="true"></i><?= $titulo;?></h4>
                    </div>

                    <?php 
                    $atributos = array(
                        'name' => 'form_core',
                    );

                    if(isset($usuarios)){
                      $usuario_id = $usuarios->id;
                    }else{
                      $usuario_id  = '';

                    }
                    ?>
                    <?php echo form_open('restrita/usuarios/core/'.$usuario_id, $atributos, ); ?>
                    
                    <div class="card-body">
                      
                      <div class="form-row">
                       
                        <div class="form-group col-md-4">
                          <label>Nome</label>
                          <input type="text" name="first_name" class="form-control" value="<?php echo (isset($usuarios) ? $usuarios->first_name : set_value('first_name'));?>">
                          <?php echo form_error('first_name','<div class="text-danger">','</div>');?>
                        </div>
                         <div class="form-group col-md-4">
                          <label>Sobrenome</label>
                          <input type="text" name="last_name" class="form-control" value="<?php echo (isset($usuarios) ? $usuarios->last_name: set_value('last_name'));?>">
                          <?php echo form_error('last_name','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-4">
                          <label>E-mail</label>
                          <input type="email" name="email" class="form-control" value="<?php echo (isset($usuarios) ? $usuarios->email: set_value('email'));?>">
                          <?php echo form_error('email','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Senha</label>
                          <input type="password" class="form-control" name="password" >
                          <?php echo form_error('password','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Confirma</label>
                          <input type="password" class="form-control" name="confirma" >
                          <?php echo form_error('confirma','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Usuário</label>
                          <input type="text" class="form-control" name="username" value="<?php echo (isset($usuarios) ? $usuarios->username: set_value('username'));?>" >
                          <?php echo form_error('username','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Perfil de acesso</label>
                          <select class="form-control" name="perfil">
                            <option selected>Selecione</option>

                            <?php foreach ($grupos as $grupo):?>

                              <?php if(isset($usuarios)):?>
                                <option value="<?php echo $grupo->id;?>"
                                <?php echo ($grupo->id == $perfil->id ?'selected' : '');?>> <?php echo $grupo->name;?></option>

                              <?php else:?>
                                <option value="<?php echo $grupo->id;?>"
                                > <?php echo $grupo->name;?></option>
                                
                              <?php endif;?>
                           
                            <?php endforeach;?>
                              
                            
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Ativo</label>
                          <select class="form-control" name="active">

                            <?php if(isset($usuarios)):?>
                            
                            <option value="1"<?php echo($usuarios->active == 1 ? 'selected' : 'selecione') ?> >Sim</option>
                            <option value="0"<?php echo($usuarios->active == 0 ? 'selected' : '') ?> >Não </option>

                            <?php else: ?>

                            <option value="1">Sim</option>
                            <option value="0">Não </option>

                          <?php endif;?>

                          </select>
                        </div>  

                        <?php if(isset($usuarios)):?>
                          <input type="hidden" name="usuario_id" value="<?php echo $usuarios->id;?>">  
                        <?php endif;?> 

                    </div>
                    <div class="card-footer">
                      <div class=" mb-5" style="float:right;">
                      <button class="btn btn-primary mr-2 ">Salvar</button>
                      <a class="btn btn-dark float-left mr-2" href="<?php echo base_url('restrita/usuarios');?>">Voltar</a>

                    </div>
                    </div>
                    <?php echo form_close(); ?>

                  </div>
                  </div>
             </div>
  </section>
          <?php $this->load->view('restrita/layout/sidebar_setting');?>      
  </div>

