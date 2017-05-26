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
            <h3><i class="fa fa-angle-right"></i> Gestores</h3>
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
                                  <th>Usuario</th>
                                  <th class="numeric">Correo</th>
                                  <th class="numeric">Activo</th>    
                                  <th class="numeric">DNI</th>    
                                  <th class="numeric">Apellidos</th>    
                                  <th class="numeric">Nombres</th>      
                                  <th>Acciones</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
                                if($table){ 
                                  foreach ($table as $r) {
                              ?>
                              <tr>
                                <td><?php echo $r['rus_usuario']; ?></td>
                                <td class="numeric"><?php echo $r['rus_correo']; ?></td>
                                <td class="numeric"><?php echo $r['rus_activo']; ?></td>
                                <td class="numeric"><?php echo $r['rad_dni']; ?></td>
                                <td class="numeric"><?php echo $r['rad_apellidos']; ?></td>
                                <td class="numeric"><?php echo $r['rad_nombres']; ?></td>
                                <td>
                                  <?php if($this->session->userdata('rus_id')<>$r['rus_id']){ ?>
                                  <div class="btn-group">
                                    <a title="Visualizar" href="<?php echo site_url($this->controller.'/view/'.$r['rus_id']); ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    <a title="Editar" href="<?php echo site_url($this->controller.'/update/'.$r['rus_id']); ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <a title="Cambiar Clave" href="<?php echo site_url($this->controller.'/password/'.$r['rus_id']); ?>" class="btn btn-success"><i class="fa fa-lock"></i></a>
                                    <a title="Borrar" onclick="return confirm('¿Desea eliminar el Gestor <?php echo $r['rus_usuario']; ?>?')" href="<?php echo site_url($this->controller.'/delete/'.$r['rus_id']); ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                                  </div>
                                  <?php } ?>
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