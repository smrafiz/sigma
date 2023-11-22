<?php
/**
 * Theme Engine Room.
 * This theme uses PSR-4 and OOP logic instead of procedural coding.
 * Every function, hook and action is properly divided and organized inside related folders and files.
 *
 * @package ThemeStarter\Signature
 * @since   1.0.0
 */

declare( strict_types=1 );

use ThemeStarter\Signature\Bootstrap;
use ThemeStarter\Signature\Common\Functions\Functions;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Load PSR4 autoloader.
 *
 * @since 1.0.0
 */
$sd_signature_autoloader = require get_parent_theme_file_path( 'vendor/autoload.php' );

if ( ! class_exists( 'ThemeStarter\Signature\\Bootstrap' ) ) {
	wp_die( esc_html__( 'Easy Docs is unable to find the Bootstrap class.', 'signature' ) );
}

/**
 * Bootstrap the theme.
 *
 * @param object $sd_signature_autoloader Autoloader Object.
 *
 * @since 1.0.0
 */
add_action(
	'after_setup_theme',
	static function () use ( $sd_signature_autoloader ) {
		$app = new Bootstrap();
		$app->registerServices( $sd_signature_autoloader );
	}
);

/**
 * Create a function for external uses.
 *
 * @return Functions
 * @since 1.0.0
 */
function sd_signature() {
	return new Functions();
}
