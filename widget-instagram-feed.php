<?php

/**
 * Plugin Name: Easy Feed Widget
 * Plugin URI:  https://wordpress.org/plugins/easy-feed-widget/
 * Description: Show latest IG photos
 * Version:     1.0.1
 * Author:      Apsara Aruna
 * Author URI:  http://profile.wordpress.org/apsaraaruna
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wifeed
 */

if (!defined('ABSPATH')) {
	die;
}

define('WIFPLUGIN_URL', plugin_dir_url(__FILE__));

$wif_options = get_option('wif_settings');

require_once(plugin_dir_path(__FILE__) . '/includes/widget-instagram-feed-scripts.php');

require_once(plugin_dir_path(__FILE__) . '/includes/widget-instagram-feed-shortcodes.php');

if (is_admin()) {
	require_once(plugin_dir_path(__FILE__) . '/includes/widget-instagram-feed-settings.php');
} else {
}
