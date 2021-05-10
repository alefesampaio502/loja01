  <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php base_url('restrita');?>"> <img alt="image" src="<?= base_url('public/assets/img/logo.png')?>" class="header-logo" /> <span
                class="logo-name">Painel da loja</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            
            <li class="dropdown <?php echo $this->router->fetch_class() == 'home' && $this->router->fetch_method() == 'index' ? 'active': '';?>">
              <a href="<?php base_url('restrita');?>" class="nav-link"><i class="fa fa-home"></i><span>Home</span></a>
            </li>

  

             <li class="dropdown <?php echo $this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' ? 'active':'';?>">
       <a href="#" class="menu-toggle nav-link has-dropdown">
       <i class="fas fa-cubes"></i><span>Categoria</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo base_url('restrita/master');?>">Categoria pai</a></li>
                <li><a class="nav-link" href="<?php echo base_url('restrita/categorias');?>">categoria filhas</a></li>
              </ul>
            </li>

             <li class="dropdown <?php echo $this->router->fetch_class() == 'marcas' && $this->router->fetch_method() == 'index' ? 'active':'';?>">
              <a href="<?php echo base_url('restrita/marcas');?>" class="nav-link"><i class="fa fa-list"></i><span>Marcas</span></a>
            </li>

       
             <li class="dropdown <?php echo $this->router->fetch_class() == 'produtos' && $this->router->fetch_method() == 'index' ? 'active':'';?>">
              <a href="<?php echo base_url('restrita/produtos');?>" class="nav-link"><i class="fas fa-archive"></i><span>Produtos</span></a>
            </li>

            <li class="dropdown <?php echo $this->router->fetch_class() == 'usuarios' && $this->router->fetch_method() == 'index' ? 'active':'';?>">
              <a href="<?php echo base_url('restrita/usuarios');?>" class="nav-link"><i class="fa fa-users"></i><span>Usuários</span></a>
            </li>

       <li class="dropdown <?php echo $this->router->fetch_class() == 'sistema' && $this->router->fetch_method() == 'index' ? 'active':'';?>">
       <a href="#" class="menu-toggle nav-link has-dropdown">
        <i class="fas fa-cogs"></i><span>Configurações</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo base_url('restrita/sistema');?>">Sistema</a></li>

                <li><a class="nav-link" href="<?php echo base_url('restrita/sistema/correios');?>">Correios</a></li>

                <li><a class="nav-link" href="<?php echo base_url('restrita/sistema/pagseguro');?>">Pagseguro</a></li>

                <li><a class="nav-link" href="<?php echo base_url('restrita/login/logout');?>"><i class="fas fa-power-off"></i>Logout</a></li>
              </ul>
            </li>
            
          </ul>
        </aside>
      </div>
      