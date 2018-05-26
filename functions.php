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

/**
 * Remove unnecessary options
 *
 * @since Icomoonizr 1.0
 */
add_filter( 't_em_admin_filter_header_options_no_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_slider', '__return_false' );
add_filter( 't_em_admin_filter_front_page_options_wp_front_page', '__return_false' );
add_filter( 't_em_admin_filter_front_page_options_widgets_from_page', '__return_false' );
add_filter( 't_em_admin_filter_archive_options_the_content', '__return_false' );
add_filter( 't_em_admin_filter_archive_options_the_excerpt', '__return_false' );
add_filter( 't_em_admin_filter_archive_pagination_output', '__return_false' );

/**
 * Modify Layout Options
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_layout_options( $layout_options = '' ){
	unset( $layout_options['two-columns-content-left'] );
	unset( $layout_options['two-columns-content-right'] );
	unset( $layout_options['three-columns-content-left'] );
	unset( $layout_options['three-columns-content-right'] );
	unset( $layout_options['three-columns-content-middle'] );
	return $layout_options;
}
add_filter( 't_em_admin_filter_layout_options', 'icomoonizr_layout_options' );

/**
 * Modify Footer Options
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_footer_options( $footer_options = '' ){
	unset( $footer_options['four-footer-widget'] );
	unset( $footer_options['three-footer-widget'] );
	unset( $footer_options['two-footer-widget'] );
	unset( $footer_options['one-footer-widget'] );
	return $footer_options;
}
add_filter( 't_em_admin_filter_footer_options', 'icomoonizr_footer_options' );
?>
