<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued','finch') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */

// https://github.com/roots/roots/pull/1234/files

//function roots_wp_title($title) {
//  if (is_feed()) {
//    return $title;
//  }
//
//  $title .= get_bloginfo('name');
//
//  return $title;
//}
//add_filter('wp_title', 'roots_wp_title', 10);
