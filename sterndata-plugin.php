<?php
/**
 * Plugin Name: SternData common stuff plugin
 * Description: functions to support shortcodes and popup
 * Version: 20141121a 
 * Author: Stern Data Solutions
 * Author URI: http://www.sterndata.com
 * License: GPL 2
 */

function sds_plugin_init() {
 add_shortcode('sds-sitemap','sds_sitemap_func');
 add_shortcode('year','sds_shortcode_year');
 add_shortcode('child-menu','sds_child_menu');
 add_shortcode('anchor','sds_anchor');
 wp_enqueue_script('popup', plugins_url('popup.js',__FILE__) , array(), '2.0' , true);
}
add_action( 'init', 'sds_plugin_init' );

function sds_child_menu($atts) {
   global $post;
   $str = ''; 
   $a = shortcode_atts( array(
        'title' => '',
    ), $atts );

   if ( !is_page() ) return;
  
   // is this a child page?
   $parent = $post->post_parent;
 
   // if so, then use the parent to query for childen.  
   // if not, use this page

   if ($parent) {
       $id = $parent; 
     } else {
       $id = $post->ID;
     } 
 
   // does this page have children?
   $my_wp_query = new WP_Query();
   $all_wp_pages = $my_wp_query->query(array(
          'post_type' => 'page',
          'orderby' => 'title', 
          'order' => 'ASC',
          'posts_per_page' => -1,
           )
          );
   $pages = get_page_children($id,$all_wp_pages);
   if (sizeof($pages)==0) return;
   $str .= '<h2>' . $a['title'] . '</h2>';
   $str .= '<ul class="child-page-menu">';
   foreach ($pages as $page) {
       $str .=  '<li><a href="'. get_permalink($page->ID) . '">' . $page->post_title . '</a></li>'; 
       }
   $str .= "</ul>";
   wp_reset_postdata();
   return $str;
}

function sds_sitemap_func() {
  $results="<div id=\"sds-sitemap\">\n";
  $results .= "<div id=\"sds-sitemap-pages\">\n";
  $results .= "<h2>Pages</h2>\n";
  $all_pages = get_pages();
  $results .= "<ul>\n";
  foreach ($all_pages as $page) {
     $results .= "<li><a href=\"".get_page_link( $page->ID )."\">".$page->post_title."</a></li>\n";
     }

  $results .= "</ul></div>\n<div id=\"sds-sitemap-posts;\">\n";
  $results .=  "<h2>Posts</h2>\n";
    $cats = get_categories();
     // loop through the categries
     foreach ($cats as $cat) {
        // setup the cateogory ID
        $cat_id= $cat->term_id;
        $first_post=true;
        // create a custom wordpress query
       $query_args = array (
                'cat' => $cat_id,
                'posts_per_page' => -1,
                'cache_results' => true
                );
       $myq =  new WP_Query( $query_args );
        // start the wordpress loop!
        if ($myq->have_posts()) {
            if ( $first_post ) {
              $results .= "<h3>".$cat->name."</h3>\n<ul>\n";
              $first_post=false;
              }
            while ( $myq->have_posts() ) : $myq->the_post();
               $results .= "<li><a href='";
               $results .= get_permalink();
               $results .= "'>";
               $results .= get_the_title();
                $results .= "</a></li>\n";
            endwhile;
            $results .= "</ul>\n";
            }
          wp_reset_postdata();
          }
   $results .= "</div></div>";
   return $results;
}
function sds_shortcode_year () {
   return date('Y');
}
function sds_anchor($atts) {
   $a = shortcode_atts( array(
        'name' => '',
    ), $atts );
   return '<div class="sds-anchor" id="' . sanitize_text_field($a['name']) . '"></div>';
}
