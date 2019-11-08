<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gorgeous
 */
?>
<?php #header('X-Frame-Options: SAMEORIGIN'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<title>Gorgeous</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<link rel="stylesheet" href="">
	<!--[if lt IE 9]>
	<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/image/favicon.ico">
    
    <?php wp_head(); ?>

</head>

<body>
    <div id="notify" class="notify" data-notification-status=""></div>
	<div id="main-container" class="main-container">
		
		<!--index cover-->
        <?php get_template_part('layout/component/cover-image'); ?>
		