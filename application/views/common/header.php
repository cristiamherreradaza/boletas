<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Boletas</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/datable/datatables.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css');?>">
</head>
<body class="sidebar-mini wysihtml5-supported skin-purple sidebar-collapse fixed">
  <div class="wrapper">
      <header class="main-header">
        <img src="<?php echo base_url('assets/img/head.png');?>">  
        <a href="#" class="logo">
          <span class="logo-mini"><b>SAC</b>B</span>
          <span class="logo-lg"><b>SAC - </b>B</span>
        </a>
        <nav class="navbar navbar-static-top">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="<?php echo base_url('inicio/usuario/').$this->session->userdata('id_usuario');?>" class="dropdown-toggle">
                  <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata('username')?></span>
                </a>
              </li>
              <li>
              <a href="<?php echo base_url('inicio/logout')?>"><i class="fa fa-close"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    