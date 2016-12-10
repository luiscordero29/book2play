<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo site_url('panel/index') ?>" class="logo"><b>RESERVA DE INSTALACIONES</b></a>
            <!--logo end-->
            <div class="top-menu">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user fa-2x"></i> CUENTA<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo site_url('cuenta/index'); ?>"><i class="fa fa-fw fa-user"></i> Mi Cuenta</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('cuenta/update'); ?>"><i class="fa fa-fw fa-edit"></i> Editar Datos</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('cuenta/password'); ?>"><i class="fa fa-fw fa-gear"></i> Cambiar Clave</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo site_url('cuenta/salir'); ?>"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesi&oacute;n</a>
                        </li>
                    </ul>
                </li>
              </ul>
            </div>
        </header>
      <!--header end-->