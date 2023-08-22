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
                        <div class="page-item">
                            <?php 
                                while( have_posts() ) : the_post();
                                the_content();
                                endwhile;
                            ?>                                
                        </div>
                </main>
            </div>
        </div>

<?php get_footer(); ?>