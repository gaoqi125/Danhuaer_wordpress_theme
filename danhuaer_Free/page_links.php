<?php
/**
 Template Name: Links Page
 */

get_header(); ?>
<style>#header .page-container,#wrapper.page-container{width:822px}#container.metrics-container{width:817px}.widget-area{display:none}</style>
		<div id="container" class="metrics-container">
			<div id="content" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(inner); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="inner">
						<?php wp_list_bookmarks('categorize=0&
category_orderby=id&before=<li>&after=</li>&show_images=0&
show_description=0&orderby=name&title_li=LINKS：&title_before=<h3>&title_after=</h3>'); ?>
					</div>
				</div><!-- #post-## -->
                
                <div class="clear inner">
                <h1 class="entry-title">申请友链</h1>
                <div class="linkapply">
                欢迎各大网站交换友情链接。目前仅接受文字链接，将会以文字的方式放在本页面。<br/>在您把本站加入贵站友情链接后，请给我来邮件，注明链接方式并附链接代码。我们将尽快将贵站做好友情链接。<br/>
                Mailto：nigoli@vip.qq.com
                <div class="linkinto">
                链接名称：<strong>蛋花儿</strong><br>
                链接网址：<strong>http://danhuaer.com</strong><br>
                链接代码：<textarea cols="40" rows="3" name="link_code" id="link_code"><a href="http://danhuaer.com" target="_blank">蛋花儿</a></textarea>
                </div>
                </div>

                
                </div>

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
