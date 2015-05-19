<?php
/**
 * Custom Builder Item Table
 */
if (!function_exists('stpb_generate_table')) {
    function stpb_generate_table($data) {
        $data_table = $data['settings']['table'];
        $count_row = count($data_table);
        $count_col = count($data_table[0]);
        $rows_setting = array();
        $cols_setting = array();
        $caption_table = (isset($data['settings']['caption']) && $data['settings']['caption'] != '') ? $data['settings']['caption'] : '';
        $display_type_table = (isset($data['settings']['display_type']) && $data['settings']['display_type'] != '') ? $data['settings']['display_type'] : '';
        $table_style_table = (isset($data['settings']['table_style']) && $data['settings']['table_style'] != '') ? $data['settings']['table_style'] : '';
        for($i=0; $i<$count_row; $i++) {
            $rows_setting[] = $data_table[$i][0];
        }
        for($i=0; $i<$count_col; $i++) {
            $cols_setting[] = $data_table[0][$i];
        }
        $table_setting = array(
            'table_style'    => $table_style_table,
            'display_type'   => $display_type_table,
            'caption_table'  => $caption_table
        );
        $table_setting = wp_parse_args($table_setting);
        $short_code = '';
        $short_code .= '[st_table '. stpb_create_shortcode_attrs($table_setting) .']';
        for($i=1; $i<$count_row; $i++) {
            $row_setting = array(
                'row_style' => $rows_setting[$i]['row_style']
            );
            $row_setting = wp_parse_args($row_setting);
            $short_code .= '[st_row '. stpb_create_shortcode_attrs($row_setting) .']';
            for($j=1; $j<$count_col; $j++) {
                if (is_array($data_table[$i][$j])) {
                    $col_setting = array(
                        'col_style' => $cols_setting[$j]['column_style']
                    );
                    $col_setting = wp_parse_args($col_setting);
                    $short_code .= '[st_col '. stpb_create_shortcode_attrs($col_setting) .']';
                    if (isset($rows_setting[$i]['row_style']) && $rows_setting[$i]['row_style'] == 'button') {
                        if (isset($data_table[$i][$j]['button']) && trim($data_table[$i][$j]['button']) != '') {
                            $short_code .= stripslashes_deep($data_table[$i][$j]['button']);
                        }
                    } else {
                        $short_code .= balanceTags($data_table[$i][$j]['text']);
                    }
                    $short_code .= '[/st_col]';
                }
            }
            $short_code .= '[/st_row]';
        }
        $short_code .= '[/st_table]';
        $short_code = apply_filters('stpb_generate_table', $short_code, $data);
        return $short_code;
    }
}
/**
 * Start Custom Builder Item Service
 */
function stpb_generate_custom_service($data) {
    $data_settings = $data['settings'];
    $content = (isset($data_settings['autop']) && $data_settings['autop'] == 1) ? wpautop($data_settings['content']) : $data_settings['content'];
    unset($data_settings['content']);
    $short_code = ' [st_custom_service '. stpb_create_shortcode_attrs($data_settings) .'] '. $content .' [/st_custom_service] ';
    $short_code = apply_filters('stpb_generate_custom_service', $short_code, $data);
    return $short_code;
}
/**
 * Start Custom Builder Item Icons Box
 */
function stpb_generate_custom_icons_box($data) {
    $data_settings = $data['settings'];
    $items_settings = array();
    $items_settings = wp_parse_args($items_settings);
    $count_item = count($data_settings['custom_icon_list']);
    //$short_code = ' [st_icon_lists '. stpb_create_shortcode_attrs($items_settings) .'] ';
    $short_code = ' [st_custom_icon_lists number_items="'.$count_item.'"] ';
    if ($count_item > 0) {
        foreach($data_settings['custom_icon_list'] as $index => $item) {
            $item_settings = array(
                'title'             => $item['title'],
                'icon'              => $item['icon'],
                'index'=>           $index,
                'color_type'        => $data_settings['color_type'],
                'color'             => $data_settings['color'],
            );
            $item_settings = wp_parse_args($item_settings);
            $short_code .= ' [st_custom_icon_list '. stpb_create_shortcode_attrs($item_settings) .']';
            if($item['content']!=''){
                $item['content'] = balanceTags($item['content']);
                $item['content'] = (isset($item['autop']) && $item['autop'] == 1) ? wpautop($item['content']) : $item['content'];
                $short_code .= do_shortcode($item['content']);
            }
            $short_code .= '[/st_custom_icon_list] ';
        }
    }
    $short_code .= ' [/st_custom_icon_lists] ';
    $short_code = apply_filters('stpb_generate_custom_icons_box', $short_code, $data);
    return ($count_item > 0) ? $short_code : '';
}
/**
 * Start Custom Builder Item Icons Link
 */
function stpb_generate_custom_icons_link($data) {
    $data_settings = $data['settings'];
    $items_settings = array();
    $items_settings = wp_parse_args($items_settings);
    $count_item = count($data_settings['custom_icons_link']);
    $per_row = $data_settings['per_row'];
    //$short_code = ' [st_icon_lists '. stpb_create_shortcode_attrs($items_settings) .'] ';
    $short_code = ' [st_icons_links number_items="'.$count_item.'" per_row="'. $per_row .'"] ';
    if ($count_item > 0) {
        foreach($data_settings['custom_icons_link'] as $index => $item) {
            $link  = (array) json_decode(stripslashes_deep($item['link']));
            
            $item_settings = array(
                'title'             => $item['title'],
                'icon'              => $item['icon'],
                'index'             => $index
            );
    
            $item_settings = array_merge($link, $item_settings);
            
            $item_settings = wp_parse_args($item_settings);
            $short_code .= ' [st_icons_link '. stpb_create_shortcode_attrs($item_settings) .']';
            if($item['content']!=''){
                $item['content'] = balanceTags($item['content']);
                $item['content'] = (isset($item['autop']) && $item['autop'] == 1) ? wpautop($item['content']) : $item['content'];
                $short_code .= do_shortcode($item['content']);
            }
            $short_code .= '[/st_icons_link] ';
        }
    }
    $short_code .= ' [/st_icons_links] ';
    $short_code = apply_filters('stpb_generate_custom_icons_link', $short_code, $data);
    return ($count_item > 0) ? $short_code : '';
}
/**
 * Start Custom Builder Item Lessons
 */
function stpb_generate_custom_lessons($data) {
    $data_settings = $data['settings'];
    $content = (isset($data_settings['autop']) && $data_settings['autop'] == 1) ? wpautop($data_settings['content']) : $data_settings['content'];
    unset($data_settings['content']);
    $short_code = ' [st_lessons '. stpb_create_shortcode_attrs($data_settings) .'] '. $content .' [/st_lessons] ';
    $short_code = apply_filters('stpb_generate_custom_service', $short_code, $data);
    return $short_code;
}
/**
 * Custom Page Builder Item Course
 */
function stpb_generate_custom_course($data) {
    $data_settings = $data['settings'];
    $short_code = ' [st_course '. stpb_create_shortcode_attrs($data_settings) .'] ';
    $short_code = apply_filters('stpb_generate_custom_course', $short_code, $data);
    return $short_code;
}
/**
 * Custom Page Builder Item Event
 */
function stpb_generate_custom_event($data) {
    $data_settings = $data['settings'];
    $short_code = ' [st_event '. stpb_create_shortcode_attrs($data_settings) .'] ';
    $short_code = apply_filters('stpb_generate_custom_event', $short_code, $data);
    return $short_code;
}
/**
 * Start Custom Builder Item Image
 */
function stpb_generate_custom_image($data) {
    $data_settings = $data['settings'];
    $data_settings = wp_parse_args($data_settings);
    $short_code = ' [st_custom_image '. stpb_create_shortcode_attrs($data_settings) .'] ';
    $short_code = apply_filters('stpb_generate_custom_image', $short_code, $data);
    return $short_code;
}
/**
 * Custom Builder Item Staff
 */
function stpb_generate_custom_staff($data) {
    $data_settings = $data['settings'];
    $items_settings = array(
        'link_target'   => $data_settings['link_target'],
        'num_cols'      => $data_settings['num_cols'],
        'container_show'  => $data_settings['container_show']
    );
    $items_settings = wp_parse_args($items_settings);
    $count_item = count($data_settings['staff']);
    $short_code = ' [st_staffs number_items="'.$count_item.'" '. stpb_create_shortcode_attrs($items_settings) .'] ';
    if ($count_item > 0) {
        foreach($data_settings['staff'] as $index => $item) {
            $item_settings = array(
                'title'             => $item['title'],
                'image_id'          => $item['image_id'],
                'caption'           => $item['caption'],
                'link'              => $item['link'],
                'phone'             => $item['phone'],
                'email'             => $item['email'],
                'skype'             => $item['skype'],
                'linkedin'          => $item['linkedin'],
                'index'             => $index
            );
            $item_settings = wp_parse_args($item_settings);
            $short_code .= ' [st_staff '. stpb_create_shortcode_attrs($item_settings) .'] ';
            $item['content'] = balanceTags($item['content']);
            $item['content'] = (isset($item['autop']) && $item['autop'] == 1) ? wpautop($item['content']) : $item['content'];
            $short_code .= do_shortcode($item['content']);
            $short_code .= ' [/st_staff] ';
        }
    }
    $short_code .= ' [/st_staffs] ';
    $short_code = apply_filters('stpb_generate_custom_staff', $short_code, $data);
    return ($count_item > 0) ? $short_code : '';
}
