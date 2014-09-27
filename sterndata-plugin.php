<?php
/**
 * Plugin Name: SternData common stuff plugin
 * Description: functions to support shortcodes.
 * Version: 20140903a 
 * Author: Stern Data Solutions
 * Author URI: http://www.sterndata.com
 * License: TBD
 */

function sds_plugin_init() {
 add_shortcode('sds-sitemap','sds_sitemap_func');
 add_shortcode('year','sds_shortcode_year');

}
add_action( 'init', 'sds_plugin_init' );

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
               $resuls .= get_permalink();
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
add_shortcode('year',sds_shortcode_year);

