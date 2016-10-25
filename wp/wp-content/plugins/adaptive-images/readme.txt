
=== Adaptive Images for WordPress ===

Contributors: nevma
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WCES7V9D45HDS
Tags: adaptive images, responsive images, mobile images, resize images, optimize images, adaptive, responsive, mobile, resize, optimize, images
Requires at least: 4.0
Tested up to: 4.6
Stable tag: 0.6.60
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adaptive images plugin transparently resizes your images, per device screen size, in order to reduce download times in 
mobile environments. 



== Description ==

= Adaptive Images =

Resizes and optimizes images delivered to mobile devices, in a transparent and unobtrusive way, so that the total 
download time is dramatically reduced. It works as a filter between the device and your WordPress website. It actually 
works for all types of device screen sizes, although it is targeted mostly at mobile environments. 

Note that this is not a CSS responsive images solution. This plugin does not force browsers to render images as if they 
were smaller. It actually sends smaller images to them! Then it is the job of the CSS to instruct the browsers how to 
render them. 

= Fundamental goals = 

 1. Reduce the total download time in mobile devices dramatically.
 2. Work transparantly and unobtrusively by being independant of your theme code.
 3. Be agnostic of the yet-not-finalized `picture` element or HTML img `srcset` attribute.

 = Side benefits =

 1. Respects search engines and sends them the orginal version of each image, because it depends on Javascript.
 2. If it does not recognise a device screen it falls over to the original image size. But even this is very rare and 
    mostly refers to very old or possibly deprecated devices. 
 3. Does not need to load the WordPress ennironment in order to resize and compress images.

= Supported formats =

 - JPEG (adjustable quality)
 - PNG (is transformed to PNG8)
 - GIF (not animated)

= CDN/Varnish/external caching service support =

Since version 0.6.0 CDN/Varnish/external caching service support has been added as an option, in an ***experimental*** 
mode. This mode is experimental in the following ways: i) it is not thorougly tested yet ii) however, it works in 
almost all test cases so far iii) it bears no dangers to your isntallation iv) it adds a special url parameter to your 
image urls, so it is slightly obtrusive.

Tested with MaxCDN and Varnish up to now.

= Default breakpoints =

 - 1024px wide screens
 - 640px wide screens
 - 480px wide screens

Since version 0.5.0 and upwards it is configurable whether the plugin should take into account the landscape or the 
portrait orientation of each device.

HiDPI (high device pixel density or retina) screens are supported too.

= How to test = 

 1. Test with Chrome&apos;s device emulation mode https://developer.chrome.com/devtools/docs/device-mode in Developer 
    Tools. See here https://www.youtube.com/watch?v=hCAC1XUUOvw/ for an example. Unfortunately, Firefox&apos;s 
    Responsive Design Mode does not actually emulate a mobile screen size!
 2. Test with a tool like Webpagetest http://www.webpagetest.org/. Make sure you set the "Emulate Mobile Browser" 
    setting in the "Advanced Settings" > "Chrome" tab. 
 3. Test with a tool like GTmetrix http://gtmetrix.com/. Make sure you enable mobile device testing. The plugin will 
    have no effect on desktop sized devices.
 4. Test with an actual mobile device, a smartphone or tablet. Watch your website load in a snap.
 5. Check the `/wp-contents/cache` directory to see the `/adaptive-images` directory and its contents. This is where 
    the resized images are kept and cached by default.

Also you can:

 1. View an image straight from a browser and add a &quot;?debug=true&quot; at the end of the url like this 
    &quot;http://www.website.com/wp-content/uploads/2015/01/image.jpg?debug=true&quot;. This should print useful debug
    information about the plugin functions in your installation. If you keep seeing your image, then the plugin is not
    working as it should and the cause is probably a failure to update the .htaccess file properly.
 2. Add a &quot;?debug=original&quot; at the end of the url of an image and you will see the orginal version of the 
    image even when a smaller version of it should have been shown.
 3. Hit the &quot;Print debug&quot; and &quot;Print diagnostics&quot; buttons at the plugin settings page to see useful 
    debug information about the plugin and your WordPress installation.

You could test with a normal desktop browser, but only if the computer screen size falls under at least of one of the 
specified breakpoints!

 = Incompatibilities and issues = 

 - Cannot work with installations where the `/wp-content` directory is not in its default position, which is inside the 
   root directory of the WordPress installation, along with `/wp-admin` and `/wp-includes`.
 - The plugin supports Nginx, but it must be manually configured.

 = Stuff to keep in mind = 

 - The plugin needs to add a little bit of code to your `.htaccess` file in order to function properly. It removes 
   this code once disabled. If you are not cool with that, then&hellip; tough luck! 
 - The plugin does not care whether the device is actually mobile or not. It checks the device screen resolution. If 
   you have set your breakpoints big enough then it should work just as good for desktop devices as well. However it targets mostly the mobile ones.
 - The resized versions of the pictures are kept in a special directory in the `/wp-content/cache` directory. This 
   causes some storage overhead. It is up to you to judge whether this overhead is a sustainable option in your 
   hosting environment.
 - The plugin does not help with (nor hinder) art direction. Simple as that. Art direction 
   https://usecases.responsiveimages.org/#art-direction in responsive images is an entirely different, yet important, 
   problem. This plugin does not tackle with it. But it works in a supplementary way without interfering with other 
   solutions that do. This means that you can combine it with any art direction solution.

= Credits = 

 - The plugin was originally based on the WP-Resolutions plugin https://github.com/JorgenHookham/WP-Resolutions/, but 
   since version 0.3.0 it is a complete rewrite!
 - Both plugins - WP-Resolutions and this one - have borrowed ideas from the Adaptive Images http://adaptive-images.com/
   solution specially adapted for WordPress.
 - Many-many thanks to "railgunner" for the initial idea in the forum and to the Pressidium team for helping with 
   debugging the CDN/Varnish/external caching service feature.

Thank you for using the plugin and, please, do let us know how it works (or doesn't work) for you. We love comments 
and creative feedback!



== Installation ==

= Usual process =

 1. Install the plugin via "Plugins &gt; Add New".
 2. Activate the plugin.
 3. Go to its settings and save them!

The plugin should simply work! 

De-activate the plugin to disable it. Activate the plugin to enable it. Delete it and it&apos;s gone. So simple. 



== Frequently Asked Questions ==

= What's the story? =

First came the Adaptive Images solution http://adaptive-images.com/ which is still there and works on its own. Then 
came the WP-Resolutions plugin https://github.com/JorgenHookham/WP-Resolutions. But it is not in the WordPress plugin
repository anymore and the Github version is not compatible with the latest WordPress versions. So we are updating and
maintaining it. Many under the hood changes have taken place, but the overall functionality is the same.

Since version 0.5.0 the plugin has been completely rewritten, in order to not rely on the Adaptive Images solution, 
which was released under a CC-BY license that is not compatible with the GPL. This problem has now been overcome and 
the part that used to rely on the Adaptive Images is brand new!

= Is this plugin heavy? =

Well, not much really. The image resizing process is not computationally negligible, but the images are only resized 
when they are first requested and then they are cached. However, it must be noted that the images in the watched 
directories, the ones the plugin is responsible for resizing and delivering, are ultimately delivered by a PHP script 
and not a generic server process! 

So actually one has to decide on a balance between creating and storing too many image sizes in contrast to burdening 
their server resources. 



== Screenshots ==

1. Plugin settings page in the admin area.
2. Resized versions of your images are cached by default in `/wp-content/cache/adaptive-images`.
3. Total web page load time is reduced dramatically on a mobile device (tested in http://webpagetest.org/).
4. Each device is served an image resized its real dimensions, therefore a lot smaller in total size.



== Upgrade Notice ==

= 0.5.0 =

It is recommended, but not absolutely necessary, to save one&apos;s settings anew, due to the big changes in the image 
resizing script, which was completely re-written, renamed and relocated inside the plugin&apos;s directories since this 
version. 

= 0.3.0 =

Ater upgrading to version 0.3.0 you will need to:

 - Save your settings anew. If you do not then the plugin will operate with its current default settings without 
   problems as it is expected.
 - Manually delete the old image cache directory `/wp-content/cache-ai`. The new default image cache directory is
   `/wp-content/cache/adaptive-images`.

Apologies for the inconvenience! We are still in early versions. What is important is that the plugin actually works 
as intended. We try to minimize the hassle between these versions. This is not expected to happen pretty often.



== Changelog ==

= 0.6.60 =

 - Removed PNG8 compression for PNGs because it was not peoducing acceptable quality results. PNGs are now simply
   resized and compressed via normal 32bit PNG compression. In future versions there will be an option to enable and
   disable PNG8 compression at will and perhaps a way for the plugin to detect in which images it should apply PNG8
   compression and in which others to apply 32bit PNG compression.

= 0.6.51 =

 - Just an update to the plugin version, because 0.6.41 was coming before 0.6.5, due to a lexicographical sorting and 
   was not available as an update in the repository!

= 0.6.5 =

 - PHP warning in adaptive images script removed.

= 0.6.42 =

 - Minor bug fix when saving plugin settings.

= 0.6.41 =

 - Version 0.6.4 bug fix caused a new bug in image path resolution when the WordPress is installed in a subdirectory of 
  the server root directory.

= 0.6.4 =

 - Fixed bug wp-content dir resolution within the standalone Adaptive Images image handling scrips, where sometimes the
  server document root was not reported by PHP as being the same as the WordPress installation path. 

= 0.6.3 =

 - Fixed bug in htaccess rewrite rules generation when installation is not in root directory.
 - Fixed bug in image delivery script where browser cache was not set correctly in some case.

= 0.6.2 =

 - Fixed bug where WordPress installation root directory was not calculated correctly in certain cases.

= 0.6.1 =

CDN/Varnish compatibility improved. Previously some images were downloaded in both their original and their resized 
version. Now they are only downloaded once. However if the website is too fast there may be 1-2 images that might 
manage to download in their original size. We guess that is OK, though.

= 0.6.0 =

 - Added CDN/Varnish/external caching service support.
 - Added Thickbox confirmation dialog on the cache cleanup button in the plugin settings page.
 - Added donation button in the plugin settings page.
 - Documentation stuff.

= 0.5.2 =

 - Fixed a bug where the path of the image resizing script was not correctly created in the `.htaccess` file (again).

= 0.5.1 =

 - Fixed a bug where the path of the image resizing script was not correctly created in the `.htaccess` file.
 - Some documentation.

= 0.5.0 =

 - New option in settings to define whether the plugin should use the bigger dimension of a device as its with or take 
   into account the current orientation. Up to now the plugin used the width of the landscape orientation, which is the 
   biggest of each device&apos;s dimensions.
 - New option in settings to define whether the plugin should use take special care for HiDPI (retina, high pixel 
   density screens and serve these devices better quality images according to their pixel density.
 - Better PNG compression via PNG8. This converts true color PNG images to palette image, which reduces colours and the 
   alpha channel Kudos http://stackoverflow.com/questions/5752514/how-to-convert-png-to-8-bit-png-using-php-gd-library/.
 - Fixed some edge cases of not being able to serve a resized image by reverting to original image. 
 - More analytical settings page debugging and diagnostics.
 - Added debugging methods in the image cache generation script.
 - Plugin can be configured to respect your default expires headers.
 - Some documentation stuff (as always).
 - Completely rewritten the script that generates and caches the resized versions of images in order to avoid the GPL 
   vs CC-BY-3.0 licensing incompatibility of the original Adaptive Images script (http://adaptive-images.com/). Plugin 
   is now totally independant and free of any licensing issues.
 - Due to the above, the image resizing script is no longer the same, it has been transformed to a new script, named 
   `adaptive-images-script.php` which is in the root folder of the plugin. However the old script is still left inside 
   the plugin folders for compatibility purposes (old versions and users not having saved their settings anew).

= 0.3.52 =

 - Documentation stuff.

= 0.3.51 =

 - Minor bug in settings page url parameters.
 - Documentation stuff.

= 0.3.5 =

 - Allow for default browser cache settings.
 - More thorough debugging information.
 - Added diagnostics debugging in the settings page.
 - Nicer admin area user messages with icons.
 - Minor fixes here (and there).
 - Documentation enhancements.

= 0.3.04 =

 - Documentation enhancements (yeah).
 - Added &quot;noptimize&quot; tag in HEAD Javascript to exclude it from optimizers.

= 0.3.03 =

 - Added Last-modified HTTP header for resized images, as the best practices do suggest.

= 0.3.02 =

 - When no device size/resolution is detected then show the original image. Helps avoid misunderstandings and sends 
   search engines the actual images instead of the resized ones.

= 0.3.01 =

 - Documentation enhancements.

= 0.3.0 =

 - Almost a complete rewrite of the code.
 - Completely updated the settings page to be user friendly.
 - Added action in the settings page for cache cleanup.
 - Added action in the settings page for debug info.
 - Added action in the settings page for cache size calculation.
 - Added watched directories field in the settings page anew.
 - Divided the plugin files into logical parts.
 - Default resolutions changed to 1024, 640 and 480 because the cookie is set based on the max value between screen 
   width and height and most screens have a height between 480 and 640px. Tablets are between 640 and 1024px wide/tall.
   The iPad is 1024px tall. A screen with a width higher than 1024px is probably not a mobile screen.
 - Changed default image cache directory in order to place it inside the expected WordPress `/wp-content/cache`
   directory, so now by default it is `/wp-content/cache/adaptive-images`.
 - Added check for the plugin options.
 - Added check for the PHP GD library.
 - Added check for the .htaccess file.
 - Added upgrade from older versions functions.
 - Added upgrade from 0.2.08 to 0.3.0 versions functions.
 - Added unistall script `uninstall.php`.
 - Documentation enhancements (as usual).

= 0.2.08 =

 - Added cache size calculation.
 - Added cache clean up methods.
 - Added nonces to admin actions.
 - Documentation enhancements.

= 0.2.06 =

 - Settings are now separate in an ai-user-settings.php file.

= 0.2.05 =

 - If the original requested image width and the device screen size are bigger than maximum available breakpoint, then 
   serve the the original image. 

= 0.2.04 =

 - Refactoring code.

= 0.2.03 =

 - Set the default screen size breakpoints to 1024, 600, 320.

= 0.2.02 =

 - Refactoring code to separate Adaptive Images files from the other plugin files.

= 0.2.01 =

 - The first stable version after the initial fork.
 - Corrected basic PHP errors.
 - Corrected basic WordPress errors.
 - Now compatible with version 4.1.1.
 - New document root takes into account installations in subdirectories.

= 0.1 =

 - The version forked from the WP Resolutions plugin https://github.com/JorgenHookham/WP-Resolutions.
 - This version does not work with WordPress anymore (at least version 4.1.1 and upwards).