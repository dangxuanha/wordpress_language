<?php
function st_custom_pagebuilder_items($items){
    // remove item text
    $unset_array = array(
        'stpb_service', 'stpb_image', 'stpb_team_member'
    );
    foreach($unset_array as $item) {
        unset($items[$item]);    
    }
    // this function must return
    // add new items
    $items['stpb_custom_service'] = array(
        'title' => __('Service Box','smooththemes'),
        'tooltip'=>__('Add Service block','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_service.png",
        'generate_func' => 'stpb_generate_custom_service',
        'preview'=>false
    );
    
    $items['stpb_custom_icons_box'] = array(
        'title' => __('Icons List Box','smooththemes'),
        'tooltip'=>__('Add Icons block','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_list.png",
        'generate_func' => 'stpb_generate_custom_icons_box',
        'preview'=>false
    );
    
    $items['stpb_custom_icons_link'] = array(
        'title' => __('Icons Link','smooththemes'),
        'tooltip'=>__('Add Icons block','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_list.png",
        'generate_func' => 'stpb_generate_custom_icons_link',
        'preview'=>false
    );
    
    $items['stpb_custom_lessons'] = array(
        'title' => __('Lessons Box','smooththemes'),
        'tooltip'=>__('Add Lessons block','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_service.png",
        'generate_func' => 'stpb_generate_custom_lessons',
        'preview'=>false
    );
    
    $items['stpb_custom_course'] = array(
        'title' => __('Course Box','smooththemes'),
        'tooltip'=>__('Course block','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_service.png",
        'generate_func' => 'stpb_generate_custom_course',
        'preview'=>false
    );
    
    $items['stpb_custom_event'] = array(
        'title' => __('Event Box','smooththemes'),
        'tooltip'=>__('Event block','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_service.png",
        'generate_func' => 'stpb_generate_custom_event',
        'preview'=>false
    );
    
    $items['stpb_custom_image'] = array(
        'title' => __('Image','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_image.png",
        'tab'=>'media',
        'tooltip'=>__('Add a Image','smooththemes'),
        'generate_func' => 'stpb_generate_custom_image',
        'preview'=>true
    );
    
    $items['stpb_custom_staff'] = array(
        'title' => __('Staff','smooththemes') ,
        'tooltip'=>__('Add Staff block','smooththemes'),
        'icon'=>ST_PAGEBUILDER_URL."assets/images/builder_client.png",
        'generate_func' => 'stpb_generate_custom_staff'
    );
    
    return $items;
}
add_filter('stpb_list_items','st_custom_pagebuilder_items');
