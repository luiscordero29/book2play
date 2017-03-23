<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view($this->controller.'/template/header'); ?>
  <div class="login-logo">
    <img src="<?php echo base_url(); ?>/assets/img/logo.png">
  </div>
  <div id="login-page">
      <div class="container">
          
          <?php 
              $at = array('class' => 'form-login', 'role' => 'form');
              echo form_open('accesos/restaurar',$at); 
          ?> 
            <h2 class="form-login-heading">RESTAURAR CLAVE</h2>
            <div class="login-wrap">
                <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>  
                <?php $this->load->view($this->controller.'/template/alerts'); ?>
                <input name="email" required type="text" class="form-control" placeholder="E-mail" autofocus>
                <br>
                <label class="checkbox">
                    <span class="pull-right">
                        <a href="<?php echo site_url($this->controller.'/index') ?>"> Iniciar Sesión.</a>
                    </span>
                </label>
                <button class="btn btn-default btn-block" type="submit"><i class="fa fa-lock"></i> RESTAURAR</button>                
            </div>
    
          <?php echo form_close(); ?>  
      
      </div>
    </div>
<?php $this->load->view($this->controller.'/template/footer'); ?>