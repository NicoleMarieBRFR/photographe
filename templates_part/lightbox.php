<!-- lightbox -->

<div class="lightbox">
    <button class="lightbox_close">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_lightbox.svg" alt="icon close lightbox">
    </button>
    <button class="lightbox_next">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_right.svg" alt="arrow right">
    </button>
    <button class="lightbox_prev">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_left.svg" alt="arrow left">
    </button>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="lightbox_container">
            <div class="img_item">
                <img class="lightbox_img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
            </div>
            <div class="group">
                <p class="lightbox_title"><?php the_title(); ?></p>
                
                <p class="lightbox_cat">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'categorie');
                    if ($categories && !is_wp_error($categories)) {
                        $category_names = array();
                        foreach ($categories as $category) {
                            $category_names[] = $category->name;
                        }
                        echo implode(', ', $category_names);
                    }
                    ?>  
                </p>
            </div>
        </div>
    </article>
</div>
