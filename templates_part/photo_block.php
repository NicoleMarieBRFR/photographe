<?php       

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

    // The Loop.
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
            echo '</li>';
        }
        echo '</ul>';
    } else {
        esc_html_e( 'Aucun article correspondant trouvé.' );
    }

    // wp_reset_postdata();
?>