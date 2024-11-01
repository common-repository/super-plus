<?php defined('ABSPATH') or exit; ?>
<?php
if (get_option('super_plus_jdt') == 'checked') {
/*加载进度*/
    function splus_wpn_enqueue()
    {
        wp_enqueue_style('nprogresss', SUPER_PLUS_URL . 'jdt/nprogress.css');
        wp_enqueue_script('nprogress', SUPER_PLUS_URL . 'jdt/nprogress.js', array(
            'jquery'
        ), '0.1.2', true);
        wp_enqueue_script('wp-nprogress', SUPER_PLUS_URL . 'jdt/global.js', array(
            'jquery',
            'nprogress'
        ), '0.0.1', true);
    }
    add_action('wp_enqueue_scripts', 'splus_wpn_enqueue');
}
?>
<?php
if (get_option('super_plus_glgjt') == 'checked') {
/*前台隐藏顶部管理工具条*/
    show_admin_bar(false);
}
?>
<?php
/*替换头像*/
if (get_option('super_plus_gravatar') == 'checked') {
    function splus_geekzu_avatar($avatar)
    {
        $avatar = str_replace(array(
            "www.gravatar.com",
            "0.gravatar.com",
            "1.gravatar.com",
            "2.gravatar.com",
            "secure.gravatar.com"
        ), "sdn.geekzu.org", $avatar);
        return $avatar;
    }
    add_filter('get_avatar', 'splus_geekzu_avatar', 10, 3);
}
?>
<?php
if (get_option('super_plus_wryh') == 'checked') {
/*微软雅黑*/
    function splus_admin_fonts()
    {
        echo '<style type="text/css">
        * { font-family: "Microsoft YaHei" !important; }
        i, .ab-icon, .mce-close, i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page, .qt-fullscreen, .star-rating .star { font-family: dashicons !important; }
        .mce-ico { font-family: tinymce, Arial !important; }
        .fa { font-family: FontAwesome !important; }
        .genericon { font-family: "Genericons" !important; }
        .appearance_page_scte-theme-editor #wpbody *, .ace_editor * { font-family: Monaco, Menlo, "Ubuntu Mono", Consolas, source-code-pro, monospace !important; }
        .post-type-post #advanced-sortables, .post-type-post #autopaging .description { display: none !important; }
        .form-field input, .form-field textarea { width: inherit; border-width: 0; }
        </style>';
    }
    add_action('admin_head', 'splus_admin_fonts');
}
?>
<?php
if (get_option('super_plus_number') == 'checked') {
/*积分特效*/
    function splus_jifen()
    {
        echo '<script> jQuery(document).ready(function($) { $("html,body").click(function(e){ var n=Math.round(Math.random()*100); var $i=$("<b/>").text("+"+n); var x=e.pageX,y=e.pageY; $i.css({ "z-index":99999, "top":y-20, "left":x, "position":"absolute", "color":"#E94F06" }); $("body").append($i); $i.animate( {"top":y-180,"opacity":0}, 1500, function(){$i.remove();}); e.stopPropagation();});}); </script>';
    }
    add_action('wp_footer', 'splus_jifen');
}
?>
<?php
if (get_option('super_plus_chuser') == 'checked') {
/*中文用户*/
    add_filter('sanitize_user', 'splus_chinese_user', 3, 3);
    function splus_chinese_user($username, $raw_username, $strict)
    {
        $username = $raw_username;
        $username = strip_tags($username);
        $username = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $username);
        $username = preg_replace('/&.+?;/', '', $username);
        if ($strict)
            $username = preg_replace('|[^a-z0-9 _.\-@\x80-\xFF]|i', '', $username);
        $username = preg_replace('|\s+|', ' ', $username);
        return $username;
    }
}
?>
<?php
if (get_option('super_plus_ping') == 'checked') {
/* 禁止站内文章PingBack */
    function splus_no_self_ping(&$links)
    {
        $home = get_option('home');
        foreach ($links as $l => $link)
            if (0 === strpos($link, $home))
                unset($links[$l]);
    }
    add_action('pre_ping', 'splus_no_self_ping');
}
?>
<?php
if (get_option('super_plus_nofollow') == 'checked') {
/* 自动为博客内的连接添加nofollow属性并在新窗口打开链接 */
    add_filter('the_content', 'splus_cn_nf_url_parse');    
    function splus_cn_nf_url_parse($content)
    {
        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
        if (preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
            if (!empty($matches)) {
                $srcUrl = get_option('siteurl');
                for ($i = 0; $i < count($matches); $i++) {
                    $tag      = $matches[$i][0];
                    $tag2     = $matches[$i][0];
                    $url      = $matches[$i][0];
                    $noFollow = '';
                    $pattern  = '/target\s*=\s*"\s*_blank\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if (count($match) < 1)
                        $noFollow .= ' target="_blank" ';
                    $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if (count($match) < 1)
                        $noFollow .= ' rel="nofollow" ';
                    $pos = strpos($url, $srcUrl);
                    if ($pos === false) {
                        $tag = rtrim($tag, '>');
                        $tag .= $noFollow . '>';
                        $content = str_replace($tag2, $tag, $content);
                    }
                }
            }
        }
        $content = str_replace(']]>', ']]>', $content);
        return $content;
    }
}
?>
<?php
if (get_option('super_plus_bingbg') == 'checked') {
/*调用Bing美图作为登陆界面背景*/
    function splus_bingbg()
    {
        $str = file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
        if (preg_match("/<url>(.+?)<\/url>/ies", $str, $matches)) {
            $imgurl = '//cn.bing.com' . $matches[1];
            echo '<style type="text/css">body{background: url(' . $imgurl . ');width:100%;height:100%;background-image:url(' . $imgurl . ');-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;-moz-border-image: url(' . $imgurl . ') 0;background-repeat:no-repeat\9;background-image:none\9;}</style>';
        }
    }
    add_action('login_head', 'splus_bingbg');
}
?>
<?php
if (get_option('super_plus_simplifyhead') == 'checked') {
/*头部不良信息移除*/
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
}
?>
<?php
if (get_option('super_plus_100img') == 'checked') {
/*wordpress图片上传品质完美*/
add_filter('jpeg_quality', 'splus_jpeg');
function splus_jpeg() {
    return 100;
}
}
?>
<?php
if (get_option('super_plus_replaceurl') == 'checked') {
/*自动添加a标签nofollow与target="_blank"属性*/
    add_action('template_redirect', 'splus_relative_urls');   
    function splus_relative_urls()
    {
        if (is_feed() || get_query_var('sitemap'))
            return;
        $filters = array(
            'post_link',
            'post_type_link',
            'page_link',
            'attachment_link',
            'get_shortlink',
            'post_type_archive_link',
            'get_pagenum_link',
            'get_comments_pagenum_link',
            'term_link',
            'search_link',
            'day_link',
            'month_link',
            'year_link'
        );
        foreach ($filters as $filter) {
            add_filter($filter, 'wp_make_link_relative');
        }
    }
}
?>
<?php
if (get_option('super_plus_welcomemsg') == 'checked') {
/*Welcomemsg欢迎信息*/
    require "welcomemsg.php";
    function splus_welcomemsg_css()
    {
        echo '<style type="text/css">#hellobaby { width: 200px; background:#000000; border:1px solid #B3B3B3; color:#FFFFFF; font-size:14px; opacity:0.7; filter:alpha(opacity=70); padding: 10px 10px 10px 10px; position:fixed; right:0; top:150px; z-index:999; } .closebox{float:left;text-align:center;font-size:26px;margin-top:0px;padding: 0 10px 0 0;} .closebox a{border-bottom: none;}</style>';
    }
    function splus_welcomemsg()
    {
        $msg = welcome_msg();
        if ($msg !== false) {
            echo "<script type=\"text/javascript\"> (function(){ var wait = 30; var interval = setInterval(function(){ var time = --wait; if(time <= 0) { $('#hellobaby').animate({right:'-20000px'}).hide(); clearInterval(interval); }; }, 1000); })(); </script>";
            echo '<div id="hellobaby"> <div class="closebox"><a href="javascript:void(0)" onclick="$(\'#hellobaby\').animate({right:\'-20000px\'});" title="关闭">x</a></div>';
            echo $msg;
            echo '</div>';
        }
    }
    add_action('wp_head', 'splus_welcomemsg_css');
    add_action('wp_footer', 'splus_welcomemsg');
}
?>
<?php
if (get_option('super_plus_ietip') == 'checked') {
/*提示IE10以下IE用户更换浏览器*/
    function plus_ietip()
    {
        echo '<!--[if lt IE 10]><script src="//wuyongzhiyong.b0.upaiyun.com/iedie/v1.1/script.min.js"></script><![endif]-->';
    }
    add_action('wp_head', 'plus_ietip');
}
?>
<?php
if (get_option('super_plus_linkman') == 'checked') {
/*Wordpress原生链接器*/
    add_filter('pre_option_link_manager_enabled', '__return_true');
}
?>
<?php
if (get_option('super_plus_google') == 'checked') {
/*Google公共库加速geekzu版*/
    function super_plus_google($buffer)
    {
        $buffer = str_replace("fonts.googleapis.com", "fonts.geekzu.org", $buffer);
        $buffer = str_replace("ajax.googleapis.com", "sdn.geekzu.org/ajax", $buffer);
        return $buffer;
    }
    function super_plus_google_start()
    {
        ob_start("super_plus_google");
    }
    function super_plus_google_end()
    {
        ob_end_flush();
    }
    add_action('init', 'super_plus_google_start');
    add_action('shutdown', 'super_plus_google_end');
}
?>
<?php
if (get_option('super_plus_codehl') == 'checked') {
/*代码高亮*/
    function plus_add_prismjs()
    {
        wp_register_script('prismJS', SUPER_PLUS_URL . 'codehl/splus_prism.js');
        wp_enqueue_script('prismJS');
    }
    function plus_add_prismcss()
    {
        wp_register_style('prismCSS', SUPER_PLUS_URL . 'codehl/splus_prism.css');
        wp_enqueue_style('prismCSS');
    }
    add_action('wp_enqueue_scripts', 'plus_add_prismjs');
    add_action('wp_head', 'plus_add_prismcss');
}
?>
<?php
if (get_option('super_plus_compress') == 'checked') {
/*页面压缩*/
function wp_compress_html()
{
function wp_compress_html_main ($buffer)
{
    $initial=strlen($buffer);
    $buffer=explode("<!--wp-compress-html-->", $buffer);
    $count=count ($buffer);
    for ($i = 0; $i <= $count; $i++)
    {
        if (stristr($buffer[$i], '<!--wp-compress-html no compression-->'))
        {
            $buffer[$i]=(str_replace("<!--wp-compress-html no compression-->", " ", $buffer[$i]));
        }
        else
        {
            $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
            $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
            $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
            $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
            while (stristr($buffer[$i], '  '))
            {
            $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
            }
        }
        $buffer_out.=$buffer[$i];
    }
    return $buffer_out;
}
ob_start("wp_compress_html_main");
}
add_action('get_header', 'wp_compress_html');
}
?>
<?php
if (get_option('super_plus_baidusb') == 'checked') {
/*禁止百度转码*/
    function splus_baidusb()
    {
		echo '<meta http-equiv="Cache-Control" content="no-transform" />';
		echo '<meta http-equiv="Cache-Control" content="no-siteapp" />';  
    }
    add_action('wp_head', 'splus_baidusb');
}
?>
<?php
if (get_option('super_plus_jscssxx') == 'checked') {
/*移除WordPress加载的JS和CSS链接中的版本号*/
function splus_remove_cssjs_ver( $src ) {
	if( strpos( $src, 'ver='. get_bloginfo( 'version' ) ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'splus_remove_cssjs_ver', 999 );
add_filter( 'script_loader_src', 'splus_remove_cssjs_ver', 999 );
}
?>
<?php
if (get_option('super_plus_jqueryxx') == 'checked') {
/*移除WordPress自带的JS*/
function splus_enqueue_scripts() 
{
	wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'splus_enqueue_scripts', 1 );
}
?>
<?php
if (get_option('super_plus_wp38x') == 'checked') {
/*移除WordPress登陆错误抖动*/
function splus_login_error() {
        remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'splus_login_error');
}
?>
<?php
if (get_option('super_plus_wpidx') == 'checked') {
/*禁止自动保存和修改历史记录*/
add_action(‘wp_print_scripts’, ‘no_autosave’);
remove_action(‘pre_post_update’,’wp_save_post_revision’);
function no_autosave() {
wp_deregister_script(‘autosave’);
}
}
?>
<?php
if (get_option('super_plus_ncxx') == 'checked') {
/*禁止无中文评论*/
function refused_spam_comments( $comment_data ) {  
$pattern = '/[一-龥]/u';  
if(!preg_match($pattern,$comment_data['comment_content'])) {  
wp_die('请勿恶意评论,评论必须含中文!');  
}  
return( $comment_data );  
}  
add_filter('preprocess_comment','refused_spam_comments');  
}
?>
<?php
if (get_option('super_plus_xmlrpc') == 'checked') {
/*禁用WordPress的XML-RPC离线发布功能*/
add_filter('xmlrpc_enabled', '__return_false');
}
?>
<?php
if (get_option('super_plus_xwdg') == 'checked') {
/*屏蔽WordPress默认小工具*/
add_action( 'widgets_init', 'splus_unregister_widgets' );   
function splus_unregister_widgets() {   
    unregister_widget( 'WP_Widget_Archives' );   
    unregister_widget( 'WP_Widget_Calendar' );   
    unregister_widget( 'WP_Widget_Categories' );   
    unregister_widget( 'WP_Widget_Links' );   
    unregister_widget( 'WP_Widget_Meta' );   
    unregister_widget( 'WP_Widget_Pages' );   
    unregister_widget( 'WP_Widget_Recent_Comments' );   
    unregister_widget( 'WP_Widget_Recent_Posts' );   
    unregister_widget( 'WP_Widget_RSS' );   
    unregister_widget( 'WP_Widget_Search' );   
    unregister_widget( 'WP_Widget_Tag_Cloud' );   
    unregister_widget( 'WP_Widget_Text' );   
    unregister_widget( 'WP_Nav_Menu_Widget' );   
}
}
?>
<?php
if (get_option('super_plus_sox') == 'checked') {
/*WordPress关闭自动更新检测*/
add_filter('pre_site_transient_update_core',    create_function('$a', "return null;"));
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;"));
add_filter('pre_site_transient_update_themes',  create_function('$a', "return null;"));
remove_action('admin_init', '_maybe_update_core');
remove_action('admin_init', '_maybe_update_plugins');
remove_action('admin_init', '_maybe_update_themes');
}
?>
<?php
if (get_option('super_plus_xua') == 'checked') {
/*WordPress防采集UA功能*/
$ua = $_SERVER['HTTP_USER_AGENT'];
$now_ua = array('FeedDemon','BOT/0.1 (BOT for JCE)','CrawlDaddy','Java','Jullo','Feedly','UniversalFeedParser','ApacheBench','Swiftbot','YandexBot','AhrefsBot','YisouSpider','jikeSpider','MJ12bot','ZmEu','WinHttp','EasouSpider','HttpClient','Microsoft URL Control','jaunty','oBot','Python-urllib','Indy Library','FlightDeckReports Bot','YYSpider'); //恶意USER_AGENT[2015-08-26更新]
if(!$ua) {
header("Content-type: text/html; charset=utf-8");
wp_die('Super-Plus插件已启用禁断恶意UA采集功能,请检查自身行为或者联系网站站长!');
}else{
    foreach($now_ua as $value )
    if(preg_match($value,$ua)) {
    header("Content-type: text/html; charset=utf-8");
    wp_die('Super-Plus插件已启用禁断恶意UA采集功能,请检查自身行为或者联系网站站长!');
    }
}
}
?>
<?php
if (get_option('super_plus_nof5cc') == 'checked') {
/*防止CC攻击*/
session_start();
$timestamp = time();
$ll_nowtime = $timestamp ;
if ($_SESSION){
  $ll_lasttime = $_SESSION['ll_lasttime'];
  $ll_times = $_SESSION['ll_times'] + 1;
  $_SESSION['ll_times'] = $ll_times;
}else{
  $ll_lasttime = $ll_nowtime;
  $ll_times = 1;
  $_SESSION['ll_times'] = $ll_times;
  $_SESSION['ll_lasttime'] = $ll_lasttime;
}
if(($ll_nowtime - $ll_lasttime) < 3){
  if ($ll_times>=5){
wp_die('Super-Plus插件已禁止频繁刷新,请等待10s后刷新重新载入页面!');
  exit;
  }
}else{
  $ll_times = 0;
  $_SESSION['ll_lasttime'] = $ll_nowtime;
  $_SESSION['ll_times'] = $ll_times;
}
}
?>
<?php
if (get_option('super_plus_oEmbed') == 'checked') {
/*oembed禁用*/
remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
}
?>
<?php
if (get_option('super_plus_oEmbed') == 'checked') {
/*中文名防乱码*/
function upload_file($filename) {
$parts = explode('.', $filename);
$filename = array_shift($parts);
$extension = array_pop($parts);
foreach ( (array) $parts as $part)
$filename .= '.' . $part;
  
if(preg_match('/[一-龥]/u', $filename)){
$filename = md5($filename);
}
$filename .= '.' . $extension;
return $filename ;
}
add_filter('sanitize_file_name', 'upload_file', 5,1);
}
?>
<?php
if (get_option('super_plus_adminID') == 'checked') {
/*保护wordpress管理员账号*/
add_filter( 'request', 'splus_author_link_request' );
function splus_author_link_request( $query_vars ) {
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id=$query_vars['author_name'];
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );   
        }
    }
    return $query_vars;
}
add_filter( 'author_link', 'splus_author_link', 10, 2 );
function splus_author_link( $link, $author_id) {
    global $wp_rewrite;
    $author_id = (int) $author_id;
    $link = $wp_rewrite->get_author_permastruct();
      
    if ( empty($link) ) {
        $file = home_url( '/' );
        $link = $file . '?author=' . $author_id;
    } else {
        $link = str_replace('%author%', $author_id, $link);
        $link = home_url( user_trailingslashit( $link ) );
    }
      
    return $link;
}
}
?>
<?php
if (get_option('super_plus_nosearch') == 'checked') {
/*关闭wordpress站内搜索功能以及对外请求*/
function splus_filter_query( $query, $error = true ) {
        if ( is_search() ) {
                $query->is_search = false;
                $query->query_vars[s] = false;
                $query->query[s] = false;
                if ( $error == true )
                        $query->is_404 = true;
        }
}
add_action( 'parse_query', 'splus_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );
}
?>
<?php
if (get_option('super_plus_footjs') == 'checked') {
/*强制js底部载入*/
function ds_print_jquery_in_footer( &$scripts) {
    if ( ! is_admin() )
        $scripts->add_data( 'jquery', 'group', 1 );
}
add_action( 'wp_default_scripts', 'ds_print_jquery_in_footer' );
}
?>
<?php
if (get_option('super_plus_nofirame') == 'checked') {
/*禁止外部Iframe框架网站内容*/
function break_out_of_frames() {
    if (!is_preview()) {
        echo "\n<script type=\"text/javascript\">";
        echo "\n<!--";
        echo "\nif (parent.frames.length > 0) { parent.location.href = location.href; }";
        echo "\n-->";
        echo "\n</script>\n\n";
    }
}
add_action('wp_head', 'break_out_of_frames');
}
?>
<?php
if (get_option('super_plus_nofirame') == 'checked') {
/*禁止非管理员权限用户访问后台*/
function redirect_user_login() {
    global $current_user,$pagenow;
    get_currentuserinfo();
    $valid_pages = array('admin-ajax.php', 'async-upload.php', 'media-upload.php');
    if( !current_user_can('administrator') && !in_array( $pagenow, $valid_pages ) ){
        wp_redirect( v7v3_my_account_link() ); exit;
    }
}
add_action('admin_init','redirect_user_login');
}
?>
<?php
if (get_option('super_plus_xwpin') == 'checked') {
/*屏蔽WP官方新闻功能*/
function disable_dashboard_widgets() {
    remove_meta_box('dashboard_primary', 'dashboard', 'core');//wordpress博客  
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');//wordpress其它新闻  
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');//wordpress概况
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');//wordresss链入链接  
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');//wordpress链入插件  
}  
add_action('admin_menu', 'disable_dashboard_widgets');
}
?>
<?php
if (get_option('super_plus_xemoji') == 'checked') {
/*屏蔽Emoji*/
remove_action( 'admin_print_scripts','print_emoji_detection_script');
remove_action( 'admin_print_styles','print_emoji_styles');
remove_action( 'wp_head','print_emoji_detection_script',	7);
remove_action( 'wp_print_styles','print_emoji_styles');
remove_filter( 'the_content_feed','wp_staticize_emoji');
remove_filter( 'comment_text_rss','wp_staticize_emoji');
remove_filter( 'wp_mail','wp_staticize_emoji_for_email');
}
?>
<?php
if (get_option('super_plus_sjm') == 'checked') {
/*加载三角梅*/
    function splus_wpn_enqueue_sjm()
    {
        wp_enqueue_style('sjm', SUPER_PLUS_URL . 'mh/my.css');
        wp_enqueue_script('sjm', SUPER_PLUS_URL . 'mh/my.js', array(
            'jquery'
        ), '0.1.2', true);
    }
    add_action('wp_enqueue_scripts', 'splus_wpn_enqueue_sjm');
}
?>
<?php
if (get_option('super_plus_ls_dsxf') == 'checked') {
/*[临时]定时作业修复*/
remove_action( 'admin_init','_wp_check_for_scheduled_split_terms');
}
?>