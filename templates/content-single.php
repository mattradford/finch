<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <div class="page__title">
      <h1><?php the_title(); ?></h1>
    </div>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:','finch'), 'after' => '</p></nav>')); ?>
    </footer>
  </article>
<?php endwhile; ?>
