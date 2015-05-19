<?php 
/************************************************************
* MAIN Functions file
*************************************************************/

/************************************************************
* Define Constant Variables
*************************************************************/
$get_theme = wp_get_theme();
$theme_name = $get_theme->get('TextDomain');
DEFINE('CSS_DIR',get_template_directory_uri().'/css/');
DEFINE('JS_DIR',get_template_directory_uri().'/js/');
DEFINE('STYLE_URI',get_stylesheet_uri());
DEFINE('THEMEPREFIX',$theme_name);
/************************************************************
* Theme Requirements (if any..)
*************************************************************/
require_once('libs/class.settings-api.php');
require_once('libs/class-tgm-plugin-activation.php');

/************************************************************
* Theme Setup
* - remove_header_info
* - _kt_custom_background_cb
* - register menu
*************************************************************/
function ketchupthemes_theme_setup(){
    
        // Set $content_width
        if ( ! isset( $content_width ) )
        $content_width = 575;

        add_editor_style( 'style.css' );
        // Load Background
        $ketchupthemes_background_args = array(
        'default-color' => 'ffffff',
        'default-image' => '',
        'wp-head-callback' => 'ketchupthemes_custom_background_cb',
        );
        add_theme_support( 'custom-background', $ketchupthemes_background_args );
        
        //Load Header
        $ketchupthemes_header_defaults = array(
        'default-image'          => '',
        'random-default'         => false,
        'width'                  => '1170',
        'height'                 => '370',
        'flex-height'            => false,
        'flex-width'             => false,
        'default-text-color'     => '',
        'header-text'            => false,
        'uploads'                => true,
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
        );
        add_theme_support( 'custom-header', $ketchupthemes_header_defaults );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        register_nav_menu( 'primary', 'Main Menu' );
        load_theme_textdomain('directory', get_template_directory() . '/languages');
    }
add_action('after_setup_theme', 'ketchupthemes_theme_setup');
    
function ketchupthemes_custom_background_cb() {
  $background = set_url_scheme( get_background_image() );
  $color = get_theme_mod( 'background_color', get_theme_support( 'custom-background', 'default-color' ) );

  if ( ! $background && ! $color )
    return;

  $style = $color ? "background-color: #$color;" : '';

  if ( $background ) {
    $image = " background-image: url('$background');";

    $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
    if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
      $repeat = 'repeat';
    $repeat = " background-repeat: $repeat;";

    $position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
    if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
      $position = 'left';
    $position = " background-position: top $position;";

    $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
    if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
      $attachment = 'scroll';
    $attachment = " background-attachment: $attachment;";

    $style .= $image . $repeat . $position . $attachment;
  }
?>
<style type="text/css" id="custom-background-css">
body.custom-background { <?php echo trim( $style ); ?> }
</style>
<?php
}
/************************************************************
*Load Stylesheets and Scripts..
*************************************************************/
    
    /***JS***/
    function ketchupthemes_load_scripts() {
   
        wp_enqueue_script('bootstrap', JS_DIR.'bootstrap.min.js',array('jquery'),'',true);
        wp_enqueue_script('slicknav',JS_DIR.'jquery.slicknav.min.js',array('jquery'),'',true);
        wp_enqueue_script('init',JS_DIR.'init.js',array('jquery'),'',true);
        wp_localize_script('init', 'init_vars', array(
            'label' => __('Menu', 'directory')
        ));

    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    }
    add_action('wp_enqueue_scripts', 'ketchupthemes_load_scripts');
    /***CSS***/
    function ketchupthemes_load_styles()
    { 
        wp_enqueue_style( 'bootstrap', CSS_DIR. 'bootstrap.min.css','','','all' );
        wp_enqueue_style( 'bootstrap-theme', CSS_DIR. 'bootstrap-theme.min.css','','','all' );
        wp_enqueue_style( 'slicknav',CSS_DIR.'slicknav.css','','','all');
        wp_enqueue_style( 'style', STYLE_URI,'','','all' );
    }    
    add_action('wp_enqueue_scripts', 'ketchupthemes_load_styles');
   
   
    function ketchupthemes_add_ie_html5_shim () {
        echo '<!--[if lt IE 9]>';
        echo '<script src="'.get_template_directory_uri().'/js/html5shiv.js"></script>';
        echo '<![endif]-->';
    }
    add_action('wp_head', 'ketchupthemes_add_ie_html5_shim');
    
/************************************************************
*Sidebar Initialization
*************************************************************/
function ketchupthemes_widgets_init() {
    
    register_sidebar(array(
        'name' => __('Sidebar', 'directory' ),
        'id'   => 'sidebar',
        'description' => __('This is the widgetized sidebar.', 'directory' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Directory Top Left', 'directory' ),
        'id'   => 'directory_top_left',
        'description' => __('This is the widgetized directory top left position.', 'directory' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Directory Top Right', 'directory' ),
        'id'   => 'directory_top_right',
        'description' => __('This is the widgetized directory top right position.', 'directory' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('directory1', 'directory' ),
        'id'   => 'directory1',
        'description' => __('This is the widgetized directory 1 position.', 'directory' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('directory2', 'directory' ),
        'id'   => 'directory2',
        'description' => __('This is the widgetized directory position.', 'directory' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('directory3', 'directory' ),
        'id'   => 'directory3',
        'description' => __('This is the widgetized directory 3 position.', 'directory' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('directory4', 'directory' ),
        'id'   => 'directory4',
        'description' => __('This is the widgetized directory 4 position.', 'directory' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    }
    add_action( 'widgets_init', 'ketchupthemes_widgets_init' );
/************************************************************
*Theme Functions (general) ,filters and hooks
* - excerpt_length
* - wp_title
* - TGM Activation Class
*************************************************************/
/**TGM Activation Class That Require ReduxFramework Plugin**/
add_action('tgmpa_register','ketchupthemes_required_plugins');
function ketchupthemes_required_plugins(){
    $plugins = array(
                
                // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'Listings Post Type Enable', // The plugin name.
            'slug'               => 'listings-post-type-enable', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
            
    );
    

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'               => 'directory',             
        'default_path'         => '',                             
        'parent_menu_slug'     => 'themes.php',                 
        'parent_url_slug'     => 'themes.php',                 
        'menu'                 => 'install-required-plugins',   
        'has_notices'          => true,                           
        'is_automatic'        => false,                         
        'message'             => '',                           
        'strings'              => array(
            'page_title'                                   => __( 'Install Required Plugins', 'directory' ),
            'menu_title'                                   => __( 'Install Plugins', 'directory' ),
            'installing'                                   => __( 'Installing Plugin: %s','directory' ), // %1$s = plugin name
            'oops'                                         => __( 'Something went wrong with the plugin API.', 'directory' ),
            'notice_can_install_required'                 => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends to install Listings Post Type Enable Plugin in order to enable the directory functionality.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                      => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'                => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'            => _n_noop( 'This theme recommends to activate Listings Post Type Enable Plugin in order to enable the directory functionality.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                     => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                         => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                         => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                                   => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                               => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                       => __( 'Return to Required Plugins Installer', 'directory'),
            'plugin_activated'                             => __( 'Plugin activated successfully.', 'directory' ),
            'complete'                                     => __( 'All plugins installed and activated successfully. %s', 'directory' ), // %1$s = dashboard link
            'nag_type'                                    => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );   
}

function ketchupthemes_wp_title($title,$sep){
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

   // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        
        $title = "$title $sep " . sprintf( __( 'Page %s', 'directory' ), max( $paged, $page ) );
        
        return $title;
}
add_filter( 'wp_title', 'ketchupthemes_wp_title', 10, 2 );
      

function ketchupthemes_excerpt_length( $length ) {
	return 24;
	}
	add_filter( 'excerpt_length', 'ketchupthemes_excerpt_length', 999 );
function ketchupthemes_fallback( $args ) {
        if ( current_user_can( 'manage_options' ) ) {

            extract( $args );

            $fb_output = null;

            if ( $container ) {
                $fb_output = '<' . $container;

                if ( $container_id )
                    $fb_output .= ' id="' . $container_id . '"';

                if ( $container_class )
                    $fb_output .= ' class="' . $container_class . '"';

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ( $menu_id )
                $fb_output .= ' id="' . $menu_id . '"';

            if ( $menu_class )
                $fb_output .= ' class="' . $menu_class . '"';

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ( $container )
                $fb_output .= '</' . $container . '>';

            echo $fb_output;
        }
    }
/***Returns Custom Taxonomies**/
function ketchupthemes_get_the_listing_categories($postid){
        
        $listing_categories = wp_get_post_terms($postid,'listing-category',array('fields'=>'all'));
      
        if(!empty($listing_categories)){ 
            
        $count = 0;  
        $arraysize = count($listing_categories);         
        foreach($listing_categories as $lcat){
            $thelink = get_term_link($lcat->slug,'listing-category');  
            echo '<a href="'. $thelink.'">'.$lcat->name.'</a>';
            
           if($count<$arraysize-1){ 
            echo " , ";
           }
            $count++;
         }
        }
    }
function ketchupthemes_get_the_listing_tags($postid){
        
        $listing_tags = wp_get_post_terms($postid,'listing-tag',array('fields'=>'all'));
      
        if(!empty($listing_tags)){ 
            
        $count = 0;  
        $arraysize = count($listing_tags);         
        foreach($listing_tags as $ltag){
            $thelink = get_term_link($ltag->slug,'listing-tag');  
            echo '<a href="'. $thelink.'">'.$ltag->name.'</a>';
            
           if($count<$arraysize-1){ 
            echo " , ";
           }
            $count++;
         }
        }
    }
/************************************************************
* Theme Metaboxes
*************************************************************/
function ketchupthemes_add_address_box() {

    $screens = array('listing');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'ketchupthemes_address_metabox',
            __( 'Add Listing Address', 'directory' ),
            'ketchupthemes_create_inner_address_metabox',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'ketchupthemes_add_address_box' );

/***Number***/
function ketchupthemes_add_number_box() {

    $screens = array('listing');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'ketchupthemes_number_metabox',
            __( 'Add Str number', 'directory' ),
            'ketchupthemes_create_inner_number_metabox',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'ketchupthemes_add_number_box' );

/***City***/
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function ketchupthemes_add_city_box() {

    $screens = array('listing');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'ketchupthemes_city_metabox',
            __( 'Add City Name', 'directory' ),
            'ketchupthemes_create_inner_city_metabox',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'ketchupthemes_add_city_box' );

/***Zip***/
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function ketchupthemes_add_zip_box() {

    $screens = array('listing');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'ketchupthemes_zip_metabox',
            __( 'Add zip code', 'directory' ),
            'ketchupthemes_create_inner_zip_metabox',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'ketchupthemes_add_zip_box' );

/***Country***/
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function ketchupthemes_add_country_box() {

    $screens = array('listing');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'ketchupthemes_country_metabox',
            __( 'Add country name', 'directory' ),
            'ketchupthemes_create_inner_country_metabox',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'ketchupthemes_add_country_box' );

/***Phone***/
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function ketchupthemes_add_phone_box() {

    $screens = array('listing');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'ketchupthemes_phone_metabox',
            __( 'Add phone number', 'directory' ),
            'ketchupthemes_create_inner_phone_metabox',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'ketchupthemes_add_phone_box' );
/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ketchupthemes_create_inner_address_metabox( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'ketchupthemes_inner_address_metabox', 'ketchupthemes_inner_address_metabox_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_listing_address', true );

  echo '<label for="ketchupthemes_new_address_field">';
       _e( "Please Enter your Address without a number", 'directory' );
  echo '</label> ';
  echo '<input type="text" id="ketchupthemes_address_field" name="ketchupthemes_address_field" value="' . esc_attr( $value ) . '" size="25" />';
}
/***Print Number***/
/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ketchupthemes_create_inner_number_metabox( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'ketchupthemes_inner_number_metabox', 'ketchupthemes_inner_number_metabox_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_listing_number', true );

  echo '<label for="ketchupthemes_new_number_field">';
       _e( "Please Enter your street number", 'directory' );
  echo '</label> ';
  echo '<input type="text" id="ketchupthemes_number_field" name="ketchupthemes_number_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/***Print City***/
/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ketchupthemes_create_inner_city_metabox( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'ketchupthemes_inner_city_metabox', 'ketchupthemes_inner_city_metabox_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_listing_city', true );

  echo '<label for="ketchupthemes_new_city_field">';
       _e( "Please Enter your city name", 'directory' );
  echo '</label> ';
  echo '<input type="text" id="ketchupthemes_city_field" name="ketchupthemes_city_field" value="' . esc_attr( $value ) . '" size="25" />';
}
/***Print Zip***/
/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ketchupthemes_create_inner_zip_metabox( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'ketchupthemes_inner_zip_metabox', 'ketchupthemes_inner_zip_metabox_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_listing_zip', true );

  echo '<label for="ketchupthemes_new_zip_field">';
       _e( "Please Enter your zip code", 'directory' );
  echo '</label> ';
  echo '<input type="text" id="ketchupthemes_zip_field" name="ketchupthemes_zip_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/***Print Country***/
/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ketchupthemes_create_inner_country_metabox( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'ketchupthemes_inner_country_metabox', 'ketchupthemes_inner_country_metabox_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_listing_country', true );

  echo '<label for="ketchupthemes_new_country_field">';
       _e( "Please Enter your country", 'directory' );
  echo '</label> ';
  echo '<input type="text" id="ketchupthemes_country_field" name="ketchupthemes_country_field" value="' . esc_attr( $value ) . '" size="25" />';
}
/***Print Phone**/
/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ketchupthemes_create_inner_phone_metabox( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'ketchupthemes_inner_phone_metabox', 'ketchupthemes_inner_phone_metabox_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_listing_phone', true );

  echo '<label for="ketchupthemes_new_phone_field">';
       _e( "Please Enter your phone number", 'directory' );
  echo '</label> ';
  echo '<input type="text" id="ketchupthemes_phone_field" name="ketchupthemes_phone_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function ketchupthemes_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['ketchupthemes_inner_address_metabox_nonce'] ) || !isset( $_POST['ketchupthemes_inner_number_metabox_nonce'] ) || !isset( $_POST['ketchupthemes_inner_city_metabox_nonce'] )
  || !isset( $_POST['ketchupthemes_inner_zip_metabox_nonce'] ) || 
  !isset( $_POST['ketchupthemes_inner_country_metabox_nonce'] ) || 
  !isset( $_POST['ketchupthemes_inner_phone_metabox_nonce'] ))
    return $post_id;

  $nonce = $_POST['ketchupthemes_inner_address_metabox_nonce'];
  
  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'ketchupthemes_inner_address_metabox' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $listing_address = sanitize_text_field( $_POST['ketchupthemes_address_field'] );
  $listing_number =  sanitize_text_field( $_POST['ketchupthemes_number_field'] );
  $listing_city =    sanitize_text_field( $_POST['ketchupthemes_city_field'] );
  $listing_zip =     sanitize_text_field( $_POST['ketchupthemes_zip_field'] );
  $listing_country = sanitize_text_field( $_POST['ketchupthemes_country_field'] );
  $listing_phone =   sanitize_text_field( $_POST['ketchupthemes_phone_field'] );
    // Update the meta field in the database.
  update_post_meta( $post_id, '_listing_address', $listing_address );
  update_post_meta( $post_id, '_listing_number', $listing_number );
  update_post_meta( $post_id, '_listing_city', $listing_city );
  update_post_meta( $post_id, '_listing_zip', $listing_zip );
  update_post_meta( $post_id, '_listing_country', $listing_country);
  update_post_meta( $post_id, '_listing_phone', $listing_phone);
}
add_action( 'save_post', 'ketchupthemes_save_postdata' );
/***********************************************************
* Theme options panel
************************************************************/
if ( !class_exists('Ketchup_Settings' ) ):
class Ketchup_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new Ketchup_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
       function ketchupthemes_load_admin_styles(){
       wp_enqueue_style( 'admin_styles',CSS_DIR.'admin_opts.css','', '','all');
    }
       $opt_page = add_theme_page('Theme Settings', 'Theme Settings', 'delete_posts', THEMEPREFIX.'_'.'theme_settings', array($this, 'plugin_page'));
         add_action( 'admin_print_styles-' .$opt_page, 'ketchupthemes_load_admin_styles' );
    }
    function get_settings_sections() {
        $sections = array(
            array(
                'id' => THEMEPREFIX.'_general',
                'title' => __( 'General Settings', 'directory' ),
                'desc'=>__('Here you can find the settings for this theme.
               <div class="premium_opts">
                <p>Do you want <b>premium features?</b></p>
                <ul>
                    <li>Widgetized Home Page</li>
                    <li>Responsive Design</li>
                    <li>Favicon Upload</li>
                    <li>Logo Upload</li>
                    <li>Customizable Background</li>
                    <li>Full Width Slider</li>
                    <li>Customizable Header</li>
                    <li>Sidebar</li>
                    <li>Four Widget Areas In The Footer Area</li>
                    <li>Social Icons</li>
                    
                </ul>
                <p>Visit this link here to know more.<p><a class="premium_link" href="'.esc_url('http://ketchupthemes.com/wordpress-directory-theme','directory').'">Directory Theme- Premium Edition</a></p>
                </div>')
               
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            THEMEPREFIX.'_general' => array(
             array(
                    'name' => 'favicon',
                    'label' => __( 'Upload Favicon', 'directory' ),
                    'desc' => __( '<p>Upload your favicon.Make sure it is 16x16pixels.</p>', 'directory' ),
                    'type' => 'file',
                    'default' => '',
                    'sanitize_callback'=>'esc_url_raw'
                )
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
$settings = new Ketchup_Settings();
/***GET THE VALUE FROM OPTIONS***/
function ketchupthemes_get_options( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}