<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view($this->controller.'/template/header'); ?>
<?php $this->load->view($this->controller.'/template/navbar'); ?>
<?php $this->load->view($this->controller.'/template/sidebar'); ?>
    
     <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Blank Page</h3>
            <div class="row mt">
              <div class="col-lg-12">
              <p>Place your content here.</p>
              </div>
            </div>
      
          </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
    
<?php $this->load->view($this->controller.'/template/footer'); ?>