<?php

function edu_register_post_types(){

    $course_slug = trim(st_get_setting('post_course')) !='' ? trim(st_get_setting('post_course')) : 'course'  ;
    register_post_type('course',array(
            'label'=>_x('Course','smooththemes'),
            'labels'=>array(
                'singular_name'=>_x('Course','smooththemes'),
                'menu_name'=>_x('Course','smooththemes'),
                'all_items'=>_x('All Course','smooththemes'),
                'add_new'=>_x('Add Course','smooththemes'),
                'add_new_item'=>_x('Add new Course','smooththemes'),
                'edit_item'=>_x('Edit Course','smooththemes'),
                'new_item'=>_x('New Course','smooththemes'),
                'view_item'=>_x('View Course','smooththemes'),
                'search_items'=>_x('Search Course','smooththemes'),
                'not_found'=>_x('Not found','smooththemes'),
                'not_found_in_trash'=>_x('Not found in trash','smooththemes')
            ),
            'public' => true,
            'show_ui'=>true,
            'rewrite'=> array('slug'=> $course_slug,  'with_front' => false),
            'supports'=>array( 'title','editor' ,'thumbnail','excerpt' ),
            'menu_position'=>20

    ));
    $event_slug = trim(st_get_setting('post_event')) !='' ? trim(st_get_setting('post_event')) : 'event'  ;
    register_post_type('event',array(
            'label'=>_x('Event','smooththemes'),
            'labels'=>array(
                'singular_name'=>_x('Event','smooththemes'),
                'menu_name'=>_x('Event','smooththemes'),
                'all_items'=>_x('All Event','smooththemes'),
                'add_new'=>_x('Add Event','smooththemes'),
                'add_new_item'=>_x('Add new Event','smooththemes'),
                'edit_item'=>_x('Edit Event','smooththemes'),
                'new_item'=>_x('New Event','smooththemes'),
                'view_item'=>_x('View Event','smooththemes'),
                'search_items'=>_x('Search Event','smooththemes'),
                'not_found'=>_x('Not found','smooththemes'),
                'not_found_in_trash'=>_x('Not found in trash','smooththemes')
            ),
            'public' => true,
            'show_ui'=>true,
            'rewrite'=> array('slug'=> $event_slug,  'with_front' => false),
            'supports'=>array( 'title','editor' ,'thumbnail','excerpt' ),
            'menu_position'=>20

    ));

}

add_action('init','edu_register_post_types');

// register_cuztom_taxonomy

function edu_register_taxonomies(){

    register_taxonomy('course_category','course',array(
        'labels' =>array(
            'name'=>__('Course Categories','smooththemes'),
            'menu_name'=>__('Categories','smooththemes'),
            'singular_name'=>__('Course Category','smooththemes'),
            'all_items'=>__('All Course Categories','smooththemes'),
            'edit_item'=>__('Edit Course Category','smooththemes'),
            'update_item'=>__('Edit Course Category','smooththemes'),

            'add_new_item'=>__('New Course Category','smooththemes'),

            'new_item_name'=>__('New Course Category Name','smooththemes'),

            'search_items'=>__('Search Course Categories','smooththemes'),

            'popular_items'=>__('Popular Course Categories','smooththemes')

        ),
        'show_tagcloud'=> false,
        'show_ui'=>true,
        'hierarchical'=>true
    ));

}

add_action('init','edu_register_taxonomies');
/// ===================

function edu_manage_post_type_columns($column_name, $id) {
    global $wpdb;

    switch ($column_name) {

        case 'course_category':
            echo get_the_term_list( $id, 'course_category', '', ', ', '' );
            break;
        default:

            break;
    } // end switch
}



function edu_add_new_post_type_columns($columns) {

    $new_cols = array();
    $i=1;
    $insert_index = 3;
    foreach($columns as $k => $col){
        if($i==$insert_index){
            $new_cols['course_category'] = __('Categories','smooththemes');
        }
        $new_cols[$k] = $col;
        $i++;
    }

    return $new_cols;
}
// Add to admin_init function



function edu_show_post_type_thumb_support(){
    foreach( apply_filters('edu_show_post_type_thumb_col', array('course') ) as $k=> $v ){
        add_action('manage_'.$v.'_posts_custom_column', 'edu_manage_post_type_columns', 10, 2);
        add_filter('manage_edit-'.$v.'_columns', 'edu_add_new_post_type_columns',10);
    }

}

add_action('init', 'edu_show_post_type_thumb_support');


