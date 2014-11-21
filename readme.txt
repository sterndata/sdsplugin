=== Standard Stuff (SternData) ===
Contributors: sstern
Requires at least: 3.8.4
Tested up to: 4.1
License: Gnu Public License V2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides commonly used shortcodes and the popup window script.

== Description ==
This plugin provides the shortcodes as shown below and adds a javascript popup window function, \"popUP\"

 add_shortcode(\'sds-sitemap\',\'sds_sitemap_func\');
 add_shortcode(\'year\',\'sds_shortcode_year\');
 add_shortcode(\'child-menu\',\'sds_child_menu\');
 add_shortcode(\'anchor\',\'sds_anchor\');
 wp_enqueue_script(\'popup\', plugins_url(\'popup.js\',__FILE__) , array(), \'2.0\' , true)


== Installation ==
Install like any other plugin. Unzip into wp-content/plugins/
