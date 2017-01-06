<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view($this->controller.'/template/header'); ?>
<?php $this->load->view($this->controller.'/template/navbar'); ?>
<?php $this->load->view($this->controller.'/template/sidebar'); ?>
    
     <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Panel de Control</h3>
            <div class="row mt">
              <div class="col-lg-12">
                <?php 
                  switch ($this->session->userdata('rus_tipo')) {
                    case 'ADMIN_GLOBAL':
                      # Administrador Global
                      ?>
                <div class="row mtbox">
                  <a href="<?php echo site_url('comunidades/index'); ?>">
                    <div class="col-xs-2 col-xs-offset-3 box0">
                      <div class="box1">
                        <span class="fa fa-building"></span>
                        <h3><?php echo $this->Panel_model->contar_comunidades(); ?></h3>
                      </div>
                      <p>Comunidades</p>
                    </div>
                  </a>
                  <a href="<?php echo site_url('gestores/index'); ?>">
                    <div class="col-xs-2 box0">
                      <div class="box1">
                        <span class="fa fa-users"></span>
                        <h3><?php echo $this->Panel_model->contar_gestores(); ?></h3>
                      </div>
                      <p>Gestores</p>
                    </div>
                  </a>
                  <a href="<?php echo site_url('administradores/index'); ?>">
                    <div class="col-xs-2 box0">
                      <div class="box1">
                        <span class="fa fa-users"></span>
                        <h3><?php echo $this->Panel_model->contar_administradores(); ?></h3>
                      </div>
                      <p>Administradores</p>
                    </div>
                  </a>
                </div>
                <?php
                      break;
                      case 'ADMIN_COMUNIDAD':
                      # Administrador Global
                      ?>
                <div class="row mtbox">
                  <a href="<?php echo site_url('instalaciones/index'); ?>">
                    <div class="col-xs-2 col-xs-offset-4 box0">
                      <div class="box1">
                        <span class="fa fa-building"></span>
                        <h3><?php echo $this->Panel_model->contar_instalaciones(); ?></h3>
                      </div>
                      <p>Instalaciones</p>
                    </div>
                  </a>
                  <a href="<?php echo site_url('clientes/index'); ?>">
                    <div class="col-xs-2 box0">
                      <div class="box1">
                        <span class="fa fa-users"></span>
                        <h3><?php echo $this->Panel_model->contar_clientes(); ?></h3>
                      </div>
                      <p>Usuarios</p>
                    </div>
                  </a>
                </div>
                <?php
                      break;
                    case 'USUARIO':
                      redirect('reservas/index');
                      break;
                  } 
                ?>

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
    
<?php $this->load->view($this->controller.'/template/footer'); ?>