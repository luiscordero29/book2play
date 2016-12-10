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
            <h3><i class="fa fa-angle-right"></i> Reservas - [Reservar]</h3>

            <div class="row mt">
              <div class="col-lg-12">
                  <div class="row">
                    <div class="col-xs-6">
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
                        
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de Instalación</h4>
                        <div class="box-body">
                          <dl class="dl-horizontal">
                            <dt>ID:</dt>
                            <dd><?php echo $row['rin_id']; ?></dd>
                            <dt>Nombre de la Propiedad:</dt>
                            <dd><?php echo $row['rin_nombre']; ?></dd>
                            <dt>Activo:</dt>
                            <dd><?php echo $row['rin_activo']; ?></dd>
                            <dt>Número reservas al día por usuario:</dt>
                            <dd><?php echo $row['rin_numero']; ?></dd>
                            <dt>Tipo:</dt>
                            <dd><?php echo $row['rin_tipo']; ?></dd>
                            <dt>Duración:</dt>
                            <dd><?php echo $row['rin_duracion']; ?></dd>
                            <dt>Hora Inicio:</dt>
                            <dd><?php echo $row['rin_hora_inicio']; ?></dd>
                            <dt>Hora Fin:</dt>
                            <dd><?php echo $row['rin_hora_fin']; ?></dd>
                            <dt>Días de Antelación:</dt>
                            <dd><?php echo $row['rin_antelacion']; ?></dd>
                            <dt>Horas de Anulación:</dt>
                            <dd><?php echo $row['rin_anulacion']; ?></dd>
                          </dl>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-panel">
                      <?php $this->load->view('panel/template/alerts'); ?>
                      <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                      
                      <?php 
                        $at = array('class' => 'form-horizontal style-form');
                        echo form_open('reservas/reservar/'.$row['rin_id'],$at); 
                      ?>
                          <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar Disponibilidad</h4>
                          <div class="form-group">
                              <label for="fecha" class="col-sm-2 col-sm-2 control-label">Elegir Fecha</label>
                              <div class="col-sm-10">
                                <input type="text" name="fecha" class="form-control" id="fecha" placeholder="Elegir Fecha" required="" autocomplete="off">
                              </div>
                          </div>                                                       
                          <div class="form-group">
                              <div class="col-lg-12">
                                <input type="hidden" name="rco_id" value="<?php echo $row['rco_id']; ?>">
                                <input type="hidden" name="rin_id" value="<?php echo $row['rin_id']; ?>">
                                <input type="hidden" name="rin_antelacion" value="<?php echo $row['rin_antelacion']; ?>">
                                <button type="submit" class="btn btn-primary">Consultar</button>
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