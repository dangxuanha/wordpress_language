<?php
/**
 * stFramework
 *
 * This is description
 *
 * @author        SmoothThemes
 * @copyright    Copyright (c) SmoothThemes
 * @link        http://www.SmoothThemes.com
 * @since        Version 1.0
 * @package    stFramework
 * @version    1.0
 */
global $wp_registered_sidebars, $predefined_colors, $color_define, $patterns_bg;
$general_tab = array();
$tpl_sidebars = array();
foreach ($wp_registered_sidebars as $k => $s) {
    $tpl_sidebars[$s['id']] = $s['name'];
}
$predefined_colors = array(
    '099ad1' => ST_FRAMEWORK_IMG . 'colors/099ad1.png',
    '37b6bd' => ST_FRAMEWORK_IMG . 'colors/37b6bd.png',
    'c71c77' => ST_FRAMEWORK_IMG . 'colors/c71c77.png',
    'ffb400' => ST_FRAMEWORK_IMG . 'colors/ffb400.png',
    '6957af' => ST_FRAMEWORK_IMG . 'colors/6957af.png',
    '74aea1' => ST_FRAMEWORK_IMG . 'colors/74aea1.png',
    '808080' => ST_FRAMEWORK_IMG . 'colors/808080.png',
    '80b500' => ST_FRAMEWORK_IMG . 'colors/80b500.png',
    'bca474' => ST_FRAMEWORK_IMG . 'colors/bca474.png',
    'c62020' => ST_FRAMEWORK_IMG . 'colors/c62020.png',
    'c71c77' => ST_FRAMEWORK_IMG . 'colors/c71c77.png'
);

$color_define = array(
    '099ad1' => ST_FRAMEWORK_IMG . 'colors/099ad1.png',
    '37b6bd' => ST_FRAMEWORK_IMG . 'colors/37b6bd.png',
    'c71c77' => ST_FRAMEWORK_IMG . 'colors/c71c77.png',
    'ffb400' => ST_FRAMEWORK_IMG . 'colors/ffb400.png',
    '6957af' => ST_FRAMEWORK_IMG . 'colors/6957af.png',
    '74aea1' => ST_FRAMEWORK_IMG . 'colors/74aea1.png',
    '808080' => ST_FRAMEWORK_IMG . 'colors/808080.png',
    '80b500' => ST_FRAMEWORK_IMG . 'colors/80b500.png',
    'bca474' => ST_FRAMEWORK_IMG . 'colors/bca474.png',
    'c62020' => ST_FRAMEWORK_IMG . 'colors/c62020.png',
    'c71c77' => ST_FRAMEWORK_IMG . 'colors/c71c77.png'
);

$patterns_bg = array(
    'pattern1.png' => ST_FRAMEWORK_IMG . 'patterns/pattern1.png',
    'pattern2.png' => ST_FRAMEWORK_IMG . 'patterns/pattern2.png',
    'pattern3.png' => ST_FRAMEWORK_IMG . 'patterns/pattern3.png',
    'pattern4.png' => ST_FRAMEWORK_IMG . 'patterns/pattern4.png',
    'pattern5.png' => ST_FRAMEWORK_IMG . 'patterns/pattern5.png',
    'pattern6.png' => ST_FRAMEWORK_IMG . 'patterns/pattern6.png',
    'pattern7.png' => ST_FRAMEWORK_IMG . 'patterns/pattern7.png',
);

$general_tab_page = array(
    array(
        'name' => 'page_mod',
        'title' => __('Boxed of Full-Width Layout', 'smooththemes'),
        'type' => 'select',
        'multiple' => false,
        'options' => array(
            'full-width' => __('Full width', 'smooththemes'),
            'boxed' => __('Boxed', 'smooththemes')
        ),
        'default' => 'right-sidebar',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'show_header_right_widget',
        'title' => __('Show Header Right Widgets', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'show_footer_widget',
        'title' => __('Show Footer Widgets', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'footer_layout',
        'title' => __('Footer Layout', 'smooththemes'),
        'type' => 'select',
        'multiple' => false,
        'options' => array(
            12 => __('1 Column', 'smooththemes'),
            6 => __('2 Columns', 'smooththemes'),
            4 => __('3 Columns', 'smooththemes'),
            3 => __('4 Columns', 'smooththemes'),
            2 => __('6 Columns', 'smooththemes'),
            '4-8' => __('Layout 1/3 + 2/3 ', 'smooththemes'),
            '8-4' => __('Layout 2/3 + 1/3 ', 'smooththemes'),
            '3-9' => __('Layout 1/4 + 3/4 ', 'smooththemes'),
            '9-3' => __('Layout 3/4 + 1/4 ', 'smooththemes'),
            '3-3-6' => __('Layout 1/4 + 1/4 + 2/4 ', 'smooththemes'),
            '6-3-3' => __('Layout 2/4 + 1/4 + 1/4 ', 'smooththemes'),
            '3-6-3' => __('Layout 1/4 + 2/4 + 1/4 ', 'smooththemes'),
        ),
        'show_when'=>'show_footer_widget',
        'show_on'=>'y',
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => '<div style="height: 150px; display: block;"></div>'
    )
);
if (st_is_page_builder_active()) {
    array_unshift($general_tab_page, array(
        'name' => 'layout',
        'title' => __('Default Layout', 'smooththemes'),
        'type' => 'select',
        'multiple' => false,
        'options' => array(
            'left-sidebar' => __('Left Sidebar', 'smooththemes'),
            'right-sidebar' => __('Right Sidebar', 'smooththemes'),
            'left-right-sidebar' => __('Left and Right Sidebar', 'smooththemes'),
            'no-sidebar' => __('No Sidebar', 'smooththemes'),
        ),
        'default' => 'left-sidebar',
        'desc' => '',
        'desc_bottom' => ''
    ),
        array(
            'name' => 'left_sidebar',
            'title' => __('Left Sidebar', 'smooththemes'),
            'type' => 'select',
            'multiple' => false,
            'options' => $tpl_sidebars,
            'show_when'=>'layout',
            'show_on' => 'left-sidebar left-right-sidebar',
            'default' => '',
            'desc' => '',
            'desc_bottom' => ''
        ),
        
        
        array(
            'name' => 'right_sidebar',
            'title' => __('Right Sidebar', 'smooththemes'),
            'type' => 'select',
            'multiple' => false,
            'options' => $tpl_sidebars,
            'show_when'=>'layout',
            'show_on' => 'right-sidebar  left-right-sidebar',
            'default' => '',
            'desc' => '',
            'desc_bottom' => ''
        )
    );
}
$general_tab_logo = array(
    array(
        'name' => 'site_logo',
        'title' => 'Site logo',
        'type' => 'upload',
        'default' => ST_FRAMEWORK_IMG . 'logo.png',
        'desc' => '',
        'desc_bottom' => 'Upload your custom logo.'
    ),
    array(
        'name' => 'site_logo_pd_top',
        'title' => 'Logo Padding top',
        'type' => 'text',
        'default' => '',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'site_logo_pd_bot',
        'title' => 'Logo padding bottom',
        'type' => 'text',
        'default' => '',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => '',
        'title' => 'Login Logo Image',
        'type' => 'heading'
    ),
    array(
        'name' => 'login_logo',
        'title' => 'Login logo',
        'type' => 'upload',
        'default' => ST_FRAMEWORK_IMG . 'logo.png',
        'desc' => '',
        'desc_bottom' => 'Upload your custom logo.'
    ),
    array(
        'name' => 'width_login_logo',
        'title' => 'Width Login logo',
        'type' => 'text',
        'default' => '',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'height_login_logo',
        'title' => 'Height Login logo',
        'type' => 'text',
        'default' => '',
        'desc' => '',
        'desc_bottom' => ''
    )
);
$general_tab_favicon = array(
    array(
        'name' => 'site_favicon',
        'title' => 'Upload Favicon',
        'type' => 'upload',
        'desc' => '',
        'desc_bottom' => 'Upload your custom favicon.'
    )
);
$oe_social = array(
    array(
        'name' => 'facebook',
        'title' => __('Facebook URL', 'smooththemes'),
        'type' => 'text',
        'default' => '#',
        'desc' => '',
        'desc_bottom' => 'Enter your Facebook link'
    ),
    array(
        'name' => 'twitter',
        'title' => 'Twitter URL',
        'type' => 'text',
        'default' => '#',
        'desc' => '',
        'desc_bottom' => 'Enter your Twitter link'
    ),
    array(
        'name' => 'google_plus',
        'title' => 'Google+ URL',
        'type' => 'text',
        'default' => '#',
        'desc' => '',
        'desc_bottom' => 'Enter your Google+ link'
    )
);
if(current_theme_supports('st-titlebar')){
    $list_titlebar_bg = apply_filters('st_titlebar_list_bg',array());
    $bg_options=  array();
    foreach($list_titlebar_bg as $k => $bg){
        $bg_options[$k] = $bg['img'];
    }
    $oe_titlebar = array(
        array(
            'name' => 'titlebar_type',
            'title' => __('Background Type', 'smooththemes'),
            'type' => 'radio',
            'options' => array(
                'defined' => __('Defined background', 'smooththemes'),
                'custom' => __('Custom', 'smooththemes'),
            ),
            'default' => 'defined',
            'desc' => '',
            'desc_bottom' => ''
        ),
        array(
            'name' => 'titlebar_defined',
            'title' => __('Defined titlebar', 'smooththemes'),
            'options' => $bg_options,
            'size' => 30,
            'default' => '',
            'type' => 'layout',
            'show_when'=>'titlebar_type',
            'show_on'=>'defined',
            'desc' => '',
            'desc_bottom' => ''
        ),
        array(
            'name' => 'titlebar_bg_color',
            'title' => __('Background color', 'smooththemes'),
            'type' => 'color',
            'default' => 'CCCCCC',
            'desc' => '',
            'desc_bottom' => '',
            'show_when'=>'titlebar_type',
            'show_on'=>'custom',
        ),
        array(
            'name' => 'titlebar_bg_img',
            'title' => __('Background image', 'smooththemes'),
            'type' => 'upload',
            'default' => '',
            'desc' => '',
            'desc_bottom' => '',
            'show_when'=>'titlebar_type',
            'show_on'=>'custom',
        ),
        array(
            'name' => 'titlebar_bg_position',
            'title' => __('Background positon', 'smooththemes'),
            'type' => 'select',
            'options' => array(
                'tl' => __('Top left', 'smooththemes'),
                'tc' => __('Top center', 'smooththemes'),
                'tr' => __('Top right', 'smooththemes'),
                'cc' => __('Center', 'smooththemes'),
                'bl' => __('Bottom left', 'smooththemes'),
                'br' => __('Bottom right', 'smooththemes'),
                'bc' => __('Bottom center', 'smooththemes'),
            ),
            'default' => '',
            'desc' => '',
            'desc_bottom' => '',
            'show_when'=>'titlebar_type',
            'show_on'=>'custom',
        ),
        array(
            'name' => 'titlebar_bg_repeat',
            'title' => __('Background repeat', 'smooththemes'),
            'type' => 'select',
            'options' => array(
                'repeat' => __('Repeat', 'smooththemes'),
                'no-repeat' => __('No repeat', 'smooththemes'),
                'repeat-x' => __('Repeat X', 'smooththemes'),
                'repeat-y' => __('Repeat Y', 'smooththemes'),
                'stretch'=>__('Stretch to fit','smooththemes')
            ),
            'default' => '',
            'desc' => '',
            'desc_bottom' => '',
            'show_when'=>'titlebar_type',
            'show_on'=>'custom',
        )
    );
}
$oe_header = array(
    array(
        'name' => 'phone_number',
        'title' => __('Phone Number', 'smooththemes'),
        'type' => 'text',
        'default' => __('', 'smooththemes'),
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'hdescription',
        'title' => __('Description', 'smooththemes'),
        'type' => 'text',
        'default' => __('', 'smooththemes'),
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'hbg_type',
        'title' => __('Background Type', 'smooththemes'),
        'type' => 'radio',
        'options' => array(
            'd' => __('Defined background image', 'smooththemes'),
            'c' => __('Defined background color', 'smooththemes'),
            'custom' => __('Custom', 'smooththemes'),
        ),
        'default' => 'd',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'hdefined_bg',
        'title' => __('Defined background Image', 'smooththemes'),
        'type' => 'layout',
        'multiple' => false,
        'options' => $patterns_bg,
        'size' => 30,
        'default' => 'background1.jpg',
        'desc' => '',
        'show_when'=>'hbg_type',
        'show_on'=>'d',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'hdefined_bg_color',
        'title' => __('Defined background color', 'smooththemes'),
        'type' => 'layout',
        'multiple' => false,
        'options' => $predefined_colors,
        'size' => 30,
        'default' => 'background1.jpg',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'hbg_type',
        'show_on'=>'c',
    ),
    array(
        'title' => __('Custom Background', 'smooththemes'),
        'type' => 'heading',
        'show_when'=>'hbg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'hbg_color',
        'title' => __('Background color', 'smooththemes'),
        'type' => 'color',
        'default' => 'CCCCCC',
        'desc' => 'NOTE: background style only apply when selected Boxed layout.',
        'desc_bottom' => '',
        'show_when'=>'hbg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'hbg_img',
        'title' => __('Background image', 'smooththemes'),
        'type' => 'upload',
        'default' => '',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'hbg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'hbg_position',
        'title' => __('Background position', 'smooththemes'),
        'type' => 'select',
        'options' => array(
            'tl' => __('Top left', 'smooththemes'),
            'tc' => __('Top center', 'smooththemes'),
            'tr' => __('Top right', 'smooththemes'),
            'cc' => __('Center', 'smooththemes'),
            'bl' => __('Bottom left', 'smooththemes'),
            'br' => __('Bottom right', 'smooththemes'),
            'bc' => __('Bottom center', 'smooththemes'),
        ),
        'default' => '',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'hbg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'hbg_repeat',
        'title' => __('Background repeat', 'smooththemes'),
        'type' => 'select',
        'options' => array(
            'repeat' => __('Repeat', 'smooththemes'),
            'no-repeat' => __('No repeat', 'smooththemes'),
            'repeat-x' => __('Repeat X', 'smooththemes'),
            'repeat-y' => __('Repeat Y', 'smooththemes')
        ),
        'default' => '',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'hbg_type',
        'show_on'=>'custom',
    )
,
    array(
        'name' => 'hbg_attachment',
        'title' => __('Background attachment', 'smooththemes'),
        'type' => 'select',
        'options' => array(
            'scroll'=>__('Scroll','smooththemes'),
            'fixed'=>__('Fixed','smooththemes')
        ),
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'hbg_type',
        'show_on'=>'custom',
    )
);
$oe_single_post = array(
    array(
        'name' => 's_show_featured_img',
        'title' => __('Show Featured Image on single post', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 's_show_post_meta',
        'title' => __('Show post meta (author, date, categrories) on single post', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 's_show_post_tag',
        'title' => __('Show post tags on single post', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 's_show_author_desc',
        'title' => __('Show Author Description', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 's_show_comments',
        'title' => __('Show comments on single post', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    )
);
$oe_course = array(
    array(
        'name' => 'sc_show_featured_img',
        'title' => __('Show Featured Image on single course', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'sc_show_post_meta',
        'title' => __('Show course meta (author, date, date start) on single course', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'sc_show_author_desc',
        'title' => __('Show Author Description', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'n',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'sc_show_comments',
        'title' => __('Show comments on single course', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'n',
        'desc' => '',
        'desc_bottom' => ''
    )
);
if (st_is_page_builder_active()) {
    array_unshift($oe_course, array(
        'name' => 'layout_course',
        'title' => __('Default Layout', 'smooththemes'),
        'type' => 'select',
        'multiple' => false,
        'options' => array(
            'left-sidebar' => __('Left Sidebar', 'smooththemes'),
            'right-sidebar' => __('Right Sidebar', 'smooththemes'),
            'left-right-sidebar' => __('Left and Right Sidebar', 'smooththemes'),
            'no-sidebar' => __('No Sidebar', 'smooththemes'),
        ),
        'default' => 'left-sidebar',
        'desc' => '',
        'desc_bottom' => ''
    ),
        array(
            'name' => 'course_left_sidebar',
            'title' => __('Left Sidebar', 'smooththemes'),
            'type' => 'select',
            'multiple' => false,
            'options' => $tpl_sidebars,
            'show_when'=>'layout_course',
            'show_on' => 'left-sidebar left-right-sidebar',
            'default' => '',
            'desc' => '',
            'desc_bottom' => ''
        ),
        array(
            'name' => 'course_right_sidebar',
            'title' => __('Right Sidebar', 'smooththemes'),
            'type' => 'select',
            'multiple' => false,
            'options' => $tpl_sidebars,
            'show_when'=>'layout_course',
            'show_on' => 'right-sidebar  left-right-sidebar',
            'default' => '',
            'desc' => '',
            'desc_bottom' => ''
        )
    );
}
$oe_event = array(
    array(
        'name' => 'se_show_featured_img',
        'title' => __('Show Featured Image on single event', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'se_show_post_meta',
        'title' => __('Show event meta (author, date, date start) on single event', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'se_show_author_desc',
        'title' => __('Show Author Description', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'n',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'se_show_comments',
        'title' => __('Show comments on single event', 'smooththemes'),
        'type' => 'radio',
        'multiple' => false,
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'n',
        'desc' => '',
        'desc_bottom' => ''
    )
);
if (st_is_page_builder_active()) {
    array_unshift($oe_event, array(
        'name' => 'layout_event',
        'title' => __('Default Layout', 'smooththemes'),
        'type' => 'select',
        'multiple' => false,
        'options' => array(
            'left-sidebar' => __('Left Sidebar', 'smooththemes'),
            'right-sidebar' => __('Right Sidebar', 'smooththemes'),
            'left-right-sidebar' => __('Left and Right Sidebar', 'smooththemes'),
            'no-sidebar' => __('No Sidebar', 'smooththemes'),
        ),
        'default' => 'left-sidebar',
        'desc' => '',
        'desc_bottom' => ''
    ),
        array(
            'name' => 'event_left_sidebar',
            'title' => __('Left Sidebar', 'smooththemes'),
            'type' => 'select',
            'multiple' => false,
            'options' => $tpl_sidebars,
            'show_when'=>'layout_event',
            'show_on' => 'left-sidebar left-right-sidebar',
            'default' => '',
            'desc' => '',
            'desc_bottom' => ''
        ),
        array(
            'name' => 'event_right_sidebar',
            'title' => __('Right Sidebar', 'smooththemes'),
            'type' => 'select',
            'multiple' => false,
            'options' => $tpl_sidebars,
            'show_when'=>'layout_event',
            'show_on' => 'right-sidebar  left-right-sidebar',
            'default' => '',
            'desc' => '',
            'desc_bottom' => ''
        )
    );
}
$bg_tab = array(
    array(
        'name' => 'bg_type',
        'title' => __('Background Type', 'smooththemes'),
        'type' => 'radio',
        'options' => array(
            'd' => __('Defined background image', 'smooththemes'),
            'c' => __('Defined background color', 'smooththemes'),
            'custom' => __('Custom', 'smooththemes'),
        ),
        'default' => 'd',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'defined_bg',
        'title' => __('Defined background Image', 'smooththemes'),
        'type' => 'layout',
        'multiple' => false,
        'options' => $patterns_bg, 
        'size' => 30,
        'default' => 'background1.jpg',
        'desc' => '',
        'show_when'=>'bg_type',
        'show_on'=>'d',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'defined_bg_color',
        'title' => __('Defined background color', 'smooththemes'),
        'type' => 'layout',
        'multiple' => false,
        'options' => $predefined_colors,
        'size' => 30,
        'default' => 'background1.jpg',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'bg_type',
        'show_on'=>'c',
    ),
    array(
        'title' => __('Custom Background', 'smooththemes'),
        'type' => 'heading',
        'show_when'=>'bg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'bg_color',
        'title' => __('Background color', 'smooththemes'),
        'type' => 'color',
        'default' => 'CCCCCC',
        'desc' => 'NOTE: background style only apply when selected Boxed layout.',
        'desc_bottom' => '',
        'show_when'=>'bg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'bg_img',
        'title' => __('Background image', 'smooththemes'),
        'type' => 'upload',
        'default' => '',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'bg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'bg_position',
        'title' => __('Background position', 'smooththemes'),
        'type' => 'select',
        'options' => array(
            'tl' => __('Top left', 'smooththemes'),
            'tc' => __('Top center', 'smooththemes'),
            'tr' => __('Top right', 'smooththemes'),
            'cc' => __('Center', 'smooththemes'),
            'bl' => __('Bottom left', 'smooththemes'),
            'br' => __('Bottom right', 'smooththemes'),
            'bc' => __('Bottom center', 'smooththemes'),
        ),
        'default' => '',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'bg_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'bg_repeat',
        'title' => __('Background repeat', 'smooththemes'),
        'type' => 'select',
        'options' => array(
            'repeat' => __('Repeat', 'smooththemes'),
            'no-repeat' => __('No repeat', 'smooththemes'),
            'repeat-x' => __('Repeat X', 'smooththemes'),
            'repeat-y' => __('Repeat Y', 'smooththemes')
        ),
        'default' => '',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'bg_type',
        'show_on'=>'custom',
    )
,
    array(
        'name' => 'bg_attachment',
        'title' => __('Background attachment', 'smooththemes'),
        'type' => 'select',
        'options' => array(
            'scroll'=>__('Scroll','smooththemes'),
            'fixed'=>__('Fixed','smooththemes')
        ),
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'bg_type',
        'show_on'=>'custom',
    ),
);
$skins = array(
    array(
        'name' => 'skin_type',
        'title' => __('Skin Type', 'smooththemes'),
        'type' => 'radio',
        'options' => array(
            'c' => __('Defined color', 'smooththemes'),
            'custom' => __('Custom', 'smooththemes'),
        ),
        'default' => 'c',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'custom_global_skin',
        'title' => __('Defined  Skin', 'smooththemes'),
        'type' => 'layout',
        'multiple' => false,
        'options' => $color_define,
        'size' => 30,
        'default' => '099ad1',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'skin_type',
        'show_on'=>'c',
    ),
    
    
    array(
        'name' => 'skin_color',
        'title' => __('Background color', 'smooththemes'),
        'type' => 'color',
        'default' => '099ad1',
        'desc' => '',
        'desc_bottom' => '',
        'show_when'=>'skin_type',
        'show_on'=>'custom',
    ),
    array(
        'name' => 'link',
        'title' => __('Link color', 'smooththemes'),
        'type' => 'color',
        'default' => '',
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'link_hover',
        'title' => __('Link hover color', 'smooththemes'),
        'type' => 'color',
        'default' => '',
        'desc' => '',
        'desc_bottom' => ''
    )
);
// Font Style Tabs
$font_body = array(
    array(
        'name' => 'body_font',
        'title' => __('Body Font', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
                        sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker 
                        including versions of Lorem Ipsum.',
        'options' => array(
            'font-family' => 'Droid Sans',
            'color' => '000000',
            'font-weight' => 'normal',
            'font-style' => 'nomal',
            'line-height' => '18', // unit px
            'line-height-unit' => 'px',
            'font-size' => '12',
            'font-size-unit' => 'px',
            'letter-spacing' => '0',
            'letter-spacing-uni' => 'px'
        ),
        'desc' => __('', 'smooththemes'),
        'desc_bottom' => ''
    ),
);
$font_heading = array(
    array(
        'name' => 'headings_font',
        'title' => __('Heading Font', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => '<div style="font-size: 24px; line-height: 30px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>',
        'options' => array(
            'font-family' => 'Droid Sans'
        ),
        'support' => array('font_family'),
        'desc' => '',
        'desc_bottom' => ''
    ),
    array(
        'name' => 'heading_1',
        'title' => __('H1', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'support' => array('font_size'),
        'options' => array(
            'font-size' => '34'
        ),
        'desc_bottom' => ''
    ),
    array(
        'name' => 'heading_2',
        'title' => __('H2', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'support' => array('font_size'),
        'options' => array(
            'font-size' => '34'
        ),
        'desc_bottom' => ''
    ),
    array(
        'name' => 'heading_3',
        'title' => __('H3', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'support' => array('font_size'),
        'options' => array(
            'font-size' => '34'
        ),
        'desc_bottom' => ''
    ),
    array(
        'name' => 'heading_4',
        'title' => __('H4', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'support' => array('font_size'),
        'options' => array(
            'font-size' => '34'
        ),
        'desc_bottom' => ''
    ),
    array(
        'name' => 'heading_5',
        'title' => __('H5', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'support' => array('font_size'),
        'options' => array(
            'font-size' => '34'
        ),
        'desc_bottom' => ''
    ),
    array(
        'name' => 'heading_6',
        'title' => __('H6', 'smooththemes'),
        'type' => 'style',
        'function' => 'st_settings_fonts',
        'default' => '',
        'previetxt' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'support' => array('font_size'),
        'options' => array(
            'font-size' => '34'
        ),
        'desc_bottom' => ''
    ),
);
global $st_hooks;
$ads_tab = array(
    array(
        'name' => 'ads',
        'title' => 'Site Ads Management',
        'type' => 'ui',
        'default' => '',
        'support' => array('title', 'content', 'hook'),
        'hooks' => $st_hooks,
        'desc' => '',
        'desc_bottom' => ''
    )
);
$tracking_code = array(
    array(
        'name' => 'headder_tracking_code',
        'type' => 'textarea',
        'title' => __('Header tracking code', 'smooththemes'),
        'default' => ''
    ),
    array(
        'name' => 'footer_tracking_code',
        'type' => 'textarea',
        'title' => __('Footer tracking code', 'smooththemes'),
        'default' => ''
    ),
);
$st_framework = array(
    array(
        'name' => 'st_framework',
        'type' => 'radio',
        'title' => __('Show Admin Options Header', 'smooththemes'),
        'options' => array('y' => __('Yes', 'smooththemes'), 'n' => __('No', 'smooththemes')),
        'default' => 'y'
    )
);
// ========================== Setup Load Panel ========================== \\
$tabs_settings = new Smooththemes_Tabs_Settings();
// General Setting
$tabs_settings->add_tab('general', __('General Setings', 'smooththemes'), $general_tab, 'icon-cog');
$tabs_settings->add_tab('general_page', __('Page Settings', 'smooththemes'), $general_tab_page, 'icon-caret-right', 'general');
$tabs_settings->add_tab('general_logo', __('Logo', 'smooththemes'), $general_tab_logo, 'icon-caret-right', 'general');
$tabs_settings->add_tab('general_favicon', __('Favicon', 'smooththemes'), $general_tab_favicon, 'icon-caret-right', 'general');
// Font Style Setting
$tabs_settings->add_tab('fonts', __('Font Style', 'smooththemes'), '', 'icon-font');
$tabs_settings->add_tab('fonts_body', __('Body Font', 'smooththemes'), $font_body, 'icon-caret-right', 'fonts');
$tabs_settings->add_tab('fonts_heading', __('Heading Font', 'smooththemes'), $font_heading, 'icon-caret-right', 'fonts');
// Color Setting
$tabs_settings->add_tab('elements_color', __('Elements Color', 'smooththemes'), '', 'icon-magic');
$tabs_settings->add_tab('site_skin', __('Skins', 'smooththemes'), $skins, 'icon-caret-right', 'elements_color');
$tabs_settings->add_tab('body_bg', __('Body Background', 'smooththemes'), $bg_tab, 'icon-caret-right', 'elements_color');
// Overall Elements
$tabs_settings->add_tab('overall_elements', __('Overall Elements', 'smooththemes'), '', 'icon-cogs');
$tabs_settings->add_tab('header_setting', __('Header', 'smooththemes'), $oe_header, 'icon-caret-right', 'overall_elements');
if(isset($oe_titlebar)){
    $tabs_settings->add_tab('titlebar', __('Titlebar', 'smooththemes'), $oe_titlebar, 'icon-caret-right', 'overall_elements');
}
$tabs_settings->add_tab('single_setting', __('Single Post Elements', 'smooththemes'), $oe_single_post, 'icon-caret-right', 'overall_elements');
$tabs_settings->add_tab('course_setting', __('Single Course', 'smooththemes'), $oe_course, 'icon-caret-right', 'overall_elements');
$tabs_settings->add_tab('event_setting',__('Single Event','smooththemes'),$oe_event,'icon-caret-right','overall_elements');
$tabs_settings->add_tab('social', __('Social', 'smooththemes'), $oe_social, 'icon-caret-right', 'overall_elements');
// for header and footer code
$tabs_settings->add_tab('tracking_code', __('Tracking code', 'smooththemes'), $tracking_code, 'icon-cogs');
// for
$tabs_settings->add_tab('st_framework', __('Framework Options', 'smooththemes'), $st_framework, 'icon-cogs');
function st_build_google_font_options_url($font)
{
    if (empty($font['family']) || $font['family'] == '') {
        continue;
    }
    $variants = '';
    if (isset($font['variants']) && count($font['variants'])) {
        $variants = join(',', $font['variants']);
    }
    $subsets = '';
    if (isset($font['subsets']) && count($font['subsets'])) {
        $subsets = join(',', $font['subsets']);
    }
    $url = 'http://fonts.googleapis.com/css?family=' . urlencode($font['family']);
    if ($variants != '') {
        $url .= ':' . urlencode($variants);
    }
    if ($subsets != '') {
        $url .= '&subset=' . urlencode($subsets);
    }
    return $url;
}
// Load Google Webfonts
function st_google_font_to_options()
{
    if (!function_exists('st_get_google_fonts_array')) {
        if (is_file(ST_FRAMEWORK_PHP . 'google-fonts.php')) {
            include(ST_FRAMEWORK_PHP . 'google-fonts.php');
        }
    }
    if (!function_exists('st_get_google_fonts_array')) {
        return array();
    }
    $google_fonts = st_get_google_fonts_array();
    // echo count($google_fonts);
    $font_options = array();
    foreach ($google_fonts as $k => $font) {
        if (empty($font['family']) || $font['family'] == '') {
            continue;
        }
        $font_options[$font['family']] = st_build_google_font_options_url($font);
    }
    return $font_options;
}
