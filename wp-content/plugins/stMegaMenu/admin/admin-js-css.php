<?php
/**
 * Call JS in backend
 * @return print js in admin head 
 */
function st_menu_admin_js(){
    global $ajax_nonce;
    wp_enqueue_script('jquery');
    wp_enqueue_script('stmenu',ST_STMENU_ADMIN_JS_URL.'/stmenu.js',array('jquery', 'jquery-ui-sortable'));
}

/**
 * Call CSS in backend
 * @return print css in admin head
 */
function st_menu_admin_css(){ 
        
        wp_enqueue_style('stmenu',ST_STMENU_ADMIN_CSS_URL.'/stmenu.css');
}

/**
 * Add action to hook
 */
add_action('admin_print_scripts-nav-menus.php','st_menu_admin_js');
add_action('admin_print_styles-nav-menus.php','st_menu_admin_css'); 


/**
 * Call JS in settings backend
 * @return print js in admin head 
 */
function st_menu_setting_admin_js(){
    global $ajax_nonce;
    wp_enqueue_script('jquery');
    wp_enqueue_script('stmenu',ST_STMENU_ADMIN_JS_URL.'/stmenusettings.js',array('jquery', 'jquery-ui-sortable'));
}

/**
 * Call CSS in settings backend
 * @return print css in admin head
 */
function st_menu_setting_admin_css(){ 
        wp_enqueue_style('stmenu',ST_STMENU_ADMIN_CSS_URL.'/stmenusettings.css');
}

/**
 * Add action to hook
 */
add_action('admin_print_scripts-appearance_page_stsettings','st_menu_setting_admin_js');
add_action('admin_print_styles-appearance_page_stsettings','st_menu_setting_admin_css'); 


function st_check_shortcode() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('shortcode');
    wp_enqueue_script('stmenu',ST_STMENU_ADMIN_JS_URL.'/custom.js',array());
}
add_action('admin_footer','st_check_shortcode');


    