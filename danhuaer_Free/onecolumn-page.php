<?php
/**
 * Template Name: One column, no sidebar
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */

get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">

			<?php
			 get_template_part( 'loop', 'page' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
