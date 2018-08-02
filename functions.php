<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

add_theme_support( 'title-tag' );

function posmon_scripts() {
    // Register Styles
    wp_register_style( 'w3-columns', "https://www.w3schools.com/w3css/4/w3.css", array(), '1.0' );
    wp_register_style( 'animateCSS', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css", array(), '1.0' );
    wp_register_style( 'google-font', "https://fonts.googleapis.com/css?family=Comfortaa:300,400,700", array(), '1.0' );
    wp_register_style( 'bootstrap', get_template_directory_uri() . "/css/bootstrap.min.css", array(), '1.0' );
    wp_register_style( 'flexslider', get_template_directory_uri() . "/css/flexslider.css", array(), '1.0' );
    wp_register_style( 'font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css", array(), '1.0' );
    wp_register_style( 'main-styles', get_template_directory_uri() . "/css/estilos.css", array(), '1.0' );

    wp_register_style( 'posmon-styles', get_stylesheet_uri(), array(), '1.0' );


    // Enqueue Styles
    wp_enqueue_style( 'posmon-styles' );
    wp_enqueue_style( 'w3-columns' );
    wp_enqueue_style( 'animateCSS' );
    wp_enqueue_style( 'font-awesome' );
    wp_enqueue_style( 'google-font' );
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'flexslider' );
    wp_enqueue_style( 'main-styles' );

    // Register Scripts
    wp_register_script(  'smoothScroll', get_template_directory_uri() . "/js/SmoothScroll.min.js", array(), '1.0', true);
    wp_register_script(  'flexsliderJs', get_template_directory_uri() . "/js/jquery.flexslider-min.js", array(), '1.0', true);
    wp_register_script(  'mainScripts', get_template_directory_uri() . "/js/scripts.js", array(), '1.0', true);

    // Enqueue Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('smoothScroll');
    wp_enqueue_script('flexsliderJs');
    wp_enqueue_script('mainScripts');
}

add_action( 'wp_enqueue_scripts', 'posmon_scripts' );
