<?php

class Easy_Image_Sizes extends Easy_Image_Sizes_Core {

    public function __construct() {

        parent::__construct();
        
        add_filter( 'init', array($this, 'registerImageSizes'));
        
        add_filter( 'image_size_names_choose', array($this, 'loadImageSizesIntoCore'));

    }

    public function registerImageSizes() {

        $sizes = $this->getSizes();
        
        if(!empty($sizes)) {
        
            foreach($sizes as $size) {
                
                $is_cropped = $this->getMetaForEasyImageSizes( 'easy_image_sizes_cropped', $size->ID);
                
                if($is_cropped == 'No') {
                    
                    $cropped = false;
                    
                }
                
                if($is_cropped == 'Yes') {
                    
                    $cropped = array(0 => 'center', 1 => 'center');
                                     
                    if($crop_x = $this->getMetaForEasyImageSizes('easy_image_sizes_crop_x', $size->ID)) {
                        
                        $cropped[0] = $crop_x;
                        
                    }
                    
                    if($crop_y = $this->getMetaForEasyImageSizes('easy_image_sizes_crop_y', $size->ID)) {
                        
                        $cropped[1] = $crop_y;
                        
                    }

                }
        
                add_image_size(
                    sanitize_title($size->post_title),
                    $this->getMetaForEasyImageSizes( 'easy_image_sizes_width', $size->ID),
                    $this->getMetaForEasyImageSizes( 'easy_image_sizes_height', $size->ID),
                    $cropped
                ); 
            
            }
            
        }
        
    }

    public function loadImageSizesIntoCore($sizes) {

        $addsizes = array();
        
        $image_sizes = $this->getSizes();
        
        foreach($image_sizes as $size) {
        
            $addsizes[sanitize_title($size->post_title)] = __($size->post_title);
        
        }
        
        $newsizes = array_merge($sizes, $addsizes);
        
        return $newsizes;
        
    }

    public function getSizes() {

        $args = array(
            'posts_per_page'   => -1,
            'post_type'        => 'easy_image_sizes',
            'post_status'      => 'publish',
        );
        
        return get_posts( $args );

    }

}
