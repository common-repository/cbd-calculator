<?php
/*
Plugin Name: CBD Calculator
Plugin URI: https://cbd-reviewed.com/
Description: Convert MG into ML, calculate the right CBD amounts for humans and pets, according to issue type, severity and weight. Easy as a breeze by using simple shortcodes.
Author: Cbd-Reviewed.com
Author URI: https://cbd-reviewed.com/
Text Domain: cbd-calculator
Version: 1.0.1
*/

if ( ! defined( 'ABSPATH' ) ) { return; } // Exit if accessed directly

/**
 * Define common constants
 */
if ( ! defined( 'CBD_CALC_DIR_URL' ) )  define( 'CBD_CALC_DIR_URL',  plugins_url( '', __FILE__ ) );
if ( ! defined( 'CBD_CALC_DIR_PATH' ) ) define( 'CBD_CALC_DIR_PATH', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'CBD_CALC_VERSION' ) )  define( 'CBD_CALC_VERSION', '1.0.0' );

// Include required files
require_once CBD_CALC_DIR_PATH . '/include/shortcode.php';
require_once CBD_CALC_DIR_PATH . '/include/settings.php';

if ( file_exists( CBD_CALC_DIR_PATH . '/include/email.php' ) ) {
	require_once CBD_CALC_DIR_PATH . '/include/email.php';
}

if ( ! function_exists( 'cbd_calc_enqueue_scripts' ) ) {
	/**
	 * Register scripts and styles
	 * @return void
	 */
	function cbd_calc_enqueue_scripts() {
		$options = get_option( 'cbd_plugin' );
		$language = isset( $options['language'] ) ? $options['language'] : 'en';
		
		wp_register_style( 'cbd_calc-styles',   CBD_CALC_DIR_URL . '/assets/css/style.css?' . time(), array(), CBD_CALC_VERSION );
		wp_register_script( 'cbd_calc-scripts', CBD_CALC_DIR_URL . '/assets/js/scripts.js?' . time(), array( 'jquery' ), CBD_CALC_VERSION, true );
		
		if ( $language == 'en' ) {
			$data = array(
				'sending' => esc_html__( 'Sending...', 'cbd-calculator' ),
				'sent' => esc_html__( 'Finished', 'cbd-calculator' ),
				'incorrect_email' => esc_html__( 'Invalid email address', 'cbd-calculator' ),
			);
		} else {
			$data = array(
				'sending' => esc_html__( 'Sendet...', 'cbd-calculator' ),
				'sent' => esc_html__( 'Bestätigen', 'cbd-calculator' ),
				'incorrect_email' => esc_html__( 'Fehlerhafte Email Adresse', 'cbd-calculator' ),
			);
		}

		$data['ajaxurl'] = admin_url( 'admin-ajax.php' );

		wp_localize_script( 'cbd_calc-scripts', 'cbd_calc', $data );
	}
}
add_action( 'wp_enqueue_scripts', 'cbd_calc_enqueue_scripts' );