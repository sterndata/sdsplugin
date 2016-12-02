=== Standard Stuff (SternData) ===
Contributors: sstern sterndata
Requires at least: 3.8.4
Tested up to: 4.7
License: Gnu Public License V2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides commonly used shortcodes and the popup window script.

The plugin at https://github.com/afragen/github-updater allows this to be updated via github

== Description ==
This plugin provides the shortcodes as shown below and adds a javascript popup window function, "popUP"

Shortcodes:
     [sds_phpinfo]
     	  outputs phpinfo()

     [font-size size='newsize'] text [/font-size]
          overrides font size.  Use percentage (e.g., 115%)

     [sds-sitemap]
         returns a list of pages and posts by category

     [year]
         returns the current year (for use in copyright, etc.)

     [anchor name='anchorname']
         inserts an anchor tag

     [popup label='text' url='url' width='popup width']

     [sds_column ] text [/sds_column]
		 	accepts two parameters, "width" as a number (e.g., width="50%") or a class name (e.g class="half")

     [years-since start="a year number"]
          returns years since a year number. For example, In business for [years-since start="1960"] years.

		 [sds_recent_post cat='category_name']
		 	    returns the most recent post title and except for that category

== Changelog ==
 =20160913=
  years-since returns numbers as strings in the NumberFormatter class is available
 =20160827=
  added sds_phpinfo
 =20160517=
  added sds_recent_post
 =20150930=
  change version number format to work better with WordPress and github updater
 =20150830a=
 # added "years-since"
 =20150830=
 * removed menion of "child_pages" which was removed from the code a while ago.
 =20150624a=
 * update readme :-)
 * handle shortcodes withing sds_columns

== Installation ==
Install like any other plugin. Unzip into wp-content/plugins/
