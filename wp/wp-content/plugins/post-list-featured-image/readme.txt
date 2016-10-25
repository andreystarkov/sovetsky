=== Post List Featured Image ===
Contributors: JAkzam, pcgrejaldo
Donate link: http://jaggededgemedia.com/donate/
Tags: featured, image, posts, pages, developer tools
Requires at least: WP 3.5.1, PHP 5.3.0
Tested up to: 4.5
Stable tag: 0.5.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A plugin that adds the "Featured Image" column in admin posts and pages list.

== Description ==

Finally a simple plugin that adds the "Featured Image" column in admin posts and pages list. It lets the wordpress site owners see which posts or pages have a featured image set. 

Choose between three thumbnail sizes.
Sort the Post List by Featured Image
Filter the Post List by Has/Does Not Have Featured Image

Of course, this is mainly intended for use on the Post List page, since most themes require a featured image be set for the excerpt thumbnail image. It doesn't seem like much, and the plugin is truly non-invasive to the rest for the WP install. But the value that this simple tool can have on the overall organization for Admins and Developers of WordPress websites is priceless.

By enhancing the plugin with the Pro Addon, you can easily change, add, or remove images with the **Quick Edit** feature, directly from your Posts List Page, which now includes standard Post Editor Media Library selection. Pro also now supports **Custom Post Type** lists.

== Installation ==

1. **Important** Backup your files and database.

2. **(Recommended)** Install directly from the WP Directory through your admin panel Plugins > Add New > Search for "Post List Featured Image". Click install under the name, and activate when prompted. 

3. Upload post-list-featured-image.zip via "wp-admin/plugin-install.php?tab=upload" or if using FTP, unzip
post-list-featured-image.zip and upload `/post-list-featured-image/` directory to the `/wp-content/plugins/`
directory.

4. Activate the plugin through the 'Plugins' menu in WordPress (under plugin name: **"Post List Featured Image"**).

5. Find more Installation options at http://jaggededgemedia.com/plugins/post-list-featured-image/

== Frequently Asked Questions ==

= I have some questions. How do I contact you? =

Send them to http://wordpress.org/support/plugin/post-list-featured-image

= Where are the settings for the plugin? =

Settings can be reached from the Settings link on the Plugin list page or by going to Media > Featured Image Settings

== Screenshots ==

1. Screenshot shows the "Featured Image" column added in Posts list.
2. Screenshot shows the "Featured Image" column added in Pages list.
3. Screenshot shows the WP Directory installation process.
4. Screenshot shows the WP Upload Zip file installation process.
5. Screenshot shows the "Featured Image Settings" menu.

== Instructions and Usage ==
* **Thumbnail Size**

Choose between 50px, 100px and 150px

* **Sorting by Featured Image**

On the Post/Page list pages of the Admin area, click on the Featured Image column heading to sort by Featured Image ID.

* **Filtering by Featured Image**

On the Post/Page list pages of the Admin area, Choose to Filter the posts by "Show All Posts with Featured Image" or "Show All Posts without Featured Image"

This is especially helpful for assigning new featured image to posts that do not have them. Or this helps with large sites, with many posts, and editing the post featured images for those posts using the "Quick Edit" feature, available with the **Pro Addon**

*Please remember, if you do not see the Featured Image column in your Post/Page Lists to click on "Screen Options" in the upper right corner, and tick the box for Featured Image.*

== Pro Features ==
* Set featured images in *QUICK EDIT* mode
* Custom post type support
* *NEW* Auto set the first image of a post as featured image in *QUICK EDIT* mode
* *NEW* Auto set the first image of a post as featured image by *post type*

== Changelog ==

= 0.5.9 =
* tested with WP 4.5

= 0.5.8 =
* moved: plugin activation/deactivation actions to autoload.php
* changed: stable/tested tag
* fixed: multisite options key

= 0.5.7 =
* changed: unnecessary remove_theme_support function call
* changed: textdomain constant to string

= 0.5.6 =
* tested with WP 4.0

= 0.5.5 =
* fixed: function name typo
* changed: jquery-ui theme url

= 0.5.4 =
* fixed: plugin text domain load call

= 0.5.3 =
* moved: php_required_version check to main plugin file.

= 0.5.2 =
* fixed: plugin_action_links filter handler statement checks

= 0.5.1 =
* fixed: undefined index thumb_size
* fixed: incorrect domain
* updated: POT file

= 0.5.0 =
* code overhaul: requires at least PHP 5.3.0
* added: [featured_img] shortcode

= 0.4.0 =
* compatibility: tested with WP 3.9.1
* changed: JEM News Update and settings page default active tab

= 0.3.9 =
* changed: hook plfi_usage_instructions args
* fixed: undefined variable 'upgrade_notice'

= 0.3.8 =
* changed: deprecated functions in parse-readme.php

= 0.3.7 =
* changed: settings page style

= 0.3.6 =
* changed: settings page UI and new video

= 0.3.5 =
* compatibility: tested with WP 3.8.1
* moved: tabs html into a hook

= 0.3.4 =
* changed: settings page styles and layout

= 0.3.3 =

* File adjustment

= 0.3.2 =
* Added default filter field

= 0.3.1 =
* Changed help links in settings page

= 0.3.0 =
* Added post type list table filter for posts that have or doesn't have a featured image.
* Added post type list table sort by featured image id
* Changed settings page UI

= 0.2.0 =
* Added "Featured Image Settings" page (Media > Featured Image Settings).

= 0.1.0 =
* Adds the "Featured Image" column in the admin posts and pages list.

== Upgrade Notice ==

= 0.1.0 =

We aim to stay current with the latest release of WordPress. Not upgrading may cause the feature to break if you upgrade your WordPress install. **Important:** Please do your backup before updating.
