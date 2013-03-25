<?php
/**
 * The template for displaying Archive pages.
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */

get_header(); ?>

		<div id="container">
          <div class="center">
		  <div class="inline-block-center page-title">
		    <div class="line-separator linen right"></div>
		    <div class="line-separator linen left"></div>
		     <h1>
		        <?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'danhuaer' ), get_the_date() ); ?>
		        <?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'danhuaer' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'danhuaer' ) ) ); ?>
		        <?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'danhuaer' ), get_the_date( _x( 'Y', 'yearly archives date format', 'danhuaer' ) ) ); ?>
		        <?php else : ?>
				<?php _e( 'Blog Archives', 'danhuaer' ); ?>
		        <?php endif; ?>
			</h1>
		  </div>
		 </div>
        
  
			<div id="content" role="main">

<?php

	if ( have_posts() )
		the_post();
?>

<?php

	rewind_posts();

	 get_template_part( 'loop', 'archive' );
?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
