<footer class="content-info">
  <div class="footer__container">
        <div class="footer__row">
            <nav class="footer__nav">
              <?php
                if (has_nav_menu('footer_navigation')) :
                  wp_nav_menu(array('theme_location' => 'footer_navigation', 'depth'=>1));
                endif;
              ?>
            </nav>
        </div>
        <div class="footer__row">
            <div class="footer__text">
                
                <p class="copyright"><?php echo '&copy;&nbsp2002 - '.date('Y').'&nbsp;'.get_bloginfo('name'); ?>. 
                    
                <?php if(get_field('footer_charity_text','options')) { ?>
                    <p class="charity"><?php the_field('footer_charity_text','options'); ?> </p>
                <?php } ?>                    
                
                <?php if(get_field('footer_colophon_text','options') && get_field('footer_colophon_link','options')) { ?>
                    <p class="colophon"><a href="<?php the_field('footer_colophon_link','options'); ?>"><?php the_field('footer_colophon_text','options'); ?></a></p>
                <?php } ?>    

            </div>
        </div>

      
      
      
  </div>
</footer>

<?php wp_footer(); ?>