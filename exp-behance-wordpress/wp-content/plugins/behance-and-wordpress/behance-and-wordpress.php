<?
/*
   Plugin Name: Behance and Wordpress
   Plugin URI: http://wordpress.org/extend/plugins/behance-and-wordpress/
   Version: 0.1
   Author: Devon Hirth
   Description: 
   Text Domain: behance-and-wordpress
   License: GPLv3
  */


$BAW_SETTINGS = array(
    'APP_NAME'          => 'Personal Portfolio',
    'API_KEY_CLIENT_ID' => 'S9ISvMy4MgV4cXvijnbIQOqtj9gTtVI0',
    'CLIENT_SECRET'     => '_d4WB4R.VV1_VL5qcCy1nYZGujY7nJN6',
    'REDIRECT_URI'      => 'http://www.devonhirth.com',
    'ENDPOINT'          => 'projects',
    'FIELD'             => '',
    'TIME'              => '',
    'PAGE'              => '',
    'USER'              => 'devonhirth',
    'PLUGINDIR'         => plugins_url( '' , __FILE__ ),
    'STORAGE'           => 'json', // json || sql
);


/**
 * Helpers Function Array
 *
 * Usage (replace 'function_name' and $function_arg);
 * call_user_func( $helpers['function_name'] , $function_arg , $function_arg );
 *
 * Add Array Item (Function);
 * 'function_name' => function( $function_arg ) {
 *     // Do something
 *     return $return_something;
 * },
 */
$BAW_HELPERS = array(


    /**
     * Create slug from string. Replacing special characters
     * and spaces with underscores.
     * @param  string $string string to generate slug.
     * @param  string $space string to replace spaces and special chars.
     * @return string the formatted slug.
     */
    'create_slug' => function( $string , $space ) {
        $string = rtrim( strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/' , $space , html_entity_decode( strip_tags( $string ) ) ) ) ) , $space );
        return $string;
    },


    /**
     * cURL Function
     * @param  [string] $url url to curl
     * @return [object]      the object return of the curl or the file content
     */
    'get_curl' => function( $setopt ) {
        if( function_exists( 'curl_init' ) ) {
            $ch = curl_init();
            if ( array_key_exists( 'CURLOPT_URL' , $setopt ) )            curl_setopt( $ch , CURLOPT_URL , $setopt['CURLOPT_URL'] );
            if ( array_key_exists( 'CURLOPT_RETURNTRANSFER' , $setopt ) ) curl_setopt( $ch , CURLOPT_RETURNTRANSFER , $setopt['CURLOPT_RETURNTRANSFER'] );
            if ( array_key_exists( 'CURLOPT_HEADER' , $setopt ) )         curl_setopt( $ch , CURLOPT_HEADER , $setopt['CURLOPT_HEADER'] );
            if ( array_key_exists( 'CURLOPT_SSL_VERIFYHOST' , $setopt ) ) curl_setopt( $ch , CURLOPT_SSL_VERIFYHOST , $setopt['CURLOPT_SSL_VERIFYHOST'] );
            if ( array_key_exists( 'CURLOPT_SSL_VERIFYPEER' , $setopt ) ) curl_setopt( $ch , CURLOPT_SSL_VERIFYPEER , $setopt['CURLOPT_SSL_VERIFYPEER'] );
            if ( array_key_exists( 'CURLOPT_USERAGENT' , $setopt ) )      curl_setopt( $ch , CURLOPT_USERAGENT , $setopt['CURLOPT_USERAGENT'] );
            $output = curl_exec( $ch );
            echo curl_error( $ch );
            curl_close( $ch );
            return $output;
        } else {
            return file_get_contents( $url );
        }
    },


    /**
     * Custom post type generator. You can much more cleanly add custom options
     * and defaults to your custom post types by setting up an array of custom
     * post type keys and array values that contain the settings you want. The
     * main benefit is to remove the need for nested array keys and values, 
     * enhance the ability to quickly list out options, and consolidate code 
     * while maintaining maximum visible options. This function can also create
     * pages if they are needed.
     *
     * Labels and arguments require a keyname => value, i.e. 'singular_name' => 'Custom Name'.
     * Supports require a single string value, i.e. 'title', 'editor', 'thumbnail', etc.
     * Sample usage;
     * 
     * $types = array( 
     *  'Hotel Spaces' => array( 'singular_name' => 'Hotel Space' , 'title' , 'thumbnail' ),
     *  'Rooms' => array( 'singular_name' => 'Room' , 'create_page' => 'Stay' , 'has_archive' => false , 'title' , 'thumbnail' ),
     *  'Venues' => array( 'singular_name' => 'Venue' , 'create_page' => 'Dine & Drink' , 'has_archive' => false , 'title' , 'thumbnail' ),
     *  'Galleries' => array( 'singular_name' => 'Gallery' , 'create_page' => 'Gallery' , 'has_archive' => false , 'title' , 'thumbnail' ),
     *  'Events' => array( 'singular_name' => 'Event' , 'create_page' => 'Events at the Raleigh' , 'has_archive' => false , 'title' , 'thumbnail' ),
     *  'Specials' => array( 'singular_name' => 'Special' , 'create_page' => 'Raleigh Specials' , 'has_archive' => false , 'title' , 'thumbnail' ),
     *  'Exclusives' => array( 'singular_name' => 'Exclusive' , 'title' , 'thumbnail' ),
     *  'Press' => array( 'create_page' => 'Press & Awards' , 'has_archive' => false , 'title' , 'thumbnail' )
     * );
     * 
     * foreach ( $types as $type => $settings )
     * {
     *  $post_types = custom_post_type_generator( $type , $settings );
     * }
     *
     * $disable_page_gen = false;
     * 
     * @param  string $t key value of the post types array.
     * @param  array $s custom settings for the post type.
     * @return boolean true if page created, false if not.
     */
    'register_post_type' => function( $t , $s ) { 
        
        global $disable_page_gen;
        $slug = createSlug( $t , '_' );

        $slug  = array_key_exists( 'name' , $s ) ? $s[ 'name' ] : $t;
        $space = '_';
        $slug  = rtrim( strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/' , $space , html_entity_decode( strip_tags( $slug ) ) ) ) ) , $space );


        $labels = array(
            'name'               => array_key_exists( 'name' , $s )               ? __( $s[ 'name' ] , 'pbtheme' )          : __( $t , 'pbtheme' ),
            'singular_name'      => array_key_exists( 'singular_name' , $s )      ? __( $s[ 'singular_name' ] , 'pbtheme' ) : __( $t , 'pbtheme' ),
            'all_items'          => array_key_exists( 'all_items' , $s )          ? __( $s[ 'all_items' ] , 'pbtheme' )     : __( 'All', 'pbtheme' ),
            'add_new'            => array_key_exists( 'add_new' , $s )            ? __( $s[ 'add_new' ] , 'pbtheme' )       : __( 'Add New' , 'pbtheme' ),
            'add_new_item'       => array_key_exists( 'add_new_item' , $s )       ? __( $s[ 'add_new_item' ] , 'pbtheme' )  : __( 'Add New' , 'pbtheme' ),
            'edit'               => array_key_exists( 'edit' , $s )               ? __( $s[ 'edit' ] , 'pbtheme' )          : __( 'Edit' , 'pbtheme' ),
            'edit_item'          => array_key_exists( 'edit_item' , $s )          ? __( $s[ 'edit_item' ] , 'pbtheme' )     : __( 'Edit' , 'pbtheme' ),
            'new_item'           => array_key_exists( 'new_item' , $s )           ? __( $s[ 'new_item' ] , 'pbtheme' )      : __( 'New' , 'pbtheme' ),
            'view_item'          => array_key_exists( 'view_item' , $s )          ? __( $s[ 'view_item' ] , 'pbtheme' )     : __( 'View' , 'pbtheme' ),
            'search_items'       => array_key_exists( 'search_items' , $s )       ? __( $s[ 'search_items' ] , 'pbtheme' )  : __( 'Search' , 'pbtheme' ),
            'not_found'          => array_key_exists( 'not_found' , $s )          ? __( $s[ 'not_found' ] , 'pbtheme' )     : __( 'Nothing found in the Database.', 'pbtheme' ),
            'not_found_in_trash' => array_key_exists( 'not_found_in_trash' , $s ) ? __( $s[ 'add_new_item' ] , 'pbtheme' )  : __( 'Nothing found in Trash', 'pbtheme' ),
            'parent_item_colon'  => array_key_exists( 'parent_item_colon' , $s )  ? __( $s[ 'add_new_item' ] , 'pbtheme' )  : ''
        );

        $rewrite = array(
            'slug'       => array_key_exists( 'slug' , $s )       ? __( $s[ 'slug' ] , 'pbtheme' )       : $slug, // you can specify the url slug 
            'with_front' => array_key_exists( 'with_front' , $s ) ? __( $s[ 'with_front' ] , 'pbtheme' ) : false
        );

        $supports = array( 
            // What's enabled in the post editor
            in_array( 'title' , $s )         ? 'title'         : null,
            in_array( 'editor' , $s )        ? 'editor'        : null,
            in_array( 'author' , $s )        ? 'author'        : null,
            in_array( 'thumbnail' , $s )     ? 'thumbnail'     : null,
            in_array( 'excerpt' , $s )       ? 'excerpt'       : null,
            in_array( 'trackbacks' , $s )    ? 'trackbacks'    : null,
            in_array( 'custom-fields' , $s ) ? 'custom-fields' : null,
            in_array( 'comments' , $s )      ? 'comments'      : null,
            in_array( 'revisions' , $s )     ? 'revisions'     : null,
            in_array( 'sticky' , $s )        ? 'sticky'        : null,
            in_array( 'post-formats' , $s )  ? 'post-formats'  : null
        );

        $args = array(
            'labels'              => $labels,
            'rewrite'             => $rewrite,
            'supports'            => $supports,
            'description'         => array_key_exists( 'description', $s )         ? __( $s[ 'description' ] , 'pbtheme' ) : null, // Custom Type Description
            'public'              => array_key_exists( 'public', $s )              ? $s[ 'public' ]                        : true,
            'publicly_queryable'  => array_key_exists( 'publicly_queryable', $s )  ? $s[ 'publicly_queryable' ]            : true,
            'exclude_from_search' => array_key_exists( 'exclude_from_search', $s ) ? $s[ 'exclude_from_search' ]           : false,
            'show_ui'             => array_key_exists( 'show_ui', $s )             ? $s[ 'show_ui' ]                       : true,
            'query_var'           => array_key_exists( 'query_var', $s )           ? $s[ 'query_var' ]                     : true,
            'menu_position'       => array_key_exists( 'menu_position', $s )       ? $s[ 'menu_position' ]                 : null, // this is what order you want it to appear in on the left hand side menu
            'menu_icon'           => array_key_exists( 'menu_icon', $s )           ? $s[ 'menu_icon' ]                     : null, // the icon for the custom post type menu
            'show_in_nav_menus'   => array_key_exists( 'show_in_nav_menus', $s )   ? $s[ 'show_in_nav_menus' ]             : true,
            'has_archive'         => array_key_exists( 'has_archive', $s )         ? $s[ 'has_archive' ]                   : true, // you can rename the slug here
            'capability_type'     => array_key_exists( 'capability_type', $s )     ? $s[ 'capability_type' ]               : 'post',
            'hierarchical'        => array_key_exists( 'hierarchial', $s )         ? $s[ 'hierarchial' ]                   : false
        );
        
        register_post_type( $slug , $args ); // http://codex.wordpress.org/Function_Reference/register_post_type

        if ( !array_key_exists( 'create_page' , $s ) || get_page_by_title( $s[ 'create_page' ] ) || $disable_page_gen ) return false;

        $page = array(
            'post_title'    => __( $s[ 'create_page' ] , 'pbtheme' ),
            'post_status' => 'publish',
            'post_type'     => 'page',
        );

        insert_post( $s[ 'create_page' ] , $page );

        return true;
        
    },

    /**
     * Post generator. You can much more cleanly add custom options and 
     * defaults to your posts by setting up an array of post keys and array 
     * values that contain the settings you want. The main benefit is to 
     * remove the need for nested array keys and values, enhance the 
     * ability to quickly list out options, and consolidate code while 
     * maintaining maximum visible options.
     *
     * Sample Usage;
     * $pages = array(
     *  'Home' => array( 'post_type' => 'page' , 'post_status' => 'publish' ),
     *  'Explore' => array( 'post_type' => 'page' , 'post_status' => 'publish' ),
     *  'About the Raleigh' => array( 'post_type' => 'page' , 'post_status' => 'publish' ),
     *  'Contact' => array( 'post_type' => 'page' , 'post_status' => 'publish' ),
     *  'Privacy Policy' => array( 'post_type' => 'page' , 'post_status' => 'publish' ),
     *  'Get Exclusives' => array( 'post_type' => 'page' , 'post_status' => 'publish' )
     * );
     * 
     * foreach ( $pages as $page => $settings )
     * {
     *  $page = insert_post( $page , $settings );
     * }
     * 
     * @param  string $p key value or regular string, the post title.
     * @param  array $s general settings
     * @return boolean true if sucess
     */
    'insert_post' => function( $p , $s ) {

        $slug  = array_key_exists( 'post_title' , $s ) ? $s[ 'post_title' ] : $p;
        $space = '_';
        $slug  = rtrim( strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/' , $space , html_entity_decode( strip_tags( $slug ) ) ) ) ) , $space );

        $post = array(
            'ID'             => array_key_exists( 'ID' , $s )              ? $s[ 'ID' ]              : null, // [ <post id> ] //Are you updating an existing post?
            'menu_order'     => array_key_exists( 'menu_order' , $s )      ? $s[ 'menu_order' ]      : null, // [ <order> ] //If new post is a page, it sets the order in which it should appear in the tabs.
            'comment_status' => array_key_exists( 'comment_status' , $s )  ? $s[ 'comment_status' ]  : null, // [ 'closed' | 'open' ] // 'closed' means no comments.
            'ping_status'    => array_key_exists( 'ping_status' , $s )     ? $s[ 'ping_status' ]     : null, // [ 'closed' | 'open' ] // 'closed' means pingbacks or trackbacks turned off
            'pinged'         => array_key_exists( 'pinged' , $s )          ? $s[ 'pinged' ]          : null, // [ ? ] //?
            'post_author'    => array_key_exists( 'post_author' , $s )     ? $s[ 'post_author' ]     : null, // [ <user ID> ] //The user ID number of the author.
            'post_category'  => array_key_exists( 'post_comment' , $s )    ? $s[ 'post_comment' ]    : null, // [ array(<category id>, <...>) ] //post_category no longer exists, try wp_set_post_terms() for setting a post's categories
            'post_content'   => array_key_exists( 'post_content' , $s )    ? $s[ 'post_content' ]    : null, // [ <the text of the post> ] //The full text of the post.
            'post_date'      => array_key_exists( 'post_date' , $s )       ? $s[ 'post_date' ]       : null, // [ Y-m-d H:i:s ] //The time post was made.
            'post_date_gmt'  => array_key_exists( 'post_date_gmt' , $s )   ? $s[ 'post_date_gmt' ]   : null, // [ Y-m-d H:i:s ] //The time post was made, in GMT.
            'post_excerpt'   => array_key_exists( 'post_excerpt' , $s )    ? $s[ 'post_excerpt' ]    : null, // [ <an excerpt> ] //For all your post excerpt needs.
            'post_name'      => array_key_exists( 'post_name' , $s )       ? $s[ 'post_name' ]       : $slug, // [ <the name> ] // The name (slug) for your post
            'post_parent'    => array_key_exists( 'post_parent' , $s )     ? $s[ 'post_parent' ]     : null, // [ <post ID> ] //Sets the parent of the new post.
            'post_password'  => array_key_exists( 'post_password' , $s )   ? $s[ 'post_password' ]   : null, // [ ? ] //password for post?
            'post_status'    => array_key_exists( 'post_status' , $s )     ? $s[ 'post_status' ]     : null, // [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | 'custom_registered_status' ] //Set the status of the new post.
            'post_title'     => array_key_exists( 'post_title' , $s )      ? $s[ 'post_title' ]      : $p, // [ <the title> ] //The title of your post.
            'post_type'      => array_key_exists( 'post_type' , $s )       ? $s[ 'post_type' ]       : null, // [ 'post' | 'page' | 'link' | 'nav_menu_item' | 'custom_post_type' ] //You may want to insert a regular post, page, link, a menu item or some custom post type
            'tags_input'     => array_key_exists( 'tags_input' , $s )      ? $s[ 'tags_input' ]      : null, // [ '<tag>, <tag>, <...>' ] //For tags.
            'to_ping'        => array_key_exists( 'to_ping' , $s )         ? $s[ 'to_ping' ]         : null, // [ ? ] //?
            'tax_input'      => array_key_exists( 'tax_input' , $s )       ? $s[ 'tax_input' ]       : null  // [ array( 'taxonomy_name' => array( 'term', 'term2', 'term3' ) ) ] // support for custom taxonomies. 
        );

        $post_id = wp_insert_post( $post ); // http://codex.wordpress.org/Function_Reference/wp_insert_post

        return true;

    },


    /**
     * Creates a taxonomy based on key => valu array input.
     *
     * Sample Usage;
     *
     * $taxonomies = array(
     *  'Space Types' => array( 'association' => 'Hotel Spaces' , 'create_category' => array( 'Explore' , 'Events' ) ),
     *  'Venue Types' => array( 'association' => 'Venues' , 'create_category' => array( 'Miami' , 'Hotel' ) ),
     *  'Gallery Types' => array( 'association' => 'Galleries' , 'create_category' => array( 'Video' , 'Album' , 'Featured' ) ),
     *  'Press Types' => array( 'association' => 'Press' , 'create_category' => array( 'News' , 'Awards' ) )
     * );
     * 
     * foreach ( $taxonomies as $taxonomy => $settings )
     * {
     *  $categories = pb_register_taxonomy( $taxonomy , $settings );
     * }
     * 
     * @param  string $t key value or regular string, the taxonomy title
     * @param  array $s general settings
     * @return boolean true if sucess
     */
    'register_taxonomy' => function( $t , $s ) {

        global $disable_category_gen;

        $slug  = $t;
        $space = '_';
        $slug  = rtrim( strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/' , $space , html_entity_decode( strip_tags( $slug ) ) ) ) ) , $space );
        $association = array_key_exists( 'association' , $s ) ? $s[ 'association' ] : null;
        if ( $association != null ) $association = rtrim( strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/' , $space , html_entity_decode( strip_tags( $association ) ) ) ) ) , $space );


        $labels = array(
            'name'              => array_key_exists( 'name' , $s )              ? __( $t , 'pbtheme' )                                  : __( $t , 'pbtheme' ),
            'singular_name'     => array_key_exists( 'singular_name' , $s )     ? __( $s[ 'singular_name' ] , 'pbtheme' )       : __( $t , 'pbtheme' ),
            'search_items'      => array_key_exists( 'search_items' , $s )      ? __( $s[ 'search_items' ] , 'pbtheme' )        : __( 'Search' , 'pbtheme' ),
            'all_items'         => array_key_exists( 'all_items' , $s )         ? __( $s[ 'all_items' ] , 'pbtheme' )           : __( 'All' , 'pbtheme' ),
            'parent_item'       => array_key_exists( 'parent_item' , $s )       ? __( $s[ 'parent_item' ] , 'pbtheme' )         : __( 'Parent' , 'pbtheme' ),
            'parent_item_colon' => array_key_exists( 'parent_item_colon' , $s ) ? __( $s[ 'parent_item_colon' ] , 'pbtheme' )   : __( 'Parent:' , 'pbtheme' ),
            'edit_item'         => array_key_exists( 'edit_item' , $s )         ? __( $s[ 'edit_item' ] , 'pbtheme' )           : __( 'Edit' , 'pbtheme' ),
            'update_item'       => array_key_exists( 'update_item' , $s )       ? __( $s[ 'update_item' ] , 'pbtheme' )         : __( 'Update' , 'pbtheme' ),
            'add_new_item'      => array_key_exists( 'add_new_item' , $s )      ? __( $s[ 'add_new_item' ] , 'pbtheme' )        : __( 'Add New' , 'pbtheme' ),
            'new_item_name'     => array_key_exists( 'new_item_name' , $s )     ? __( $s[ 'new_item_name' ] , 'pbtheme' )       : __( 'New Name' , 'pbtheme' ),
            'menu_name'         => array_key_exists( 'menu_name' , $s )         ? __( $s[ 'menu_name' ] , 'pbtheme' )           : __( $t , 'pbtheme' )
        );

        $rewrite = array( 
            'slug' => array_key_exists( 'slug' , $s ) ? $s[ 'slug' ] : $slug, 
        );

        $args = array(
            'rewrite'           => $rewrite,
            'labels'            => $labels,
            'hierarchical'      => array_key_exists( 'hierarchical' , $s )      ? $s[ 'hierarchical' ] : true, // determines if taxonomy hierarchical like categories or not hierarchical like tags (defaults to false in wp).
            'show_ui'           => array_key_exists( 'show_ui' , $s )           ? $s[ 'show_ui' ] : true,
            'show_admin_column' => array_key_exists( 'show_admin_column' , $s ) ? $s[ 'show_admin_column' ] : true,
            'query_var'         => array_key_exists( 'query_var' , $s )         ? $s[ 'query_var' ] : $slug
        );

        register_taxonomy( $slug , $association , $args ); // http://codex.wordpress.org/Function_Reference/register_taxonomy
        register_taxonomy_for_object_type( $slug , $association ); // http://codex.wordpress.org/Function_Reference/register_taxonomy_for_object_type

        if ( !array_key_exists( 'create_category' , $s ) || $disable_category_gen ) return false;

        $categories = $s[ 'create_category' ];

        foreach ( $categories as $category )
        {   
            insert_term( $category , array( 'taxonomy' => $slug ) );
        }

        return true;

    },
    

    /**
     * Create a category for a particular taxonomy
     * @param  string $c the category name
     * @param  [type] $s [description]
     * @return [type]    [description]
     */
    'insert_term' => function( $c , $s ) {

        global $disable_category_gen;
        $slug = $c;
        $space = '_';
        $slug  = rtrim( strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/' , $space , html_entity_decode( strip_tags( $slug ) ) ) ) ) , $space );

        $args = array(
            'alias_of'    => array_key_exists( 'alias_of' , $s )    ? $s[ 'alias_of' ]    : null,
            'description' => array_key_exists( 'description' , $s ) ? $s[ 'description' ] : null,
            'parent'      => array_key_exists( 'parent' , $s )      ? $s[ 'parent' ]      : null,
            'slug'        => array_key_exists( 'slug' , $s )        ? $s[ 'slug' ]        : $slug 
        );

        wp_insert_term( $c , $s[ 'taxonomy' ] , $args );

        return true;

    }

);


/**
 * The Styles and Scripts needed for the plugin.
 * @return void
 */
function baw_scripts() {

    global $BAW_SETTINGS;
    // CSS
    // wp_enqueue_style(  'farbtasticcss' , $_PLUGINDIR . '/lib/farbtastic/farbtastic.css'    , null , null , 'screen' );
    // Javascript
    // wp_enqueue_script( 'farbtasticjs'  , $_PLUGINDIR . '/lib/farbtastic/farbtastic.js'     , null , array( 'jQuery' ) , true );

}
add_action( 'wp_enqueue_scripts' , 'be_scripts' );


/**
 * Set Parameters for getting projects.
 * @return [type] [description]
 */
function baw_init() {

    global $BAW_SETTINGS;

    $parameters = array(
        0 => array(
            'endpoint' => $BAW_SETTINGS[ 'ENDPOINT' ],
            'field'    => $BAW_SETTINGS[ 'FIELD' ],
            'time'     => $BAW_SETTINGS[ 'TIME' ],
            'page'     => $BAW_SETTINGS[ 'PAGE' ],
            'api_key'  => $BAW_SETTINGS[ 'API_KEY_CLIENT_ID' ]
        )
    );

    foreach ( $parameters as $set ) {
        baw_getbehance( $set );
    }
}

/**
 * Store Behance projects.
 * @return [type] [description]
 */
function baw_getbehance() {

    global $BAW_SETTINGS;

    // Store projects as json
    // if ( option == json )
    
    $ENDPOINT     = $BAW_SETTINGS[ 'ENDPOINT' ]; unset( $BAW_SETTINGS[ 'ENDPOINT' ] );
    $CURLOPT_URL  = 'http://www.behance.net/v2/'.$ENDPOINT;
    $cache_id     = 'baw_'.$ENDPOINT.'_';
    $param_count  = 0;
    $param_length = sizeof( $parameters );

    foreach( $parameters as $key => $value ) :
        $CURLOPT_URL .= ( $param_count > 0 ) ? '&'.$key.'='.(string)$value : '?'.$key.'='.(string)$value;
        $cache_id    .= ( $param_count < $param_length - 1 ) ? $value.'_' : '';
        $param_count++;
    endforeach;
    
    $cache_id       = trim( $cache_id , '_' );
    $cache_projects = 'wp-content/cache/' . $cache_id . '.json';

    if ( file_exists( $cache_projects ) && filemtime( $cache_projects ) > time() - 60 * 60 ) :
        $data_projects  = json_decode( file_get_contents( $cache_projects ) , true );
    else :
        $data_projects  = call_user_func( $BAW_HELPERS[ 'get_curl' ] , array( 
            'CURLOPT_URL'            => $CURLOPT_URL,
            'CURLOPT_USERAGENT'      => $BAW_SETTINGS[ 'APP_NAME' ],
            'CURLOPT_RETURNTRANSFER' => true
        ));
        $data_projects  = json_decode( $data_projects , true );
        $cache_projects = file_put_contents( $cache_projects , json_encode( $data_projects ) );
    endif;

    $parameters[ 'endpoint' ] = $ENDPOINT;
    unset( $parameters[ 'api_key' ] );

    // Store Projects in the Database
    // if ( option == sql )
    // if ( !get_page_by_title( $p ) || !$disable_page_gen ) 
    //  call_user_func( $BAW_HELPERS[ 'insert_post' ] , array() );

}



