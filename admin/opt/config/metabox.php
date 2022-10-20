<?php
// phpcs:ignore
/**
 * Description: Metabox options.
 */

if (! defined('ABSPATH')) {
    exit;
}


    /*
     * Vars
     */

    /*
     *This is the only way to get it working on all post types,
     * though _builtin is set to false, it actually appears on all
     * post types (buitin and not builtin)
     */
    $args               = array( 'public' => true, '_builtin' => false );
    $set_post_types     = get_post_types($args);

    // exclude post types
    $exclude_post_types =   isset(get_option('_booster_sweeper_options')[ 'exclude_settings_post_types' ])
                        ?         get_option('_booster_sweeper_options')[ 'exclude_settings_post_types' ] : '';

    $exclude_post_types = ! empty($exclude_post_types) ? explode(' ', $exclude_post_types) : array();
    $exclude_post_types = array_map('sanitize_title', $exclude_post_types);
    $_escaped_excluded_post_types = array_map('esc_html', $exclude_post_types);

    // trim the values of $exclude_post_types
    $_escaped_excluded_post_types = array();

foreach ( $exclude_post_types as $key ) {
    // we have to escape it here
    $_escaped_excluded_post_types[] = esc_html(trim($key));
}


    $no_options_frontend    = esc_html__('No options available -> Page has to be visited at least once on the front side to collect the resources.', 'booster-sweeper');
    $chosen_placeholder_res = esc_html__('Select some options here...', 'booster-sweeper');

    // set frontend tab
    $frontend_tab = array(
        'title'     => esc_html__('Front end', 'booster-sweeper'),
        'icon'      => 'fas fa-forward',
        'fields'    => array(
            array(
                'id'            => 'frontend_styles',
                'type'          => 'select',
                'title'         => esc_html__('Select style(s)', 'booster-sweeper'),
                'options'       => 'booster_sweeper_list_single_frontend_styles',
                'empty_message' => $no_options_frontend,
                'chosen'        => true,
                'placeholder'   => $chosen_placeholder_res,
                'multiple'      => true,
            ),
            array(
                'id'            => 'frontend_scripts',
                'type'          => 'select',
                'title'         => esc_html__('Select script(s)', 'booster-sweeper'),
                'options'       => 'booster_sweeper_list_single_frontend_scripts',
                'empty_message' => $no_options_frontend,
                'chosen'        => true,
                'placeholder'   => $chosen_placeholder_res,
                'multiple'      => true,
            ),
        )
    );


    /*
     * Differentiate options availabe on the basic & the pro version
     */
    if (function_exists('booster_sweeper_metabox_settings_pro') ) {

        $get_license = class_exists('Booster__Sweeper__Pro') && Booster__Sweeper__Pro::getLicense() !== '' ? true : false;

        if ($get_license === true) {

            $backend_tab_fields = booster_sweeper_metabox_settings_pro();

            // if license not active
        } else {

            $backend_tab_fields = array(
                array(
                    'type'     => 'callback',
                    'function' => 'booster_sweeper_license_call',
                ),
            );
        }

        // if the pro plugin isn't active
    } else {

        $backend_tab_fields = array(
            array(
                'type'     => 'callback',
                'function' => 'booster_sweeper_upgrade_call',
            ),
        );
    }


    // Gather the fields for backend tab
    $backend_tab = array(
        'title'   => esc_html__('Back end', 'booster-sweeper'),
        'icon'    => 'fas fa-backward',
        'fields'  => $backend_tab_fields,
    );


    /*
     * Booster sweeper metabox.
     */

    $exclude_settings_indi = isset(get_option('_booster_sweeper_options')[ 'exclude_settings_indi' ])
                           ?       get_option('_booster_sweeper_options')[ 'exclude_settings_indi' ] : '';

    if ($exclude_settings_indi !== '1') {

        CSF::createMetabox(
            '_mb_booster_sweeper', array(
            'title'              => 'Booster Sweeper',
            'post_type'          => $set_post_types,
            'exclude_post_types' => $_escaped_excluded_post_types,
            'context'            => 'side',
            )
        );

        CSF::createSection(
            '_mb_booster_sweeper', array(
                'fields' => array(
                    array(
                        'id'        => 'test_mode',
                        'type'      => 'checkbox',
                        'title'        => esc_html__('Test mode', 'booster-sweeper'),
                        'help'        => esc_html__('If enabled, applied rules will be rendered only to the logged in users who can manage options, i.e. you.', 'booster-sweeper'),
                    ),
                    array(
                        'id'        => 'tabbed_options',
                        'type'      => 'tabbed',
                        'help'      => esc_html__('Switch the tabs to set all the options',    'booster-sweeper'),
                        'desc'      => esc_html__('Frontend options are updated on the actual page load, i.e. page has to be visited for options to be updated.',    'booster-sweeper'),
                        'tabs'      => array(
                            $frontend_tab,
                            $backend_tab,
                        ),
                    ),
                )
            )
        );

    }
