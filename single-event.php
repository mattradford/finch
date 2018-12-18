<div class="page__wrap">

  <article <?php post_class(); ?>>
    <header>
      <div class="page__title">
      <h1><?php the_title(); ?></h1>
    </div>
    </header>
    <div class="entry-content">
        <?php eo_get_template_part( 'event-meta', 'event-single' ); ?>
        <?php the_content(); ?>
    </div>
  </article>

</div>