<?php
/*
Template Name: Page Builder
*/
?>
<div class="page__wrap <?php if (has_post_thumbnail()) { echo ' page__image'; } ?>">
<?php while (have_posts()) : the_post(); ?>
    <?php if ( !is_front_page() ) { ?>
        <div class="page__title"><h1><?php echo roots_title(); ?></h1></div>
    <?php } ?>
    <?php get_template_part('templates/content', 'page-builder'); ?>
<?php endwhile; ?>

 </div>