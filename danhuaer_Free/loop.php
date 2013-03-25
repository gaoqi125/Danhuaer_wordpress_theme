<?php
/**
 * The loop that displays posts.
 *
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */
?>
<?php /* 404 */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="error404 not-found center" style="width:100%;height:100%;">
		<style>#top_icon{display:none}#content{width:100%!important;height:100%!important}</style>
		<div class="entry-content">		
          <div style="color:#3b6187; margin-bottom:20px; font-size:14px; font-weight:bold;">404 - 运气不赖哟，蛋花儿泡澡无码高清大图被你看到了！！</div>
            <p><span class="error_bg"></span></p>           
            <div style="margin-bottom:20px;"><a href="javascript:history.go(-1);">返回上一页</a><span class="textline">|</span><a href="<?php bloginfo( 'url' ) ?>">首页</a></div>
          
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->


<?php endif; ?>

<?php	/* Start the Loop.	 */ ?>
     <?php $count = 0 ?>
<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class('content-node left ffm'); ?>>

			<div class="entry-content">
               
                <div class="ts_post"><div class="ts_open ts_ie"><span class="ts_img ts_icon"></span><span class="ts_img ts_text"></span><span alt="转帖到新浪微博" data="s_<?php the_ID(); ?>" class="shareico share_sina"></span><span alt="转帖到腾讯微博" data="s_<?php the_ID(); ?>" class="shareico share_qq"></span><span alt="转帖到QQ空间" data="s_<?php the_ID(); ?>" class="shareico share_qzone"></span></div></div><!-- .ts_post -->
                
                <div class="posrel">
				<a target="_blank" href="<?php the_permalink(); ?>" class="ajax ximg thepermalink"><?php the_post_thumbnail(array(192,auto), array( 'class' => 'dhpic','title' => get_the_title(),'alt' => get_the_title(),'date-enlarge' => p2_catch_that_image())); ?>
               </a>
                           
                              
                             <div class="exinfo marbot"><a target="_blank" href="<?php the_permalink(); ?>"><?php echo get_the_excerpt(); ?></a></div>
               
               </div>

                
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'danhuaer' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
            
            
    
			
          
            
            <div class="entry-utility share-section">
				<a rel="nofollow" target="_blank" title="<?php esc_attr_e( 'Leave a comment', 'danhuaer' ); ?>" href="<?php the_permalink(); ?>#respond"><span class="commentico comment_icon"></span></a>
                <span class="prompt left">转贴：</span><span alt="转帖到新浪微博" data="s_<?php the_ID(); ?>" class="shareico shareico_sina"></span><span alt="转帖到腾讯微博" data="s_<?php the_ID(); ?>" class="shareico shareico_qq"></span><span alt="转帖到QQ空间" data="s_<?php the_ID(); ?>" class="shareico shareico_qzone"></span><span class="s_stat"><span class="s_Cnt"><?php if(function_exists('the_views')) { the_views(); } ?></span></span>
                
              
                
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php $count++ ?>

<?php endwhile // have_posts() ?>


