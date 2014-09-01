<?php
/**
 * Plugin Name: SternData theme support plugin 
 * Description: functions to support the theme.
 * Version: 1.0
 * Author: Stern Data Solutions
 * Author URI: http://www.sterndata.com
 * License: TBD
 */

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
        query_posts( array( 'cat' => $cat_id, 'posts_per_page' => -1) );
        // start the wordpress loop!
        if (have_posts()) {
            if ( $first_post ) {
              $results .= "<h3>".$cat->name."</h3>\n<ul>\n";
              $first_post=false;
              }
            while ( have_posts() ) : the_post();
               $results .= "<li><a href='";
               $resuls .= get_permalink();
               $results .= "'>";
               $results .= get_the_title();
                $results .= "</a></li>\n";
            endwhile;
            $results .= "</ul>\n";
            }
          wp_reset_query();
          }
   $results .= "</div></div>";
   return $results;
}

add_shortcode('sds-sitemap','sds_sitemap_func');

function sds_dump_post_func () {
  global $post;
  
  $str = print_r($post, true);
  
  return $str;
}
add_shortcode('sds_dump_post','sds_dump_post_func');
