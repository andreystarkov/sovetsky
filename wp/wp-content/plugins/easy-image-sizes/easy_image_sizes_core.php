<?php

class Easy_Image_Sizes_Core {
    
    public $name = 'Easy Image Sizes';

    public $slug = 'easy-image-sizes';
    
    public $text_domain = 'easy_image_sizes';
    
    public $post_type_name = 'easy_image_sizes';

    public function __construct() {
        
        add_action('admin_enqueue_scripts', array($this, 'registerResources'));
        
        add_action('init', array($this, 'registerPostType'));
        
        add_action('add_meta_boxes', array($this, 'addMetaBoxForEasyImageSizes'));
        
        add_action('save_post', array($this, 'saveForEasyImageSizes'));
        
        add_filter('enter_title_here', array($this, 'changeTitlePlaceholderText'));
        
        add_filter('manage_edit-easy_image_sizes_columns', array($this, 'editEasyImageSizesColumns'));
        
        add_action('manage_easy_image_sizes_posts_custom_column', array($this, 'manageEasyImageSizesColumns'), 10, 2);
        
        add_filter('post_row_actions', array($this, 'removeQuickEditFromPostList'), 10, 2);

    }
    
    protected function loadResource($name, $file_path, $is_script=false) {

        $url = plugins_url($file_path, __FILE__);
        
        $file = plugin_dir_path(__FILE__) . $file_path;

        if(file_exists($file)) {
        
            if($is_script) {
            
                wp_register_script( $name, $url, array('jquery') );
                
                wp_enqueue_script( $name );
                
            } else {
            
                wp_register_style($name, $url);
                
                wp_enqueue_style($name);
                
            } 
        }

    }
    
    public function registerResources() {

        $this->loadResource($this->slug . '-admin-script', '/resources/admin.js', true);
        
        $this->loadResource($this->slug . '-admin-style', '/resources/admin.css');

    }

    public function registerPostType() {

        $labels = array(
            'name'                  => _x( 'Image Sizes', 'Post Type General Name', $this->text_domain ),
            'singular_name'         => _x( 'Image Size', 'Post Type Singular Name', $this->text_domain ),
            'menu_name'             => __( 'Easy Image Sizes', $this->text_domain ),
            'name_admin_bar'        => __( 'Easy Image SIzes', $this->text_domain ),
            'parent_item_colon'     => __( 'Parent Image Size:', $this->text_domain ),
            'all_items'             => __( 'All Image Sizes', $this->text_domain ),
            'add_new_item'          => __( 'Add New Image Size', $this->text_domain ),
            'add_new'               => __( 'Add New', $this->text_domain ),
            'new_item'              => __( 'New Item', $this->text_domain ),
            'edit_item'             => __( 'Edit Item', $this->text_domain ),
            'update_item'           => __( 'Update Item', $this->text_domain ),
            'view_item'             => __( 'View Item', $this->text_domain ),
            'search_items'          => __( 'Search Item', $this->text_domain ),
            'not_found'             => __( 'Not found', $this->text_domain ),
            'not_found_in_trash'    => __( 'Not found in Trash', $this->text_domain ),
            'items_list'            => __( 'Items list', $this->text_domain ),
            'items_list_navigation' => __( 'Items list navigation', $this->text_domain ),
            'filter_items_list'     => __( 'Filter items list', $this->text_domain ),
        );
        
        $capabilities = array(
            'edit_post'             => 'manage_options',
            'read_post'             => 'manage_options',
            'delete_post'           => 'manage_options',
            'edit_posts'            => 'manage_options',
            'edit_others_posts'     => 'manage_options',
            'publish_posts'         => 'manage_options',
            'read_private_posts'    => 'manage_options',
        );
        
        $args = array(
            'label'                 => __( 'Image Size', $this->text_domain ),
            'description'           => __( 'Easy Image Sizes Settings', $this->text_domain ),
            'labels'                => $labels,
            'supports'              => array( 'title', ),
            'hierarchical'          => false,
            'public'                => false,
            'menu_icon'             => 'dashicons-format-gallery',
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 80,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,		
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'rewrite'               => false,
            'capabilities'          => $capabilities,
        );
        
        register_post_type( 'easy_image_sizes', $args );

    }
    
    public function changeTitlePlaceholderText($title) {
    
        $current_screen = get_current_screen();
        
        if(isset($current_screen->post_type)) {
        
            if('easy_image_sizes' == $current_screen->post_type) {
        
                $title = 'Enter image size name';
            }
            
        }
        
        return $title;
    }

    public function getMetaForEasyImageSizes($value, $post_id = false) {

        global $post;
        
        $id = ($post_id) ? $post_id : $post->ID;

        $field = get_post_meta($id, $value, true);
        
        if ($field && $field != '') {
            
            return stripslashes(wp_kses_decode_entities($field));
            
        }
            
        return false;
        
    }

    public function addMetaBoxForEasyImageSizes() {
    
        add_meta_box(
            'easy_image_sizes-easy_image_sizes',
            __( 'Easy Image Sizes', $this->text_domain ),
            array($this, 'fieldsForEasyImageSizes'),
            'easy_image_sizes',
            'normal',
            'core'
        );
        
    }
    

    public function fieldsForEasyImageSizes($post) {
        
        wp_nonce_field( '_easy_image_sizes_nonce', 'easy_image_sizes_nonce' );
        ?>

        <div class="easy_image_sizes_item">
            <label for="easy_image_sizes_width"><?php _e( 'Width', $this->text_domain ); ?> <span><?php _e( 'in px', $this->text_domain ); ?></span></label><br>
            <input type="number" name="easy_image_sizes_width" id="easy_image_sizes_width" placeholder="e.g. 500" value="<?php echo $this->getMetaForEasyImageSizes( 'easy_image_sizes_width' ); ?>" required>
        </div>	
        <div class="easy_image_sizes_item">
            <label for="easy_image_sizes_height"><?php _e( 'Height', $this->text_domain ); ?> <span><?php _e( 'in px', $this->text_domain ); ?></span></label><br>
            <input type="number" name="easy_image_sizes_height" id="easy_image_sizes_height" placeholder="e.g. 250" value="<?php echo $this->getMetaForEasyImageSizes( 'easy_image_sizes_height' ); ?>" required>
        </div>
        <div class="easy_image_sizes_item">
            <label for="easy_image_sizes_cropped"><?php _e( 'Cropped', $this->text_domain ); ?></label><br>
            <select name="easy_image_sizes_cropped" id="easy_image_sizes_cropped">
                <option <?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_cropped' ) === 'No' ) ? 'selected' : '' ?>>No</option>
                <option <?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_cropped' ) === 'Yes' ) ? 'selected' : '' ?>>Yes</option>
            </select>
        </div>
        <div class="easy_image_sizes_item easy_image_sizes_advanced">
            <label for="easy_image_sizes_crop_x"><?php _e( 'Crop X Axis', $this->text_domain ); ?> <span><?php _e( 'Default: centre', $this->text_domain ); ?></span></label><br>
            <select name="easy_image_sizes_crop_x" id="easy_image_sizes_crop_x">
                <option value="center" <?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_crop_x' ) === 'center' ) ? 'selected' : '' ?>>Centre</option>
                <option value="left" <?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_crop_x' ) === 'left' ) ? 'selected' : '' ?>>Left</option>
                <option value="right" <?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_crop_x' ) === 'right' ) ? 'selected' : '' ?>>Right</option>
            </select>
        </div>
        <div class="easy_image_sizes_item easy_image_sizes_advanced">
            <label for="easy_image_sizes_crop_y"><?php _e( 'Crop Y Axis', $this->text_domain ); ?> <span><?php _e( 'Default: centre', $this->text_domain ); ?></span></label><br>
            <select name="easy_image_sizes_crop_y" id="easy_image_sizes_crop_y">
                <option value="center"<?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_crop_y' ) === 'center' ) ? 'selected' : '' ?>>Centre</option>
                <option value="top" <?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_crop_y' ) === 'top' ) ? 'selected' : '' ?>>Top</option>
                <option value="bottom" <?php echo ($this->getMetaForEasyImageSizes( 'easy_image_sizes_crop_y' ) === 'bottom' ) ? 'selected' : '' ?>>Bottom</option>
            </select>
        </div>
        <?php
    }

    public function saveForEasyImageSizes( $post_id ) {
        
        $min_permission = 'edit_post';
        
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can($min_permission, $post_id)) {
            return;
        } 
        
        if(!isset($_POST['easy_image_sizes_nonce']) || !wp_verify_nonce($_POST['easy_image_sizes_nonce'], '_easy_image_sizes_nonce')) {
            return;
        }
        
        $fields = array(
            'easy_image_sizes_width',
            'easy_image_sizes_height',
            'easy_image_sizes_cropped',
            'easy_image_sizes_crop_x',
            'easy_image_sizes_crop_y'
        );
        
        $fields_to_strip = array(
            'easy_image_sizes_width',
            'easy_image_sizes_height'
        );
        
        foreach($fields as $field) {
            
            if (isset($_POST[$field])) {
            
                $field_val = (in_array($field, $fields_to_strip)) ? preg_replace("/[^0-9]/","",$_POST[$field]) : $_POST[$field];
                
                update_post_meta($post_id, $field, esc_attr($field_val));
                
            }
            
            
        }

    }

    public function editEasyImageSizesColumns($columns) {
    
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Image Size Name' ),
            'dimensions' => __( 'Dimensions' ),
            'cropped' => __( 'Cropped' ),
            'date' => __( 'Date' )
        );
    
        return $columns;
        
    }
    
    function manageEasyImageSizesColumns($column, $post_id) {
        
        global $post;
    
        switch($column) {
    
            case 'dimensions':
                $width = $this->getMetaForEasyImageSizes('easy_image_sizes_width', $post_id);
                
                $height = $this->getMetaForEasyImageSizes('easy_image_sizes_height', $post_id);
                
                $dimensions = ($width) ? $width : 'Not Set';
                $dimensions .= 'x';
                $dimensions .= ($height) ? $height : 'Not Set';
                echo $dimensions;
                
                break;
    
            /* If displaying the 'genre' column. */
            case 'cropped':
                $cropped = $this->getMetaForEasyImageSizes('easy_image_sizes_cropped', $post_id);
                
                echo ($cropped) ? $cropped : 'No';
    
                break;

            default :
                break;
                
        }
        
    }
    
    function removeQuickEditFromPostList($actions) {
        
        global $post;
        
        if($post->post_type == $this->post_type_name && is_admin()) {
            
            unset($actions['inline hide-if-no-js']);
            
        }
        
        return $actions;
    
    }

}