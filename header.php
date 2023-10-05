<header>
    <section class="gp-main-menu">
        <div class="top-bar container">
            <div class="custom-logo">
                <?php 
                    if( has_custom_logo() ){
                        the_custom_logo();
                    }else{
                        ?>
                            <a href="<?php echo home_url( '/' ); ?>"><span><?php bloginfo( 'name' ); ?></span></a>
                        <?php
                    }
                ?>
            </div>
            <div class="menu-area">
                <nav class="main-menu">
                    <button class="check-button">
                        <div class="menu-icon">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                        </div>
                    </button>
                    <?php wp_nav_menu( array( 'theme_location' => 'photographe_main_menu', 'depth' => 1 ) ); ?>
                </nav>
            </div>
        </div>
    </section>
</header>

