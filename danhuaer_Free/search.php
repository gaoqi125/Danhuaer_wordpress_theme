<?php
/**
 * The template for displaying Search Results pages.
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
		     <h1><?php printf( __( 'Search Results for: %s', 'danhuaer' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		  </div>
		 </div>           
      
        
		

<?php if ( have_posts() ) : ?>
				<div id="content" role="main">
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
<div id="content" role="main" style="position: initial !important;width: auto !important;height: auto !important;">
	<div id="post-0" class="error404 not-found center">
		<style>#top_icon { display:none; }</style>
		<div class="entry-content">		
          <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'danhuaer' ); ?></p>
          			<?php get_search_form(); ?>
            <p><span class="error_bg"></span></p>      
            <div style="color:#3b6187; margin-bottom:20px; font-size:14px; font-weight:bold;">运气不赖哟，蛋花儿泡澡无码高清大图被你看到了！！</div>     
            <div style="margin-bottom:20px;"><a href="javascript:history.go(-1);">返回上一页</a><span class="textline">|</span><a href="<?php bloginfo( 'url' ) ?>">首页</a></div>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>
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
