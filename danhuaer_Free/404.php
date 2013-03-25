<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */

get_header(); ?>

	<div id="container">
		<div id="content404" role="main">

	<div id="post-0" class="error404 not-found center">
		<style>#top_icon { display:none; }</style>
		<div class="entry-content">		
          <div style="color:#3b6187; margin-bottom:20px; font-size:16px; font-weight:bold;">404 - 运气不赖哟，蛋花儿泡澡无码高清大图被你看到了！！</div>
          <div style="margin-bottom:20px;"><a href="javascript:history.go(-1);"><span class="arrowleft"></span>返回上一页</a><span class="textline">|</span><a href="<?php bloginfo( 'url' ) ?>">访问首页<span class="arrowright"></span></a></div>
            <p><span class="error_bg"></span></p>           
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>