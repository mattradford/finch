<?php

// Declare any ACF options pages
if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page(array(
        'title' => 'Custom Settings',
        'parent' => 'options-general.php',
        'capability' => 'manage_options'
    ));
    acf_add_options_sub_page(array(
        'title' => '404 Error Page',
        'parent' => 'options-general.php',
        'capability' => 'manage_options'
    ));

}

// Remove Yoast SEO meta from users below Editor
add_action('add_meta_boxes', 'yoast_is_toast2', 99);
function yoast_is_toast2(){
    //capability of 'edit_pages' equals admin, therefore if NOT editor
    //hide the meta box from all other roles on the following 'post_type' 
    //such as post, page, custom_post_type, etc
    if (!current_user_can('edit_posts')) {
        remove_meta_box('wpseo_meta', 'page', 'normal');
        remove_meta_box('wpseo_meta', 'post', 'normal');
    }
}

// Yoast SEO to bottom of edit screen
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

// Force the kitchen sink to always be on
add_filter( 'tiny_mce_before_init', 'tcb_force_kitchensink_open2' );
function tcb_force_kitchensink_open2( $args ) {
  $args['wordpress_adv_hidden'] = false;
  return $args;
}

// Remove ability to modify themes and plugins
define('DISALLOW_FILE_EDIT',true);

// Disable update notifications for non-admins
function no_update_notification() {
	if (!current_user_can('activate_plugins')) remove_action('admin_notices', 'update_nag', 3);
}
add_action('admin_notices', 'no_update_notification', 1);

// Replace How Are You (en-GB)
function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'How are you,', 'Your account: ', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

// removes dashboard widgets except Gravity Forms
function mattrad_remove_dashboard_meta_boxes(){
    global $wp_meta_boxes;
    // Dashboard core widgets :: Left Column
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['pb_backupbuddy_stats']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['bruteprotect_dashboard_widget']);
 
    // Additional dashboard core widgets :: Right Column
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    // Remove the welcome panel
    update_user_meta(get_current_user_id(), 'show_welcome_panel', false);
}
add_action('wp_dashboard_setup', 'mattrad_remove_dashboard_meta_boxes');

// removes tricky little Gravity Forms & WP Help dashboard widgets
function mattrad_remove_dashboard_widgets(){
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['cws-wp-help-dashboard-widget']);    
}
add_action('wp_dashboard_setup', 'mattrad_remove_dashboard_widgets', 11);

// Login screen

// Pretty up the login with a logo
// Add CSS in the file referenced below, then create the appropriate logo in assets/img/logo-login.png
function custom_login_css() {
echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/assets/css/login-styles.css" />';
}
add_action('login_head', 'custom_login_css');

// Change login link. Note home_url not site_url
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

// Change login link to that of the website
function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// Make sure Remember Me is checked = fewer password resets!
function login_checked_remember_me() {
    add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );
function rememberme_checked() {
    echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

// Set wp-admin colour scheme
function finch_colour_scheme() {
    wp_admin_css_color(
        'finch',
        __('finch'),
        get_template_directory_uri()."/assets/css/wp-admin-colours.css",
        array('#07273E', '#14568A', '#6e949c', '#bb3131'),
        array( 'base' => '#e5f8ff', 'focus' => '#fff', 'current' => '#fff' )
    );

}
add_action('admin_init', 'finch_colour_scheme', 10);

// http://www.hongkiat.com/blog/wordpress-admin-color-scheme/
// set default colour scheme to finch for new users.
function set_default_admin_color($user_id) {
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'finch'
    );
    wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');

/*** Remove Emoji ***/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Prevent theme updates showing
remove_action( 'load-update-core.php', 'wp_update_themes' );
add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );