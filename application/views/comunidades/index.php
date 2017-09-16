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
                <h3><i class="fa fa-angle-right"></i> Comunidades</h3>
              </div>
              <div class="col-md-3" style="text-align: right; padding-top: 15px;">
                <a href="<?php echo site_url('panel/index'); ?>" class="btn btn-info">Volver</a>
              </div>
            </div>
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
                                  <th>Comunidad</th>
                                  <th class="numeric">Gestor</th>
                                  <th class="numeric">Acceso</th>       
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
                                  <b>Nombre:</b>
                                  <?php echo $r['rco_nombre']; ?><br />
                                  <b>Dirección:</b>
                                  <?php echo $r['rco_direccion']; ?><br />
                                  <b>Contacto:</b>
                                  <?php echo $r['rco_contacto']; ?><br />
                                  <b>Móvil:</b>
                                  <?php echo $r['rco_movil']; ?><br />
                                  <b>E-mail:</b>
                                  <?php echo $r['rco_correo']; ?><br />
                                  <b>N° Vecinos:</b>
                                  <?php echo $r['rco_vecinos']; ?><br />                                    
                                </td>
                                <td>
                                  <b>DNI:</b>
                                  <?php echo $r['rad_dni']; ?><br />
                                  <b>Apellidos:</b>
                                  <?php echo $r['rad_apellidos']; ?><br />
                                  <b>Nombres:</b>
                                  <?php echo $r['rad_nombres']; ?><br />                                                              
                                </td>
                                <td>
                                  <b>Usuario:</b>
                                  <?php echo $r['rus_usuario']; ?><br />
                                  <b>Correo:</b>
                                  <?php echo $r['rus_correo']; ?><br />
                                  <b>Activo:</b>
                                  <?php echo $r['rus_activo']; ?><br />                                                              
                                </td>                               
                                <td>
                                  <div class="btn-group">
                                    <a title="Visualizar" href="<?php echo site_url($this->controller.'/view/'.$r['rco_id']); ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    <a title="Editar" href="<?php echo site_url($this->controller.'/update/'.$r['rco_id']); ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <a title="Borrar" onclick="return confirm('¿Desea eliminar la Comunidad <?php echo $r['rco_nombre']; ?>?')" href="<?php echo site_url($this->controller.'/delete/'.$r['rco_id']); ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
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