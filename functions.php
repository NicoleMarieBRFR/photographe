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

// last link menu
add_filter( 'wp_nav_menu_items', 'prefix_add_menu_item', 10, 2 );
function prefix_add_menu_item ( $items, $args ) {
   if($args->theme_location == 'photographe_main_menu') {
       $items_array = array();
               while ( false !== ( $item_pos = strpos ( $items, '<li', 10 ) ) ) // Add the position where the menu item is placed
               {
                   $items_array[] = substr($items, 0, $item_pos);
                   $items = substr($items, $item_pos);
               }
               $items_array[] = $items;
               array_splice($items_array, 2, 0, '<li><a class="cd-popup-trigger">Contact</a></li>'); // insert custom item after 1
       
               $items = implode('', $items_array);
            }  
              
              return $items;
}
