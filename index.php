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
                <div class="container">
                    <section id="content-hero">
                        <div class="">
            index   
                        </div>
                    </section>
                    <?php get_sidebar(); ?>
                </div>
            </main>
        </div>
        
    </div>

<?php get_footer(); ?>
