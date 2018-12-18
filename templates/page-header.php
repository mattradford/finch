<?php
    if (has_post_thumbnail()) {
        $image_data = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "large" );
        echo '<div class="page__featured-image" style="background-image: url('.$image_data[0].');"></div>';
    }
?>
