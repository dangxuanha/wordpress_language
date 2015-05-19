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




if(is_admin()){
    // ajax save theme options
    add_action( 'wp_ajax_smooththemes_save_option_action', 'smooththemes_save_option_action' );
    function smooththemes_save_option_action() {
        $st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE


        if(isset($_POST['save']) && $_POST['save']=='Y'){

            $data = array();

            $count = 0;
            foreach( $_POST as $key => $arr ){
                if(strpos($key, ST_FRAMEWORK_SETTINGS_OPTION)!==false){
                    $k = str_replace(ST_FRAMEWORK_SETTINGS_OPTION.'_', '', $key);
                    $data[$k]= $arr;
                }
            }

            if(st_is_wpml()){
                // ICL_LANGUAGE_CODE
                //  echo var_dump($st_default_lang_code,ICL_LANGUAGE_CODE);
                if($st_default_lang_code==ICL_LANGUAGE_CODE || ICL_LANGUAGE_CODE=='' || strpos($st_default_lang_code,ICL_LANGUAGE_CODE)!==false){
                    // update_option(ST_FRAMEWORK_SETTINGS_OPTION,$_POST[ST_FRAMEWORK_SETTINGS_OPTION]);
                    update_option(ST_FRAMEWORK_SETTINGS_OPTION,$data);
                }
                update_option(ST_FRAMEWORK_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE, $data);
                do_action('st_save_options',$data);

            }else{
                update_option(ST_FRAMEWORK_SETTINGS_OPTION,$data);
                do_action('st_save_options', $data );
            }


            flush_rewrite_rules();
        }

        echo 1;
        die();
    }
}



if(!function_exists('st_is_page_builder_active')){
    if(!function_exists('is_plugin_active') ){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }
    function st_is_page_builder_active(){
       return is_plugin_active('stToolKit/stToolKit.php');
    }
}
if (!function_exists('st_get_normal_fonts')) {
    function st_get_normal_fonts() {
       return  array(
                    'Arial'=>'', //  array('value', font_url)
                    'Arial Black'=>'',
                    'Arial Narrow'=>'',
                    'Courier New'=>'',
                    'Georgia'=>'',
                    'Times New Roman'=>'',
                    'Trebuchet MS'=>'',
                    'Verdana'=>'',
                    'Andale Mono'=>'',
                    'Baskerville'=>'',
                    'Bookman Old Style'=>'',
                    'Calibri'=>'',
                    'Cambria'=>'',
                    'Candara'=>'',
                    'Century Gothic'=>'',
                    'Century Schoolbook'=>'',
                    'Consolas'=>'',
                    'Constantia'=>'',
                    'Corbel'=>'',
                    'Franklin Gothic'=>'',
                    'Garamond'=>'',
                    'Gill Sans'=>'',
                    'Helvetica'=>'',
                    'Hoefler'=>'',
                    'Lucida Bright'=>'',
                    'Lucida Grande'=>'',
                    'Palatino'=>'',
                    'Rockwell'=>'',
                    'Tahoma'=>''
                );
    }
}
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
/**  === DO NOT CHANGE === */
global $st_options ; // for Settings
       
       
/**
*  load options 
* @return array();  
*/   
function __st_get_options(){
    if(st_is_wpml()){
         $st_same_settings = get_option('st_same_lang_settings','y');
        // reload  options for current language
         if($st_same_settings=='y'){
            $st_options = get_option(ST_FRAMEWORK_SETTINGS_OPTION,array()); 
         }else{
            $st_options = get_option(ST_FRAMEWORK_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE,array()); 
            if(empty($st_options)){
                 $st_options = get_option(ST_FRAMEWORK_SETTINGS_OPTION,array());  // default value
            }
         }
    }else{
         // default settings
        $st_options = get_option(ST_FRAMEWORK_SETTINGS_OPTION);
    }
    
 // if is priview  and user can edit theme options
  if(isset($_POST['wp_customize']) && $_POST['wp_customize']=='on'  &&  current_user_can( 'edit_theme_options' )){
        $st_options = __st_preview_options($st_options, $_POST['customized']);
  }
  return  $st_options;
 
}   
 
 
 
function st_stripslashes($array){
    return stripslashes_deep($array);
}
/**
 * merge admin settings with preview settings
 * @return array
 */ 
function __st_preview_options($options, $preview_options){
    
    $preview_options   = (array) json_decode(stripslashes($preview_options));
    if(is_array($preview_options)){
         
        foreach($preview_options as $k => $v){
             $options[$k] = $v;
        }
       
    }
    return $options;
}
/**
 *  get settings and translate options.
 */ 
$st_options   = __st_get_options();