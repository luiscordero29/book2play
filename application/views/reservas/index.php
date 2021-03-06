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
            <h3><i class="fa fa-angle-right"></i> Reservas</h3>

            <div class="row mt">
              <div class="col-lg-12">

                  
                  
                  <div class="form-panel">
                      <?php $this->load->view('panel/template/alerts'); ?>
                      <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                      
                      <?php 
                        $at = array('class' => 'form-horizontal style-form');
                        echo form_open('reservas/index',$at); 
                      ?>

                          <div class="form-group">

                              <label for="rin_id" class="col-sm-2 col-sm-2 control-label">Elegir Instalacion</label>
                              <div class="col-sm-4">
                                <select name="rin_id" id="rin_id" class="form-control" required="">
                                  <option value="">SELECCIONE</option>
                                  <?php 
                                  if (!empty($res_instalaciones_table)) {
                                    foreach ($res_instalaciones_table as $r) {
                                      if ($r['rin_numero']>1) {
                                        $text = $r['rin_numero'].' RESERVAS POR DÍA';
                                      }else{
                                        $text = $r['rin_numero'].' RESERVA POR DÍA';
                                      }
                                  ?>
                                  <option <?php if ($r['rin_id']==$rin_id): ?>selected<?php endif; ?> value="<?php echo $r['rin_id']; ?>"><?php echo $r['rin_nombre'].': '.$text; ?></option>
                                  <?php }} ?>
                                </select>
                              </div>
                              <label for="fecha" class="col-sm-2 col-sm-2 control-label">Elegir Fecha</label>
                              <div class="col-sm-2">
                                <input type="text" name="fecha" class="form-control" id="fecha" placeholder="Elegir Fecha" required="" autocomplete="off" value="<?php echo $this->Reservas_model->date_to_1($hoy); ?>">
                              </div>
                              <div class="col-lg-2">                                
                                <button type="submit" class="btn btn-primary">Consultar</button>
                              </div>
                          </div>
                          
                      <?php 
                        echo form_close(''); 
                      ?>
                  </div>

                  <?php 
                    $at = array('class' => 'form-horizontal style-form', 'id' => 'FormReservar');
                    echo form_open('reservas/reservar_listar',$at); 
                  ?>
                  <input type="hidden" name="rin_id" value="<?php echo $rin_id; ?>">
                  <input type="hidden" name="rco_id" value="<?php echo $rco_id; ?>">
                  <input type="hidden" name="rin_numero" value="<?php echo $rin_numero; ?>">
                  <input type="hidden" name="fecha" value="<?php echo $this->Reservas_model->date_to_1($hoy); ?>">
                  <input type="hidden" name="rop_id" id="hidden_rop_id" value="">
                  <input type="hidden" name="hoy" id="hidden_hoy" value="">
                  <?php 
                    echo form_close(''); 
                  ?>
                  
                  <div class="row seven-cols">
                    <?php for ($i=0; $i < 7; $i++) { ?>
                    <div class="col-lg-1 col-md-3 col-sm-4 col-xs-6">
                      <div class="form-panel">
                      <h4 class="mb"><?php echo $this->Reservas_model->semana($hoy) .' '. $this->Reservas_model->date_to_1($hoy); ?></h4>
                      <hr>
                      <?php 
                        $horas = $this->Reservas_model->res_instalaciones($rin_id);
                        foreach ($horas as $hora) {
                          if ($this->Reservas_model->disponible($hora['rop_id'], $hoy )) {
                      ?>
                          <div class="hora">                         
                          <?php echo $this->Reservas_model->hora($hora['rop_hora_inicio']) .' - '.$this->Reservas_model->hora($hora['rop_hora_fin']); ?> 
                          <?php if ($this->Reservas_model->disponibilidad_fechas($hoy,$rin_id,$hora['rop_hora_inicio'])): ?>                            
                          <button id="reservar_action" class="btn btn-success btn-xs" data-rop_id="<?php echo $hora['rop_id']; ?>" data-hoy="<?php echo $hoy; ?>" data-info="<?php echo 'Reservar el horario '.$this->Reservas_model->hora($hora['rop_hora_inicio']) .' - '.$this->Reservas_model->hora($hora['rop_hora_fin']).' de '.$this->Reservas_model->date_to_1($hoy); ?>" data-toggle="modal" data-target="#reservar_modal">RESERVAR</button>
                          <?php else: ?>
                          <button class="btn btn-default btn-xs">NO DISPONIBLE</button>
                          <?php endif ?>
                          </div>
                          <hr>
                          <?php }else{  ?>  
                          <div class="hora">
                          <?php echo $this->Reservas_model->hora($hora['rop_hora_inicio']) .' - '.$this->Reservas_model->hora($hora['rop_hora_fin']); ?> 
                          <?php if ($this->Reservas_model->disponible_usuario($hora['rop_id'], $hoy )): ?>
                          <button class="btn btn-info btn-xs">OCUPADO</button><br />
                          <?php else: ?>
                          <button class="btn btn-danger btn-xs">OCUPADO</button><br />
                          <?php endif ?>
                          <?php echo $this->Reservas_model->cliente($hora['rop_id'], $hoy ); ?>
                          </div>                          
                          <hr>
                      <?php 
                        }} 
                        $hoy = $this->Reservas_model->tomorrow($hoy);
                      ?>
                      </div>
                    </div>
                    <?php } ?>
                  </div>

          

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
            
  <!-- /.content-wrapper -->
  <?php $this->load->view('panel/template/footer'); ?>