<?php
add_filter('widget_text', 'do_shortcode');// execute shortcodes in widgets


// Numeric page navigation, adapted from Bones
function finch_page_navi() {
    global $wp_query;
    $bignum = 999999999;
    if ( $wp_query->max_num_pages <= 1 )
        return;

    echo '<nav class="pagination">';

        echo paginate_links( array(
            'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
            'format' 		=> '',
            'current' 		=> max( 1, get_query_var('paged') ),
            'total' 		=> $wp_query->max_num_pages,
            'prev_text' 	=> '&larr;',
            'next_text' 	=> '&rarr;',
            'type'			=> 'list',
            'end_size'		=> 3,
            'mid_size'		=> 3
        ) );

    echo '</nav>';
} /* end page navi */

// remove home from breadrumbs
function remove_home_from_breadcrumb($links)
{
	if ($links[0]['url'] == get_home_url()) { array_shift($links); }
	return $links;
}
add_filter('wpseo_breadcrumb_links', 'remove_home_from_breadcrumb');

add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function wti_loginout_menu_link( $items, $args ) {
   if ($args->theme_location == 'footer_navigation') {
      if (is_user_logged_in()) {
         $items .= '<li class="right"><a href="'. wp_logout_url() .'">'. __("Website logout") .'</a></li>';
      } else {
         $items .= '<li class="right"><a href="'. wp_login_url(get_permalink()) .'">'. __("Website login") .'</a></li>';
      }
   }
   return $items;
}