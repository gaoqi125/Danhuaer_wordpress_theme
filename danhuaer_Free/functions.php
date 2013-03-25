<?php
/**
 * danhuaer functions and definitions
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */

if ( ! isset( $content_width ) )
	$content_width = 640;
add_action( 'after_setup_theme', 'danhuaer_setup' );

if ( ! function_exists( 'danhuaer_setup' ) ):
function danhuaer_setup() {
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'danhuaer', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'danhuaer' ),
	) );
	add_custom_background();
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/i/headers/home-banner.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to danhuaer_header_image_width and danhuaer_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'danhuaer_header_image_width', 1440 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'danhuaer_header_image_height', 198 ) );

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See danhuaer_admin_header_style(), below.
	add_custom_image_header( '', 'danhuaer_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/i/headers/neihan-banner.jpg',
			'thumbnail_url' => '%s/i/headers/neihan-banner.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'danhuaer' )
		),
		'path' => array(
			'url' => '%s/i/headers/home-banner.jpg',
			'thumbnail_url' => '%s/i/headers/home-banner.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'danhuaer' )
		)
	) );
}
endif;

if ( ! function_exists( 'danhuaer_admin_header_style' ) ) :
function danhuaer_admin_header_style() {
?>
<style type="text/css">
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
</style>
<?php
}
endif;

function danhuaer_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'danhuaer_page_menu_args' );

//首页文章字数限制
function danhuaer_excerpt_length( $length ) {
	return 300;
}
add_filter( 'excerpt_length', 'danhuaer_excerpt_length' );


add_filter( 'use_default_gallery_style', '__return_false' );

function danhuaer_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'danhuaer_remove_gallery_css' );

if ( ! function_exists( 'danhuaer_comment' ) ) :
function danhuaer_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	preg_match_all('/\[img=?\]*(.*?)(\[\/img)?\]/e', $comment->comment_content, $matches);
		$sum = count($matches[1]);
		if ($sum > 0)
			$comment_pic = $matches[1][0];
	//读取评论文字内容，过滤代码和图片
	$comment_content = trim(strip_tags(apply_filters( 'comment_text', $comment->comment_content )));
	$comment_excerpt = '【'.get_the_title().'】 @'.get_comment_author() .'：'.urlencode( $comment_content);
	$comment_title = get_the_excerpt();
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class('comment-item'); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-pspan">
		<div class="comment-author vcard commenter">
              <div class="comment-meta commentmetadata">
                  <div class="share_up left">                 
                  <a rel="nofollow" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo urlencode(esc_url( get_permalink() )); ?>&amp;pics=<?php if(is_page()): echo urlencode($comment_pic); else : echo p2_catch_that_image(); endif; ?>&amp;title=<?php echo urlencode($comment_title); ?> &amp;summary=<?php echo '@'.get_comment_author() .'：'.urlencode( $comment_content); ?>" title="转发到QQ空间" target="_blank"><span alt="转发到QQ空间" class="cs_qzone comment_social"></span></a>
                  <a rel="nofollow" href="http://v.t.qq.com/share/share.php?appkey=801069107&amp;title=<?php echo $comment_excerpt; ?>&amp;pic=<?php if(is_page()): echo urlencode($comment_pic); else : echo p2_catch_that_image(); endif; ?>&amp;url=<?php echo urlencode(esc_url( get_permalink() )); ?>" title="转贴到腾讯微博" target="_blank"><span alt="腾讯微博" class="cs_qq comment_social"></span></a>
                  <a rel="nofollow" href="http://service.weibo.com/share/share.php?appkey=1767202731&amp;title=<?php echo $comment_excerpt; ?>&amp;pic=<?php if(is_page()): echo urlencode($comment_pic); else : echo p2_catch_that_image(); endif; ?>&amp;url=<?php echo urlencode(esc_url( get_permalink() )); ?>" title="转发到新浪微博" target="_blank"><span alt="转发到新浪微博" class="cs_sina comment_social"></span></a>                
                  </div><!-- .share_up -->
                  <div class="reply_up left">
			      <?php edit_comment_link( '<span class="cs_edit comment_social"></span>' ); ?><?php comment_reply_link( array_merge( (array)$args, array( 'reply_text' =>'<span title="评论" class="cs_reply comment_social"></span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                  </div><!-- .share_up -->
              </div><!-- .comment-meta .commentmetadata -->
			<?php echo get_avatar( $comment, 50 ); ?>
			<?php printf( __( '%s', 'danhuaer' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            <div class="comment-body"><?php comment_text(); ?></div>  
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'danhuaer' ); ?></em>
			<br />
		<?php endif; ?>	

		<div class="vote">
			<span class="actions" ><?php if(function_exists(ckrating_display_karma)) { ckrating_display_karma(); } ?></span>
            
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'danhuaer' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'danhuaer' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


function danhuaer_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'danhuaer' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'danhuaer' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'danhuaer' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'danhuaer' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'danhuaer_widgets_init' );


function danhuaer_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'danhuaer_remove_recent_comments_style' );

if ( ! function_exists( 'danhuaer_posted_on' ) ) :
function danhuaer_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'danhuaer' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'danhuaer' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'danhuaer_posted_in' ) ) :
function danhuaer_posted_in() {
	$tag_list = get_the_tag_list( '', '&nbsp;&nbsp;' );
	if ( $tag_list ) {
		$posted_in = '<a href="%3$s" title="链向 %4$s 的固定链接" rel="bookmark">永久链接</a><span class="textline">|</span>分类：%1$s<span class="textline">|</span>标签：%2$s';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = '<a href="%3$s" title="链向 %4$s 的固定链接" rel="bookmark">永久链接</a><span class="textline">|</span>分类：%1$s';
	} else {
		$posted_in ='<a href="%3$s" title="链向 %4$s 的固定链接" rel="bookmark">永久链接</a>';
	}
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


function p2_catch_that_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_post_thumbnail($post->ID, 'large'), $matches);
$first_img = $matches [1] [0];
if(empty($first_img)){
$first_img = get_bloginfo('template_url') . '/i/default.jpg';
}
return $first_img;
}

function p2_catch_that_image_m() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_post_thumbnail($post->ID, 'medium'), $matches);
$first_img = $matches [1] [0];
if(empty($first_img)){
$first_img = get_bloginfo('template_url') . '/i/default.jpg';
}
return $first_img;
}

//************禁用WP无用的功能函数************
//完整的删除WordPress的版本号
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');
//移除head中的rel="wlwmanifest"
remove_action("wp_head", "wlwmanifest_link");
//移除head中的rel="EditURI"
remove_action('wp_head','rsd_link');
//评论跳转链接添加nofollow
function nofollow_compopup_link(){
    return' rel="nofollow"';
  }
add_filter('comments_popup_link_attributes','nofollow_compopup_link');

//禁止自动把'Wordpress'之类的变成'WordPress'
remove_filter('comment_text','capital_P_dangit',31);
remove_filter('the_content','capital_P_dangit',11);
remove_filter('the_title','capital_P_dangit',11);
/*禁用半角引号自动转换为全角引号*/
remove_filter('the_content','wptexturize');


//pin列表评论摘要内容
function pin_list_comment($content) {
  $content = trim(strip_tags(preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '', $content)));
  $content = wp_status($content, '', 23, 1);
  return $content;
}
add_filter('get_comment_excerpt', 'pin_list_comment');


 //修改标签云格式   
add_filter('widget_tag_cloud_args','style_tags');
function style_tags($args) {
$categories=get_categories();
foreach($categories as $category) {
	 echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . $category->count. ' 个话题" ' . '>' . $category->name.'</a>';
	 } 
$args = $categories.$args;
$args = array(       
'largest'    => '12',      
'smallest'   => '12', 
'unit'   => 'px',
'format'     => 'flat',  
'separator'  => '', //标签之间的文本/空格
'number' => '29',    
//'exclude' => 'id', 将要排除的标签（term_id）的ID，各ID用逗号隔开。默认不排除任何标签。
//'include' => 'id', 将要包含的标签（term_id）的ID，各ID用逗号隔开。默认包含所有标签。
'orderby' => 'count',      
'order' => 'DESC'  
);
return $args;
}

//更换后台登录界面logo图标
add_filter('login_headerurl', create_function(false,"return get_bloginfo( 'url' );"));
add_filter('login_headertitle', create_function(false,"return get_bloginfo( 'description' );"));
 function nowspark_login_head() {
    echo '<style type="text/css">body.login #login h1 {background-color: white;margin-left: 8px;font-weight: normal;-moz-border-radius: 3px;-khtml-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;border: 1px solid #E5E5E5;-moz-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;-webkit-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;-khtml-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;margin-bottom: 10px;} body.login #login h1 a {background: url('.get_bloginfo( 'template_directory' ).'/i/danhuaer_logo.gif) no-repeat 0 0 transparent;background-size:195px 65px;padding: 0;margin: 10px auto 5px;width: 200px;background-color: white;}</style>';}
add_action("login_head", "nowspark_login_head");

//隐藏管理后台帮助按钮和版本更新提示
function hide_help() {
	echo'<style type="text/css">#contextual-help-link-wrap { display: none !important; } .update-nag{ display: none !important; } #footer-left, #footer-upgrade{ display: none !important; }#wp-admin-bar-wp-logo{display: none !important;}.default-header img{width:400px;}</style>
	<link rel="shortcut icon" href="http://danhuaer.com/favicon.ico" >
   <link rel="icon" type="image/gif" href="http://danhuaer.com/animated_favicon1.gif" >
   <link rel="apple-touch-icon" href="http://danhuaer.com/apple-touch-icon.png" >';
}
add_action('admin_head', 'hide_help');

//隐藏管理工具栏admin Bar
function hide_admin_bar($flag) {
return false;
}
add_filter('show_admin_bar','hide_admin_bar'); 


//评论贴图支持[img][/img]标签
/* Comment Image Embedder */
function embed_images($content) {
  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
  $content = preg_replace('/(@[^.,:;!?\\s#@。，：；！？]+)/u', '<span style="color:#999">$1</span>', $content);
  return $content;
}
add_filter('comment_text', 'embed_images');
add_filter('comment_text_rss', 'embed_images', '', 1);


//把页面从搜索结果中排除
add_filter('pre_get_posts','search_filter');
function search_filter($query) {
          if ($query->is_search) {
                    $query->set('post_type', 'post');
          }
          return $query;
}

//文章与评论时间优化
function time_diff( $time_type ){
    switch( $time_type ){
        case 'comment':    //如果是评论的时间
            $time_diff = current_time('timestamp') - get_comment_time('U');
			if( $time_diff < 60 )
                echo '刚刚';
            elseif(( $time_diff < 3600 ) && ($time_diff >= 60))
                echo human_time_diff(get_comment_time('U'), current_time('timestamp')). '前';
			elseif (($time_diff < 86400) && ($time_diff >= 3600)) 
			    echo get_comment_time('G:i');
            else
                echo get_comment_time('n/d G:i');
            break;
        case 'post';    //如果是日志的时间
            $time_diff = current_time('timestamp') - get_the_time('U');
			if( $time_diff < 60 )
                echo '刚刚';
            elseif(( $time_diff < 3600 ) && ($time_diff >= 60))
                echo human_time_diff(get_the_time('U'), current_time('timestamp')). '前';
			elseif (($time_diff < 86400) && ($time_diff >= 3600)) 
			    echo get_the_time('G:i');
            else
                the_time('n/d G:i');
            break;
    }
}

//RSS优化
function diw_post_thumbnail_feeds($content) {
	global $post;
$post_excerpt = strip_tags(apply_filters('the_content', $post->post_content));
$content = $post_excerpt. '<div>' . get_the_post_thumbnail($post->ID, 'large') . '</div>';
	return $content;
}
add_filter('the_excerpt_rss', 'diw_post_thumbnail_feeds');
add_filter('the_content_feed', 'diw_post_thumbnail_feeds');
//修改RSS中的文章标题，更改字数。
function wpbeginner_titlerss($content) {
global $post;
if (is_single()){
$post_excerpt = strip_tags(apply_filters('the_content', $post->post_content));
}else{
$post_excerpt = $post->post_title;
}
$post_v_title = mb_strimwidth(strip_tags($post_excerpt), 0, 122,"…");
$post_title = mb_strimwidth(strip_tags($post_excerpt), 0, 126,"…");
$content = $post_title;
return $content;
}
add_filter('the_title_rss', 'wpbeginner_titlerss');


//禁用wordpress评论html代码
function plc_comment_post( $incoming_comment ) {
	$incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
	$incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );
	return( $incoming_comment );
}
function plc_comment_display( $comment_to_display ) {
	$comment_to_display = str_replace( '&apos;', "'", $comment_to_display );
	return $comment_to_display;
}
add_filter( 'preprocess_comment', 'plc_comment_post', '', 1);
add_filter( 'comment_text', 'plc_comment_display', '', 1);
add_filter( 'comment_text_rss', 'plc_comment_display', '', 1);
add_filter( 'comment_excerpt', 'plc_comment_display', '', 1);
//删除评论中的url自动链接
remove_filter('comment_text', 'make_clickable', 9);
//删除评论者的网站url链接
function my_get_comment_author_link($content) {
	$content = ereg_replace("<a [^>]*>|<\/a>","",$content);
		return $content;
}
add_filter('get_comment_author_link', 'my_get_comment_author_link');
add_filter('get_avatar', 'my_get_comment_author_link');

// 字符长度(一个汉字代表一个字符，两个字母代表一个字符)
if (!function_exists('wp_strlen')) {
	function wp_strlen($text) {
		$a = mb_strlen($text, 'utf-8');
		$b = strlen($text);
		$c = $b / 3 ;
		$d = ($a + $b) / 4;
		if ($a == $b) { // 纯英文、符号、数字
			return $b / 2;
		} elseif ($a == $c) { // 纯中文
			return $a;
		} elseif ($a != $c) { // 混合
			return $d;
		} 
	} 
} 
// 截取字数
if (!function_exists('wp_status')) {
	function wp_status($content, $url, $length, $num = '') {
		$temp_length = (mb_strlen($content, 'utf-8')) + (mb_strlen($url, 'utf-8'));
		if ($num) {
			$temp_length = (wp_strlen($content)) + (wp_strlen($url));
		} 
		if ($url) {
			$length = $length - 4; // ' - '
			$url = ' ' . $url;
		} 
		if ($temp_length > $length) {
			$chars = $length - 3 - mb_strlen($url, 'utf-8'); // '...'
			if ($num) {
				$chars = $length - wp_strlen($url);
				$str = mb_substr($content, 0, $chars, 'utf-8');
				preg_match_all("/([\x{0000}-\x{00FF}]){1}/u", $str, $half_width); // 半角字符
				$chars = $chars + count($half_width[0]) / 2;
			} 
			$content = mb_substr($content, 0, $chars, 'utf-8');
			$content = $content . "…";
		} 
		$status = $content . $url;
		return trim($status);
	} 
} 

// 社会化分享按钮
function wp_share_button($s) {
	global $post;
	$key_qq = 801069107;
	$key_sina = 1767202731;
	$post_title = trim(strip_tags($post -> post_title));
	$post_content = trim(strip_tags($post -> post_content));
	$post_excerpt = trim(strip_tags(get_the_excerpt()));
	$post_link = get_permalink($post -> ID);
	$post_id = $post -> ID;
	// 设置分类ID
		$url = urlencode($post_link); // 文章网址
		$turl = "";
		$title = urlencode($post_title) ; // 文章标题
		$content .= ($post_excerpt) ? $post_excerpt : $post_content; // 内容摘要
		// 截取字数
		$qq = urlencode(str_replace($post_link, '', wp_status($content, '', 140, 1)));
		$sina = urlencode(str_replace($post_link, '', wp_status($content, '', 140, 1)));
		//$sohu = urlencode(str_replace($post_link, '', wp_status($content, '', 140, 1)));
		//$netease = urlencode(str_replace($post_link, '', wp_status($content, '', 140)));
		$content = urlencode(str_replace($post_link, '', wp_status($content, '', 140)));
		$pic = p2_catch_that_image(); // 第一张图
		$pic_m = p2_catch_that_image_m();
	$share = array();
	
	$share['sina'] = array("新浪微博","http://service.weibo.com/share/share.php?appkey=".$key_sina."&title=".$sina."&pic=".$pic."&url=".$url);
	$share['qq'] = array("腾讯微博","http://v.t.qq.com/share/share.php?appkey=".$key_qq."&title=".$qq."&pic=".$pic."&url=".$url);
	//$share['sohu'] = array("搜狐微博","http://t.sohu.com/third/post.jsp??appkey=EyXuAogJI4bhlwJYVvtZ&title=".$sohu."&pic=".$pic."&content=utf-8&url=".$url);
	//$share['baidu'] = array("百度搜藏","http://cang.baidu.com/do/add?it=".$content."&iu=".$url."&dc=&fr=ien#nw=1");
	//$share['netease'] = array("网易微博","http://t.163.com/article/user/checkLogin.do?info=".$netease." ".$url."&images=".$pic."&link=http://tmd.cc/&source=糗事微博&togImg=true");
	
	$share['qzone'] = array("QQ空间","http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=".$url."&pics=".$pic."&title=".$title."&summary=".$content);
	$share['renren'] = array("人人网","http://share.renren.com/share/buttonshare.do?title=".$content."&link=".$url."&pic=".$pic);
	//$share['kaixin001'] = array("开心网","http://www.kaixin001.com/repaste/bshare.php?rtitle=".$title."&rcontent=".$content."&rurl=".$url);
	//$share['douban'] = array("豆瓣","http://www.douban.com/recommend/?url=".$url."&title=".$content."&v=1");
		
	// 最终输出
	foreach($share as $key => $vaule) {
		echo '<a class="left" rel="nofollow" href="' .$vaule[1]. '" title="'.$vaule[0].'" target="_blank"><span alt="'.$vaule[0].'" class="shareico share'.$s.'_'.$key.'"></span></a> ';
	}
}

function my_search_form( $form ) {
$form = '<form role="search" method="get" id="navsearchform" action="' . home_url( '/' ) . '" >
<input id="s" class="search-text radius" type="text" value="搜索好玩的... " name="s" onFocus="if (this.value == \'搜索好玩的... \')  {this.value = \'\';}" onBlur="if (this.value == \'\') {this.value = \'搜索好玩的... \';}">
</form>';
return $form; }
add_filter( 'get_search_form', 'my_search_form' );

function p2_title_from_content( $content ) {
	$title = p2_excerpted_title( $content, 30 ); 
	static $strlen =  null;
		if ( !$strlen ) {
				$strlen = function_exists( 'mb_strlen' )? 'mb_strlen' : 'strlen';
		}
		$max_len = 30;
		$title = $strlen( $content ) > $max_len? wp_html_excerpt( $title, $max_len ) . '…' : $title;
		$title = trim( strip_tags( $title ) );
		$title = str_replace("\n", " ", $title);
	return $title;
}
function p2_excerpted_title( $content, $word_count ) {
	$content = strip_tags( $content );
	$words = preg_split( '/([\s_;?!\/\(\)\[\]{}<>\r\n\t"]|\.$|(?<=\D)[:,.\-]|[:,.\-](?=\D))/', $content, $word_count + 1, PREG_SPLIT_NO_EMPTY );

	if ( count( $words ) > $word_count ) {
		array_pop( $words ); 
		$content = implode( ' ', $words );
		$content = $content . '...';
	} else {
		$content = implode( ' ', $words );
	}
	$content = trim( strip_tags( $content ) );
	return $content;
}
function p2_fix_empty_titles( $post_ID, $post ) {
	if ( ! is_object( $post ) || 'post' !== $post->post_type )
		return;
	if ( empty( $post->post_title ) ) {
		$post->post_title = p2_title_from_content( $post->post_content );
		$post->post_modified = current_time( 'mysql' );
		$post->post_modified_gmt = current_time( 'mysql', 1 );
		return wp_update_post( $post );
	}
}
add_action( 'save_post', 'p2_fix_empty_titles', 10, 2 );