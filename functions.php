<?php 

require get_template_directory() . '/inc/customizer.php';

function photographe_load_style(){
    wp_enqueue_style( 'template.css', get_template_directory_uri() . '/css/template.css'); 
    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);    
    wp_enqueue_script('scripts');   
}
add_action( 'wp_enqueue_scripts', 'photographe_load_style' );

function photographe_config(){
    // menus
    register_nav_menus(
        array(
            'photographe_main_menu' => 'Main Menu',
            'photographe_footer_menu' => 'Footer Menu'
        )
    );
    // logo
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 1100,
        'flex-height' => true,
        'flex-width'  => true
    ) );
}
add_action( 'after_setup_theme', 'photographe_config', 0 );