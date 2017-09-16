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
                <h3><i class="fa fa-angle-right"></i> Gestores - [Editar]</h3>
              </div>
              <div class="col-md-3" style="text-align: right; padding-top: 15px;">
                <a href="<?php echo site_url('gestores/index'); ?>" class="btn btn-info">Volver</a>
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
                                <input type="text" name="rus_usuario" class="form-control" id="rus_usuario" placeholder="Usuario" value="<?php echo $row['rus_usuario']; ?>" required="" autofocus="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rus_correo" class="col-sm-2 col-sm-2 control-label">Correo</label>
                              <div class="col-sm-10">
                                  <input type="email" class="form-control" name="rus_correo" id="rus_correo" placeholder="Correo" value="<?php echo $row['rus_correo']; ?>" required="" maxlength="255"  >
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rus_activo" class="col-sm-2 col-sm-2 control-label">Activo</label>
                              <div class="col-sm-10">
                                  <select name="rus_activo" id="rus_activo" class="form-control" required>
                                    <option value="">SELECCIONE</option>
                                    <option value="SI" <?php if ($row['rus_activo']=='SI'): ?>selected<?php endif ?>>SI</option>
                                    <option value="NO" <?php if ($row['rus_activo']=='NO'): ?>selected<?php endif ?>>NO</option>
                                  </select>      
                              </div>
                          </div>
                          <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de Gestor</h4>                
                          <div class="form-group">
                              <label for="rad_dni" class="col-sm-2 col-sm-2 control-label">DNI</label>
                              <div class="col-sm-10">
                                <input type="text" name="rad_dni" class="form-control" id="rad_dni" placeholder="DNI" required="" value="<?php echo $row['rad_dni']; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rad_apellidos" class="col-sm-2 col-sm-2 control-label">Apellidos</label>
                              <div class="col-sm-10">
                                <input type="text" name="rad_apellidos" class="form-control" id="rad_apellidos" placeholder="Apellidos" required="" value="<?php echo $row['rad_apellidos']; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rad_nombres" class="col-sm-2 col-sm-2 control-label">Nombres</label>
                              <div class="col-sm-10">
                                <input type="text" name="rad_nombres" class="form-control" id="rad_nombres" placeholder="Nombres" required="" value="<?php echo $row['rad_nombres']; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-lg-12">
                                <input type="hidden" name="rus_tipo" value="ADMIN_COMUNIDAD">
                                <input type="hidden" name="rus_id" value="<?php echo $row['rus_id']; ?>">
                                <input type="hidden" name="rad_id" value="<?php echo $row['rad_id']; ?>">
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