<?php
// phpcs:ignore
/**
 * Description: Plugin's initialization
 */

if (! defined('ABSPATH')) {
    exit;
}


if (! class_exists('Booster_Sweeper') ) {

    add_action('init', array( 'Booster_Sweeper', 'textdomain' ));

    /**
     * Plugin's init class.
     */
    // phpcs:ignore
    class Booster_Sweeper
    {

        /**
         * Version.
         *
         * Also has to be updated in the framework settings' createOptions,
         *
         * @see /admin/opt/config/framework.php
         */
        // phpcs:ignore
        public static function version()
        {

            $plugin_version = '1.0.0';
            return $plugin_version;

        }

        /**
         * Load plugin's textdomain.
         * 
         * @return null Hooking a load_plugin_textdomain().
         */
        public static function textdomain()
        {

            load_plugin_textdomain('booster-sweeper', false, basename(dirname(__FILE__)) . '/languages');

        }


    }

}
