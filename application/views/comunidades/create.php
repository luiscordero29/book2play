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
                <h3><i class="fa fa-angle-right"></i> Comunidades - [Registar]</h3>
              </div>
              <div class="col-md-3" style="text-align: right; padding-top: 15px;">
                <a href="<?php echo site_url('comunidades/index'); ?>" class="btn btn-info">Volver</a>
              </div>
            </div>
            <div class="row mt">
              <div class="col-lg-12">

                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de la Comunidad</h4>
                      <?php $this->load->view('panel/template/alerts'); ?>
                      <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                      
                      <?php 
                        $at = array('class' => 'form-horizontal style-form');
                        echo form_open('',$at); 
                      ?>
                          <div class="form-group">
                              <label for="rco_nombre" class="col-sm-2 col-sm-2 control-label">Nombre</label>
                              <div class="col-sm-10">
                                <input type="text" name="rco_nombre" class="form-control" id="rco_nombre" placeholder="Nombre" required="" autofocus="" value="<?php echo set_value('rco_nombre'); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rco_direccion" class="col-sm-2 col-sm-2 control-label">Dirección</label>
                              <div class="col-sm-10">
                                <input type="text" name="rco_direccion" class="form-control" id="rco_direccion" placeholder="Dirección" required="" value="<?php echo set_value('rco_direccion'); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rco_contacto" class="col-sm-2 col-sm-2 control-label">Contacto</label>
                              <div class="col-sm-10">
                                <input type="text" name="rco_contacto" class="form-control" id="rco_contacto" placeholder="Contacto" required="" value="<?php echo set_value('rco_contacto'); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rco_movil" class="col-sm-2 col-sm-2 control-label">Móvil</label>
                              <div class="col-sm-10">
                                <input type="text" name="rco_movil" class="form-control" id="rco_movil" placeholder="Móvil" required="" value="<?php echo set_value('rco_movil'); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rco_correo" class="col-sm-2 col-sm-2 control-label">E-mail</label>
                              <div class="col-sm-10">
                                  <input type="email" class="form-control" name="rco_correo" id="rco_correo" placeholder="E-mail" required="" maxlength="255" value="<?php echo set_value('rco_correo'); ?>" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rco_vecinos" class="col-sm-2 col-sm-2 control-label">N° Vecinos</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="rco_vecinos" id="rco_vecinos" placeholder="N° Vecinos" required="" maxlength="255" value="<?php echo set_value('rco_vecinos'); ?>" >
                              </div>
                          </div>   
                          <h4 class="mb"><i class="fa fa-angle-right"></i> Administrador de la Comunidad</h4>                
                          <div class="form-group">
                              <label for="rus_id" class="col-sm-2 col-sm-2 control-label">Gestor</label>
                              <div class="col-sm-10">
                                  <select name="rus_id" id="rus_id" class="form-control" required>
                                    <option value="">SELECCIONE</option>
                                    <?php 
                                      if (!empty($res_administradores)) {
                                        foreach ($res_administradores as $gestor) {
                                          if (set_value('rus_id')!=$gestor['rus_id']){
                                            echo '<option value="'.$gestor['rus_id'].'">'.$gestor['rad_dni'].'-'.$gestor['rad_apellidos'].' '.$gestor['rad_nombres'].'</option>';
                                          }else{
                                            echo '<option selected value="'.$gestor['rus_id'].'">'.$gestor['rad_dni'].'-'.$gestor['rad_apellidos'].' '.$gestor['rad_nombres'].'</option>';
                                          }
                                        }
                                      }
                                    ?>
                                  </select>      
                              </div>
                          </div> 
                          <div class="form-group">
                              <div class="col-lg-12">
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