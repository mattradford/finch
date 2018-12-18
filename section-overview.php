<?php
/*
Template Name: Section Overview
*/
?>

<div class="page__wrap <?php if (has_post_thumbnail()) { echo ' page__image'; } ?>">

        <?php while (have_posts()) : the_post(); ?>
            <div class="page__title"><h1><?php echo roots_title(); ?></h1></div>
            <?php get_template_part('templates/content', 'page'); ?>

            <?php if ( have_rows('section_details') ) { ?>
              <ul class="section__details">
                <?php while ( have_rows('section_details') ) : the_row(); ?>
                  <li>
                    <a href="<?php the_sub_field('section_link'); ?>"><span><?php _e('Find out more about','finch'); ?> </span><?php the_sub_field('section_title'); ?></a>
                  </li>
                <?php endwhile; ?>
              </ul>
            <?php } ?>
        <?php endwhile; ?>


</div>
