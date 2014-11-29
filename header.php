<!DOCTYPE html>
<html>
<head>
    <title><?php
 $onTeenusePost = false;

 bloginfo('name'); print ' | ';
 $hcat = get_the_category();
 $cat = '';
 if (isset($hcat[0])) {
   $cat = $hcat[0]->term_id;
 }
 if ($cat == constant('TEENUSE_KATEGOORIA')) {
    $onTeenusePost = true;
    print mb_ucfirst( mb_convert_case(get_the_title(), MB_CASE_LOWER, "UTF-8"), 'utf8' );
 } else {
   bloginfo('description');
 }
    ?>
    </title>

    <meta name="robots" content="noindex, nofollow" />
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0"/>

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <!-- ie9+ rendering support for latest standards -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link type="image/png" rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.png"/>

    <?php //if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- Bootboxxx dependencies -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/addition/bootstrap.css" />

    <script type="text/javascript" src="<?php bloginfo('template_url');?>/addition/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url');?>/addition/bootbox.js"></script>


    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/screen.css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,600' rel='stylesheet' type='text/css' />


    <script type="text/javascript" src="<?php bloginfo('template_url');?>/addition/jqUDraggableExp.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url');?>/addition/jquery_udraggable.js"></script>

    <script type="text/javascript" src="<?php bloginfo('template_url');?>/addition/js.js"></script>
</head>
<body>
  <div id="pwrap">
