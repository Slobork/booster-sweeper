<?php
/**
 * Plugin Name:         Booster Sweeper
 * Description:         Boost the speed by sweeping assets your pages do not need
 *
 * PHP version  7.3.5
 *
 * @category Optimization
 * @package  Booster_Sweeper
 * @author   MaxPressy <webmaster@maxpressy.com>
 * @license  GPL v2 or later
 * @link     maxpressy.com
 *
 * Author URI:          https://maxpressy.com
 * Version:             1.0.1
 * Text Domain:         booster_sweeper
 * Domain Path:         /languages
 * Requires at least:   5.8
 */

if (! defined('ABSPATH')) { 
    exit; 
}

    require_once 'classes/init.php';
    require_once 'classes/resources.php';
    require_once 'clean-html.php';
    require_once 'admin/admin-init.php';
