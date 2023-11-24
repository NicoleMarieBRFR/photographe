<?php

$test = '';
$test .= '<li>';
if (has_post_thumbnail()) {
    // Affichez l'image en vedette
    $thumbnail = get_the_post_thumbnail();
   $test.= '<a href="' . esc_url(get_permalink()) . '">' . $thumbnail . '</a>';
}
echo get_template_part('templates_part/lightbox');
$test .= '</li>';
return $test;
?>