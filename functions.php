<?php

define( 'THEME_VERSION', '0.0.1' );
define( 'CACHE_VERSION', '0.0.2' );

define( 'RESOURCE_VER', THEME_VERSION.CACHE_VERSION);

// Debug
ini_set('display_errors', true);
error_reporting(E_ALL); 

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/modules/options-framework/' );
require_once dirname( __FILE__ ) . '/modules/options-framework/options-framework.php';

/**
 * Load front-end static resource
 */
function theme_scripts() {
    wp_enqueue_script( 'loading', get_template_directory_uri().'/assets/js/loading-check.js', array(), RESOURCE_VER, true );
    wp_enqueue_script( 'lib', get_template_directory_uri().'/assets/js/lib.js', array(), RESOURCE_VER, true );
    wp_enqueue_script( 'main', get_template_directory_uri().'/assets/js/main.js', array(), RESOURCE_VER, true );
    wp_localize_script( 'main', 'Poi' , 
    array(
		'ajaxurl'       => admin_url('admin-ajax.php'),
		'order'         => get_option('comment_order'), // ajax comments
	));
}

function theme_stylesheets() {
    wp_enqueue_style( 'style', get_template_directory_uri().'/assets/css/style.css', array(), RESOURCE_VER );
    wp_enqueue_style( 'lib', get_template_directory_uri().'/assets/css/lib.css', array(), RESOURCE_VER );
    wp_enqueue_style( 'md', get_template_directory_uri().'/assets/css/github-markdown.css', array(), RESOURCE_VER );
    wp_enqueue_style( 'notifications', get_template_directory_uri().'/assets/css/notifications.css', array(), RESOURCE_VER );
    wp_enqueue_style( 'font-awesome', '//cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css', array(), RESOURCE_VER );
    wp_enqueue_style( 'icon-font', '//at.alicdn.com/t/font_1036641_ecwc5ed6ds8.css', array(), RESOURCE_VER );
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );
add_action( 'wp_enqueue_scripts', 'theme_stylesheets' );

require_once get_template_directory() . '/modules/functions/env-setup.php'; 
require_once get_template_directory() . '/modules/functions/comment-modules.php'; 
require_once get_template_directory() . '/modules/functions/convertors.php'; 
//require_once get_template_directory() . '/modules/functions/customize-style.php'; 

// allowed tags
function poi_add_allowed_tags($tags) {
    $tags['time'] = array(
        'datetime' => true,
    );
    $tags['span'] = array(
        'class' => true,
        'id' => true
    );
    $tags['a'] = array(
        'class' => true,
        'id' => true,
        'href' => true
    );
    $tags['img'] = array(
        'class' => true,
        'id' => true,
        'src' => true
    );
    return $tags;
}
add_filter('wp_kses_allowed_html', 'poi_add_allowed_tags');


//EOF