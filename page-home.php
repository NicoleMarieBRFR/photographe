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
                    $hero_img = wp_get_attachment_url( get_theme_mod( 'set_hero_background' ) );  
                ?>
                <section id="content-hero" style="background-image: url('<?php echo $hero_img ?>'); ">
                    <div class="hero-items">
                    <h1 style="-webkit-text-stroke: 0.5px <?php echo $hero_color_h1; ?>;"> <?php echo nl2br( $hero_title );?></h1>
                    </div>
                </section>
            </main>
        </div>
        
    </div>

    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
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