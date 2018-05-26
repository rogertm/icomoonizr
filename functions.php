<?php
/**
 * Icomoonizr
 *
 * @package			WordPress
 * @subpackage		Icomoonizr
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Icomoonizr 1.0
 */

/**
 * Icomoonizr Setup
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_setup(){
	// Make Icomoonizr available for translation.
	load_child_theme_textdomain( 'icomoonizr', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'icomoonizr_setup' );

/**
 * Enqueue and register all css and js
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_enqueue(){
	wp_register_style( 'icomoonizr-', t_em_get_css( 'theme', T_EM_CHILD_THEME_DIR_PATH .'/css', T_EM_CHILD_THEME_DIR_URL .'/css' ), '', t_em_theme( 'Version' ), 'all' );
	wp_enqueue_style( 'icomoonizr-' );
}
add_action( 'wp_enqueue_scripts', 'icomoonizr_enqueue' );

/**
 * Dequeue styles form parent theme
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_dequeue(){
	wp_dequeue_style( 'twenty-em-style' );
	wp_deregister_style( 'twenty-em-style' );
}
add_action( 'wp_enqueue_scripts', 'icomoonizr_dequeue', 999 );
?>
