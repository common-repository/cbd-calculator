<?php
if ( ! class_exists( 'CbdCalcOptions' ) ) {
    class CbdCalcOptions {
        /**
         * Holds the values to be used in the fields callbacks
         */
        private $options;

        /**
         * Start up
         */
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
            add_action( 'admin_init', array( $this, 'page_init' ) );
        }

        /**
         * Add options page
         */
        public function add_plugin_page() {
            // This page will be under "Settings"
            add_options_page(
                esc_html__( 'CBD settings', 'cbd-calculator' ), 
                esc_html__( 'CBD settings', 'cbd-calculator' ),
                'manage_options', 
                'cbd-setting', 
                array( $this, 'create_admin_page' )
            );
        }

        /**
         * Options page callback
         */
        public function create_admin_page()
        {
            // Set class property
            $this->options = get_option( 'cbd_plugin' );
            
            ?>
            <div class="wrap">
                <form method="post" action="options.php">
                <?php
                    // This prints out all hidden setting fields
                    settings_fields( 'cbd_plugin_settings_group' );
                    do_settings_sections( 'my-setting-admin' );
                    submit_button();
                ?>
                </form>
            </div>
            <?php
        }

        /**
         * Register and add settings
         */
        public function page_init()
        {        
            register_setting(
                'cbd_plugin_settings_group', // Option group
                'cbd_plugin' // Option name
            );

            add_settings_section(
                'cbd_plugin_settings', // ID
                esc_html__('CBD plugin settings', 'cbd-calculator'), // Title
                array( $this, 'print_section_info' ), // Callback
                'my-setting-admin' // Page
            );

            add_settings_field(
                'language', 
                esc_html__('Language', 'cbd-calculator'), 
                array( $this, 'language_callback' ), 
                'my-setting-admin', 
                'cbd_plugin_settings'
            );

            add_settings_field(
                'weight', 
                esc_html__('Weight unit', 'cbd-calculator'), 
                array( $this, 'weight_unit_callback' ), 
                'my-setting-admin', 
                'cbd_plugin_settings'
            );

            add_settings_field(
                'email_option', 
                esc_html__('Email function', 'cbd-calculator'), 
                array( $this, 'email_option_callback' ), 
                'my-setting-admin', 
                'cbd_plugin_settings'
            );

            add_settings_field(
                'email', 
                esc_html__('Email Address', 'cbd-calculator'), 
                array( $this, 'email_callback' ), 
                'my-setting-admin', 
                'cbd_plugin_settings'
            ); 
        }

        /** 
         * Print the Section text
         */
        public function print_section_info()
        {
            esc_html_e('Enter your settings below:', 'cbd-calculator');
        }

        /** 
         * Get the settings option array and print one of its values
         */
        public function weight_unit_callback()
        {
            $weight_unit = isset( $this->options['weight_unit'] ) ? $this->options['weight_unit'] : '';
            ?>
            <select name="cbd_plugin[weight_unit]">
                <option value="kg" <?php selected('kg', $weight_unit); ?>><?php esc_html_e('Kilograms', 'cbd-calculator') ?></option>
                <option value="lbs" <?php selected('lbs', $weight_unit); ?>><?php esc_html_e('Pounds', 'cbd-calculator') ?></option>
            </select>
            <?php
        }

        /** 
         * Get the settings option array and print one of its values
         */
        public function language_callback()
        {
            $current = isset( $this->options['language'] ) ? $this->options['language'] : '';
            ?>
            <select name="cbd_plugin[language]">
                <option value="en" <?php selected('en', $current); ?>><?php esc_html_e('English', 'cbd-calculator') ?></option>
                <option value="de" <?php selected('de', $current); ?>><?php esc_html_e('German', 'cbd-calculator') ?></option>
            </select>
            <?php
        }

        /** 
         * Get the settings option array and print one of its values
         */
        public function email_option_callback()
        {
            $current = isset( $this->options['email_option'] ) ? $this->options['email_option'] : '';
            ?>
            <select name="cbd_plugin[email_option]">
                <option value="enable" <?php selected('enable', $current); ?>><?php esc_html_e('Enable', 'cbd-calculator') ?></option>
                <option value="disable" <?php selected('disable', $current); ?>><?php esc_html_e('Disable', 'cbd-calculator') ?></option>
            </select>
            <?php
        }

        /** 
         * Get the settings option array and print one of its values
         */
        public function email_callback()
        {
            $email = isset( $this->options['email'] ) ? $this->options['email'] : get_option('admin_email');
            printf(
                '<input type="text" id="title" name="cbd_plugin[email]" value="%s" />',
                esc_attr( $email )
            );
        }
    }
}

if( is_admin() ) {
    $my_settings_page = new CbdCalcOptions();
}

