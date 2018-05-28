<?php
/**
 * Icomoonizr
 *
 * @package			WordPress
 * @subpackage		Icomoonizr
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/icon-pack
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

	// remove_action( 't_em_action_site_info_bottom', 't_em_credit' );
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

	wp_register_script( 'child-app-utils', t_em_get_js( 'app.utils', T_EM_CHILD_THEME_DIR_PATH .'/js', T_EM_CHILD_THEME_DIR_URL .'/js' ), array( 'jquery' ), t_em_theme( 'Version' ), true );
	wp_enqueue_script( 'child-app-utils' );
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

/**
 * Add custom general options to Admin Panel
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_custom_general_options(){
	// Get JSON file to read the Icon Pack from GitHub
?>
	<div class="sub-layout text-option general">
		<label class="description single-option">
			<p><?php _e( 'JSON file for Icon Pack', 'icomoonizr' ); ?></p>
			<p class="description"><?php _e( 'URL address of JSON file to read the Icon Pack', 'icomoonizr' ); ?></p>
			<input type="text" class="regular-text" name="t_em_theme_options[icon_pack_json]" value="<?php echo t_em( 'icon_pack_json' ) ?>" />
		</label>
	</div>
<?php
}
add_action( 't_em_admin_action_general_options_after', 'icomoonizr_custom_general_options', 15 );

/**
 * Merge into default theme options
 * This function is attached to the "t_em_admin_filter_default_theme_options" filter hook
 * @return array 	Array of options
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_default_theme_options( $default_theme_options ){
	$options = array(
		'icon_pack_json'	=> '',
	);
	$default_options = array_merge( $default_theme_options, $options );
	return $default_options;
}
add_filter( 't_em_admin_filter_default_theme_options', 'icomoonizr_default_theme_options' );

/**
 * Sanitize and validate the input.
 * This function is attached to the "t_em_admin_filter_theme_options_validate" filter hook
 * @param $input array  Array of options to validate
 * @return array
 *
 * @since Icomoonizr 1.0
 */
function icomoonizr_options_validate( $input ){
	if ( ! $input )
		return;

	$input['icon_pack_json'] = ( isset( $input['icon_pack_json'] ) ) ? esc_url_raw( $input['icon_pack_json'] ) : '';

	return $input;
}
add_filter( 't_em_admin_filter_theme_options_validate', 'icomoonizr_options_validate' );

/**
 * Icon Demo
 *
 * @since Icomoonizr 1.1
 */
function icomoonizr_icomoon_demo(){
	if ( ! is_front_page() )
		return;

	/**
	 * Get the icons from GitHub
	 */
	$get_json		= t_em( 'icon_pack_json' );
	$read_json		= file_get_contents( $get_json );
	$decode_json	= json_decode( $read_json, true );
	$icons 			= $decode_json['icons'];
	$count			= count( $icons );
?>
	<section id="icon-pack">
		<div class="icon-filter form-group <?php echo t_em_grid( '7' ) ?>">
			<p class="lead"><?php printf( __( 'Browse in <strong>%s</strong> icons in the list below', 'icomoonizr' ), $count ) ?></p>
			<label for="icon-filter" class="sr-only"><?php _e( 'Search Icons', 'icomoonizr' ) ?></label>
			<input id="icon-filter" class="form-control form-control-lg" type="text" name="filter" placeholder="<?php _e( 'Search Icons...', 'icomoonizr' ) ?>">
		</div>
		<div class="icon-list">
<?php
	foreach ( $icons as $key => $value ) :
		$property = $value['properties'];
?>
			<div class="icon-wrapper" data-icon="<?php echo $property['name'] ?>">
				<div class="icon">
					<p class="icon-brand"><span class="<?php echo 'icomoon-'. $property['name'] ?>"></span></p>
				</div>
			</div>
<?php
	endforeach;
?>
		</div>
		<div id="icon-details" class="demo d-none">
			<div class="<?php t_em_container(); ?>">
				<div class="demo-preview"><i class="icomoon"></i></div>
				<div class="demo-class"></div>
				<div class="demo-markup"></div>
				<div class="demo-svg"></div>
			</div>
			<a id="close-details" href="#" class="text-light"><i class="icomoon-circle-with-cross"></i></a>
		</div>
	</section>
<?php
}
add_action( 't_em_action_content_before', 'icomoonizr_icomoon_demo' );
?>
