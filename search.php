<div class="page__wrap">

        <div class="page__title"><h1><?php echo roots_title(); ?></h1></div>
        <?php if (!have_posts()) : ?>
          <div class="alert">
            <p><?php _e('Sorry, no results were found.','finch'); ?></p>
          </div>
          <?php get_search_form(); ?>
        <?php endif; ?>

        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('templates/content', 'search-result'); ?>
        <?php endwhile; ?>

        <?php if ($wp_query->max_num_pages > 1) { finch_page_navi(); } ?>


</div>
