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
                <h3><i class="fa fa-angle-right"></i> Administradores - [Registrar]</h3>
              </div>
              <div class="col-md-3" style="text-align: right; padding-top: 15px;">
                <a href="<?php echo site_url('administradores/index'); ?>" class="btn btn-info">Volver</a>
              </div>
            </div>
            <div class="row mt">
              <div class="col-lg-12">

                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de Acceso</h4>
                      <?php $this->load->view('panel/template/alerts'); ?>
                      <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                      
                      <?php 
                        $at = array('class' => 'form-horizontal style-form');
                        echo form_open('',$at); 
                      ?>
                          <div class="form-group">
                              <label for="rus_usuario" class="col-sm-2 col-sm-2 control-label">Usuario</label>
                              <div class="col-sm-10">
                                <input type="text" name="rus_usuario" class="form-control" id="rus_usuario" placeholder="Usuario" required="" autofocus="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rus_clave" class="col-sm-2 col-sm-2 control-label">Clave</label>
                              <div class="col-sm-10">
                                <input type="password" name="rus_clave" class="form-control" id="rus_clave" placeholder="Clave" required="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rus_correo" class="col-sm-2 col-sm-2 control-label">Correo</label>
                              <div class="col-sm-10">
                                  <input type="email" class="form-control" name="rus_correo" id="Correo" placeholder="Correo" required="" maxlength="255"  >
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rus_activo" class="col-sm-2 col-sm-2 control-label">Activo</label>
                              <div class="col-sm-10">
                                  <select name="rus_activo" id="rus_activo" class="form-control" required>
                                    <option value="">SELECCIONE</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                  </select>      
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-lg-12">
                                <input type="hidden" name="rus_tipo" value="ADMIN_GLOBAL">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                              </div>
                          </div>
                      <?php 
                        echo form_close(''); 
                      ?>
                  </div>
          

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
            
  <!-- /.content-wrapper -->
  <?php $this->load->view('panel/template/footer'); ?>