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
            <h3><i class="fa fa-angle-right"></i> Cuenta</h3>
            <div class="row mt">
              <div class="col-lg-12">

                <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Mi Cuenta</h4>  
                  <p><b>Usuario:</b> <?php echo $row['rus_usuario']; ?></p>
                  <p><b>Correo:</b> <?php echo $row['rus_correo']; ?></p>
                  <p><b>Activo:</b> <?php echo $row['rus_activo']; ?></p>
                <br />
                <h4 class="mb"><i class="fa fa-angle-right"></i> Mis Datos</h4>  
                  <p><b>DNI:</b> <?php echo $row['rcl_dni']; ?></p>
                  <p><b>Nombres:</b> <?php echo $row['rcl_nombres']; ?></p>
                  <p><b>Apellidos:</b> <?php echo $row['rcl_apellidos']; ?></p>
                  <p><b>Móvil:</b> <?php echo $row['rcl_movil']; ?></p>
                  <p><b>Bloque:</b> <?php echo $row['rcl_bloque']; ?></p>
                  <p><b>Portal:</b> <?php echo $row['rcl_portal']; ?></p>
                  <p><b>Piso:</b> <?php echo $row['rcl_piso']; ?></p>
                  <p><b>Letra:</b> <?php echo $row['rcl_letra']; ?></p>
                </div>

              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
    
<?php $this->load->view('panel/template/footer'); ?>