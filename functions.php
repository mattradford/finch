<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
    'lib/utils.php',                    // Utility functions
    'lib/init.php',                     // Initial theme setup and constants
    'lib/wrapper.php',                  // Theme wrapper class 
    'lib/sidebar.php',                  // Sidebar class
    'lib/config.php',                   // Configuration
    'lib/titles.php',                   // Page titles
    'lib/nav.php',                      // Custom nav modifications
    'lib/scripts.php',                  // Scripts and stylesheets
    'lib/extras.php',                   // Title clean up, excerpt
    'lib/admin_functions.php',          // Backend functions
    'lib/front_end_functions.php',      // Front End functions
    'lib/forms.php',                    // Forms
    
);

foreach ($roots_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion','finch'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);