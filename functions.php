<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

add_theme_support( 'title-tag' );

add_image_size('product_thumbnail', 78, 78, true );

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
    wp_register_script(  'jPages', get_template_directory_uri() . "/js/jPages.min.js", array(), '1.0', true);
    wp_register_script(  'touchSwipe', get_template_directory_uri() . "/js/jquery.touchSwipe.min.js", array(), '1.0', true);
    wp_register_script(  'mainScripts', get_template_directory_uri() . "/js/mainScripts.js", array(), '1.0', true);

    // Enqueue Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('smoothScroll');
    wp_enqueue_script('flexsliderJs');
    wp_enqueue_script('jPages');
    wp_enqueue_script('touchSwipe');
    wp_enqueue_script('mainScripts');

    wp_localize_script( 
        'mainScripts',
        'rest_api_route',
        array(
            'url' => rest_url( '/wp/v2/productos/' ),
        )
    );
}

add_action( 'wp_enqueue_scripts', 'posmon_scripts' );

add_action( 'rest_api_init', 'posmon_rest_api' );

function posmon_rest_api() {
    register_rest_field(
        'productos',
        'genero',
        array(
            'get_callback'      => 'posmon_producto_genero',
            'schema'            => null,
            'update_callback'   => null,
        )
    );
    register_rest_field(
        'productos',
        'desc',
        array(
            'get_callback'      => 'posmon_producto_desc',
            'schema'            => null,
            'update_callback'   => null,
        )
    );
    register_rest_field(
        'productos',
        'opciones',
        array(
            'get_callback'      => 'posmon_producto_opciones',
            'schema'            => null,
            'update_callback'   => null,
        )
    );
    register_rest_field(
        'productos',
        'galeria',
        array(
            'get_callback'      => 'posmon_producto_galeria',
            'schema'            => null,
            'update_callback'   => null,
        )
    );

}


function posmon_producto_genero () {
    global $post;
    $post_id = $post->ID;

    return get_post_meta( $post_id, 'posmon_campos_productos_genero_producto', true );
}

function posmon_producto_desc () {
    global $post;
    $post_id = $post->ID;

    $desc = get_post_meta( $post_id, 'posmon_campos_productos_desc_producto', true );

    if ( isset( $desc )  ) {
        return wpautop( $desc );

    } else {

        return '';
    }
    
}

function posmon_producto_opciones () {
    global $post;
    $post_id = $post->ID;

    $opciones = get_post_meta( $post_id, 'posmon_campos_productos_opciones_producto', true );

    if ( isset( $opciones )  ) {
        return $opciones;

    } else {

        return '';
    }
}

function posmon_producto_galeria () {
    global $post;
    $post_id = $post->ID;

    $metabox = get_post_meta( $post_id, 'posmon_campos_productos_galeria_producto', true );

    if ( $metabox != ""  ) {
        $galery = array();
        $thumbnails = array();
    
        foreach ( (array) $metabox as $key => $value) {
            $galery[] = $value;
            $thumbnails[] = wp_get_attachment_image_src( $key, 'product_thumbnail');
        }
    
        $result = array(
            "galeria"       => $galery,
            "thumbnails"    => $thumbnails,
        );
    
        return $result;
    } else {
        return '';
    }

}


function posmon_menus(){

    register_nav_menus( array(
        'social_menu' => __('Menú Social ', 'posmon'),
    ));

}

add_action( 'init', 'posmon_menus' );


// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'edit.php' );
}

// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-post');
}

add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

/**
 * Hide editor on specific pages.
 *
 */
add_action( 'admin_head', 'hide_editor' );

function hide_editor() {

    global $pagenow;
    if( !( 'post.php' == $pagenow ) ) return;

    global $post;
    // Get the Post ID.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;

    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if($template_file == 'insumos.php'){
    remove_post_type_support('page', 'editor');
    }
}