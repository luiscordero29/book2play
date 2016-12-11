<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                    
                  <li class="mt">
                      <a href="<?php echo site_url('panel/index'); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Panel de Control</span>
                      </a>
                  </li>
                  <?php 
                  switch ($this->session->userdata('rus_tipo')) {
                    case 'ADMIN_GLOBAL':
                      # Administrador Global
                      ?>
                      <li class="sub-menu">
                          <a href="javascript:;" >
                              <i class="fa fa-building"></i>
                              <span>Comunidades</span>
                          </a>
                          <ul class="sub">
                              <li><a href="<?php echo site_url('comunidades/index'); ?>">Listado</a></li>
                              <li><a href="<?php echo site_url('comunidades/create'); ?>">Registrar</a></li>
                          </ul>
                      </li>
                      <li class="sub-menu">
                          <a href="javascript:;" >
                              <i class="fa fa-users"></i>
                              <span>Gestores</span>
                          </a>
                          <ul class="sub">
                              <li><a href="<?php echo site_url('gestores/index'); ?>">Listado</a></li>
                              <li><a href="<?php echo site_url('gestores/create'); ?>">Registrar</a></li>
                          </ul>
                      </li>
                      <li class="sub-menu">
                          <a href="javascript:;" >
                              <i class="fa fa-users"></i>
                              <span>Administradores</span>
                          </a>
                          <ul class="sub">
                              <li><a href="<?php echo site_url('administradores/index'); ?>">Listado</a></li>
                              <li><a href="<?php echo site_url('administradores/create'); ?>">Registrar</a></li>
                          </ul>
                      </li>
                      <?php
                      break;
                    case 'ADMIN_COMUNIDAD':
                      # Administrador Global
                      ?>
                      <li class="sub-menu">
                          <a href="javascript:;" >
                              <i class="fa fa-building"></i>
                              <span>Instalaciones</span>
                          </a>
                          <ul class="sub">
                              <li><a href="<?php echo site_url('instalaciones/index'); ?>">Listado</a></li>
                              <li><a href="<?php echo site_url('instalaciones/create'); ?>">Registrar</a></li>
                          </ul>
                      </li>
                      <li class="sub-menu">
                          <a href="javascript:;" >
                              <i class="fa fa-users"></i>
                              <span>Clientes</span>
                          </a>
                          <ul class="sub">
                              <li><a href="<?php echo site_url('clientes/index'); ?>">Listado</a></li>
                              <li><a href="<?php echo site_url('clientes/create'); ?>">Registrar</a></li>
                          </ul>
                      </li>
                      <?php
                      break;
                    case 'USUARIO':
                      # Administrador Global
                      ?>
                      <li class="sub-menu">
                          <a href="<?php echo site_url('reservas/index'); ?>" >
                              <i class="fa fa-calendar"></i>
                              <span>Reservas</span>
                          </a>
                      </li>
                      <li class="sub-menu">
                          <a href="<?php echo site_url('agenda/index'); ?>" >
                              <i class="fa fa-book"></i>
                              <span>Mis Reservas</span>
                          </a>
                      </li>
                      <?php
                      break;
                  } ?>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-user"></i>
                          <span>Cuenta</span>
                      </a>
                      <ul class="sub">
                          <li>
                            <a href="<?php echo site_url('cuenta/index'); ?>">Mi Cuenta</a>
                          </li>
                          <li>
                              <a href="<?php echo site_url('cuenta/update'); ?>">Editar Datos</a>
                          </li>
                          <li>
                              <a href="<?php echo site_url('cuenta/password'); ?>">Cambiar Clave</a>
                          </li>
                          <li class="divider"></li>
                          <li>
                              <a href="<?php echo site_url('cuenta/salir'); ?>">Cerrar Sesi&oacute;n</a>
                          </li>
                      </ul>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->