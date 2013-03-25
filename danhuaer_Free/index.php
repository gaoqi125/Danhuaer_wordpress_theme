<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
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
		     <h1><?php if ( is_home() or is_front_page() ) : ?>
                 <span>最新发布</span>
				 <?php else : ?>
				 <?php the_title() ; ?>
				 <?php endif; ?></h1>
		  </div>
		 </div>
			<div id="content" role="main">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
            <div class="clear"></div>
            <?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'danhuaer' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'danhuaer' ) ); ?></div>
				</div><!-- #nav-below -->
<?php else : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link(); ?></div>
					<div class="nav-next"><?php previous_posts_link(); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
		</div><!-- #container -->

<?php get_footer(); ?>
