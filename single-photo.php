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
                                <h2 class="page-title m-rp">
                                    <?php 
                                        echo single_post_title();
                                    ?>
                                </h2>
                                <div class="m-rp">
                                    <p>Référence : <?php echo esc_html( get_field('Référence') ); ?></p>
                                    <p>Categorie : <?php echo get_the_terms( get_the_ID(), 'categorie', false )[0]->name; ?></p>
                                    <p>Format : <?php echo get_the_terms( get_the_ID(), 'format', false )[0]->name; ?></p>
                                    <p>Type : <?php echo esc_html( get_field('Type') ); ?></p>
                                    <p>ANNÉE : <?php $post_date = get_the_date('Y'); echo $post_date; ?></p>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            <div class="page-img m-rp">
                                <?php the_content(); ?>                             
                            </div>
                        </div>
                        <section class="section-contact">
                            <div class="item first">
                                <h3>Cette photo vous intéresse ?</h3>
                                <button onClick="go('<?php echo esc_html( get_field('Référence')); ?>');" class="cd-popup-trigger button_style">Contact</button>
                            </div>
                            <div class="item sec">
                                <div class="previous">
                                    <?php
                                        $prev_post = get_previous_post();
                                        $prev_post_id = $prev_post ? $prev_post->ID : 0;
                                        $prev_post_thumbnail = get_the_post_thumbnail_url($prev_post_id, 'thumbnail');
                                        
                                        if ( ! empty( $prev_post ) ): ?>
                                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                                <img src="<?php echo $prev_post_thumbnail; ?>" alt="<?php the_title_attribute(); ?>" />
                                                <svg width="26" height="8" viewBox="0 0 26 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.646447 3.64645C0.451184 3.84171 0.451184 4.15829 0.646447 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659728 4.53553 0.464466C4.34027 0.269204 4.02369 0.269204 3.82843 0.464466L0.646447 3.64645ZM1 4.5H26V3.5H1V4.5Z" fill="black"/>
                                                </svg>
                                            </a>
                                    <?php endif; ?>
                                </div>
                                <div class="next">
                                    <?php
                                        $next_post = get_next_post();
                                        $next_post_id = $next_post ? $next_post->ID : 0;
                                        $next_post_thumbnail = get_the_post_thumbnail_url($next_post_id, 'thumbnail');

                                        if ( ! empty( $next_post ) ): ?>
                                            <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                            <img src="<?php echo $next_post_thumbnail; ?>" alt="<?php the_title_attribute(); ?>" />
                                            <svg width="26" height="8" viewBox="0 0 26 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M25.3536 3.64645C25.5488 3.84171 25.5488 4.15829 25.3536 4.35355L22.1716 7.53553C21.9763 7.7308 21.6597 7.7308 21.4645 7.53553C21.2692 7.34027 21.2692 7.02369 21.4645 6.82843L24.2929 4L21.4645 1.17157C21.2692 0.976311 21.2692 0.659728 21.4645 0.464466C21.6597 0.269204 21.9763 0.269204 22.1716 0.464466L25.3536 3.64645ZM25 4.5H0V3.5H25V4.5Z" fill="black"/>
                                            </svg>
                                            </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </section>
                        <section id="related">
                            <h2 class="m-rp"> Vous aimerez aussi </h2>
                            <div class="related-post photo_items">
                                <?php get_template_part('templates_part/photo_block', 'photo', array('type'=>'single')); ?>
                                <?php get_template_part('templates_part/lightbox'); ?>
                            </div>
                            <div class="related_button m-rp">
                                <button class="button_style">Toute les photos</button>
                            </div>                         
                        </section>
                    </article>
                </main>
            </div>
        </div>

<?php get_footer(); ?>