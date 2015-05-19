<?php
/**
 * SmoothThemes
 *
 * This is description
 *
 * @author		SmoothThemes
 * @copyright	Copyright (c) SmoothThemes
 * @link		http://www.SmoothThemes.com
 * @since		Version 1.0
 * @package 	SmoothThemes
 * @version 	1.0
*/
register_sidebar(array(
    'name' => __('Default Sidebar','smooththemes'),
    'id' => 'sidebar_default',
    'description' => 'This is default sidebar widget that will displayed on all pages.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));
register_sidebar(array(
    'name' => __('Default Course Sidebar','smooththemes'),
    'id' => 'sidebar_course',
    'description' => 'This is default course sidebar widget that will displayed on all single course.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));
register_sidebar(array(
    'name' => __('Default Event Sidebar','smooththemes'),
    'id' => 'sidebar_event',
    'description' => 'This is default event sidebar widget that will displayed on all single event.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));
if (st_is_woocommerce()) {
    register_sidebar(array(
        'name' => __('Default Product Sidebar','smooththemes'),
        'id' => 'sidebar_product',
        'description' => 'This is default event sidebar widget that will displayed on all single product.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    
    ));
}
if (st_get_setting('show_header_right_widget', 'y') == 'y') {
    register_sidebar(array(
        'name' => __('Header Right Sidebar','smooththemes'),
        'id' => 'header_right_widget',
        'description' => 'This is default sidebar widget that will displayed on all pages.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    
    ));
}
// footer_layout
function st_setup_footer_sidebar(){
    $footer_layout =  st_get_setting('footer_layout');
    if($footer_layout==''){
        $footer_layout = 3; // default 4 columns  12/3=4
    }
    $args = array(
        // 'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    );
    if(strpos($footer_layout,'-')===false){
        $footer_layout  = 12/$footer_layout;
        for($i=1; $i<= $footer_layout; $i++){
            $args['name'] =sprintf(__('Footer %d','smooththemes'), $i);
            $args['id'] = 'footer_'.$i;
            register_sidebar($args);
        }
    }else{
        $footer_layout = explode('-',$footer_layout);
        $n = count($footer_layout);
        for($i=0; $i< $n; $i++){
            $number=  $footer_layout[$i];
            $text= $i+1;
            switch(intval($number)){
                case 3:
                    $text = '1/4';
                break;
                case 4:
                    $text = '1/3';
                break;
                case 6:
                    $text = '2/4';
                break;
                case 8:
                    $text = '2/3';
                break;
                case 9:
                    $text = '3/4';
                break;
            }
            $args['name'] =sprintf(__('Footer %d (%s)','smooththemes'), ($i+1), $text);
            $args['id'] = 'footer_'.($i+1);
            register_sidebar($args);
        }
    }
}
st_setup_footer_sidebar();