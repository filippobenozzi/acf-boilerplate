<!DOCTYPE html>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]><body class="ie7"><![endif]-->
<!--[if IE 8 ]><body class="ie8"><![endif]-->
<!--[if IE 9 ]><body class="ie9"><![endif<]-->
<!--[ifload (gt IE 9)|!(IE)]><!--><!--<![endif]-->

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">

    <?php wp_head(); ?>
    <meta name="keywords" content="#" />

    <meta name="author" content="Dinamiza">
    <meta name="Copyright" content="Copyright 2017 Dinamiza">

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/common/img/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/common/img/apple-touch-icon.png">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="common/js/html5.js"></script>
    <![endif]-->

</head>

<body lang="it">

    <section id="infocontent" style="display: none">
        <h3><a href="http://www.dinamiza.it/" target="_blank" title="Web agency">Dinamiza</a></h3>
    </section><!--infocontent-->

    <?php render_theme_block('navbar'); ?>