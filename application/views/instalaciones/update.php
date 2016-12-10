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
            <h3><i class="fa fa-angle-right"></i> Instalaciones - [Editar]</h3>

            <div class="row mt">
              <div class="col-lg-12">

                  <div class="form-panel">
                      <?php $this->load->view('panel/template/alerts'); ?>
                      <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                      
                      <?php 
                        $at = array('class' => 'form-horizontal style-form');
                        echo form_open('',$at); 
                      ?>
                          <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de la Instalación</h4>
                          <div class="form-group">
                              <label for="rin_nombre" class="col-sm-2 col-sm-2 control-label">Nombre de la Propiedad</label>
                              <div class="col-sm-10">
                                <input type="text" name="rin_nombre" class="form-control" id="rin_nombre" placeholder="Nombre de la Propiedad" required="" autofocus="" maxlength="250" value="<?php echo $row['rin_nombre']; ?>">
                              </div>
                          </div>  
                          <div class="form-group">
                              <label for="rin_activo" class="col-sm-2 col-sm-2 control-label">Activo</label>
                              <div class="col-sm-10">
                                  <select name="rin_activo" id="rin_activo" class="form-control" required="">
                                    <option value="">SELECCIONE</option>
                                    <option <?php if ($row['rin_activo']=='SI'): ?>selected<?php endif ?> value="SI">SI</option>
                                    <option <?php if ($row['rin_activo']=='NO'): ?>selected<?php endif ?> value="NO">NO</option>
                                  </select>      
                              </div>
                          </div> 
                          <div class="form-group">
                              <label for="rin_numero" class="col-sm-2 col-sm-2 control-label">Número reservas al día por usuario:</label>
                              <div class="col-sm-10">
                                <input type="text" name="rin_numero" class="form-control" id="rin_numero" placeholder="Número reservas al día por usuario" required="" maxlength="4" value="<?php echo $row['rin_numero']; ?>">
                              </div>
                          </div>                                               
                          <div class="form-group">
                              <div class="col-lg-12">
                                <input type="hidden" name="rin_id" value="<?php echo $row['rin_id']; ?>">
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