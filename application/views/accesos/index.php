<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view($this->controller.'/template/header'); ?>
  <div class="login-logo">
    <img src="<?php echo base_url(); ?>/assets/img/logo.png">
  </div>
  <div id="login-page">
      <div class="container">
          
          <?php 
              $at = array('class' => 'form-login', 'role' => 'form');
              echo form_open('accesos/index',$at); 
          ?> 
            <h2 class="form-login-heading">INICIAR SESSIÓN</h2>
            <div class="login-wrap">
                <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>  
                <?php $this->load->view($this->controller.'/template/alerts'); ?>
                <input name="usuario" required type="text" class="form-control" placeholder="DNI" autofocus>
                <br>
                <input name="clave" required type="password" class="form-control" placeholder="Clave">
                <label class="checkbox">
                    <span class="pull-right">
                        <a href="<?php echo site_url($this->controller.'/restaurar') ?>"> Restaurar Clave.</a>
                    </span>
                </label>
                <button class="btn btn-default btn-block" type="submit"><i class="fa fa-lock"></i> ENTRAR</button>                
            </div>
    
          <?php echo form_close(); ?>  
      
      </div>
    </div>
<?php $this->load->view($this->controller.'/template/footer'); ?>