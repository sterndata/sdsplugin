<?php
/**
 * Plugin Name: Standard Stuff (SternData)
 * Plugin URI:	https://github.com/sterndata/sdsplugin
 * Description: functions to support shortcodes and popup
 * Version: 2018.06.19
 * Author: Stern Data Solutions
 * Author URI: http://www.sterndata.com
 * License: Gnu Public License V2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/************************************

Copyright (C) 2014-2016 Steven D. Stern dba Stern Data Solutions

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA	02110-1301, USA.

*******************************/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function sds_plugin_scripts() {
	wp_enqueue_script( 'popup', plugins_url( 'popup.js',__FILE__ ) , array(), '2.0' , true );
}
add_action( 'wp_enqueue_scripts', 'sds_plugin_scripts' );

/*
* sds_recent_post
*	get the most recent post in a category
*	and provide  a link to the other posts in that category
*/
add_shortcode( 'sds_recent_post', 'sds_recent_post' );
function sds_recent_post( $atts, $content ) {
	$a = shortcode_atts( array(
		'cat' => '',
	), $atts );

	$args = array(
		'posts_per_page' => 1,
		'offset' => 0,
		'category_name' => $a['cat'],
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
	);
	$recent_posts = new WP_Query( $args );
	ob_start();
	if ( ! $recent_posts-> have_posts() ) {
		return 'No Posts Found for ' . $a['cat'];
	}
	while ( $recent_posts->have_posts() ) {
		$recent_posts->the_post();
		the_title( '<h2>', '</h2>' );
		the_excerpt();
		if ( '' != $a['cat'] ) {
			$href = '/category/' . $a['cat'];
		} else {
			$href = '/blog';
		}
		echo "<p><a href='$href'>Read More" . ucwords( $a['cat'] ) . '</a></p>';
	}
	wp_reset_query();
	return ob_get_clean();
}

add_shortcode( 'sds-sitemap', 'sds_sitemap_func' );
function sds_sitemap_func() {
	$results = "<div id=\"sds-sitemap\">\n";
	$results .= "<div id=\"sds-sitemap-pages\">\n";
	$all_pages = get_pages();
	if ( $all_pages ) {
		$results .= '<h2>Pages</h2>';
		$results .= "<ul>\n";
		foreach ( $all_pages as $page ) {
			$results .= '<li><a href="' . get_page_link( $page->ID ) . '">' . $page->post_title . "</a></li>\n";
		}
		$results .= '</ul>';
	}
	$count_posts = wp_count_posts();
	if ( $count_posts->publish > 0 ) {
		$results .= "</div>\n<div id=\"sds-sitemap-posts;\">\n";
		$results .= "<h2>Posts</h2>\n";
		$cats = get_categories();
		 // loop through the categries
		foreach ( $cats as $cat ) {
			// setup the cateogory ID
			$cat_id = $cat->term_id;
			$first_post = true;
			// create a custom wordpress query
			$query_args = array(
				'cat' => $cat_id,
				'posts_per_page' => -1,
				'cache_results' => true,
				);
			$myq = new WP_Query( $query_args );
			// start the wordpress loop!
			if ( $myq->have_posts() ) {
				if ( $first_post ) {
					$results .= '<h3>' . $cat->name . "</h3>\n<ul>\n";
					$first_post = false;
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
	} // end if count posts
	 $results .= '</div></div>';
	return $results;
}

add_shortcode( 'year', 'sds_shortcode_year' );
function sds_shortcode_year() {
	return date( 'Y' );
}

if ( !is_function( 'sds_anchor' ) {
	add_shortcode( 'anchor' ,  'sds_anchor' );
	function sds_anchor( $atts ) {
		$a = shortcode_atts( array(
			'name' => '',
		), $atts );
		return '<div class="sds-anchor" id="' . sanitize_text_field( $a['name'] ) . '"></div>';
	}
}

add_shortcode( 'popup' , 'sds_popup' );
function sds_popup( $atts ) {
	$a = shortcode_atts( array(
		'label' => '',
		'url' => '',
		'width' => 1024,
	), $atts );
	$str = '<a class="sds_popup" href="javascript:popUp(\'';
	$str .= esc_js( esc_url( $a['url'] ) );
	$str .= '\',' . (int) $a['width'] . ')">' . sanitize_text_field( $a['label'] ) . '</a>';
	return $str;
}

add_shortcode( 'font-size' ,'sds_font_size' );
function sds_font_size( $atts, $content ) {
	$a = shortcode_atts( array(
		'size' => '100%',
	), $atts );
	return '<div style="font-size: ' . $a['size'] . ';">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'sds_column', 'sds_column' );
function sds_column( $atts, $content ) {
	$a = shortcode_atts( array(
			 'width' => '',
			 'class' => '',
	), $atts );

	$str = 'class="sds_column ';
	if ( '' != $a['class'] ) {
		$str .= $a['class'];
	}
	$str .= '"';

	if ( '' != $a['width'] ) {
		$str .= ' style="width:' . $a['width'] . ';"';
	}

	return "<div $str >" . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'years-since', 'sds_years_since' );
function sds_years_since( $atts, $content ) {

	// returns the difference between the start year
	// and the current year

	$a = shortcode_atts( array(
		'start' => 0,
	), $atts );

	$ty = date( 'Y' );
	$since = $ty - (int) $a['start'];

	if ( $since < 0 ) {
		return '<b>years-since error: start date must be less than or equal to this year.</b>';
	}
	if ( 0 == $since ) {
		return 'less than one';
	}
	if ( class_exists( 'NumberFormatter' ) ) {
		$a = new NumberFormatter( 'en',NumberFormatter::SPELLOUT );
		return $a-> format( $since );
	} else {
		return "$since";
	}
}
function sds_phpinfo() {
	ob_start();
	phpinfo();
	return ob_get_clean();
}
add_shortcode( 'sds_phpinfo', 'sds_phpinfo' );

function sds_show_mod_date( $atts, $content ) {
   return get_the_modified_date();
}
add_shortcode( 'last-update', 'sds_show_mod_date' );
