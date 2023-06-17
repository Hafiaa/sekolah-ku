
<!DOCTYPE html>
<html lang="zxx">
    
<!-- Mirrored from keenitsolutions.com/products/html/edulearn/edulearn-demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2019 07:11:58 GMT -->
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>Sekolah Pintar</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon">
        <!-- bootstrap v4 css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/font-awesome.min.css">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/animate.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/owl.carousel.css">
		<!-- slick css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/slick.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/magnific-popup.css">
		<!-- Offcanvas CSS -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/off-canvas.css">
		<!-- flaticon css  -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>fonts/flaticon.css">
		<!-- flaticon2 css  -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>fonts/fonts2/flaticon.css">
        <!-- rsmenu CSS -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/rsmenu-main.css">
        <!-- rsmenu transitions CSS -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/rsmenu-transitions.css">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>style.css">
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/') ?>css/responsive.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
        	table td{
        		font-size: 14px !important;
        		overflow: hidden;
        	}
        </style>
    </head>
    <body class="home1">
		<!--Preloader area end here-->
		
        <!--Full width header Start-->
		<div class="full-width-header">

		
			
			<!--Header Start-->
			<header id="rs-header" class="rs-header" style="background: #333; color: white !important;">
				
				<!-- Header Top Start -->
				<div class="rs-header-top">
					<div class="container">
						<div class="row">

							<div class="col-md-4 col-sm-12">
						        <div class="header-contact">
						            <div id="info-details" class="widget-text">
                                        <i class="glyph-icon flaticon-email"></i>
						                <div class="info-text">
						                    <a href="#" class="text-white">
						                    	<span class="text-white">Mail Us</span>
												sekolahpintar@gmail.com
											</a>
						                </div>
						            </div>
						        </div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="logo-area text-center">
									<a href="index.html"><img src="<?= base_url('assets/img/sekolah/' . $logo_sekolah ) ?>" style="width: 80px; height: 80px;"  alt="logo"></a><br><h3 style="text-shadow: 1px 1px 1px black; color: white;">Sekolah Pintar</h3>
								</div>

							</div>
							<div class="col-md-4 col-sm-12">
								

						        <div class="header-contact pull-right">
						            <div id="phone-details" class="widget-text">
						                <i class="glyph-icon flaticon-phone-call"></i>
						                <div class="info-text">
						                    <a href="#" class="text-white">
						                    	<span class="text-white">Call Us</span>
												085887721889
											</a>
						                </div>
						            </div>
						        </div>
								
							</div>
						</div>				
					</div>
				</div>
				<!-- Header Top End -->
	
				<!-- Menu Start -->
				<div class="menu-area menu-sticky">
					<div class="container">
						<div class="main-menu">
							<div class="row">
								<div class="col-sm-12">
									<!-- <div id="logo-sticky" class="text-center">
										<a href="index.html"><img src="images/logo.png" alt="logo"></a>
									</div> -->
									<a class="rs-menu-toggle"><i class="fa fa-bars"></i>Menu</a>
									<nav class="rs-menu">
										<ul class="nav-menu">
											<?php $link = $this->uri->segment(2) ?>
											<li class="menu-item-has-children <?= $link == 'dashboard' ? 'active' : '' ?>"> <a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
		                                    <li class="menu-item-has-children <?= $link == 'siswa' ? 'active' : '' ?>"> <a href="<?= base_url('user/siswa') ?>"> <i class="fa  fa-user"></i> Siswa</a>
		                                    <li class="menu-item-has-children <?= $link == 'broadcast' ? 'active' : '' ?>"> <a href="<?= base_url('user/broadcast') ?>"> <i class="fa fa-bullhorn"></i> Pemberitahuan</a>
		                                    <li class="menu-item-has-children <?= $link == 'tentang_kami' ? 'active' : '' ?>"> <a href="<?= base_url('user/tentang_kami') ?>">Tentang Kami</a>
										</ul>
									</nav>
                                    <div class="right-bar-icon rs-offcanvas-link text-right">
                                        <a class="hidden-xs rs-search" href="<?= base_url('auth') ?>"><i class="fa fa-sign-in"></i></a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Menu End -->
			</header>
			<!--Header End-->

		</div>
        <!--Full width header End-->


        <div style="min-height: 450px !important; padding-top: 50px;">
		
		