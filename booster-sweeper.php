<?php

	if ( ! defined( 'ABSPATH' ) ) { exit; }

	/**
	 * Plugin Name:         Booster Sweeper
	 * Description:         Sweep assets your pages and site do not need and that way boost the performance and speed.
	 * Author:              maxPressy
	 * Author URI:          https://maxpressy.com
	 * Version:             0.0.2
	 * Text Domain:         booster_sweeper
	 * Domain Path:         /languages
	 * Requires at least:   5.8
	 */

	include_once 'classes/init.php';
	include_once 'classes/resources.php';
	include_once 'clean-html.php';
	include_once 'admin/admin-init.php';

