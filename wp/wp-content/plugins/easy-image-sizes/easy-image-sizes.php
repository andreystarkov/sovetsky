<?php
/*
Plugin Name: Easy Image Sizes
Plugin URI:  https://www.stephenb.co.uk/easy-image-sizes-for-wordpress/
Description: Add new images sizes to WordPress the easy way
Version: 1.1.1
Author: Stephen B
Author Email: plugins@stephenb.co.uk
License: GPLv2 or later
*/

require(__DIR__ . "/easy_image_sizes_core.php");

require(__DIR__ . "/easy_image_sizes_main.php");

new Easy_Image_Sizes();