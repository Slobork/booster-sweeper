<?php
/**
 * Plugin Name:         Booster Sweeper
 * Description:         Boost the Website speed by sweeping assets your pages do not need!
 *
 * PHP version  7.4
 *
 * @category Optimization
 * @package  Booster_Sweeper
 * @author   MaxPressy <webmaster@maxpressy.com>
 * @license  GPL v2 or later
 * @link     maxpressy.com
 *
 * Author:              MaxPressy
 * Author URI:          https://maxpressy.com
 * Version:             1.0.8
 * Text Domain:         booster_sweeper
 * Domain Path:         /languages
 * Requires at least:   6.7
 */

if (! defined('ABSPATH')) {
    exit;
}

// Plugin data (getting plugin version, name, etc.)
if (! function_exists('get_plugin_data')) {
    include_once ABSPATH .'wp-admin/includes/plugin.php';
}
$plugin_data = get_plugin_data(__FILE__, true, false);
define('BOOSTER_SWEEPER', ($plugin_data && $plugin_data['Name']) ? $plugin_data['Name'] : 'Booster Sweeper');
define('BOOSTER_SWEEPER_VERSION', ($plugin_data && $plugin_data['Version']) ? $plugin_data['Version'] : '1.0.0');

require_once 'classes/init.php';
require_once 'classes/resources.php';
require_once 'clean-html.php';
require_once 'admin/admin-init.php';
