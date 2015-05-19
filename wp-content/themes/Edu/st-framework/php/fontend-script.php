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
#-----------------------------------------------------------------
# Enqueue Style
#-----------------------------------------------------------------
if( !function_exists('st_framework_enqueue_styles')){
	function st_framework_enqueue_styles(){
		if(!is_admin()){
		}
	}
}
add_action('wp_print_styles','st_framework_enqueue_styles');
#-----------------------------------------------------------------
# Enqueue Scripts
#-----------------------------------------------------------------
if(!function_exists('st_framework_enqueue_scripts')){
	function st_framework_enqueue_scripts(){
		if(!is_admin()){
		}
	}
}
add_action('wp_print_scripts','st_framework_enqueue_scripts');
