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
            <h3><i class="fa fa-angle-right"></i> Instalaciones - [Ver]</h3>
            <div class="row mt">
              <div class="col-lg-12">

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
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Horario</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <?php 
                            $horas = $this->Instalaciones_model->res_instalaciones($row['rin_id']);
                            foreach ($horas as $hora) {
                          ?>
                          <dt>ID: <?php echo $hora['rop_id']; ?></dt>
                          <dd><?php echo $hora['rop_hora_inicio'] .' - '.$hora['rop_hora_fin']; ?></dd>
                          <?php } ?>
                        </dl>
                      </div>
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
                      <!-- /.box-body -->
                  </div>

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
            
  <!-- /.content-wrapper -->
  <?php $this->load->view('panel/template/footer'); ?>