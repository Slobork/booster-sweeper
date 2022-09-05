<?php

	if ( ! defined( 'ABSPATH' ) ) exit;



	/**
	 * Plugin's init class.
	 */
	if ( ! class_exists( 'Booster__Sweeper' ) ) {

		add_action( 'init',	array( 'Booster__Sweeper', 'load_textdomain' ) );


		class Booster__Sweeper {


			/**
			 * Version.
			 *
			 * Also has to be updated in the framework settings' createOptions @see /admin/opt/config/framework.php
			 */
			public static function version() {

				$plugin_version = '0.0.2';
	
				return $plugin_version;
	
			}


			/**
			 * Load plugin's textdomain.
			 */
			public static function load_textdomain() {

				load_plugin_textdomain( 'booster-sweeper', false, basename( dirname( __FILE__ ) ) . '/languages' );
	
			}


		}

	}
