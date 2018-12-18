<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.11.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js (in footer)
 *
 */
function roots_scripts() {

  wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css', false, null);

  /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_stylesheet_directory_uri() . '/assets/js/plugins/jquery.min.js', array(), null, false);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }
  if ( is_page_template('where-we-meet.php') ) {
    wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyDIchyUb3aJhXrnXtBYN4ZACOA5mVTaZ7w', array(), '3', true);
  }
  if ( !is_admin() ) {
        wp_register_script( 'custom-scripts', get_template_directory_uri() . '/assets/js/custom_scripts.js', array(), '', true );
  }
    $query_args = array(
      'family' => 'Nunito+Sans',
      'subset' => 'latin,latin-ext',
    );
	  wp_register_style( 'scout-font', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

    wp_enqueue_style( 'scout-font' );
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-scripts');
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

/*** Remove version numbers from query string of scripts & css files ***/

add_filter( 'style_loader_src', 'finch_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'finch_remove_wp_ver_css_js', 9999 );

function finch_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// http://wordpress.stackexchange.com/a/12450
function roots_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/vendor/jquery/dist/jquery.min.js?1.11.3"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'roots_jquery_local_fallback');

// Remove head generator text, RSD and WLW manifest
remove_action ('wp_head', 'wp_generator');
remove_action ('wp_head', 'rsd_link');
remove_action ('wp_head', 'wlwmanifest_link');
remove_action ('wp_head', 'wp_shortlink_wp_head');

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDIchyUb3aJhXrnXtBYN4ZACOA5mVTaZ7w');
}

add_action('acf/init', 'my_acf_init');
