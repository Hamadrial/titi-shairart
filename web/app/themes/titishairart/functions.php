<?php
/**
 * Loads theme function files.
 *
 */

/**
 * Load translation for the theme.
 */
function starter_theme_load_theme_textdomain() {
  load_theme_textdomain( 'titishairart-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'starter_theme_load_theme_textdomain' );

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$pixels_error = function ($message, $subtitle = '', $title = '') {
  $title = $title ?: __('Theme &rsaquo; Error', 'titishairart-theme');
  $footer = __('You can report this error to <a href="mailto:support@pixels.fi">support@pixels.fi</a>', 'titishairart-theme');
  $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
  wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('5.6.4', phpversion(), '>=')) {
  $pixels_error(__('You must be using PHP 5.6.4 or greater.', 'titishairart-theme'), __('Invalid PHP version', 'titishairart-theme'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
  $pixels_error(__('You must be using WordPress 4.7.0 or greater.', 'titishairart-theme'), __('Invalid WordPress version', 'titishairart-theme'));
}

/**
 * Theme required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($pixels_error) {
  $file = "lib/{$file}.php";
  if (!locate_template($file, true, true)) {
    $pixels_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'titishairart-theme'), $file), 'File not found');
  }
}, ['assets', 'timber', 'widget-areas', 'filters']);
