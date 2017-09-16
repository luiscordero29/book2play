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
                <h3><i class="fa fa-angle-right"></i> Instalaciones - [Editar]</h3>
              </div>
              <div class="col-md-3" style="text-align: right; padding-top: 15px;">
                <a href="<?php echo site_url('instalaciones/index'); ?>" class="btn btn-info">Volver</a>
              </div>
            </div>

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
                              <label for="rin_nombre" class="col-sm-2 col-sm-2 control-label">Nombre</label>
                              <div class="col-sm-10">
                                <input type="text" name="rin_nombre" class="form-control" id="rin_nombre" placeholder="Nombre" disabled="" maxlength="250" value="<?php echo $row['rin_nombre']; ?>">
                              </div>
                          </div>    

                          <h4 class="mb"><i class="fa fa-angle-right"></i> Duración de la Reserva</h4> 
                          <div class="form-group">
                              <label for="rin_tipo" class="col-sm-2 col-sm-2 control-label">Medida</label>
                              <div class="col-sm-10">
                                  <select name="rin_tipo" id="rin_tipo" class="form-control" required="">
                                    <option value="">SELECCIONE</option>
                                    <option <?php if ($row['rin_tipo']=='MINUTOS'): ?>selected<?php endif ?> value="MINUTOS">MINUTOS</option>
                                    <option <?php if ($row['rin_tipo']=='HORAS'): ?>selected<?php endif ?> value="HORAS">HORAS</option>
                                    <option <?php if ($row['rin_tipo']=='DIA'): ?>selected<?php endif ?> value="DIA">DIA</option>
                                  </select>      
                              </div>
                          </div>                
                          <div class="form-group">
                              <label for="rin_duracion" class="col-sm-2 col-sm-2 control-label">Duración</label>
                              <div class="col-sm-10">
                                <input type="text" name="rin_duracion" class="form-control" id="rin_duracion" placeholder="Duración" required="" maxlength="4" value="<?php echo $row['rin_duracion']; ?>">
                              </div>
                          </div>

                          <h4 class="mb"><i class="fa fa-angle-right"></i> Horario de Instalación</h4> 
                          <div class="form-group">
                              <label for="rin_hora_inicio" class="col-sm-2 col-sm-2 control-label">Hora Inicio</label>
                              <div class="col-sm-10">
                                <input id="rin_hora_inicio" type="text" name="rin_hora_inicio" class="form-control" id="rin_hora_inicio" placeholder="Hora Inicio" required="" value="<?php echo $row['rin_hora_inicio']; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rin_hora_fin" class="col-sm-2 col-sm-2 control-label">Hora Fin</label>
                              <div class="col-sm-10">
                                <input id="rin_hora_fin" type="text" name="rin_hora_fin" class="form-control" id="rin_hora_fin" placeholder="Hora Fin" required="" value="<?php echo $row['rin_hora_fin']; ?>">
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
                  <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Horario de Instalación</h4>
                  <?php 
                  $horas = $this->Instalaciones_model->res_instalaciones($row['rin_id']);
                  foreach ($horas as $hora) {
                    echo $this->Instalaciones_model->hora($hora['rop_hora_inicio']) .' - '.$this->Instalaciones_model->hora($hora['rop_hora_fin']) . '<br />';
                  }
                  ?>
                  </div>
          

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
            
  <!-- /.content-wrapper -->
  <?php $this->load->view('panel/template/footer'); ?>