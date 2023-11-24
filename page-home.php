<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <?php get_header(); ?>

    <div id="page" class="site">

        <div id="content" class="site-content">
            <main id="main" class="site-main">
                <?php 
                    $hero_title = get_theme_mod( 'set_hero_title', 'Please, type some title' );
                    $hero_color_h1 = get_theme_mod( 'colors' );     

                    query_posts(
                        array(
                            'post_type' => 'photo', // Assurez-vous que 'photo' correspond à votre type de contenu personnalisé
                            'showposts' => 1,
                            'orderby' => 'rand',
                        )
                    );

                    // Vérifiez s'il y a des articles
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            // Récupérez l'URL de l'image depuis le champ personnalisé (remplacez 'image_url' par le nom correct de votre champ d'image)
                            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');


                            // Affichez votre héros avec l'image aléatoire en arrière-plan
                            ?>
                            <section id="content-hero" style="background-image: url('<?php echo esc_url($image_url); ?>'); ?>');">
                                <!-- Le contenu de votre héros -->
                                <div class="hero-items">
                                    <h1 style="-webkit-text-stroke: 0.5px <?php echo $hero_color_h1; ?>;"> <?php echo nl2br( $hero_title );?></h1>
                                </div>
                            </section>
                            <?php
                        endwhile;
                    else :
                        // Aucun article correspondant trouvé
                        echo esc_html_e('Aucune photo trouvée.');
                    endif;

                    // Réinitialisez la requête
                    wp_reset_query();
                ?>
            </main>
        </div>
        
    </div>

    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <section id="all-photos">
                <div class="container">
                    <div class="filters">

                        <div class="filters-left">
                            <div class="item">
                                <select name="event-dropdown" id="cat"  data-ajaxurl="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"> 
                                    <option value=""><?php echo esc_attr_e( 'Catégories', 'textdomain' ); ?></option> 
                                    <?php 
                                        $categories = get_categories( array(
                                            'taxonomy' => 'categorie',
                                            'orderby' => 'name',
                                            'order'   => 'ASC'
                                            ) );
            
                                    foreach ( $categories as $category ) {
                                        printf( '<option value="%1$s">%2$s</option>',
                                            esc_attr( $category->term_id ),
                                            esc_html( $category->name )
                                        );
                                    }
                                    ?>
                                </select>
                            </div>
    
                            <div class="item">
                                <select name="event-dropdown" id="format" data-ajaxurl="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"> 
                                    <option value=""><?php echo esc_attr_e( 'Format', 'textdomain' ); ?></option> 
                                    <?php 
                                        $categories = get_categories( array(
                                            'taxonomy' => 'format',
                                            'orderby' => 'name',
                                            'order'   => 'ASC'
                                            ) );
            
                                    foreach ( $categories as $category ) {
                                        printf( '<option value="%1$s">%2$s</option>',
                                            esc_attr( $category->term_id ),
                                            esc_html( $category->name )
                                        );
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="filters-right">
    
                        </div>
    
                    </div>
                    
                    <div class="photos-home">
                        <?php get_template_part('templates_part/photo_block'); ?>
                    </div>
                    <div class="related_button m-rp">
                        <button class="button_style" data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>" >Charger plus</button>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php get_footer(); ?>