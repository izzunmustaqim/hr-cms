<!DOCTYPE html>
<html lang="en">
<head><title>City CU Alumni</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/bootstrap/css/bootstrap.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/jquery-lightbox/css/lightbox.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/owl-carousel/owl-carousel/owl.carousel.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/owl-carousel/owl-carousel/owl.theme.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/jquery-circliful/css/jquery.circliful.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/css/themes/style1/cityu.css" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/css/frontend/one-page.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/css/style-responsive.css">
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom" class="frontend-one-page dark-layout"><!--BEGIN PAGE LOADER-->
<div id="page-loader"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/images/icon/preloader.gif" alt=""/></div>
<!--END PAGE LOADER--><!--BEGIN BACK TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP--><!--BEGIN CONTENT-->
<header>

    <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" data-toggle="collapse" data-target=".navbar-main-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="" class="navbar-brand"><i class="fa fa-mortar-board mar-bot20"></i> <span>City</span> Alumni <span>Network</span></a></div>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav main-menu">
                    <li class="page-scroll"><a href="#page-top">Home</a></li>
                    <li class="page-scroll"><a href="#newsletter">Register</a></li>
                    <li class="page-scroll"><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>

    </nav>
    <?php echo $content; ?>

</header>
<footer style="margin-top: 100%;">
    <div class="container"><p class="text-center">Copyright  <?php echo date("Y")?> &copy; City University College Of Science and Technology</p></div>
</footer>
<!--END CONTENT-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/js/html5shiv.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/js/respond.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/isotope/dist/isotope.pkgd.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/jquery.hoverdir.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/modernizr.custom.97074.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/jquery-lightbox/js/lightbox.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu6tm60TzeUo9rWpLnrQ7mrFn4JPMVje4&amp;sensor=false"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/owl-carousel/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/vendors/jquery-circliful/js/jquery.circliful.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/js/jquery-text-effect.js"></script>
<!--Loading script for each page-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/assets/js/jquery.appear.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/assets/plugins/jquery-wow/wow.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/assets/js/one-page_animated.js"></script>
<!--CORE JAVASCRIPT-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alumni/js/frontend-one-page.js"></script>
</body>
</html>