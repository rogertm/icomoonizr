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

get_header(); ?>

		<section id="main-content" <?php t_em_breakpoint( 'main-content' ); ?>>
			<section id="content" role="main" <?php t_em_breakpoint( 'content' ); ?>>
				<?php do_action( 't_em_action_content_before' ); ?>
				<?php do_action( 't_em_action_content_after' ); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
			<?php get_sidebar( 'alt' ); ?>
		</section><!-- #main-content -->

<?php get_footer(); ?>
