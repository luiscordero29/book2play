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
            <h3><i class="fa fa-angle-right"></i> Agenda - [Mis Reservas]</h3>
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
                                  <th>Fecha</th>
                                  <th>Horario</th>
                                  <th class="numeric">Instalación</th>
                                  <th class="numeric">Comunidad</th>         
                                  <th>Anular Reserva</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
                                if($table){ 
                                  foreach ($table as $r) {
                              ?>
                              <tr>
                                <td>
                                  <?php                                    
                                    echo $this->Agenda_model->date_to_1($r['rre_fecha']);
                                  ?>                                                 
                                </td>
                                <td>
                                  <?php                                    
                                    echo $this->Agenda_model->hora($r['rop_hora_inicio']) .' - '.$this->Agenda_model->hora($r['rop_hora_fin']);
                                  ?>                                                 
                                </td>
                                <td>
                                  <?php echo $r['rin_nombre']; ?><br />
                                  <b>Horas para poder anular:</b>
                                  <?php echo $r['rin_anulacion']; ?><br />                                                        
                                </td> 
                                
                                <td>
                                  <b>Nombre:</b>
                                  <?php echo $r['rco_nombre']; ?><br />
                                  <b>E-mail:</b>
                                  <?php echo $r['rco_correo']; ?><br />                                
                                </td>
                                <td>
                                  
                                  <div class="btn-group">
                                    <a title="Borrar" onclick="return confirm('¿Desea eliminar el registro?')" href="<?php echo site_url($this->controller.'/delete/'.$r['rre_id']); ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
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