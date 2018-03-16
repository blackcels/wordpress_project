<?php

 
add_action( 'init', 'wpdocs_codex_Gallerie_init' );
add_action( 'init', 'create_gallerie_taxonomies', 0 );
add_filter( 'single_template' , 'get_gallerie_template');
add_action('wp_enqueue_scripts', 'front_enqueue_scripts');

/**
 * Register a custom post type called "Gallerie".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_Gallerie_init() {
    $labels = array(
        'name'                  => _x( 'Mes Galleries', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Gallerie', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Mes Galleries', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Gallerie', 'Ajouter une Gallerie', 'textdomain' ),
        'add_new'               => __( 'Ajouter une Gallerie', 'textdomain' ),
        'add_new_item'          => __( 'Ajouter une Gallerie', 'textdomain' ),
        'new_item'              => __( 'Nouvelle Gallerie', 'textdomain' ),
        'edit_item'             => __( 'Editer Gallerie', 'textdomain' ),
        'view_item'             => __( 'Voir mes Gallerie', 'textdomain' ),
        'all_items'             => __( 'Toutes Mes Galleries', 'textdomain' ),
        'search_items'          => __( 'Rechercher des Galleries', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Mes Galleries:', 'textdomain' ),
        'not_found'             => __( 'Pas de Galleries trouvé.', 'textdomain' ),
        'not_found_in_trash'    => __( 'Pas de Galleries trouvé dans la corbeille.', 'textdomain' ),
        'featured_image'        => _x( 'Gallerie Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Gallerie archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Gallerie', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Gallerie', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Mes Galleries list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Mes Galleries list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Mes Galleries list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'Gallerie' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'gallerie', $args );
}

// create one taxonomies, genres for the post type "gallerie"
function create_gallerie_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		'update_item'       => __( 'Update Genre', 'textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		'menu_name'         => __( 'Genre', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'gallerie' ), $args );
}

/**
 * Calls the class on the post add/edit screens.
 */
function call_Multi_Image_Uploader()
{
    new Multi_Image_Uploader();
}

/**
 * Get images attached to some post
 *
 * @param int $post_id
 * @return array
 */
function miu_get_images($post_id=null)
{
    global $post;
    if ($post_id == null)
    {
        $post_id = $post->ID;
    }

    $value = get_post_meta($post_id, 'miu_images', true);
    $images = unserialize($value);
    $result = array();
    if (!empty($images))
    {
        foreach ($images as $image)
        {
            $result[] = $image;
        }
    }
    return $result;
}

if (is_admin())
{
    add_action('load-post.php', 'call_Multi_Image_Uploader');
    add_action('load-post-new.php', 'call_Multi_Image_Uploader');
}

/**
 * Multi_Image_Uploader
 */
class Multi_Image_Uploader{

    var $post_types = array();

    /**
     * Initialize Multi_Image_Uploader
     */
    public function __construct()
    {
        $this->post_types = array('post', 'page', 'gallerie');     //limit meta box to certain post types
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box($post_type)
    {

        if (in_array($post_type, $this->post_types))
        {
            add_meta_box(
                    'multi_image_upload_meta_box'
                    , __('Upload Multiple Images', 'miu_textdomain')
                    , array($this, 'render_meta_box_content')
                    , $post_type
                    , 'advanced'
                    , 'high'
            );
        }
    }

    /**
     * Save the images when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save($post_id)
    {
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['miu_inner_custom_box_nonce']))
            return $post_id;

        $nonce = $_POST['miu_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'miu_inner_custom_box'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('page' == $_POST['post_type'])
        {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;
        } else
        {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Validate user input.
        $posted_images = $_POST['miu_images'];
        $miu_images = array();
        if (!empty($posted_images))
        {
            foreach ($posted_images as $image_url)
            {
                if (!empty($image_url))
                    $miu_images[] = esc_url_raw($image_url);
            }
        }

        // Update the miu_images meta field.
        update_post_meta($post_id, 'miu_images', serialize($miu_images));
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content($post)
    {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('miu_inner_custom_box', 'miu_inner_custom_box_nonce');

        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta($post->ID, 'miu_images', true);

        $metabox_content = '<div id="miu_images"></div><input type="button" onClick="addRow()" value="Ajouter Emplacement" class="button" />';
        echo $metabox_content;

        $images = unserialize($value);

        $script = "<script>
            itemsCount= 0;";
        if (!empty($images))
        {
            foreach ($images as $image)
            {
                $script.="addRow('{$image}');";
            }
        }
        $script .="</script>";
        echo $script;
    }

    function enqueue_scripts($hook)
    {
        if ('post.php' != $hook && 'post-edit.php' != $hook && 'post-new.php' != $hook)
            return;
        wp_enqueue_script('miu_script', plugin_dir_url(__FILE__) . 'js/miu_script.js', array('jquery'));
    }

    
}

function front_enqueue_scripts(){
    wp_enqueue_style('style',plugin_dir_url(__FILE__) . 'css/jcarousel.connected-carousels.css',false,'all');
    wp_enqueue_script('carousel_script', plugin_dir_url(__FILE__) . 'js/jcarousel.connected-carousels.js', array('jquery'));
}


function gallerieSliderTemplate($single){
    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'gallerie' ) {
        if ( file_exists( plugin_dir_url(__FILE__) . 'template/GallerieSlider.php' ) ) {
            return plugin_dir_url(__FILE__) . 'template/GallerieSlider.php';
        }
    }

    return $single;
}

    function get_gallerie_template($single_template) {
       global $wp_query, $post;
       if ($post->post_type == 'gallerie'){
           $single_template = plugin_dir_path(__FILE__) . '/template/GallerieSlider.php';
       }
       return $single_template;
   }