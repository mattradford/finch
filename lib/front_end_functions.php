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