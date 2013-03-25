<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style-fuckie.css?ver=1.0.0">
<script src="<?php bloginfo('template_directory'); ?>/js/html5.js"></script>
<![endif]-->
<title><?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' );if ( $site_description && ( is_home() || is_front_page() ) )echo " | $site_description"; if ( $paged >= 2 || $page >= 2 )echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );?></title>
<?php /**头部SEO优化**/
if (is_home()) {
    // 将以下引号""中的内容改成你的主页介绍，如：蛋花儿是一个简单分享新鲜资讯的微型网站
    $description = " ";
    // 将以下引号""中的内容改成你的主页关键词，如：蛋花儿,模板,瀑布流,danhuaer,wordpress,pinterest
    $keywords = " ";
} elseif (is_page()) {
	$description = get_post_meta($post->ID, "Meta-Description", true) . mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");
	$keywords = get_post_meta($post->ID, "Meta-Keywords", true);
} elseif (is_single()) {
    $description1 = get_post_meta($post->ID, "Meta-Description", true);
    $description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");

    // 发布文章时可以填写自定义字段“description”，否则使用文章内容前200字作为描述
    $description = $description1 ? $description1 : $description2;

    // 发布文章时可以填写自定义字段“keywords”，否则使用文章tags作为关键词
    $keywords = get_post_meta($post->ID, "Meta-Keywords", true);
    if($keywords == '') {
        $tags = wp_get_post_tags($post->ID);    
        foreach ($tags as $tag ) {        
            $keywords = $keywords . $tag->name . ",";    
        }
        $keywords = rtrim($keywords, ',').','.get_the_category_list( ',' );
    }
} elseif (is_category()) {
    $description = category_description();
    $keywords = single_cat_title('', false).','.get_bloginfo( 'name' );
} elseif (is_tag()){
    $description = tag_description();
    $keywords = single_tag_title('', false).','.get_bloginfo( 'name' );
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
   <link rel="shortcut icon" href="<?php bloginfo( 'url' ); ?>/favicon.ico" >
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/style.css?ver=1.0" />
<?php wp_deregister_script( 'jquery' ); ?><script src="<?php bloginfo('template_directory'); ?>/js/jquery.js?ver=1.7.1"></script>
<?php wp_head(); ?>
<!--[if lte IE 6]>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/DD_belatedPNG-min.js" mce_src=”<?php bloginfo('template_directory'); ?>/js/DD_belatedPNG-min.js”></script>
    <script type="text/javascript">DD_belatedPNG.fix('.header_logo,.#s,.shareico,.sub_icon, .nav-cat,ul.menu li:hover,.ts_img,.ts_ie,.current-menu-item a,.sub-menu li,.cat_icon, .share-section, .commentico, .dh_social, .dh_toolbar .nav-previous, .dh_toolbar .nav-next, .dh_toolbar .meta-nav-previous, .dh_toolbar .meta-nav-next,.comment_social,.s_stat,.s_Cnt, .arrowdown, .xlong, a.video_play img, .xlong img, .actions img,#nextpage a.nextmore, .sitemap_icon, .vote_icon,#site-generator a,a.post-button'); </script>
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body <?php body_class(); ?>>

<div id="header">
    <div class="header-background">
         <div class="header-container page-container">
        <?php if ( is_user_logged_in () ) :?>  
<span class="user_logged">已登录&nbsp;<a href="<?php echo wp_logout_url(home_url()); ?>" title="Logout">退出</a></span>
         <?php else : ?>
<span class="user_logged"><a href="<?php echo wp_login_url(home_url()); ?>" title="登录">登录</a><span class="textline">|</span><a href="<?php echo home_url().'/wp-login.php?action=register'?>" title="注册">注册</a></span>
         <?php endif ?>
         <!-- 搜索框代码开始 -->
           <div class="header-search">
            <form method="get" id="navsearchform" action="<?php bloginfo('url');  ?>/">
            <input id="s" class="search-text radius" type="text" value="搜索好玩的... "  name="s" id="headersearchbox" onfocus="if (this.value == '搜索好玩的... ')  {this.value = '';}"onblur="if (this.value == '') {this.value = '搜索好玩的... ';}"  />
            </form>
           </div>
         <!-- 搜索框代码结束 -->

      <a class="header_logo" href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></a>
        <div class="left">
			<div id="access" role="navigation">
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'danhuaer' ); ?>"><?php _e( 'Skip to content', 'danhuaer' ); ?></a></div>
                
                 <!-- 头部导航菜单代码开始，请修改相应内容 -->
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
                 <!-- 浮动导航代码结束 -->
			</div><!-- #access -->
         </div>
         </div>
    </div>
    	</div><!-- #header -->
        
<div id="wrapper" class="hfeed page-container">
	
		<div id="masthead">
				
            <div id="top_icon">
            <!-- banner 图片css -->
            <?php
					// Compatibility with versions of Danhuaer prior to 3.4.
					if ( function_exists( 'get_custom_header' ) ) {
						// We need to figure out what the minimum width should be for our featured image.
						// This result would be the suggested width if the theme were to implement flexible widths.
						$header_image_width = get_theme_support( 'custom-header', 'width' );
					} else {
						$header_image_width = HEADER_IMAGE_WIDTH;
					}

					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= $header_image_width ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID );
					elseif ( get_header_image() ) :
						// Compatibility with versions of Danhuaer prior to 3.4.
						if ( function_exists( 'get_custom_header' ) ) {
							$header_image_width  = get_custom_header()->width;
							$header_image_height = get_custom_header()->height;
						} else {
							$header_image_width  = HEADER_IMAGE_WIDTH;
							$header_image_height = HEADER_IMAGE_HEIGHT;
						}
					?>
            <div class="danhuaer_icon"  style="background:url(<?php header_image(); ?>) no-repeat;background-size:<?php echo $header_image_width; ?>px <?php echo $header_image_height; ?>px;">
                     <?php endif; ?>

            
            </div></div>            
		</div><!-- #masthead -->


	<div id="main">