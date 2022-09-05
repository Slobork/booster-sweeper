<?php

	if ( ! defined( 'ABSPATH' ) ) { exit; }

	/**
	 * CSF - framework fields.
	 */
	if ( ! class_exists( 'CSF' ) ) {
		include_once dirname( __FILE__ ) .'/codestar-framework/codestar-framework.php';
	}

	if ( class_exists( 'CSF' ) ) {

		// Disable CSF welcome page
		add_filter( 'csf_welcome_page', '__return_false' );

		if ( class_exists( 'Booster__Sweeper__Pro' ) ) {
			include_once WP_PLUGIN_DIR .'/booster-sweeper-pro/admin/opt/config/callbacks.php';
			include_once WP_PLUGIN_DIR .'/booster-sweeper-pro/admin/opt/config/framework.php';
			include_once WP_PLUGIN_DIR .'/booster-sweeper-pro/admin/opt/config/metabox.php';
		}

		include_once dirname( __FILE__ ) .'/opt/config/callbacks.php';
		include_once dirname( __FILE__ ) .'/opt/config/framework.php';
		include_once dirname( __FILE__ ) .'/opt/config/metabox.php';

	}



	/**
	 * Enqueue admin scripts.
	 */
	if ( ! function_exists( 'booster_sweeper_admin_scripts' ) ) {

		function booster_sweeper_admin_scripts() {

			$plugin_version = Booster__Sweeper::version();
			$current_screen = get_current_screen()->base;
	
			// Load only on Booster Sweeper settings page.
			if ($current_screen == 'toplevel_page_booster-sweeper-settings') {
				
				wp_enqueue_style( 'booster-sweeper-adminizr', plugin_dir_url(  __DIR__  ) .'library/admin/adminizr.css', array(), $plugin_version );
				wp_enqueue_script( 'booster-sweeper-adminizr', plugin_dir_url(  __DIR__  ) .'library/admin/adminizr.js', array( 'jquery' ), $plugin_version, true );
			
				// add local vars for translation, accesed through the JS
				$local_var_array  = array(
					'ajax_url'			=>  admin_url('admin-ajax.php'),
					'resetpostid_nonce' =>  wp_create_nonce('booster-sweeper-resetpostid-nonce'),
					'error_text'		=>	esc_html( 'You should use only alphanumeric characters!', 'booster-sweeper'),
				);

				wp_localize_script( 'booster-sweeper-adminizr', 'booster_sweeper_localize', $local_var_array );

			}
			
		}
		add_action( 'admin_enqueue_scripts', 'booster_sweeper_admin_scripts' );

	}
