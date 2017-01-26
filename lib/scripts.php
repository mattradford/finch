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

  if (!is_admin()) {

        // The following output in the footer, after jQuery
        wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/plugins/slick.min.js', array(), '', true );
        wp_register_script( 'google-map-init', get_template_directory_uri() . '/assets/js/plugins/google-map-init.min.js', array(), '', true );
        wp_register_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/plugins/jquery.magnific-popup.min.js', array(), '', true );
        wp_register_script( 'mobile-menu', get_template_directory_uri() . '/assets/js/plugins/mobile-menu.min.js', array(), '', true );
        wp_register_script( 'accordion-js', get_template_directory_uri() . '/assets/js/plugins/jquery.accordion.min.js', array(), '', true );
        wp_register_script( 'custom-scripts', get_template_directory_uri() . '/assets/js/custom_scripts.min.js', array(), '', true );


        if (is_single() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

  }

    wp_enqueue_script('jquery');
    wp_enqueue_script('slick');
    wp_enqueue_script('google-map-init');
    wp_enqueue_script('magnific-popup');
    wp_enqueue_script('accordion-js');
    wp_enqueue_script('mobile-menu');

  //  Enqueue for a specific CPT
   if (is_page_template('where-we-meet.php')) {
       wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js', array(), '3', true);
       wp_enqueue_script('google-map-init');
   }

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
