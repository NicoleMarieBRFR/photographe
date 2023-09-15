<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/contact-header.png" alt="Image form contact">
        <?php
        // formulaire de contact
        echo do_shortcode('[contact-form-7 id="407f822" title="Contact popup"]');
        ?>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div>