<?php
// phpcs:ignore
/**
 * Description: Framework options.
 */

if (! defined('ABSPATH')) {
    exit;
}


    /*
     * Set a unique slug-like ID.
     */
    $prefix = '_booster_sweeper_options';


    CSF::createOptions(
        $prefix, array(

            'menu_parent'     => 'options-general.php',

            'framework_title' => 'Booster Sweeper',
            'menu_title'      => 'Booster Sweeper',
            'menu_slug'       => 'booster-sweeper-settings',
            'menu_icon'       => 'dashicons-image-filter',

            'footer_credit'   => 'Booster Sweeper <small> v0.0.2</small>',
            'footer_text'     => ' ',
            'theme'           => 'light',
            'show_bar_menu'   => false,

            //'ajax_save'       => false, // to get the "Review All (info)" updated it needs page refresh, so lets go with ajax false
            'output_css'      => false,
            'enqueue_webfont' => false,

        ) 
    );



    /*
     * Vars
     */


    // replaces the fields available in the pro version
    $empty_field = array(
        'type'      => 'content',
        'content'   => '',
        'class'     => 'floatany-empty-field',
    );

    // Not multisite installation or is multisite and main site
    if (! is_multisite() || (is_multisite() && is_main_site()) ) {
        
        /*
         * Since the "Unistall settings" is the only option under the "Other" heading
         * $settings_other_heading is also conditionally set based on the 
         * multisite environment
         */
        $settings_other_heading = array(
            'type'      => 'heading',
            'content'   => esc_html__('Other', 'booster-sweeper'),
        );

        $uninstall_setting = array(
            'id'        => 'uninstall_setting',
            'type'      => 'checkbox',
            'title'     => esc_html__('Uninstall settings if plugin is deleted', 'booster-sweeper'),
            'desc'      => esc_html__('If this is checked, all Booster Sweeper seetings will be deleted when the plugin is removed, otherwise the settings will be preserved.', 'booster-sweeper'),
        );

        // multisite but not the main site
    } else {

        $settings_other_heading = $empty_field;
        $uninstall_setting      = $empty_field;

    }


    /*
     * Differentiate options availabe on the basic & the pro version.
     */
    if (function_exists('booster_sweeper_framework_settings_pro') ) {
        
        $get_license = class_exists('Booster__Sweeper__Pro') && Booster__Sweeper__Pro::getLicense() !== '' ? true : false;
        
        if ($get_license === true) {

            $unload_options  = booster_sweeper_framework_settings_pro()[ 'unload_options' ];
            $unload_backend  = booster_sweeper_framework_settings_pro()[ 'unload_backend' ];
            $unload_frontend = booster_sweeper_framework_settings_pro()[ 'unload_frontend' ];
                
            // if license not active
        } else {

            $license_call_field = array(
                array(
                    'type'     => 'callback',
                    'function' => 'booster_sweeper_license_call',
                ),
            );

            $unload_options  = $license_call_field;
            $unload_backend  = $license_call_field;
            $unload_frontend = $license_call_field;

        }

        // if the pro plugin isn't active
    } else {

        $upgrade_field = array(
                array(
                    'type'      => 'callback',
                    'function'  => 'booster_sweeper_upgrade_call',
                ),
            );

            $unload_options  = $upgrade_field;
            $unload_backend  = $upgrade_field;
            $unload_frontend = $upgrade_field;

    }


    /*
     * BEGIN OPTIONS
     */


    /*
     * Opt - General tab.
     */
    CSF::createSection(
        $prefix, array(
            'title'  => esc_html__('General', 'booster-sweeper'),
            'icon'   => 'fa fa-home',
            'fields' => array(
                array(
                    'type'          => 'heading',
                    'content'       => esc_html__('Clean HTML tags from the <head>', 'booster-sweeper'),
                ),
                array(
                    'title'         => esc_html__('Remove "version generator" tag', 'booster-sweeper'),
                    'desc'          => esc_html__('It removes the meta tag stating the version of WordPress your site is using', 'booster-sweeper'),
                    'id'            => 'html_tag_generator',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove "RSD" tag', 'booster-sweeper'),
                    'desc'          => esc_html__('Really Simple Discovery (RSD) is an XML format that enables other software to communicate to the blog.', 'booster-sweeper'),
                    'id'            => 'html_tag_rsd',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove "WLW" tag', 'booster-sweeper'),
                    'desc'          => esc_html__('Windows Live Writer is the desktop application that can be remotely connected to your blog.', 'booster-sweeper'),
                    'id'            => 'html_tag_wlw',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove "shortlink" tag', 'booster-sweeper'),
                    'desc'          => esc_html__('This tag marks the short link of the post/page', 'booster-sweeper'),
                    'id'            => 'html_tag_shortlink',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove "Posts adjacent Links" tag', 'booster-sweeper'),
                    'desc'          => esc_html__('It sets the link to the previous and next posts, i.e. rel="prev" tag.', 'booster-sweeper'),
                    'id'            => 'html_tag_prev',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove "REST API" links', 'booster-sweeper'),
                    'desc'          => esc_html__('REST API is another way to communicate with the site remotely.', 'booster-sweeper'),
                    'id'            => 'html_links_rest_api',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove "oEmbed" links', 'booster-sweeper'),
                    'desc'          => esc_html__('oEmbed is an open format designed to allow embedding content from a website into another page.', 'booster-sweeper'),
                    'id'            => 'html_links_oembed',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove "Feed" links', 'booster-sweeper'),
                    'desc'          => esc_html__('Remove the links to the RSS feeds of the blog.', 'booster-sweeper'),
                    'id'            => 'html_links_feed',
                    'type'          => 'checkbox',
                ),
                array(
                    'title'         => esc_html__('Remove support for emojis', 'booster-sweeper'),
                    'desc'          => esc_html__('Emojis are mostly known as smilies like embedded in text. WordPress by default adds additional script and style elements in its head to enable emojis library.', 'booster-sweeper'),
                    'id'            => 'html_emojis',
                    'type'          => 'checkbox',
                ),
                $settings_other_heading,
                $uninstall_setting,
            )
        )
    );


    /*
     * Opt - Assets Rules (Options).
     */
    CSF::createSection(
        $prefix, array(
            'title'  => esc_html__('Assets (Options)', 'booster-sweeper'),
            'icon'   => 'fas fa-spinner',
            'fields' => $unload_options,
        )
    );


    /*
     * Opt - Unload Rules (Frontend).
     */
    CSF::createSection(
        $prefix, array(
            'title'  => esc_html__('Manage (Frontend)', 'booster-sweeper'),
            'icon'   => 'fas fa-forward',
            'class'  => 'bs-indent',
            'fields' => $unload_frontend,
        )
    );


    /*
     * Opt - Unload Rules (Backend).
     */
    CSF::createSection(
        $prefix, array(
            'title'  => esc_html__('Manage (Backend)', 'booster-sweeper'),
            'icon'   => 'fas fa-backward',
            'class'  => 'bs-indent',
            'fields' => $unload_backend,
        )
    );


    /*
     * Opt - Backup tab.
     */
    CSF::createSection(
        $prefix, array(
            'title'  => esc_html__('Import/Export', 'booster-sweeper'),
            'icon'   => 'fas fa-save',
            'fields' => array(
                array(
                    'type'   => 'backup',
                    'title'  => esc_html__('Import or export the settings', 'booster-sweeper'),
                    'before' => esc_html__('Paste the exported string in the box:', 'booster-sweeper'),
                ),
            )
        )
    );
