<footer class="site-footer">
    <?php get_template_part('templates_part/popup-contact'); ?>
            <div class="container">
                <div class="menu-footer">
                    <nav class="main-menu">
                        <?php wp_nav_menu( array( 'theme_location' => 'photographe_footer_menu', 'depth' => 1 ) ); ?>
                    </nav>
                </div>
            </div>
        </footer>
<!-- scripts -->
        <?php wp_footer(); ?>
    </body> 
</html>
