
<?php $this->load->view('restrita/layout/navbar');?>
<?php $this->load->view('restrita/layout/sidebar');?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
             <?php if($message = $this->session->flashdata('sucesso')): ?>
                        <div class="alert alert-info alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                        </button>
                      <i class="fas fa-thumbs-up mr-2"></i><strong>Atenção:</strong> <?php echo $message;?>
                      </div>
                    </div>
                  <?php endif;?>
          </div>
        </section>

        <?php $this->load->view('restrita/layout/sidebar_setting');?>

       
      </div>

