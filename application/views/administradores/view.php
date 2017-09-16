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
                <h3><i class="fa fa-angle-right"></i> Administradores - [Ver]</h3>
              </div>
              <div class="col-md-3" style="text-align: right; padding-top: 15px;">
                <a href="<?php echo site_url('administradores/index'); ?>" class="btn btn-info">Volver</a>
              </div>
            </div>
            <div class="row mt">
              <div class="col-lg-12">

                  <div class="form-panel">
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