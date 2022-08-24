<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $app['app_name'];?> | Administrator</title>
    <link rel="icon" href="data:image/jpeg;base64,<?php echo base64_encode($app['app_favicon']);?>" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/nucleo/css/nucleo.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/fortawesome/css/all.min.css');?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/dataTables.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/buttons.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/select.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/argon.min.css');?>" type="text/css">
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

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="<?php echo base_url();?>">
                    <small><b><?php echo $app['app_name'];?></b></small>
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                       <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>about">
                                <i class="fa fa-globe text-primary"></i>
                                <span class="nav-link-text">About Site</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-news">
                                <i class="fa fa-th-large text-primary"></i>
                                <span class="nav-link-text">Master</span>
                            </a>
                            <div class="collapse" id="navbar-master">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>product" class="nav-link">Product</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>news" class="nav-link">News</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>promo" class="nav-link">Promo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>career" class="nav-link">Career</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>credit" class="nav-link">Status Credit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>work" class="nav-link">Worklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>sallary" class="nav-link">Sallary</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>payment" class="nav-link">Payment Channel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>province" class="nav-link">Province</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>city" class="nav-link">City</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>district" class="nav-link">Sub District</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>apply">
                                <i class="fa fa-shopping-cart text-primary"></i>
                                <span class="nav-link-text">Credit Apply</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>user">
                                <i class="fa fa-users text-primary"></i>
                                <span class="nav-link-text">Users</span>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>admin">
                                <i class="fa fa-user-circle text-primary"></i>
                                <span class="nav-link-text">Administrator</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>logout">
                                <i class="fa fa-sign-out-alt text-primary"></i>
                                <span class="nav-link-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
	<!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-md-auto"></ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold"><i class="fa fa-user-circle"></i> <?php echo $admin['admin_fullname'];?> <i class="fa fa-chevron-down"></i></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 <a href="<?php echo base_url(); ?>profile" class="dropdown-item">
                                    <i class="fa fa-user"></i>
                                    <span>Change Profile</span>
                                </a>
                                <a href="<?php echo base_url(); ?>changepassword" class="dropdown-item">
                                    <i class="fa fa-lock"></i>
                                    <span>Change Password</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo base_url(); ?>logout" class="dropdown-item">
                                    <i class="fa fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>