<div class="page__wrap <?php if (has_post_thumbnail()) { echo ' page__image'; } ?>">
        <?php while (have_posts()) : the_post(); ?>
            <?php if ( !get_field( 'hide_page_title' ) ) { ?>
                <div class="page__title"><h1><?php echo roots_title(); ?></h1></div>
            <?php } ?>
            <?php get_template_part('templates/content', 'page'); ?>
            <?php get_template_part('templates/sidebar'); ?>
        <?php endwhile; ?>
</div>
