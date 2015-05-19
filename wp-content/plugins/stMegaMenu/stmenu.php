<?php
/*
Plugin Name: stMegaMenu
Plugin URI: http://www.smooththemes.com/
Description: A mega menu from SmoothThemes Team
Author: SmoothThemes
Version: 1.0
Author URI: http://www.smooththemes.com
*/

if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
/* Check via plugin */
define('ST_STMENU_ACTIVE',true);
define('ST_STMENU_STATUS', 0);
define('ST_STMENU_URL',plugins_url('/', __FILE__));
define('ST_STMENU_PATH',plugin_dir_path( __FILE__));
/* Admin Folder */
define('ST_STMENU_ADMIN_URL',ST_STMENU_URL.'admin');
define('ST_STMENU_ADMIN_PATH',ST_STMENU_PATH.DS.'admin');
/* Site Folder */
define('ST_STMENU_SITE_URL',ST_STMENU_URL.'site');
define('ST_STMENU_SITE_PATH',ST_STMENU_PATH.DS.'site');

include_once(ABSPATH . 'wp-includes/pluggable.php');

/* Load Extensions  */
if(is_file(get_template_directory().'/config-plugins/stMegaMenu/stMegaMenu.php')){
    include_once(get_template_directory().'/config-plugins/stMegaMenu/stMegaMenu.php');
}elseif(is_file(get_template_directory().'/stMegaMenu.php')){
    include_once(get_template_directory().'/stMegaMenu.php');
}


/* Init Admin */
require_once ST_STMENU_ADMIN_PATH.DS.'admin-int.php';
/* Init Site */
require_once ST_STMENU_SITE_PATH.DS.'site-int.php';

