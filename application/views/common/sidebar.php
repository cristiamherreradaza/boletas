<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <aside class="main-sidebar" >
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Menu</li>
          <li>
            <a href="<?php echo base_url();?>">
              <i class="fa fa-home"></i> <span>Inicio</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i> <span>Boletas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('boleta');?>"><i class="fa fa-plus"></i> Registro</a></li>
              <li><a href="<?php echo base_url('detalle');?>"><i class="fa fa-search"></i> Listado</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-search-plus"></i>
              <span>Seguimiento</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('detalle/listado/6');?>"><i class="fa fa-circle-o"></i> No Liberadas</a></li>
              <li><a href="<?php echo base_url('detalle/listado/5');?>"><i class="fa fa-circle-o"></i> Liberadas</a></li>
              <li><a href="<?php echo base_url('detalle/listado/4');?>"><i class="fa fa-circle-o"></i> Normal</a></li>
              <li><a href="<?php echo base_url('detalle/listado/1');?>""><i class="fa fa-circle-o"></i> 15 Dias</a></li>
              <li><a href="<?php echo base_url('detalle/listado/2');?>"><i class="fa fa-circle-o"></i> 10 Dias</a></li>
              <li><a href="<?php echo base_url('detalle/listado/3');?>"><i class="fa fa-circle-o"></i> 5 Dias</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url('inicio/usuario');?>">
              <i class="fa fa-user"></i> <span>Usuarios</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
  </aside>
