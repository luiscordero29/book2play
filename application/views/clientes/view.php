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
            <div class="row">
              <div class="col-md-9">
                <h3><i class="fa fa-angle-right"></i> Usuarios - [Ver]</h3>
              </div>
              <div class="col-md-3" style="text-align: right; padding-top: 15px;">
                <a href="<?php echo site_url('clientes/index'); ?>" class="btn btn-info">Volver</a>
              </div>
            </div>
            <div class="row mt">
              <div class="col-lg-12">

                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de Acceso</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <dt>Usuario:</dt>
                          <dd><?php echo $row['rcl_dni']; ?></dd>
                          <dt>Correo:</dt>
                          <dd><?php echo $row['rus_correo']; ?></dd>
                          <dt>Tipo:</dt>
                          <dd><?php echo $row['rus_tipo']; ?></dd>
                          <dt>Activo:</dt>
                          <dd><?php echo $row['rus_activo']; ?></dd>
                        </dl>
                      </div>
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de Gestor</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <dt>DNI:</dt>
                          <dd><?php echo $row['rcl_dni']; ?></dd>
                          <dt>Apellidos:</dt>
                          <dd><?php echo $row['rcl_apellidos']; ?></dd>
                          <dt>Nombres:</dt>
                          <dd><?php echo $row['rcl_nombres']; ?></dd>
                          <dt>Móvil:</dt>
                          <dd><?php echo $row['rcl_movil']; ?></dd>
                          <dt>Bloque:</dt>
                          <dd><?php echo $row['rcl_bloque']; ?></dd>
                          <dt>Portal:</dt>
                          <dd><?php echo $row['rcl_portal']; ?></dd>
                          <dt>Piso:</dt>
                          <dd><?php echo $row['rcl_piso']; ?></dd>
                          <dt>Letra:</dt>
                          <dd><?php echo $row['rcl_letra']; ?></dd>
                        </dl>
                      </div>
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de la Comunidad</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <dt>Comunidad:</dt>
                          <dd><?php echo $row['rco_nombre']; ?></dd>
                          <dt>Dirección:</dt>
                          <dd><?php echo $row['rco_direccion']; ?></dd>
                          <dt>Contacto:</dt>
                          <dd><?php echo $row['rco_contacto']; ?></dd>
                          <dt>Móvil:</dt>
                          <dd><?php echo $row['rco_movil']; ?></dd>
                          <dt>E-mail:</dt>
                          <dd><?php echo $row['rco_correo']; ?></dd>
                          <dt>N° Vecinos:</dt>
                          <dd><?php echo $row['rco_vecinos']; ?></dd>
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