<?php
/**
 * stFramework
 *
 * This is description
 *
 * @author		SmoothThemes
 * @copyright	Copyright (c) SmoothThemes
 * @link		http://www.SmoothThemes.com
 * @since		Version 1.0
 * @package 	stFramework
 * @version 	1.0
*/
/**
* ST_FRAMEWORK_NAME contains the root server path of the framework that is loaded
*/
if(!defined('ST_FRAMEWORK_NAME')) define('ST_FRAMEWORK_NAME', 'edu');
/**
* ST_TRANSLATE_OPTION contains the root server path of the framework that is loaded
*/
if(!defined('ST_TRANSLATE_OPTION')) define('ST_TRANSLATE_OPTION', ST_FRAMEWORK_NAME .'_trans');
/**
* ST_FRAMEWORK_TITLE contains the root server path of the framework that is loaded
*/
if(!defined('ST_FRAMEWORK_TITLE')) define('ST_FRAMEWORK_TITLE', 'ST Framework');
/**
* ST_BASE contains the root server path of the framework that is loaded
*/
if(!defined('ST_BASE')) define('ST_BASE', get_template_directory() .'/');
/**
* ST_THEME_URL contains the http url of the framework that is loaded
*/
if(!defined('ST_THEME_URL')) define('ST_THEME_URL', get_template_directory_uri() .'/');
/**
* ST_FRAMEWORK contains the server path of the framework folder
*/
if(!defined('ST_FRAMEWORK')) define( 'ST_FRAMEWORK', ST_BASE . 'st-framework/' );
/**
* ST_FRAMEWORK_URL contains the server path of the framework folder
*/
if(!defined('ST_FRAMEWORK_URL')) define( 'ST_FRAMEWORK_URL', ST_THEME_URL . 'st-framework/' );
/**
* ST_FRAMEWORK_SETTINGS_OPTION contains the server path of the framework folder
*/
if(!defined('ST_FRAMEWORK_SETTINGS_OPTION')) define( 'ST_FRAMEWORK_SETTINGS_OPTION', ST_FRAMEWORK_NAME );
/**
* ST_FRAMEWORK_MENU_TITLE Title Page Options Theme
*/
if(!defined('ST_FRAMEWORK_MENU_TITLE')) define( 'ST_FRAMEWORK_MENU_TITLE', 'Theme Options' );
/**
* ST_FRAMEWORK_PAGE_TITLE Title Page Options Theme
*/
if(!defined('ST_FRAMEWORK_PAGE_TITLE')) define( 'ST_FRAMEWORK_PAGE_TITLE','ST Framework' );
/**
* ST_FRAMEWORK_PAGE_SLUG Title Page Options Theme
*/
if(!defined('ST_FRAMEWORK_PAGE_SLUG')) define( 'ST_FRAMEWORK_PAGE_SLUG', 'st-framework' );
/**
* ST_FRAMEWORK_PHP contains the server path of the frameworks php folder
*/
if(!defined('ST_FRAMEWORK_PHP')) define( 'ST_FRAMEWORK_PHP', ST_FRAMEWORK . 'php/' );
/**
* ST_FRAMEWORK_JS contains the server path of the frameworks javascript folder
*/
if(!defined('ST_FRAMEWORK_JS')) define( 'ST_FRAMEWORK_JS', ST_FRAMEWORK_URL . 'assets/js/' );
/**
* ST_FRAMEWORK_CSS contains the server path of the frameworks css folder
*/ 
if(!defined('ST_FRAMEWORK_CSS')) define( 'ST_FRAMEWORK_CSS', ST_FRAMEWORK_URL . 'assets/css/' );
/**
* ST_FRAMEWORK_IMG contains the server path of the frameworks css folder
*/ 
if(!defined('ST_FRAMEWORK_IMG')) define( 'ST_FRAMEWORK_IMG', ST_FRAMEWORK_URL . 'assets/images/' );
/**
* 
*/
if(!defined('ST_RECOMMEND_PLUGINS')) define('ST_RECOMMEND_PLUGINS', get_template_directory() .'/recommended-plugins/');
/**
 * Require Files
 */
require_once('options-function.php');
require_once('options-script.php');
require_once('options-framework.php');
require_once('options-menu.php');
// lest Lib, see: https://github.com/leafo/lessphp
if(!class_exists('lessc')){
    require_once('less.php');
}
/**
 * 
 */
require_once('st-install-plugins.php');
require_once('fontend-functions.php');
if (!is_admin()) {
    require('fontend-script.php');
}