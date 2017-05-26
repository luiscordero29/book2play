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
                          <dt>Nombre:</dt>
                          <dd><?php echo $row['rin_nombre']; ?></dd>
                          <dt>Activo:</dt>
                          <dd><?php echo $row['rin_activo']; ?></dd>
                          <dt>N° reservas al día/usuario:</dt>
                          <dd><?php echo $row['rin_numero']; ?></dd>
                          <dt>Medida:</dt>
                          <dd><?php echo $row['rin_tipo']; ?></dd>
                          <dt>Duración:</dt>
                          <dd><?php echo $row['rin_duracion']; ?></dd>
                          <dt>Hora Inicio:</dt>
                          <dd><?php echo $this->Instalaciones_model->hora($row['rin_hora_inicio']); ?></dd>
                          <dt>Hora Fin:</dt>
                          <dd><?php echo $this->Instalaciones_model->hora($row['rin_hora_fin']); ?></dd>
                          <dt>Días para poder reservar:</dt>
                          <dd><?php echo $row['rin_antelacion']; ?></dd>
                          <dt>Horas para poder anular:</dt>
                          <dd><?php echo $row['rin_anulacion']; ?></dd>
                        </dl>
                      </div>
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Horario</h4>
                      <div class="box-body">
                        <dl class="dl-horizontal">
                          <?php 
                            $horas = $this->Instalaciones_model->res_instalaciones($row['rin_id']);
                            $item = 0;
                            foreach ($horas as $hora) {
                              $item++;
                          ?>
                          <dt>Bloque: <?php echo $item; ?></dt>
                          <dd><?php echo $this->Instalaciones_model->hora($hora['rop_hora_inicio']) .' - '.$this->Instalaciones_model->hora($hora['rop_hora_fin']); ?></dd>
                          <?php } ?>
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
                          <dt>N° de Vecinos:</dt>
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