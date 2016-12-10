<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('panel/template/header'); ?>
<?php $this->load->view('panel/template/navbar'); ?>
<?php $this->load->view('panel/template/sidebar'); ?>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Comunidades - [Ver]</h3>
            <div class="row mt">
              <div class="col-lg-12">

                  <div class="form-panel">
                      
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de la Comunidad</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <dt>ID:</dt>
                          <dd><?php echo $row['rco_id']; ?></dd>
                          <dt>Comunidad:</dt>
                          <dd><?php echo $row['rco_nombre']; ?></dd>
                          <dt>Dirección:</dt>
                          <dd><?php echo $row['rco_direccion']; ?></dd>
                          <dt>Contacto:</dt>
                          <dd><?php echo $row['rco_contacto']; ?></dd>
                          <dt>Móvil:</dt>
                          <dd><?php echo $row['rco_movil']; ?></dd>
                          <dt>Correo:</dt>
                          <dd><?php echo $row['rco_correo']; ?></dd>
                          <dt>Número de Vecinos:</dt>
                          <dd><?php echo $row['rco_vecinos']; ?></dd>
                        </dl>
                      </div>
                      <h4 class="mb"><i class="fa fa-angle-right"></i> 
                      Datos de Gestor</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <dt>ID:</dt>
                          <dd><?php echo $row['rad_id']; ?></dd>
                          <dt>DNI:</dt>
                          <dd><?php echo $row['rad_dni']; ?></dd>
                          <dt>Apellidos:</dt>
                          <dd><?php echo $row['rad_apellidos']; ?></dd>
                          <dt>Nombres:</dt>
                          <dd><?php echo $row['rad_nombres']; ?></dd>
                        </dl>
                      </div>
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de Acceso</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <dt>ID:</dt>
                          <dd><?php echo $row['rus_id']; ?></dd>
                          <dt>Usuario:</dt>
                          <dd><?php echo $row['rus_usuario']; ?></dd>
                          <dt>Correo:</dt>
                          <dd><?php echo $row['rus_correo']; ?></dd>
                          <dt>Tipo:</dt>
                          <dd><?php echo $row['rus_tipo']; ?></dd>
                          <dt>Activo:</dt>
                          <dd><?php echo $row['rus_activo']; ?></dd>
                        </dl>
                      </div>
                      <!-- /.box-body -->
                  </div>

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
            
  <!-- /.content-wrapper -->
  <?php $this->load->view('panel/template/footer'); ?>