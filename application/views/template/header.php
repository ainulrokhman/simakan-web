<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Simakan | Administrator</title>
    <link rel="icon" href="<?php echo base_url('assets/images/logo.png');?>" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/nucleo/css/nucleo.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/fortawesome/css/all.min.css');?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/dataTables.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/buttons.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/select.bootstrap4.min.css');?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/argon.min.css');?>" type="text/css"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/argon-dashboard.css?v=2.0.4');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css');?>" type="text/css">
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
	
	<!-- Fancybox -->
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	
	
	<script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js');?>"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?php echo base_url();?>">
        <img src="<?php echo base_url('assets/images/logo.png');?>" style="width:100px" />
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="height:auto;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo base_url();?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-home text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url();?>planing">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-calendar text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Planing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url();?>organizing">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-chart-pie text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Organizing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url();?>controlling">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-keyboard text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Controlling</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url();?>actuating">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-file-pdf text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Actuating</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master Data</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url();?>siswa">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Siswa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url();?>guru">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user-tie text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Guru</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center" style="margin-right:20px;">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-sm-1"></i> <span class="d-sm-inline d-none"><?php echo $admin['admin_name'];?></span>&nbsp;&nbsp; <i class="fa fa-chevron-down cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="<?php echo base_url();?>profile">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<span class="font-weight-bold">Profil</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="<?php echo base_url();?>profile/changepassword">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;<span class="font-weight-bold">Ganti Kata Sandi</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="<?php echo base_url();?>logout">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;<span class="font-weight-bold">Keluar</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">