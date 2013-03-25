<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */
?>
<div id="widget_all">
		<div id="primary" class="widget-area" role="complementary">
    
<ul class="xoxo">
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

		<?php endif; // end primary widget area ?>       
			</ul>

		</div><!-- #primary .widget-area -->
        
        
     
 

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>                
			</ul>

<div id="float" class="div1">
<div class="widget-container">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-7823116249740234";
/* 300x250广告图片 */
google_ad_slot = "7001700065";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>           
</div><!-- #float -->
            
		</div><!-- #secondary .widget-area -->

<?php endif; ?>

</div><!-- #widget_all -->
