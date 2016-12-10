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
            <h3><i class="fa fa-angle-right"></i> Clientes - [Registar]</h3>

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
                                  <input type="email" class="form-control" name="rus_correo" id="rus_correo" placeholder="Correo" required="" maxlength="255"  >
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
                          <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de Cliente</h4>                
                          <div class="form-group">
                              <label for="rcl_dni" class="col-sm-2 col-sm-2 control-label">DNI</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_dni" class="form-control" id="rcl_dni" placeholder="DNI" required="" maxlength="30">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rcl_nombres" class="col-sm-2 col-sm-2 control-label">Apellidos</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_nombres" class="form-control" id="rcl_nombres" placeholder="Apellidos" required="" maxlength="150">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rcl_apellidos" class="col-sm-2 col-sm-2 control-label">Nombres</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_apellidos" class="form-control" id="rcl_apellidos" placeholder="Nombres" required="" maxlength="150">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rcl_movil" class="col-sm-2 col-sm-2 control-label">Móvil</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_movil" class="form-control" id="rcl_movil" placeholder="Móvil" maxlength="30">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rcl_bloque" class="col-sm-2 col-sm-2 control-label">Bloque</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_bloque" class="form-control" id="rcl_bloque" placeholder="Bloque" maxlength="10">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rcl_portal" class="col-sm-2 col-sm-2 control-label">Portal</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_portal" class="form-control" id="rcl_portal" placeholder="Portal" maxlength="250">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rcl_piso" class="col-sm-2 col-sm-2 control-label">Piso</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_piso" class="form-control" id="rcl_piso" placeholder="Piso" maxlength="10">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rcl_letra" class="col-sm-2 col-sm-2 control-label">Letra</label>
                              <div class="col-sm-10">
                                <input type="text" name="rcl_letra" class="form-control" id="rcl_letra" placeholder="Letra" maxlength="10">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-lg-12">
                                <input type="hidden" name="rus_tipo" value="USUARIO">
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