<?php
/**
 * SmoothThemes
 *
 * @author		SmoothThemes
 * @copyright	Copyright (c) SmoothThemes
 * @link		http://www.SmoothThemes.com
 * @since		Version 1.0
 * @package 	SmoothThemes
 * @version 	1.0
*/
// theme Name
define('ST_NAME', 'stbase');
// theme supports
function edu_theme_setup(){
    add_theme_support( 'st-pagebuilder' ); // support  Page Builder of Plugin stTooKit
    add_theme_support( 'st-titlebar' ); // support  Title bar of Plugin stTooKit
// support widgets of Plugin stTooKit
    add_theme_support( 'st-widgets', array('popular-posts', 'recent-comments', 'recent-posts','twitter', 'tab-content', 'login') );
    add_theme_support( 'post-thumbnails', array('post', 'page', 'course', 'event','product') );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'automatic-feed-links' );
// Image Sizes
    // Portfolio
    add_image_size( 'portfolio-full', 1170, 600, true );
    add_image_size( 'portfolio-two', 570, 364, true );
    add_image_size( 'portfolio-three', 370, 236, true );
    add_image_size( 'portfolio-four', 270, 172, true );
    // Blog
    add_image_size( 'blog-full', 1170, 450, true );
    add_image_size( 'blog-large', 870, 350, true );
    add_image_size( 'blog-medium', 370, 250, true );
    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
    add_editor_style( array( 'assets/css/editor-style.css' ) );

    load_theme_textdomain('smooththemes', get_template_directory() . '/languages');

}

add_action( 'after_setup_theme', 'edu_theme_setup' );

/*----------------------------------------------------------*/
$themeInfo            =  wp_get_theme() ; // get_theme_data(TEMPLATEPATH . '/style.css');
#-----------------------------------------------------------------
# Define variables
#-----------------------------------------------------------------
if (!defined('ST_PAGEBUILDER_USE_CSS')) define('ST_PAGEBUILDER_USE_CSS', false);
if (!defined('ST_MEGAMENU_USE_CSS')) define('ST_MEGAMENU_USE_CSS', false);
if(!defined('ST_THEME_DIR')) define('ST_THEME_DIR', get_template_directory().'/' );
if(!defined('ST_THEME_URL')) define('ST_THEME_URL', trailingslashit(get_bloginfo('template_url') ) );
if(!defined('ST_THEME_NAME')) define('ST_THEME_NAME', trim($themeInfo['Title']));
if(!defined('ST_AUTHOR')) define('ST_AUTHOR', trim($themeInfo['Author']));                    // The theme Author
if(!defined('ST_AUTHOR_URL')) define('ST_AUTHOR_URL', trim($themeInfo['AuthorURI']));        // Author URL
if(!defined('ST_VERSION')) define('ST_VERSION', trim($themeInfo['Version']));                 // Theme version number
if(!defined('ST_SETTINGS_OPTION')) define('ST_SETTINGS_OPTION', ST_NAME);	 // Theme Option Name ( Will be user when update_option() is called )
if(!defined('ST_TRANSLATE_OPTION')) define('ST_TRANSLATE_OPTION', ST_NAME.'_trans');
if ( ! isset( $content_width ) ) $content_width = 900;
if(!function_exists('st_is_wpml')) {
    /**
     *  @true  if WPML installed.
     */
    function  st_is_wpml() {
        return function_exists('icl_get_languages');
    }
}
if(!function_exists('st_is_woocommerce') ) {
    /**
     * @return true if Woocommerce installed and atvive
     *
     */
    function st_is_woocommerce() {
        return class_exists('Woocommerce');
    }
}
require_once(ST_THEME_DIR .'includes/theme-hooks.php');
include_once(ST_THEME_DIR .'includes/theme-functions.php');
require_once(ST_THEME_DIR .'includes/theme-script.php');
require_once(ST_THEME_DIR .'includes/theme-menu.php');
require_once(ST_THEME_DIR .'includes/theme-sidebar.php');
require_once(ST_THEME_DIR .'includes/theme-post-type.php');
require_once(ST_THEME_DIR .'includes/theme-post-type-meta.php');
// woocommerce
if(st_is_woocommerce() && is_file(ST_THEME_DIR .'woocommerce/st-wc-functions.php')){
   require_once(ST_THEME_DIR .'woocommerce/st-wc-functions.php');
}
require_once(ST_THEME_DIR .'includes/widgets/recent-posts.php');
require_once(ST_THEME_DIR .'includes/widgets/divider.php');
require_once(ST_THEME_DIR .'includes/widgets/course.php');
require_once(ST_THEME_DIR .'includes/widgets/newsletter.php');
require_once(ST_THEME_DIR .'includes/widgets/get-direction.php');
require_once(ST_THEME_DIR .'includes/theme-active.php');
