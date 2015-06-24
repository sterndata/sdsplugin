=== Standard Stuff (SternData) ===
Contributors: sstern sterndata
Requires at least: 3.8.4
Tested up to: 4.2.2
License: Gnu Public License V2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides commonly used shortcodes and the popup window script.

== Description ==
This plugin provides the shortcodes as shown below and adds a javascript popup window function, "popUP"

Shortcodes:
     [font-size size='newsize'] text [/font-size]
          overrides font size.  Use percentage (e.g., 115%)

     [sds-sitemap]
         returns a list of pages and posts by category

     [year] 
         returns the current year (for use in copyright, etc.)

     [child-menu title='title'] 
         returns a list of child pages for the current page

     [anchor name='anchorname']
         inserts an anchor tag

     [popup label='text' url='url' width='popup width']
     
     [sds_column width='width'] text [/sds_column]

== Changelog == 
 =20150624a=
 * update readme :-)
 * handle shortcodes withing sds_columns

== Installation ==
Install like any other plugin. Unzip into wp-content/plugins/
