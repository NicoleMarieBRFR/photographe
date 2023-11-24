<?php
//COMECA AQUI
    global $post;
    
    if (is_page() && $post->post_name === 'home') {
        // Código a ser executado para a página home (slug 'home')
        echo "Código para a página inicial (page-home.php)";

        $loop = new WP_Query( array( 
            'post_type' => 'photo',
            'posts_per_page' =>  8,
            'orderby' => 'date', // Purely optional - just for some ordering
            'order' => 'DESC' // Ditto
        ) );   
        set_query_var( 'loop', $loop );

        // tenho que fazer o mesmo para o ajax
    } elseif (is_page() && $post->post_name === 'home') {
        // 1. On définit les arguments pour définir ce que l'on souhaite récupérer
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' =>  8,
            'orderby' => 'date', // Purely optional - just for some ordering
            'order' => 'DESC' // Ditto
        );

        // 2. On exécute la WP Query
        $my_query = new WP_Query( $args );


    } elseif ($args['type'] == 'single') {
        // Código a ser executado para a página single (slug 'single')
        echo "Código para a página de detalhes (single-photo.php)";
        $category_slug = get_the_terms( get_the_ID(), 'categorie', false )[0]->slug;
        $loop = new WP_Query( array( 
            'post_type' => 'photo',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie', // Remplacez 'votre_taxonomie' par le nom de votre taxonomie personnalisée
                    'field' => 'slug', // Vous pouvez utiliser 'id', 'slug' ou 'name' pour le champ
                    'terms' => $category_slug, // Remplacez 'votre_terme' par le terme que vous souhaitez cibler
                ),
            ),
            'posts_per_page' =>  2,
            'orderby' => 'date', // Purely optional - just for some ordering
            'order' => 'DESC' // Ditto
        ) );   
        set_query_var( 'loop', $loop );
    } else {
        // Código padrão a ser executado para outros casos
        echo $post->$post_type;
    }

// The Loop (the same code).
        if ( $loop->have_posts() ) {
            echo '<ul>';
            while ( $loop->have_posts() ) {
                $loop->the_post(); 
                echo '<li>';
                if (has_post_thumbnail()) {
                    // Affichez l'image en vedette
                    $thumbnail = get_the_post_thumbnail();
                    echo '<a href="' . esc_url(get_permalink()) . '">' . $thumbnail . '</a>';
                }
                echo get_template_part('templates_part/lightbox');
                echo '</li>';
            }
            echo '</ul>';
        } else {
            esc_html_e( 'Aucun article correspondant trouvé.' );
        }
        // 4. On réinitialise à la requête principale (important)
        wp_reset_postdata();
    
?>