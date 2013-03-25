<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

            <div id="site-info">           
          Copyright &copy; 2012 <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> All rights reserved
           <!-- 版权信息 -->
           <div id="site-generator">Theme By <a href="http://danhuaer.com/" title="蛋花儿">Danhuaer</a></div>
			</div><!-- #site-info -->
		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<?php if ( ! is_single() &&  ! is_page() ) :?>
<!--dh_cat-->
<style>#nav-below, #footer{visibility:hidden}</style>
<div id="first-infscr-loading"><img alt="Loading..." src="<?php bloginfo('template_directory'); ?>/i/indicator.gif"><span>正在加载...</span></div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dh.js"></script>
<script type="text/javascript"  src="<?php bloginfo('template_directory'); ?>/js/dh_ca.js"></script>
<script>jQuery(function($){$('#first-infscr-loading').fadeOut('normal');});</script>
<?php endif; ?>
<?php if ( is_singular() ){ ?>
<!--comments-ajax-->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
<!--dh_pack-->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dh_packs.js"></script>

</body>
</html>