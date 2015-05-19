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
function st_admin_scripts(){
    $page=isset($_REQUEST['page']) ?  $_REQUEST['page'] : '';
    if($page==ST_FRAMEWORK_PAGE_SLUG){
        st_options_admin_js();
        st_options_admin_css();
    }
    
}
   
add_action('admin_init','st_admin_scripts');
function st_options_admin_js(){
    global $ajax_nonce;
        wp_enqueue_script('jquery');
        // New in 3.5
		if(function_exists( 'wp_enqueue_media' )){
			wp_enqueue_media();
		}
        
        wp_enqueue_script('thickbox');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-slider');
        wp_enqueue_script('jquery-ui-sortable');
        
        wp_enqueue_style('thickbox');
        wp_enqueue_script('jquery-ui-datepicker');
        
        wp_deregister_script('colorpicker');
        
        
        wp_enqueue_script('dcverticalmegamenu',ST_FRAMEWORK_JS."jquery.dcverticalmegamenu.1.3.js",array('jquery'));
        wp_enqueue_script('hoverIntent',ST_FRAMEWORK_JS."/js/jquery.hoverIntent.minified.js",array('jquery'));
        
     
        wp_enqueue_script('colorpicker',ST_FRAMEWORK_JS."colorpicker/js/colorpicker.js",array('jquery'));
        wp_enqueue_script('eye',ST_FRAMEWORK_JS."colorpicker/js/eye.js",array('jquery','colorpicker'));
        wp_enqueue_script('utilsa',ST_FRAMEWORK_JS."colorpicker/js/utils.js",array('jquery','colorpicker'));
        
        // for buttons // select
        wp_enqueue_script('chosen.jquery',ST_FRAMEWORK_JS."chosen.jquery.min.js",array('jquery'));
        wp_enqueue_script('sa-chosen',ST_FRAMEWORK_JS."sa-chosen.js",array('jquery','chosen.jquery'));
        
        wp_enqueue_script('ibutton',ST_FRAMEWORK_JS."ibutton.js",array('jquery'));
        wp_enqueue_script('easing',ST_FRAMEWORK_JS."easing.js",array('jquery'));
        wp_enqueue_script('easing',ST_FRAMEWORK_JS."metadata.js",array('jquery'));
        
        wp_enqueue_script(ST_FRAMEWORK_PAGE_SLUG.'-js',ST_FRAMEWORK_JS."admin-js.js",array('jquery','media-upload','colorpicker'));
        
        wp_localize_script(ST_FRAMEWORK_PAGE_SLUG.'-js','STpanel_options',array(
            'view_full_image'=> __('View full image','smooththemes'),
            'remove'=>__('Remove','smooththemes'),
            'seletc_image'=>__('Seletc Image','smooththemes'),
            'ajax_nonce'=>$ajax_nonce,
            'uploadID'=>''
        ));
}
function st_options_admin_css(){ 
    
        wp_enqueue_style(ST_FRAMEWORK_PAGE_SLUG.'-css',ST_FRAMEWORK_CSS."smoothness/jquery-ui-1.7.3.custom.css");
        wp_enqueue_style(ST_FRAMEWORK_PAGE_SLUG.'-jquery-ui',ST_FRAMEWORK_CSS."admin-style.css");
        wp_enqueue_style(ST_FRAMEWORK_PAGE_SLUG.'-font-awesome',ST_FRAMEWORK_CSS."font-awesome.min.css");
        wp_enqueue_style(ST_FRAMEWORK_PAGE_SLUG.'-colorpicker-css',ST_FRAMEWORK_JS."colorpicker/css/colorpicker.css");
        wp_enqueue_style(ST_FRAMEWORK_PAGE_SLUG.'-colorpicker-layout-css',ST_FRAMEWORK_JS."colorpicker/css/layout.css");
    
}
    
 
add_action("admin_print_scripts-toplevel_page_st-framework","st_options_admin_js");
add_action("admin_print_styles-toplevel_page_st-framework","st_options_admin_css");
/**
 * Call Date Picker
 */
add_action('admin_print_scripts-post-new.php', 'st_print_date_picker');
add_action('admin_print_scripts-post.php', 'st_print_date_picker');
function st_print_date_picker() {
    global $post;
    if (in_array($post->post_type, array('course', 'event'))) {
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('jquery-custom-toolkit', get_template_directory_uri() . '/config-plugins/stToolKit/assets/js/custom.js', false, true);    
        wp_enqueue_style(ST_FRAMEWORK_PAGE_SLUG.'-css',ST_FRAMEWORK_CSS."smoothness/jquery-ui-1.7.3.custom.css");
    }
}