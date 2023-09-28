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
                <main id="main" class="site-main page-single-photo">
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
                                    <p>Categorie : <?php echo get_the_terms( get_the_ID(), 'categorie', false )[0]->name; ?></p>
                                    <p>Format : <?php echo get_the_terms( get_the_ID(), 'format', false )[0]->name; ?></p>
                                    <p>Type : <?php echo esc_html( get_field('Type') ); ?></p>
                                    <p>ANNÉE : <?php $post_date = get_the_date('Y'); echo $post_date; ?></p>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            <div class="page-img">
                                <?php the_content(); ?>                             
                            </div>
                        </div>
                        <section class="section-contact">
                            <div class="item">
                                <h3>Cette photo vous intéresse ?</h3>
                                <button onClick="go('<?php echo esc_html( get_field('Référence')); ?>');" class="cd-popup-trigger">Contact</button>
                            </div>
                            <div class="item">
                                <div class="previous">
                                    <?php
                                        $prev_post = get_previous_post();
                                        $next_post = get_next_post();
                                        // $id = get_post_thumbnail_id();
                                        // $thumb = get_the_post_thumbnail( $id, 'post-thumbnail' );
                                        $thumbnailUrl = get_the_post_thumbnail_url($prev_post->ID, "thumbnail");
                                        $image_html = get_the_post_thumbnail_url(get_the_ID(),'full'); // affiche seulemment le lien
                                        
                                        if ( ! empty( $prev_post ) ): ?>
                                            <?php echo apply_filters( 'the_title', $prev_post->post_title ); ?>
                                            <?php echo apply_filters( 'post_thumbnail_html', $prev_post->ID ); ?>


                                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                                <img src="<?php echo the_post_thumbnail_url($prev_post->ID); ?>" alt="<?php the_title_attribute(); ?>" />
                                            <
                                            </a>
                                    <?php endif; ?>
                                </div>
                                <div class="next">
                                    <?php
                                        if ( ! empty( $next_post ) ): ?>
                                                <?php echo apply_filters( 'the_title', $next_post->post_title ); ?>
                                                <?php echo $thumb ?>
                                            <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                            >
                                            </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h2> Vous aimerez aussi </h2>
                            <div>
                            <?php
                                $loop = new WP_Query( array( 
                                    'post_type' => 'photo', 
                                    'category_name' => get_the_terms( get_the_ID(), 'categorie', false )[0]->name, // Whatever the category ID is for your aerial category
                                    'posts_per_page' =>  2,
                                    'orderby' => 'date', // Purely optional - just for some ordering
                                    'order' => 'DESC' // Ditto
                                ) );

                                // The Loop.
                                if ( $loop->have_posts() ) {
                                    echo '<ul>';
                                    while ( $loop->have_posts() ) {
                                        $loop->the_post();
                                        echo '<li>' . esc_html( get_the_title() ) . '</li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    esc_html_e( 'Sorry, no posts matched your criteria.' );
                                }

                                while ( $loop->have_posts() ) : 
                                    $loop->the_post();
                                endwhile; 
                            ?>

                            </div>
                            
                        </section>
                    </article>
                </main>
            </div>
        </div>

<?php get_footer(); ?>