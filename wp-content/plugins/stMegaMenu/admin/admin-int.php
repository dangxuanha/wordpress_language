<?php
#-------------------------------------------------------------
# Define Path and URL
#-------------------------------------------------------------
define('ST_STMENU_ADMIN_PHP_URL',ST_STMENU_ADMIN_URL.'/php');
define('ST_STMENU_ADMIN_PHP_PATH',ST_STMENU_ADMIN_PATH.DS.'php');
define('ST_STMENU_ADMIN_JS_URL',ST_STMENU_ADMIN_URL.'/js');
define('ST_STMENU_ADMIN_CSS_URL',ST_STMENU_ADMIN_URL.'/css');

#-------------------------------------------------------------
# Load the required Framework Files 
#-------------------------------------------------------------

// check valid ajax
$current_user = wp_get_current_user(); 
$ajax_nonce = wp_create_nonce($current_user->ID);
//check_ajax_referer( $current_user->ID, 'ajax_nonce' );

if(is_admin()){
    include('admin-js-css.php');
    include(ST_STMENU_ADMIN_PHP_PATH.DS.'stsettings.php');
}

include(ST_STMENU_ADMIN_PHP_PATH.DS.'class-megamenu.php');







