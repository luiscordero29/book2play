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
            <h3><i class="fa fa-angle-right"></i> Instalaciones</h3>
            <div class="row mt">
              <div class="col-lg-12">
              
                  <div class="content-panel">
                      <h4>
                        <?php 
                        $at = array('class' => 'form-inline', 'role' => 'form');
                        echo form_open('',$at); 
                        ?>                        
                          <div class="form-group">
                              <label class="sr-only" for="s"></label>                            
                              <input type="text" name="s" class="form-control" value="<?php echo $search; ?>">
                          </div>
                          <button type="submit" class="btn btn-theme">BUSCAR</button>
                        <?php 
                        echo form_close(); 
                        ?>
                      </h4>
                          <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>Instalación</th>
                                  <th class="numeric">Horario</th>
                                  <th class="numeric">Comunidad</th>         
                                  <th>Acciones</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
                                if($table){ 
                                  foreach ($table as $r) {
                              ?>
                              <tr>
                                <td>
                                  <b>Nombre de la Propiedad:</b>
                                  <?php echo $r['rin_nombre']; ?><br />
                                  <b>Activo:</b>
                                  <?php echo $r['rin_activo']; ?><br />
                                  <b>Número reservas al día por usuario:</b>
                                  <?php echo $r['rin_numero']; ?><br />
                                  <b>Tipo:</b>
                                  <?php echo $r['rin_tipo']; ?><br />
                                  <b>Duración:</b>
                                  <?php echo $r['rin_duracion']; ?><br />
                                  <b>Hora Inicio:</b>
                                  <?php echo $r['rin_hora_inicio']; ?><br />
                                  <b>Hora Fin:</b>
                                  <?php echo $r['rin_hora_fin']; ?><br />
                                  <b>Días de Antelación:</b>
                                  <?php echo $r['rin_antelacion']; ?><br />
                                  <b>Horas de Anulación:</b>
                                  <?php echo $r['rin_anulacion']; ?><br />                                                             
                                </td> 
                                <td>
                                  <?php 
                                    $horas = $this->Instalaciones_model->res_instalaciones($r['rin_id']);
                                    foreach ($horas as $hora) {
                                      echo $hora['rop_hora_inicio'] .' - '.$hora['rop_hora_fin'] . '<br />';
                                    } 
                                  ?>                                                 
                                </td>
                                <td>
                                  <b>Nombre de la Comunidad:</b>
                                  <?php echo $r['rco_nombre']; ?><br />
                                  <b>Dirección de la Comunidad:</b>
                                  <?php echo $r['rco_direccion']; ?><br />
                                  <b>Persona de Contacto:</b>
                                  <?php echo $r['rco_contacto']; ?><br />
                                  <b>Móvil:</b>
                                  <?php echo $r['rco_movil']; ?><br />
                                  <b>Correo:</b>
                                  <?php echo $r['rco_correo']; ?><br />
                                  <b>Número de Vecinos:</b>
                                  <?php echo $r['rco_vecinos']; ?><br />                                    
                                </td>
                                <td>
                                  
                                  <div class="btn-group">
                                    <a title="Visualizar" href="<?php echo site_url($this->controller.'/view/'.$r['rin_id']); ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    <a title="Editar" href="<?php echo site_url($this->controller.'/update/'.$r['rin_id']); ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <a title="Borrar" onclick="return confirm('¿Desea eliminar el registro?')" href="<?php echo site_url($this->controller.'/delete/'.$r['rin_id']); ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                                  </div>

                                </td>
                              </tr>
                              <?php }} ?>
                             
                              </tbody>
                          </table>
                          <ul class="pagination">
                              <?php            
                                $pagination = (int)($table_rows / $table_limit);
                                for ($item=0; $item <= $pagination ; $item++) { 
                              ?>                                         
                                  <li <?php if($item == $table_page): ?>class="active"<?php endif; ?>>
                                    <a href="<?php echo site_url($this->controller.'/index/table_page/'.$item.$search_url); ?>">
                                      <?php echo $item+1; ?>
                                    </a>
                                  </li>
                              <?php                            
                                }
                              ?> 
                          </ul>
                          </section>
                  </div><!-- /content-panel -->

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
            
  <!-- /.content-wrapper -->
  <?php $this->load->view('panel/template/footer'); ?>