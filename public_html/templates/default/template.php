<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project-BK</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=BASE_URL;?>templates/<?=THEME_NAME;?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=BASE_URL;?>templates/<?=THEME_NAME;?>/css/style.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
        .header {
            background: url('<?=BASE_URL;?>templates/<?=THEME_NAME;?>/img/bg.png') no-repeat center center scroll;
        }
    </style>
    <?php $application->assets->outputJs('header') ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Header -->
    <header id="top" class="header">
        <?php echo CONTENT ?>
    </header>

    <!-- jQuery Version 2.1.1 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=BASE_URL;?>templates/<?=THEME_NAME;?>/js/bootstrap.min.js"></script>
</body>
</html>
