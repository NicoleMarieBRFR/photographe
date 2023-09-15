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

        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main page-contact">
                    <article class="container">
                        <div class="page-item">
                            <?php while (have_posts()) : the_post(); ?>
                            <div class="page-description">
                                <h2 class="page-title">
                                    <?php 
                                        echo single_post_title();
                                    ?>
                                </h2>
                                <div>
                                    <p>Référence : <?php echo esc_html( get_field('Référence') ); ?></p>
                                    <!-- categorie -->
                                    <?php
                                        $terms = get_the_terms( get_the_ID(), 'categorie', false );
                                                                
                                        if ( $terms && ! is_wp_error( $terms ) ) : 

                                            $categorie_links = array();

                                            foreach ( $terms as $term ) {
                                                $categorie_links[] = $term->name;
                                            }
                                                                
                                            $categories = join( ", ", $categorie_links );
                                            ?>

                                            <p><?php printf( 'Catégorie : %s', esc_html( $categories ) ); ?></p>
                                        <?php endif; ?>
                                        <!-- format -->
                                        <?php
                                            $terms = get_the_terms( get_the_ID(), 'format' );
                                                                    
                                            if ( $terms && ! is_wp_error( $terms ) ) : 

                                                $format_links = array();

                                                foreach ( $terms as $term ) {
                                                    $format_links[] = $term->name;
                                                }
                                                                    
                                                $formats = join( ", ", $format_links );
                                                ?>

                                                <p><?php printf( 'Format : %s', esc_html( $formats ) ); ?></p>
                                        <?php endif; ?>
                                    <p>Type : <?php echo esc_html( get_field('Type') ); ?></p>
                                    <p>ANNÉE : <?php $post_date = get_the_date('Y'); echo $post_date; ?></p>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            <div class="page-img">
                                <?php if (has_post_thumbnail()): ?>
                                    <img src="<?php the_post_thumbnail_url(array(500, 500)); ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php endif; ?>  
                                <?php the_content(); ?>                             
                            </div>
                        </div>
                        <section class="section-contact">
                            <div class="item">
                                <h3>Cette photo vous intéresse ?</h3>
                                <button>Contact</button>
                            </div>
                            <div class="item">

                            </div>
                        </section>
                    </article>
                </main>
            </div>
        </div>

<?php get_footer(); ?>