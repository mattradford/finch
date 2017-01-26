<?php
/*
Template Name: Sitemap
*/
?>

<div class="page__wrap <?php if (has_post_thumbnail()) { echo ' page__image'; } ?>">

        <?php while (have_posts()) : the_post(); ?>
            <div class="page__title"><h1><?php echo roots_title(); ?></h1></div>
            
            <div class="sitemap__wrap">

              <div class="pages">
                <h2><?php _e( 'Pages', 'finch '); ?></h2>
                <nav>
                  <?php
                    if (has_nav_menu('primary_navigation')) :
                      wp_nav_menu(array('theme_location' => 'primary_navigation', 'depth'=>4));
                    endif;
                  ?>
                </nav>
                <nav>
                  <?php
                    if (has_nav_menu('footer_navigation')) :
                      wp_nav_menu(array('theme_location' => 'footer_navigation', 'depth'=>1));
                    endif;
                  ?>
                </nav>
              </div>

              <div class="posts">
                <h2><?php _e( 'News', 'finch '); ?></h2>
               
               <?php
                $args = array(
                  'post_type'              => array( 'post' ),
                  'post_status'            => array( 'published' ),
                  'nopaging'               => true,
                  'posts_per_page'         => '10',
                );

                $posts_query = new WP_Query( $args );

                if ( $posts_query->have_posts() ) {
                  while ( $posts_query->have_posts() ) {
                    $posts_query->the_post();
                ?>
                  <div class="post">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <time><?php echo the_date(); ?></time>
                  </div>
                <?php } ?>
                  <a class="button-green"><?php _e( 'More News', 'finch' ); ?></a>
                <?php
                } else {
                  echo '<span>';
                  _e( 'No news items were found', 'finch' );
                  echo '</span>';
                }

                // Restore original Post Data
                wp_reset_postdata();
               ?>

              </div>

            </div>

        <?php endwhile; ?>

</div>
