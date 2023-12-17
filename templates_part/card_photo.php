<!-- hover_img -->
<div class="hover_img">
    <div class="group">
        <div class="title">
            <p>
                <?php the_title(); ?>
            </p>
        </div>
        <div class="cat">
            <p>
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
    <div class="eyes">
    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/eye.svg" alt="icon oeil"></a>
    </div>
    <div class="img_fullscreen">
        <button class="button_lightbox" type="button">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Icon_fullscreen.svg" alt="icon fullscreen">
        </button>
    </div>
</div>