{{ get_doctype() }}
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ application.name }}</title>
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="/global/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/themes/my.theme/css/style.css" />
    <!-- Page Level CSS -->
    {{ assets.outputCss() }}
    <style>
        .header {
            background: url('assets/themes/{{ application.theme_name }}/img/bg.png') no-repeat center center scroll;
        }
    </style>
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
    {% block content %}{% endblock %}
    </header>
    {{ assets.outputJs() }}    
    <!-- Global JS -->
    <script type="text/javascript" src="///ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/global/js/bootstrap.min.js"></script>
    <!-- Page Level JS -->
    {{ assets.outputJs() }}
</body>
</html>