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

// para mudar a quantidade de posts per page da pagina home
function custom_posts_per_page($query) {
    if (is_page('home')) { // Substitua 'sua-pagina' pelo slug ou ID da página desejada
        $query->set('posts_per_page', 8); // Altere o número aqui
    }
}
add_action('pre_get_posts', 'custom_posts_per_page');

//ajax
add_action( 'wp_ajax_ajaxGallery', 'ajaxGallery' );
add_action( 'wp_ajax_nopriv_ajaxGallery', 'ajaxGallery' );

function ajaxGallery() {

  	// Récupération des données du formulaire
  	$page = intval( $_POST['paged'] );
    $category = intval( $_POST['categorie']);
    $format = intval( $_POST['format']);
    $triDate = isset( $_POST['triDate']) ? sanitize_text_field( $_POST['triDate'] ) : ''; // Certifique-se de que triDate está definido e é uma string;

    if ( empty( $triDate ) ) {
        $triDate = 'DESC';
    }  

    $offset = 8 * $page;
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' =>  8,
        'orderby' => 'date', // Purely optional - just for some ordering
        'order' => $triDate, // Ditto
        'offset' => $offset
    );
        
    // Adiciona o filtro de categoria se uma categoria for fornecida
    if ( ! empty( $category ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'id',
            'terms'    => $category,
        );
    }

    // Adiciona o filtro de formato se um formato for fornecido
    if ( ! empty( $format ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'id',
            'terms'    => $format,
        );
    }
    
    $my_query = new WP_Query( $args );

    $html = "";

    if ( $my_query->have_posts() ) {
        while ( $my_query->have_posts() ) {
            $my_query->the_post(); 
            $html .= '<li>';
            if (has_post_thumbnail()) {
                // Affichez l'image en vedette
                $thumbnail = get_the_post_thumbnail();
                $html .= '<a href="' . esc_url(get_permalink()) . '">' . $thumbnail . '</a>';
            }
            //para poder adicionar o template do lightbox
            ob_start();
            get_template_part('templates_part/lightbox');
            $lightbox_content = ob_get_clean();
            $html .= $lightbox_content;

            $html .= '</li>';
        }
    } else {
        wp_send_json_error( '' );
    }
    // 4. On réinitialise à la requête principale (important)
    wp_reset_postdata();

  	// Envoyer les données au navigateur
	wp_send_json_success( $html );
}