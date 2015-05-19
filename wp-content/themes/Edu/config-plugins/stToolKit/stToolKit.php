<?php
function st_add_pagebuilder_support($screens){
    $screens[] ='course'; // for course
    return $screens;
}
add_filter('st_page_builder_support','st_add_pagebuilder_support');
require_once('custom-builder-items.php');
require_once('custom-builder-items-functions.php');
require_once('custom-builder-generate-items-functions.php');
require_once('custom-shortcode.php');

function stpb_input_course_categories($name='', $save_value='', $taxonomy = 'course_category'){
    if(!is_array($save_value)){
        $save_value = (array) $save_value;
    }
    if($taxonomy ==''){
        $taxonomy = 'course_category';
    }
    $select = wp_dropdown_categories('id=&show_count=1&taxonomy='.$taxonomy.'&orderby=name&echo=0&class=js-multiple+lb-chzn-select&hierarchical=1');
    $select = preg_replace("#<select([^>]*)>#", "<select$1   multiple=\"multiple\" selected-ids=\"".join(',',$save_value)."\"  data-name=\"{$name}[]\">", $select);
    echo $select;
}