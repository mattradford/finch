<header class="banner">
    <div class="banner__container">
        <div class="banner__row">

            <div class="banner__logo">
                <a class="logo" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
            </div>

            <div class="banner__title">
                <a href="<?php echo esc_url(home_url('/')); ?>"><span><?php _e('1st Finch','finch'); ?></span><span><?php _e('ampstead','finch'); ?></span>
                <span><?php _e('Scout Group','finch'); ?></span></a>
            </div>

            <div class="banner__button">
              <a href="#nav-dropdown" class="nav-control button">
                <span><?php _e('Menu','finch'); ?></span>
              </a>
              <?php if(get_field('header_button_link','options')) { ?>
                <a href="<?php the_field('header_button_link','options'); ?>" class="button join"><span><?php _e('Come And','finch'); ?></span><?php _e('Join Us','finch'); ?></a>
              <?php } ?>
            </div>
    </div>
</header>


<div class="navbar--header">
    <nav>
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'depth'=>4));
        endif;
      ?>
    </nav>
</div>
