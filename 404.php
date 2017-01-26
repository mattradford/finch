<div class="page__wrap">

        <div class="page__title"><h1><?php echo roots_title(); ?></h1></div>
        <div class="error-text">
            <?php
                if(get_field('404_error_page_text','options')) :
                    the_field('404_error_page_text','options');
                else :
                    _e('Sorry, but the page you were trying to view does not exist.','finch');
                endif;
            ?>
        </div>

        <?php get_search_form(); ?>

</div>
