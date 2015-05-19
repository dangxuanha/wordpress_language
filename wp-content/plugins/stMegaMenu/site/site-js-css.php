<?php
/**
 * Call JS and CSS in fontend
 */
if(!is_admin()){
    add_action('wp_print_scripts','st_menu_site_js',99);
    add_action('wp_print_styles','st_menu_site_css',99);
}

/**
 * Call JS in fontend
 * @return Print js in fontend
 */
function st_menu_site_js(){
    wp_enqueue_script('jquery');
    
    wp_enqueue_script('shortcode');
    
    wp_enqueue_script('stmenu',ST_STMENU_SITE_JS_URL.'/stmenu.js', array(), false, true);
    wp_localize_script( 'stmenu', 'stMegamenuSettings', array(
			'type'				=>	get_option( '_st-menu-type', 'hover' ),
			'effect'			=>	get_option( '_st-menu-effect', 'slide' ),
			'speed'		        =>	get_option( '_st-menu-speed', 600 ),
            'align'		        =>	get_option( '_st-menu-align', 'no' ),
            'textnav'		    =>	get_option( '_st-menu-textnav', __('Main Navigation', 'smooththemes') )
		));
}

/**
 * Call CSS in fontend
 * @return Print css in fontend
 */
function st_menu_site_css(){
    if (get_option( '_st-menu-style', 'yes' ) == 'yes' && (!defined('ST_MEGAMENU_USE_CSS') || ST_MEGAMENU_USE_CSS!=false)){
        wp_enqueue_style('stmenu',ST_STMENU_SITE_CSS_URL.'/stmenu.css','1.0','all');
    }

}

    