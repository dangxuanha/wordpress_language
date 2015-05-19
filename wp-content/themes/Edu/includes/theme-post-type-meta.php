<?php
/** 
 * Add to data into post meta
 */
add_action('st_save_page_options', 'st_custom_save_page_options', 10, 3);
function st_custom_save_page_options($post_id, $data, $option_name) {
    global $post;
    if (in_array($post->post_type, array('course', 'event'))) {
        $arr_data = maybe_unserialize(base64_decode($data));
        if (isset($arr_data['date_start'])) {
             update_post_meta($post_id, '_date_start', strtotime($arr_data['date_start']));
        }
    }
}
/**
 * Post Type Event
 */
if(!function_exists('st_event_get_date')){
    function  st_event_get_date($array_date ){
        $date ='';
        $now = current_time('timestamp');
        
        if(isset($array_date['date']) && !empty($array_date['date'])){
            if(preg_match('/^[\d]{4}-[\d]{1,2}-[\d]{1,2}$/',$array_date['date'])){
                
                $date = $array_date['date'];
                
                // check hour
                if( 
                
                 (isset($array_date['h']) ||  !empty($array_date['h']) ) 
                 &&  preg_match('/^[\d]{1,2}$/',$array_date['h'] ) 
                 && ( intval($array_date['h']) >=0 && intval($array_date['m']) <=24   ) 
                
                ){
                     $date .=' '.$array_date['h'];
                }else{
                     $date .=' 00';
                }
                
                // check minute
                if( (isset($array_date['m']) ||  !empty($array_date['m']) )  
                    &&  preg_match('/^[\d]{1,2}$/',$array_date['m']  
                    && ( intval($array_date['m']) >=0 && intval($array_date['m']) <=60   ) 
                    ) ){
                     $date .=':'.$array_date['m'];
                }else{
                     $date .=':00';
                }
                
                $date.=':'.date('00');
                
            }
  
        }
        
        return $date;
    }
    
}
/* Define the custom box */
add_action( 'add_meta_boxes', 'st_add_event_settings_box' );
/* Adds a box to the main column on the Post and Page edit screens */
function st_add_event_settings_box() {
    $screens = array('event');
    foreach ($screens as $screen) {
        add_meta_box(
            'st_event_box_id',
            __( 'Event Settings', 'smooththemes' ),
            'st_event_settings_box_content',
            $screen,'side','core'
        );
    }
}
function st_event_settings_box_content(){
    global $post ;
    $name =  ST_Page_Builder::PAGE_OPTIONS_NAME;
    $save_values = ST_Page_Builder::get_page_options($post->ID, array());
    wp_nonce_field(st_create_nonce(), 'stPageBuilder_nonce');
    ?>
    
    <div class="st-page-options stpb-lb-content-settings">
        <?php do_action('st_course_options_before_settings',$name,$save_values); ?>
        
        <div class="item st-option-item" show-on="r">
            <div class="left width-50">
                <?php stpb_input_text($name.'[date_start]',$save_values['date_start'], 'st_datepicker', true); ?>
            </div>
            <div class="right width-50">
                <strong><?php _e('Start Date','smooththemes');  ?></strong>
                <span><?php _e('Start Date.','smooththemes');  ?></span>
            </div>
        </div>
        
        <div class="item st-option-item" show-on="r">
            <div class="left width-50">
                <?php stpb_input_textarea($name.'[caption_featured_image]',$save_values['caption_featured_image'], '', true, true); ?>
            </div>
            <div class="right width-50">
                <strong><?php _e('Caption Featured Image','smooththemes');  ?></strong>
                <span><?php _e('Caption Featured Image.','smooththemes');  ?></span>
            </div>
        </div>
        <?php do_action('st_course_options_more_settings',$name,$save_values); ?>
    </div>
<?php
}
/**
 * Post Type Course
 */
/* Define the custom box */
add_action( 'add_meta_boxes', 'st_add_course_settings_box' );
//add_action( 'save_post', 'st_course_save_postdata' );
/* Adds a box to the main column on the Post and Page edit screens */
function st_add_course_settings_box() {
    $screens = array('course');
    foreach ($screens as $screen) {
        add_meta_box(
            'st_course_box_id',
            __( 'Course Settings', 'smooththemes' ),
            'st_course_settings_box_content',
            $screen,'side','core'
        );
    }
}
function st_course_settings_box_content(){
    global $post ;
    $name =  ST_Page_Builder::PAGE_OPTIONS_NAME;
    $save_values = ST_Page_Builder::get_page_options($post->ID, array());
    wp_nonce_field(st_create_nonce(), 'stPageBuilder_nonce');
    ?>
    
    <div class="st-page-options stpb-lb-content-settings">
        <?php do_action('st_course_options_before_settings',$name,$save_values); ?>
        
        <div class="item st-option-item" show-on="r">
            <div class="left width-50">
                <?php stpb_input_text($name.'[date_start]',$save_values['date_start'], 'st_datepicker', true); ?>
            </div>
            <div class="right width-50">
                <strong><?php _e('Date Start','smooththemes');  ?></strong>
                <span><?php _e('Date Start.','smooththemes');  ?></span>
            </div>
        </div>
        <div class="item st-option-item" show-on="r">
            <div class="left width-50">
                <?php stpb_input_text($name.'[count_lessons]',$save_values['count_lessons'], '', true); ?>
            </div>
            <div class="right width-50">
                <strong><?php _e('Count Lessons','smooththemes');  ?></strong>
                <span><?php _e('Count Lessons.','smooththemes');  ?></span>
            </div>
        </div>
        
        <div class="item st-option-item" show-on="r">
            <div class="left width-50">
                <?php stpb_input_text($name.'[level]',$save_values['level'], '', true); ?>
            </div>
            <div class="right width-50">
                <strong><?php _e('Level','smooththemes');  ?></strong>
                <span><?php _e('Level.','smooththemes');  ?></span>
            </div>
        </div>
        
        <div class="item st-option-item" show-on="r">
            <div class="left width-50">
                <?php stpb_input_text($name.'[type]',$save_values['type'], '', true); ?>
            </div>
            <div class="right width-50">
                <strong><?php _e('Type','smooththemes');  ?></strong>
                <span><?php _e('Type.','smooththemes');  ?></span>
            </div>
        </div>
        
        <div class="item st-option-item" show-on="r">
            <div class="left width-50">
                <?php stpb_input_textarea($name.'[caption_featured_image]',$save_values['caption_featured_image'], '', true, true); ?>
            </div>
            <div class="right width-50">
                <strong><?php _e('Caption Featured Image','smooththemes');  ?></strong>
                <span><?php _e('Caption Featured Image.','smooththemes');  ?></span>
            </div>
        </div>
        <?php do_action('st_course_options_more_settings',$name,$save_values); ?>
    </div>
<?php
}
