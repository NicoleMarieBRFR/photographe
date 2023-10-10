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
        
        <div class="teste">
            <?php
            // Récupérez une photo aléatoire du catalogue
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
                    <div class="hero" style="background-image: url('<?php echo esc_url($image_url); ?>');">
                        <!-- Le contenu de votre héros -->
                    <p>teste</p>
                    </div>
                    <?php
                endwhile;
            else :
                // Aucun article correspondant trouvé
                echo esc_html_e('Aucune photo trouvée.');
            endif;

            // Réinitialisez la requête
            wp_reset_query();
            ?>
            <?php
// Récupérez l'URL de l'image depuis le champ personnalisé (remplacez 'image_url' par le nom correct de votre champ d'image)
$image_url = get_post_meta(get_the_ID(), 'image_url', true);

// Vérifiez si $image_url est défini et n'est pas vide
if (!empty($image_url)) :
?>
<div class="hero" style="background-image: url('<?php echo esc_url($image_url); ?>');">
    <!-- Le contenu de votre héros -->
</div>
<?php
else :
    // Si $image_url n'est pas défini ou est vide
    echo esc_html_e('Aucune URL d\'image trouvée.');
endif;
?>
        </div>
        
    </div>

    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <section id="all-photos">
                    <div class="photos-home">
                        <?php get_template_part('templates_part/photo_block'); ?>
                    </div>
                    <div class="related_button m-rp">
                        <button class="button_style">Charger plus</button>
                    </div>                         
                </section>
            </main>
        </div>
    </div>

<?php get_footer(); ?>