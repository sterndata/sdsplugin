=== SternData plugin ===
Tags: shortcode 
Requires at least: 3.0.1
Tested up to: 4.0
License: TBD

This plugin provides the shortcodes as shown below and adds a javascript popup window function, "popUP"

 add_shortcode('sds-sitemap','sds_sitemap_func');
 add_shortcode('year','sds_shortcode_year');
 add_shortcode('child-menu','sds_child_menu');
 add_shortcode('anchor','sds_anchor');
 wp_enqueue_script('popup', plugins_url('popup.js',__FILE__) , array(), '2.0' , true)


