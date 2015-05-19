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
add_action('admin_menu','st_framework_add_admin_menu');
function st_framework_add_admin_menu() {
    $icon = ST_FRAMEWORK_IMG .'st_icon.png';
    $parent_title =  defined('ST_THEME_NAME') ?  ST_THEME_NAME: __('Theme Options','smooththemes');
    add_menu_page(apply_filters('st_admin_menu_page_title',$parent_title),apply_filters('st_admin_menu_title',$parent_title),'manage_options',ST_FRAMEWORK_PAGE_SLUG,'st_framework_admin_display','',61);
    add_submenu_page( ST_FRAMEWORK_PAGE_SLUG, apply_filters('st_settings_page_title',__('Theme Options','smooththemes')), apply_filters('st_settings_menu_title',__('Theme Options')), 'manage_options', ST_FRAMEWORK_PAGE_SLUG, 'st_framework_admin_display' );
    add_submenu_page( ST_FRAMEWORK_PAGE_SLUG,'st Custom CSS', 'Custom CSS', 'manage_options', 'st-framework-css-editor', 'st_css_display' );
}
// Function callback for add_menu_page
function st_framework_admin_display() {
    // $s =  microtime();
    include(ST_FRAMEWORK_PHP.'options-interface.php');
    //echo  microtime()-$s;
}
function st_css_display(){
    $msg= '';
    if(isset($_POST['st_css'])){
        update_option('_st_custom_css',$_POST['st_css']);
         $msg = '<div class="updated below-h2" id="message"><p>You submit saved.</p></div>';
    }
    
    ?>
     <link rel="stylesheet" href="<?php echo ST_FRAMEWORK_JS; ?>custom-css/codemirror.css">
     <script src="<?php echo ST_FRAMEWORK_JS; ?>custom-css/codemirror.js"></script>
     <script src="<?php echo ST_FRAMEWORK_JS; ?>custom-css/css.js"></script>
     <style type="text/css">
        .CodeMirror {
        border: 1px solid #ccc;
        height: auto;
        
      }
      .CodeMirror-scroll {
        overflow-y: hidden;
        overflow-x: auto;
        min-height: 200px;
      }
      
      .CodeMirror-lines {}
      .CodeMirror-gutters{
        background: #F7F7F7;
        min-height: 200px;
      }
    </style>
    <div class="wrap">
    <div class="icon32" id="icon-themes"><br/></div>
    <h2><?php _e('Custom CSS', 'smooththemes'); ?></h2>
    <?php echo $msg; ?>
    <div class="st-css" style="margin-top: 20px;">
        <form method="post" class="css-editor-fom">
        <textarea id="st_css" name="st_css"><?php echo esc_attr(stripcslashes(get_option('_st_custom_css'))); ?></textarea>
         <p><input type="submit" value="Save Changes" class="button-primary" /></p>
        </form>
    </div>
    </div>
    <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("st_css"), {
            lineNumbers: true,
            firstLineNumber: 1, mode: 'css',
            viewportMargin: Infinity,
            fixedGutter: true
        });
    </script>
    <?php
}
/** 
add css code to header 
 */
 function st_css_add_header(){
     $css_code = stripcslashes(get_option('_st_custom_css'));
     if($css_code!=''){
         echo "\n<!--  ST CSS EDITOR -->\n".' <style type="text/css">'."\n";
          echo $css_code;
         echo "\n".'</style>',"\n";
     }
 }
add_action('wp_head','st_css_add_header', 99);