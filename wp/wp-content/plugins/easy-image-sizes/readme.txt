=== Easy Image Sizes ===
Contributors: shifisteve
Tags: image sizes,images,sizes,media,media sizes,custom sizes,custom image
Requires at least: 3.9
Tested up to: 4.5.1
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easy Image Sizes allows you to configure different WordPress image sizes and use them alongside the standard ones (ie. thumbnail, small, medium etc)

== Description ==
Easy Image Sizes For WordPress is a very simple plugin that allows you to create an unlimited number of different image sizes and them alongside the builtin ones (ie. thumbnail, small, medium etc)

When an image get uploaded through the WordPress media manager (including the featured image option), WordPress creates variations of said image at different sizes for use in different scenarios. I am sure you will have seen the option to select either thumbnail, medium, or full size when inserting an image into a post or page. This plugin simply adds to the list of automatically generated sizes available.

**Features:**

* Create an unlimited number of image sizes
* Custom sizes automatically appear in the media manager for inserting into posts
* Images sizes are available for the featured image/post thumbnail
* Have WordPress crop or scale the image
* Set cropping positions (ie. top, bottom, right etc)
* Uses all native functionality for a smooth experience

== Installation ==
1. Upload the plugin files to the `/wp-content/plugins/easy-image-sizes` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the \'Plugins\' screen in WordPress
1. Use the Easy Image Sizes menu screen to add/edit/remove image sizes

== Screenshots ==
1. Showing different custom image sizes
2. Showing the image size options page
3. Showing the custom size available in the media library
4. Showing the image sizes in a post

== Changelog ==

**1.1.1 2016-05-01**

* Added missing CSS for “number” elements in admin.css
* Tested compatibility with the latest version of WordPress

**1.1 2016-03-05**

* Feature: Added image dimensions and whether cropped or not to the admin columns in the image sizes list
* Feature: Added HTML5 validation to required input fields and forced dimension fields to be numbers
* Improvement: Tidied up the getMetaForEasyImageSizes method in the core class
* Improvement: Removed unnecessary items from admin image sizes list (such as quick edit) 

**1.0 2016-02-27**

* Initial release

== Frequently Asked Questions ==
= How many different images sizes can I have? =

Hypothetically you could have as many as required. WordPress does have to generate each different image size when an image is uploaded and having LOTS of custom sizes might slightly impact performance.

= What happens to my images if I disable the plugin? =

The actual images will not be removed and they will still be available directly by using the img url, however they will not be available in the WordPress menus for inserting into posts. If you ware to reactive the plugin then the images will be fully available again.

= Can I export my custom image sizes? =

Easy Image Sizes can be exported/imported with the built in WordPress tools. It can be done as part of an entire site export, or just for the image sizes.