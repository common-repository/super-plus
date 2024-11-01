<?php
/*
Plugin Name: Super Plus
Plugin URI: http://www.xmgo.cc/super-plus
Description: Super-Plus多功能优化增强插件
Version: 1.55
Author: All-Right
Author URI: http://www.xmgo.cc
*/
?>
<?php defined('ABSPATH') or exit; ?>
<?php
/*SPlus-version*/
define("splus_version", "1.55");
/*SPlus-gongnneg*/
define("splus_gongneng", "40");
/*SPlus-initialization*/
define('SUPER_PLUS_URL', plugin_dir_url(__FILE__));
register_activation_hook(__FILE__, 'splus_plugin_activate');
register_deactivation_hook(__FILE__, 'splus_plugin_deactivate');
add_action('splus_hook_update', 'splus_updateinfo');
add_action('admin_init', 'splus_plugin_redirect');
/*SPlus-activa*/
function splus_plugin_activate()
{
    add_option('do_activation_redirect', true);  
}
/*SPlus-redirect*/
function splus_plugin_redirect()
{
    if (!wp_next_scheduled('splus_hook_update'))
        wp_schedule_event(time() + 60, 'hourly', 'splus_hook_update');
    if (get_option('do_activation_redirect', false)) {
        delete_option('do_activation_redirect');
        wp_redirect(admin_url('options-general.php?page=splus'));
    }
}
/*Register_plugin_settings_link*/
function splus_register_plugin_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=splus">设置</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_{$plugin}", 'splus_register_plugin_settings_link');
/*Register_plugin_settings*/
if (is_admin()) {
    add_action('admin_menu', 'splus_menu');
}
/*Register_plugin_settings_menu*/
function splus_menu()
{
    add_menu_page('SPlus控制面板', 'Super-Plus', 'administrator', 'splus', 'splus_options_page'); 
}
/*SPlus-option-page*/
function splus_options_page()
{
    require "inc/option.php";
}
/*SPlus-functions*/
require "inc/functions.php";
?>
