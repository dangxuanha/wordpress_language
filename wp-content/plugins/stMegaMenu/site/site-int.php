<?php

#-------------------------------------------------------------
# Define Path and URL
#-------------------------------------------------------------
define('ST_STMENU_SITE_LIB_URL',ST_STMENU_SITE_URL.'/lib');
define('ST_STMENU_SITE_LIB_PATH',ST_STMENU_SITE_PATH.DS.'lib');
define('ST_STMENU_SITE_JS_URL',ST_STMENU_SITE_URL.'/js');
define('ST_STMENU_SITE_CSS_URL',ST_STMENU_SITE_URL.'/css');

#-------------------------------------------------------------
# Load the required Framework Files 
#-------------------------------------------------------------

// check valid ajax
$current_user = wp_get_current_user(); 
$ajax_nonce = wp_create_nonce($current_user->ID);
//check_ajax_referer( $current_user->ID, 'ajax_nonce' );

if(!is_admin()){ 
    include('site-js-css.php');
}







