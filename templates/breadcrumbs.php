<div class="breadcrumbs-search">
  <div class="page__wrap">
      <?php
          if ( function_exists('yoast_breadcrumb') ) {
                  yoast_breadcrumb('<div class="breadcrumbs">','</div>');
          }
      ?>
      <div class="search">
        <?php get_template_part('templates/searchform'); ?>
      </div>
    </div>
</div>
