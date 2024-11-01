<?php defined('ABSPATH') or exit; ?>
<div class="wrap">
<p><h2>Super-Plus 控制面板</h2></p>
<div id="message" class="updated"><p>[Welcome]欢迎使用Super-Plus增强插件.</p></div>
<?php
if ($_POST['update_superpluginoptions'] == 'true') {
    splus_pluginoptions_update();
    echo '<div id="message" class="updated"><p><b> [Success] 启用功能已生效,感谢使用Super-Plus.</b></p></div>';
}
?>
<form method="POST" action="">
<input type="hidden" name="update_superpluginoptions" value="true" />
<b>系统增强</b><hr />
<input type="checkbox" name="sox" id="sox" <?php
echo get_option("super_plus_sox");
?> /> 启用“禁用WordPress自动更新”功能<p>
<input type="checkbox" name="xwpin" id="xwpin" <?php
echo get_option("super_plus_xwpin");
?> /> 启用“禁用WordPress仪表盘官方消息”功能<p>
<input type="checkbox" name="oEmbed" id="oEmbed" <?php
echo get_option("super_plus_oEmbed");
?> /> 启用“禁用编辑器Auto-Embeds识别”功能<p>
<input type="checkbox" name="chuser" id="chuser" <?php
echo get_option("super_plus_chuser");
?> /> 启用“允许添加中文用户名用户”功能<p>
<input type="checkbox" name="100img" id="100img" <?php
echo get_option('super_plus_100img');
?> /> 启用“高清图片无损无压缩上传”功能<p>
<input type="checkbox" name="xwdg" id="xwdg" <?php
echo get_option('super_plus_xwdg');
?> /> 启用“禁用Wordpress默认侧边栏小工具”功能<p>
<input type="checkbox" name="wryh" id="wryh" <?php
echo get_option('super_plus_wryh');
?> /> 启用“变更后台字体为微软雅黑”功能<p>
<input type="checkbox" name="linkman" id="linkman" <?php
echo get_option("super_plus_linkman");
?> /> 启用“Wordpress原生链接管理器”功能<p>
<input type="checkbox" name="ping" id="ping" <?php
echo get_option("super_plus_ping");
?> /> 启用“禁止站内文章互相Pingback”功能<p>
<input type="checkbox" name="replaceurl" id="replaceurl" <?php
echo get_option("super_plus_replaceurl");
?> /> 启用“使用相对链接替换为绝对链接”功能<p>
<input type="checkbox" name="wpidx" id="wpidx" <?php
echo get_option('super_plus_wpidx');
?> /> 启用“禁止文章自动保存和修订版本”功能<p>
<input type="checkbox" name="nofollow" id="nofollow" <?php
echo get_option("super_plus_nofollow");
?> /> 启用“添加a标签nofollow与target=_blank”功能<p>
<input type="checkbox" name="nosearch" id="nosearch" <?php
echo get_option("super_plus_nosearch");
?> /> 启用“关闭Wordpress站内搜索及对外请求”功能<p>
<input type="checkbox" name="nochinese" id="nochinese" <?php
echo get_option("super_plus_nochinese");
?> /> 启用“中文名称文件上传自动改名防乱码”功能<p>
<input type="checkbox" name="xemoji" id="xemoji" <?php
echo get_option("super_plus_xemoji");
?> /> 启用“禁用WordPress自带Emoji表情”功能<p>
<b>安全增强</b><hr />
<input type="checkbox" name="simplifyhead" id="simplifyhead" <?php
echo get_option("super_plus_simplifyhead");
?> /> 启用“移除部分风险/无用头部信息”功能<p>
<input type="checkbox" name="jscssxx" id="jscssxx" <?php
echo get_option("super_plus_jscssxx");
?> /> 启用“移除加载JS和CSS的WP版本号”功能<p>
<input type="checkbox" name="ncxx" id="ncxx" <?php
echo get_option("super_plus_ncxx");
?> /> 启用“拦截发布无中文评论留言”功能<p>
<input type="checkbox" name="xmlrpc" id="xmlrpc" <?php
echo get_option("super_plus_xmlrpc");
?> /> 启用“禁用XML-RPC离线发布功能”功能<p>
<input type="checkbox" name="adminID" id="adminID" <?php
echo get_option("super_plus_adminID");
?> /> 启用“保护Wordpress管理员账号”功能<p>
<input type="checkbox" name="nof5cc" id="nof5cc" <?php
echo get_option('super_plus_nof5cc');
?> /> 启用“屏蔽前台页面频繁刷新请求”功能<p>
<input type="checkbox" name="nofirame" id="nofirame" <?php
echo get_option('super_plus_nofirame');
?> /> 启用“禁止外部Iframe框架网站内容”功能<p>
<input type="checkbox" name="noadmin" id="noadmin" <?php
echo get_option('super_plus_noadmin');
?> /> 启用“禁止非管理员权限用户访问后台”功能<p>
<b>前台增强</b><hr />
<input type="checkbox" name="glgjt" id="glgjt" <?php
echo get_option('super_plus_glgjt');
?> /> 启用“前台隐藏顶部管理工具条”功能<p>
<input type="checkbox" name="jqueryxx" id="jqueryxx" <?php
echo get_option("super_plus_jqueryxx");
?> /> 启用“移除Wordpress自带JQuery库”功能<p>
<input type="checkbox" name="jdt" id="jdt" <?php
echo get_option('super_plus_jdt');
?> /> 启用“前台加载进度条特效”功能<p>
<input type="checkbox" name="sjm" id="sjm" <?php
echo get_option('super_plus_sjm');
?> /> 启用“前台加载三角梅特效”功能<p>
<input type="checkbox" name="codehl" id="codehl" <?php
echo get_option('super_plus_codehl');
?> /> 启用“文章页面代码高亮”功能<p>
<input type="checkbox" name="number" id="number" <?php
echo get_option('super_plus_number');
?> /> 启用“前台单击时出现积分特效”功能<p>
<input type="checkbox" name="welcomemsg" id="welcomemsg" <?php
echo get_option("super_plus_welcomemsg");
?> /> 启用“访客欢迎信息跟踪显示”功能<p>
<input type="checkbox" name="ietip" id="ietip" <?php
echo get_option("super_plus_ietip");
?> /> 启用“提示IE10以下IE用户更换浏览器”功能<p>
<input type="checkbox" name="wp38x" id="wp38x" <?php
echo get_option('super_plus_wp38x');
?> /> 启用“移除登录错误抖动提示特效”功能<p>
<input type="checkbox" name="bingbg" id="bingbg" <?php
echo get_option("super_plus_bingbg");
?> /> 启用“调用Bing背景作为登录页背景”功能<p>
<input type="checkbox" name="gravatar" id="gravatar" <?php
echo get_option('super_plus_gravatar');
?> /> 启用“Gravatar替换到Geekzu镜像”功能<p>
<input type="checkbox" name="google" id="google" <?php
echo get_option("super_plus_google");
?> /> 启用“Google-API替换到Geekzu-API”功能<p>
<input type="checkbox" name="compress" id="compress" <?php
echo get_option("super_plus_compress");
?> /> 启用“前台页面代码压缩”功能<p>
<input type="checkbox" name="baidusb" id="baidusb" <?php
echo get_option('super_plus_baidusb');
?> /> 启用“禁止百度自动转码”功能<p>
<input type="checkbox" name="footjs" id="footjs" <?php
echo get_option('super_plus_footjs');
?> /> 启用“强制JQuery库文件底部载入”功能<p>
<b>临时修复</b><hr />
<input type="checkbox" name="ls_dsxf" id="ls_dsxf" <?php
echo get_option('super_plus_ls_dsxf');
?> /> 修复“WordPress4.3产生无用定时作业”错误[感谢WpJam提供]<p>

<input type="submit" class="button-primary" value="保存设置" /> 
</form>
<hr />
By.<a href="http://www.xmgo.cc/">All-Right</a>|Super-Plus|Version<?php echo splus_version; ?>|总收录<?php echo splus_gongneng; ?>个功能|<a href="http://www.xmgo.cc/super-plus">点击获取最新版本&详细说明</a><br />
<b>注意:</b>如果插件相关功能与其他插件或者主题相同请勿开启,以免互相冲突.
</div>
<?php
/*Splus_pluginoptions_update*/
function splus_pluginoptions_update()
{
    if ($_POST['jdt'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_jdt', $display);
    if ($_POST['glgjt'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_glgjt', $display);
    if ($_POST['gravatar'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_gravatar', $display);
    if ($_POST['wryh'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_wryh', $display);
    if ($_POST['number'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_number', $display);
    if ($_POST['chuser'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_chuser', $display);
    if ($_POST['ping'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_ping', $display);
    if ($_POST['nofollow'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_nofollow', $display);
    if ($_POST['bingbg'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_bingbg', $display);
    if ($_POST['replaceurl'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_replaceurl', $display);
    if ($_POST['simplifyhead'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_simplifyhead', $display);
    if ($_POST['welcomemsg'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_welcomemsg', $display);
    if ($_POST['ietip'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_ietip', $display);
    if ($_POST['linkman'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_linkman', $display);
    if ($_POST['google'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_google', $display);
    if ($_POST['codehl'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_codehl', $display);
	if ($_POST['compress'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_compress', $display);
	if ($_POST['baidusb'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_baidusb', $display);
	if ($_POST['jscssxx'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_jscssxx', $display);
	if ($_POST['jqueryxx'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_jqueryxx', $display);
	if ($_POST['wp38x'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_wp38x', $display);
	if ($_POST['adminID'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_adminID', $display);
	if ($_POST['wpidx'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_wpidx', $display);
	if ($_POST['ncxx'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_ncxx', $display);
	if ($_POST['xmlrpc'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_xmlrpc', $display);
	if ($_POST['xwdg'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_xwdg', $display);
	if ($_POST['sox'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_sox', $display);
	if ($_POST['xua'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_xua', $display);
	if ($_POST['nof5cc'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_nof5cc', $display);
	if ($_POST['100img'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_100img', $display);
	if ($_POST['oEmbed'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_oEmbed', $display);
	if ($_POST['nosearch'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_nosearch', $display);
	if ($_POST['nochinese'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_nochinese', $display);
	if ($_POST['footjs'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_footjs', $display);
	if ($_POST['nofirame'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_nofirame', $display);
	if ($_POST['noadmin'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_noadmin', $display);
	if ($_POST['xwpin'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_xwpin', $display);
	if ($_POST['xemoji'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_xemoji', $display);
	if ($_POST['ls_dsxf'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_ls_dsxf', $display);
	if ($_POST['sjm'] == 'on') {
        $display = 'checked';
    } else {
        $display = '';
    }
    update_option('super_plus_sjm', $display);
}
?>