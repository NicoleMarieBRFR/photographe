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
                <img class="lightbox_img" src="" alt="">
            </div>
            <div class="group">
                <p class="lightbox_title"></p>
                
                <p class="lightbox_cat"></p>
            </div>
        </div>
    </article>
</div>
