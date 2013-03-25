<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to danhuaer_comment which is
 * located in the functions.php file.
 *
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */
?>

			<div id="comments" class="comment-container radius">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'danhuaer' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title" class="metadata"><?php echo get_comments_number() ?>人有话说<span class="arrowdown"></span></h3>

<?php /*?><?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'danhuaer' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'danhuaer' ) ); ?></div>
                
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?><?php */?>

			<!-- 显示正在加载新评论 -->
    <div id="loading-comments"><img alt="Loading..." src="<?php bloginfo('template_directory'); ?>/i/loading.gif"><span>正在加载新评论...</span></div>
   
            <ol class="commentlist">
				<?php
					wp_list_comments( array( 'callback' => 'danhuaer_comment') );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>			
                <div id="comments-nav" class="comtop"><?php paginate_comments_links('prev_text=«&next_text=»');?></div>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'danhuaer' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

	<?php comment_form(
				   array('title_reply' => '','comment_field'=>'<p class="comment-form-comment"><label for="comment">评论</label><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>')
				   ); ?>


</div><!-- #comments -->
