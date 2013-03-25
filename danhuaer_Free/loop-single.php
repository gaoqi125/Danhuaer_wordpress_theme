<?php
/**
 * The loop that displays a single post.
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.2
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(inner); ?>>

					<div class="entry-meta top-col">
						<span class="meta">
						 <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo esc_attr( $posts_by_title ); ?>" rel="author">@<?php the_author(); ?></a> 
						 <?php time_diff( $time_type = 'post' ); ?>
						</span>
					</div><!-- .entry-meta -->

					<h1 class="entry-content">
					
						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'danhuaer' ), 'after' => '</div>' ) ); ?>
					</h1><!-- .entry-content -->
                                             
               <div id="share-bar" class="share-bar-wrap entry-utility share-section">
                <?php if ( ! is_page() ) :?> 
                 <div id="nav-below" class="navigation dh_toolbar">
					<div class="nav-previous"><?php next_post_link( '%link', '<span class="meta-nav-previous"></span>' ); ?></div>
					<div class="nav-next"><?php previous_post_link( '%link', '<span class="meta-nav-next"></span>' ); ?></div>
				 </div><!-- #nav-below -->
                 <?php endif; ?> 
                <span class="prompt left">转贴：</span><?php wp_share_button($s="");?>
                <span class="s_stat"><span class="s_Cnt"><?php if(function_exists('the_views')) { the_views(); } ?></span></span>
                 
			</div><!-- #share-bar -->
               
 
                <div class="entry-utility mt50">
                
						<?php danhuaer_posted_in(); ?>
						<?php $via = get_post_meta($post->ID, 'via', true);
						$via_s = mb_strimwidth(str_replace(array ('http://','https://','www.'), '', $via), 0, 18, "…");	 
						if ($via) {
							echo '<span class="textline">|</span>来源：<a href="'.$via.'" rel="nofollow" class="external" target="_blank">'.$via_s.'</a>';
							
						}?>
						
				</div><!-- .entry-utility -->           
              
              <div class="argslist img-row">
               <h3 class="content-title">订阅我们</h3>
                    <div class="getlike-col">
                     <div class="mail_send">
                     <form method="post" target="_blank" action="http://list.qq.com/cgi-bin/qf_compose_send">
                     <input type="hidden" value="qf_booked_feedback" name="t">
                     <input type="hidden" value="47d5a6bb79fb6ce9df3e6a28edc554d650d07bfbb6f95ba1" name="id">
                     <input type="text" onblur="if (this.value == '') {this.value = '填写你的邮箱地址，订阅我们的最新精彩内容推送';}" onfocus="if (this.value == '填写你的邮箱地址，订阅我们的最新精彩内容推送') {this.value = '';}" value="填写你的邮箱地址，订阅我们的最新精彩内容推送" class="rsstxt" name="to" id="to" style="width: 70%;color: #ccc;*height:21px;_width:340px">
                     <input type="submit" class="subbutton" value="确认订阅">
                     </form> 
                     </div>
                    </div><!-- .getlike-col -->
              </div>       
                 
               
                    
             <div class="argslist img-row">
              <h3 class="content-title">刚刚更新</h3>
              <div class="single_l_area">          
               <?php 
               $args = array(
               'post__not_in' => array( $post->ID ),
               'showposts' => 6,
               'caller_get_posts' => 1,
               );
               query_posts($args);

               if (have_posts()) : 
               while (have_posts()) : the_post(); update_post_caches($posts); ?>
               <a class="img-l-block w75 mlr1" href="<?php the_permalink(); ?>">
               <div class="img-l-border h75 radius"></div><?php the_post_thumbnail(array(75,75), array( 'class' => 'img-l-src wh75 radius','title' => get_the_title(),'alt' => get_the_title())); ?><div class="img-l-title"><?php echo get_the_title(); ?></div>
               </a>
               <?php endwhile; else : ?>
               * 暂无最新文章
               <?php endif; wp_reset_query(); ?>
               </div>
              <div class="single_r_area ld_bg radius"> 
               <script type="text/javascript"><!--
                google_ad_client = "ca-pub-7823116249740234";
                /* 250x250图片广告 */
                google_ad_slot = "5593757277";
                google_ad_width = 250;
                google_ad_height = 250;
                //-->
               </script>
               <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
              </div>                           
              </div><!-- .argslist img-row -->
 
				</div><!-- #post-## -->
               
				
                <?php if ( comments_open() ) : ?>
                <div id="comments_box">
                <?php comments_template( '', true ); ?>
                </div>   <!-- #comments_box -->
                <?php endif; ?> 
                       
                
               
               

<?php endwhile; // end of the loop. ?>