<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 

        <!--main content end-->
        <!--footer start-->
        <footer class="site-footer">
          <div class="text-center">
              <?php echo date("Y").' - Sistema de Reservas para Instalaciones' ?>
              <a href="<?php echo site_url('panel/index') ?>#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
        </footer>
        <!--footer end-->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="reservar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">RESERVAR</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div id="datainfo">                            
              </div>   
            </div>
          </div>
          <div class="modal-footer">
            <button id="confirmar" type="button" class="btn btn-primary">CONFIRMAR</button>
          </div>
        </div>
      </div>
    </div>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!--common script for all pages-->
    <script src="<?php echo base_url(); ?>assets/js/common-scripts.js"></script>

    <!--datetimepicker-->
    <script src="<?php echo base_url(); ?>assets/datetimepicker/jquery.datetimepicker.full.min.js"></script>

    <!--script for this page-->
    
  <script>
      
      $("button#reservar_action").click(function(){
        
        $( "#hidden_rop_id" ).val( $( this ).attr("data-rop_id") );
        $( "#hidden_hoy" ).val( $( this ).attr("data-hoy") );
        $( "#datainfo" ).html( $( this ).attr("data-info") );
        
      });

      $( "#confirmar" ).click(function() {
        $("#FormReservar").submit();
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

      // Datetimepicker
      $.datetimepicker.setLocale('es');

      $('#rin_hora_inicio').datetimepicker({
        datepicker:false,
        format:'H:i',
        step:5
      });

      $('#rin_hora_fin').datetimepicker({
        datepicker:false,
        format:'H:i',
        step:5
      });

      $('#fecha').datetimepicker({
        timepicker:false,
        format:'d/m/Y',
        formatDate:'d/m/Y',
      });

      /*function reservar_action($var1,$var2) {
        $( "#horario" ).val( $var1 );
        $( "#datainfo" ).html( $var2 );
      }*/

  </script>

  

  </body>
</html>
