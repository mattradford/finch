<?php
add_filter('widget_text', 'do_shortcode');// execute shortcodes in widgets


/*
 *
 * Numeric page navigation, adapted from Bones
 * 
 */
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
} 

/*
 *
 * Remove home from breadrumbs
 * 
 */
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

/*
 *
 * Gravity Forms - validate age
 * 
 */
add_filter('gform_validation_1', 'verify_minimum_age');
function verify_minimum_age($validation_result){


    // retrieve the $form
    $form = $validation_result['form'];

        // date of birth is submitted in field 5 in the format YYYY-MM-DD
        // change the 5 here to your field ID
        $dob = rgpost('input_4');

        // this the minimum age requirement we are validating
        $minimum_age = 4;

        // calculate age in years like a human, not a computer, based on the same birth date every year
        $age = date('Y') - substr($dob, 0, 4);
        if (strtotime(date('Y-m-d')) - strtotime(date('Y') . substr($dob, 4, 6)) < 0){
            $age--;
        }
 
    // is $age less than the $minimum_age?
    if( $age < $minimum_age ){
 
        // set the form validation to false if age is less than the minimum age
        $validation_result['is_valid'] = false;
 
        // find field with ID of 5 and mark it as failed validation
        foreach($form['fields'] as &$field){
 
            // NOTE: replace 5 with the field you would like to mark invalid
            if($field['id'] == '4'){
                $field['failed_validation'] = true;
                $field['validation_message'] = "Sorry, your child must be at least $minimum_age years old to join the waiting list.";
                break;
            }
 
        }
 
    }
    // assign modified $form object back to the validation result
    $validation_result['form'] = $form;
    return $validation_result;
}