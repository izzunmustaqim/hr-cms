
<!DOCTYPE html>
<html lang="en" style="height: 100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error Pages - Student Portal CityU (SPC)</title>
    <!-- PACE-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/plugins/PACE/themes/blue/pace-theme-flash.css">
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/plugins/PACE/pace.min.js"></script>
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/plugins/bootstrap/dist/css/bootstrap.min.css">
    <!-- Fonts-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/plugins/themify-icons/themify-icons.css">
    <!-- Primary Style-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/build/css/first-layout.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-image: url(<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/build/images/backgrounds/16.jpg)" class="body-bg-full">
<div class="container page-container">
    <div class="page-content">
        <div class="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/build/images/logo/logo-sm-light.png" alt="" width="80"></div>
        <h1 style="font-size: 130px" class="m-0 text-muted fw-300">5<i class="ti-face-sad fs-100"></i><i class="ti-face-sad fs-100"></i></h1>
        <h4 class="fs-16 text-white fw-300">Unexpected Error!</h4>
        <p class="text-muted mb-15">An error occurred and your request couldn't be completed. No worry, we fetch your ip details and the error :)</p><a href="<?php echo Yii::app()->request->baseUrl; ?>" role="button" style="width: 130px" class="btn btn-primary btn-rounded">Return home</a>
    </div>
</div>
<!-- jQuery-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap JavaScript-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom JS-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/build/js/first-layout/extra-demo.js"></script>
</body>
</html>