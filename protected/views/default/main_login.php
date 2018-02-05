<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HRSM - Human Resource Management System</title>

    <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/styles/pages/auth.min.css">
</head>
<body style="background-image: url('<?php echo Yii::app()->request->baseUrl; ?>/themes/hr-cover/assets/img/parallax/parallax-2.jpg')">

<?php echo $content?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/jquery/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/tether/js/tether.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>