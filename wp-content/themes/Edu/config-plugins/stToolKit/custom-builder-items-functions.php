<?php
/**
 * Custom Builder Item Table
 */
if (!function_exists('stpb_table')) {
    function stpb_table($pre_name ='', $data_values=  array(), $post= false, $no_value = false, $interface= false){
        ?>
        <div class="item">
            <?php stpb_input_table($pre_name, $data_values); ?>
        </div>
        
        <div class="item">
            <div class="left width-50">
                <?php  stpb_input_select_one($pre_name.'[table_style]',$data_values['table_style'], array(
                    'table-default'=>__('Default','smooththemes'),
                    'table-striped'=>__('Striped rows','smooththemes'),
                    'table-bordered'=>__('Bordered table','smooththemes'),
                    'table-striped table-bordered'=>__('Striped rows & Bordered table','smooththemes'),
                    'table-hover'=>__('Hover rows','smooththemes'),
                    'table-hover table-bordered'=>__('Hover rows & Bordered table','smooththemes'),
                ),''); ?>
            </div>
            <div class="right  width-50">
                <strong><?php _e('Table Purpose','smooththemes') ?></strong>
                <span><?php _e('Choose if the table should be used to display tabular data or to display pricing options. (Difference: Pricing tables are flashier and try to stand out).','smooththemes'); ?></span>
            </div>
        </div>
    
        <div class="item">
            <div class="left width-50">
                <?php  stpb_input_select_one($pre_name.'[display_type]',$data_values['display_type'], array(
                    'pricing'=>__('Use the table as a Pricing Table','smooththemes'),
                    'tabular'=>__('Use the table to display tabular data','smooththemes'),
                ),'.table-tabular'); ?>
            </div>
            <div class="right  width-50">
                <strong><?php _e('Table Purpose','smooththemes') ?></strong>
                <span><?php _e('Choose if the table should be used to display tabular data or to display pricing options. (Difference: Pricing tables are flashier and try to stand out).','smooththemes'); ?></span>
            </div>
        </div>
    
    
        <div class="item show-on-select-change table-tabular" show-on="tabular" >
            <div class="left width-50">
                <?php  stpb_input_textarea($pre_name.'[caption]',$data_values['caption']); ?>
            </div>
            <div class="right  width-50">
                <strong><?php _e('Table Caption','smooththemes') ?></strong>
                <span><?php _e('Add a short caption to the table so visitors know what the data is about','smooththemes'); ?></span>
            </div>
        </div>
    
    <?php
    }
}
/**
 * Start Custom Builder Item Service
 */
function stpb_custom_service($pre_name ='', $data_values=  array(), $post= false, $no_value = false, $interface= false){
    ?>
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[title]',$data_values['title']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Title','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_textarea($pre_name.'[content]',$data_values['content']); ?>
            <span class="desc"><?php _e('Arbitrary text or HTML','smooththemes') ?></span>
            <p><label><?php stpb_input_checkbox($pre_name.'[autop]',$data_values['autop'],1); ?> <?php _e('Automatically add paragraphs','smooththemes') ?></label></p>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Content','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[icon_type]',$data_values['icon_type'], array(
                'no-icon'=>__('No Icon','smooththemes'),
                'icon'=>__('icon','smooththemes'),
                'image'=>__('Image','smooththemes')
            ),'.sl-sr-icontypes'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Icon Type','smooththemes') ?></strong>
            <span><?php _e('You can choose Image or Icon.','smooththemes'); ?></span>
        </div>
    </div>
    <div  class="item show-on-select-change sl-sr-icontypes" show-on="icon">
        <strong><?php _e('Icon','smooththemes') ?></strong>
        <?php  stpb_input_icon_popup($pre_name.'[icon]',$data_values['icon']); ?>
    </div>
    <div  class="item show-on-select-change sl-sr-icontypes" show-on="image">
        <div class="left width-50">
            <?php  stpb_input_media($pre_name.'[image]',$data_values['image'],'image',__('Select image','smooththemes')); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Image','smooththemes') ?></strong>
        </div>
    </div>
    <div class="item show-on-select-change sl-sr-icontypes" show-on="icon image"">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[icon_position]',$data_values['icon_position'], array(
                'top'=>__('Top','smooththemes'),
                'left'=>__('Left','smooththemes'),
                'right'=>__('Right','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Icon Position','smooththemes') ?></strong>
            <span><?php _e('Where the Icon display ?','smooththemes'); ?></span>
        </div>
    </div>
    
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[link]',$data_values['link']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Link','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[hover]',$data_values['hover'], array(
                ''=>__('None','smooththemes'),
                'green'=>__('Green','smooththemes'),
                'orange'=>__('Orange','smooththemes'),
                'red'=>__('Red','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Style Hover','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[custom_class]',$data_values['custom_class']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Custom Class','smooththemes') ?></strong>
            <span><?php _e('Custom Class','smooththemes'); ?></span>
        </div>
    </div>
    <?php
}
/**
 * Start Custom Builder Item Icons Box
 */
function  stpb_custom_icons_box($pre_name ='', $data_values=  array(), $post= false, $no_value = false, $interface= false){
    ?>
    <div class="item">
        <div class="left width-50">
            <?php
            stpb_input_ui($pre_name.'[custom_icon_list]', $data_values['custom_icon_list'], array(
                'title'=>true,
                'content'=>true,
                'image'=>false,
                'icon'=>true
            ), array(
                'title'=>__('List title:','smooththemes'),
                'icon'=>__('Icon:','smooththemes')
            ));
            ?>
        </div>
        <div class="right width-50">
            <strong><?php _e('Add/Edit List Items','smooththemes'); ?></strong>
            <span><?php _e('Here you can add, remove and edit the items of your item list.','smooththemes') ?></span>
        </div>
        <div class="item" >
            <div class="left width-50">
                <?php  stpb_input_select_one($pre_name.'[color_type]',$data_values['color_type'], array(
                    'default'=>__('Default- Inherit form theme settings','smooththemes'),
                    'custom'=>__('Custom','smooththemes'),
                ),'.icon_color_type'); ?>
            </div>
            <div class="right  width-50">
                <strong><?php _e('Icon Color','smooththemes') ?></strong>
            </div>
        </div>

        <div class="item show-on-select-change icon_color_type" show-on="custom">
            <div class="left width-50">
                <?php  stpb_input_color($pre_name.'[color]',$data_values['color']); ?>
            </div>
            <div class="right  width-50">
                <strong><?php _e('Icon Custom Color','smooththemes') ?></strong>
            </div>
        </div>
    </div>
<?php
}
/**
 * Start Custom Builder Item Icons Link
 */
function  stpb_custom_icons_link($pre_name ='', $data_values=  array(), $post= false, $no_value = false, $interface= false){
    ?>
    <div class="item">
        <div class="left width-50">
            <?php
            stpb_input_ui($pre_name.'[custom_icons_link]', $data_values['custom_icons_link'], array(
                'title'=>true,
                'content'=>false,
                'image'=>false,
                'icon'=>true
            ), array(
                'title'=>__('List title:','smooththemes'),
                'icon'=>__('Icon:','smooththemes'),
            ), array(
                array(
                    'title'=>__('Link:','smooththemes'),
                    'type'=>'link',
                    'name'=>'link'
                )
            ));
            ?>
        </div>
        <div class="right width-50">
            <strong><?php _e('Add/Edit List Items','smooththemes'); ?></strong>
            <span><?php _e('Here you can add, remove and edit the items of your item list.','smooththemes') ?></span>
        </div>
    </div>
    
    <div class="item">
        <div class="left width-50">
            <?php  
            $list = array(
                1, 2, 3, 4, 6
            );
            foreach($list as $k => $v) {
                $list[$k] = $v .__(' Col','smooththemes');
            }                
            stpb_input_select_one($pre_name.'[per_row]',$data_values['per_row'], $list); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Per Row','smooththemes') ?></strong>
            <span><?php _e('Here you can select number item per row.','smooththemes'); ?></span>
        </div>
    </div>
<?php
}
/**
 * Start Custom Builder Item Lessons
 */
function stpb_custom_lessons($pre_name ='', $data_values=  array(), $post= false, $no_value = false, $interface= false){
    ?>
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[title]',$data_values['title']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Title','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[caption]',$data_values['caption']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Caption','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_textarea($pre_name.'[content]',$data_values['content']); ?>
            <span class="desc"><?php _e('Arbitrary text or HTML','smooththemes') ?></span>
            <p><label><?php stpb_input_checkbox($pre_name.'[autop]',$data_values['autop'],1); ?> <?php _e('Automatically add paragraphs','smooththemes') ?></label></p>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Content','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[icon_type]',$data_values['icon_type'], array(
                'no-icon'=>__('No Icon','smooththemes'),
                'icon'=>__('icon','smooththemes'),
                'image'=>__('Image','smooththemes')
            ),'.sl-sr-icontypes'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Icon Type','smooththemes') ?></strong>
            <span><?php _e('You can choose Image or Icon.','smooththemes'); ?></span>
        </div>
    </div>
    <div  class="item show-on-select-change sl-sr-icontypes" show-on="icon">
        <strong><?php _e('Icon','smooththemes') ?></strong>
        <?php  stpb_input_icon_popup($pre_name.'[icon]',$data_values['icon']); ?>
    </div>
    <div  class="item show-on-select-change sl-sr-icontypes" show-on="image">
        <div class="left width-50">
            <?php  stpb_input_media($pre_name.'[image]',$data_values['image'],'image',__('Select image','smooththemes')); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Image','smooththemes') ?></strong>
        </div>
    </div>
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[duration]',$data_values['duration']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Duration','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[link_video]',$data_values['link_video']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Link Video','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    
    <div class="item" >
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[link_download]',$data_values['link_download']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Link Download','smooththemes') ?></strong>
            <span><?php _e('Enter something.','smooththemes'); ?></span>
        </div>
    </div>
    <?php
}
/**
 * Custom Page Builder Item Course
 */
function stpb_custom_course($pre_name ='', $data_values=  array(), $post= false, $no_value = false,  $interface= false){
    ?>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_course_categories($pre_name.'[cats]',$data_values['cats']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Which categories should be used for the course?','smooththemes') ?></strong>
            <span><?php _e('Which categories should be used for the course? You can select multiple categories here. The Page will then show posts from only those categories.','smooththemes'); ?></span>
        </div>
    </div>

    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[number]',$data_values['number']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Number','smooththemes') ?></strong>
            <span><?php _e('How many post you want to display ?','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php
            stpb_input_select_one($pre_name.'[display_style]',$data_values['display_style'], array(
                    'list'=>__('List','smooththemes'),
                    'gird'=>__('Grid','smooththemes'),
                )
                ,'.blog_display_style'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Display style','smooththemes') ?></strong>
            <span><?php _e('Select list or gird for list post','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item show-on-select-change blog_display_style" show-on="gird">
        <div class="left width-50">
            <?php
            $layouts =  array();
            foreach(array(1,2,3,4) as $k){
                $layouts[$k] = sprintf(_n('%d Column','%d Columns', $k,'smooththemes'), $k);
            }
            stpb_input_select_one($pre_name.'[columns]',$data_values['columns'], $layouts); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Layout','smooththemes') ?></strong>
            <span><?php _e('Select layout for list post','smooththemes'); ?></span>
        </div>
    </div>
    
    
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[container_show]',$data_values['container_show'], array(
                'content'=>__('Default','smooththemes'),
                'menu'=>__('No boxed','smooththemes')
            ),'.sl-sr-icontypes'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Items Style','smooththemes') ?></strong>
        </div>
    </div>
    <div class="item show-on-select-change blog_display_style" show-on="list">
        <div class="left width-50">
            <?php
            stpb_input_select_one($pre_name.'[thumbnail_type]',$data_values['thumbnail_type'], array(
                    'full-width'=>__('Full with','smooththemes'),
                    'medium-left'=>__('Medium left','smooththemes'),
                    'medium-right'=>__('Medium right','smooththemes'),
                )
                ); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Thumbnail Type','smooththemes') ?></strong>
            <span><?php _e('Select thumbnail type for list post','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[exclude]',$data_values['exclude']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Exclude','smooththemes') ?></strong>
            <span><?php _e('Define a comma-separated list of post IDs to be Exclude from the list, (example: 3,7,31 )','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[include]',$data_values['include']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Include','smooththemes') ?></strong>
            <span><?php _e('Define a comma-separated list of post IDs to be Include from the list, (example: 3,7,31 )','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[offset]',$data_values['offset']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Offset','smooththemes') ?></strong>
            <span><?php _e('The number of Posts to pass over (or displace) before collecting the set of Posts.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php
            if($data_values['excerpt_length']==='' ||  empty($data_values['excerpt_length']) || !is_numeric($data_values['excerpt_length']) ){
                $data_values['excerpt_length'] = apply_filters('stpb_bog_excerpt_length',17 );
            }else{
                $data_values['excerpt_length'] = intval($data_values['excerpt_length']);
            }
            stpb_input_text($pre_name.'[excerpt_length]',$data_values['excerpt_length']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Excerpt Length','smooththemes') ?></strong>
            <span><?php _e('The number of words you wish to display in the excerpt','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[pagination]',$data_values['pagination'], array(
                'no'=>__('No','smooththemes'),
                'yes'=>__('Yes','smooththemes'),
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Pagination','smooththemes') ?></strong>
            <span><?php _e('Should a pagination be displayed?.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[order_by]',$data_values['order_by'], array(
                'post_date'=>__('Sort by creation time','smooththemes'),
                'post_title'=>__('Sort Posts alphabetically (by title) ','smooththemes'),
                'rand'=>__('Random','smooththemes'),
                'ID'=>__('Sort by numeric Page ID','smooththemes'),
                'date_start'=>__('Date Start','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Sort By','smooththemes') ?></strong>
            <span><?php _e('Sorts the list of Post in a number of different ways.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[order]',$data_values['order'], array(
                'desc'=>__('Descending','smooththemes'),
                'asc'=>__('Ascending','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Sort Order ','smooththemes') ?></strong>
            <span><?php _e('Change the sort order of the list of Post.','smooththemes'); ?></span>
        </div>
    </div>
<?php
}
/**
 * Custom Page Builder Item Event
 */
function stpb_custom_event($pre_name ='', $data_values=  array(), $post= false, $no_value = false,  $interface= false){
    ?>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[number]',$data_values['number']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Number','smooththemes') ?></strong>
            <span><?php _e('How many post you want to display ?','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php
            stpb_input_select_one($pre_name.'[display_style]',$data_values['display_style'], array(
                    'list'=>__('List','smooththemes'),
                    'gird'=>__('Grid','smooththemes'),
                )
                ,'.blog_display_style'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Display style','smooththemes') ?></strong>
            <span><?php _e('Select list or gird for list post','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item show-on-select-change blog_display_style" show-on="gird">
        <div class="left width-50">
            <?php
            $layouts =  array();
            foreach(array(1,2,3,4) as $k){
                $layouts[$k] = sprintf(_n('%d Column','%d Columns', $k,'smooththemes'), $k);
            }
            stpb_input_select_one($pre_name.'[columns]',$data_values['columns'], $layouts); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Layout','smooththemes') ?></strong>
            <span><?php _e('Select layout for list post','smooththemes'); ?></span>
        </div>
    </div>
    
    
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[container_show]',$data_values['container_show'], array(
                'content'=>__('Content','smooththemes'),
                'box'=>__('Box','smooththemes')
            ),'.sl-sr-icontypes'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Container Show','smooththemes') ?></strong>
            <span><?php _e('You can choose Megamenu or Content.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item show-on-select-change blog_display_style" show-on="list">
        <div class="left width-50">
            <?php
            stpb_input_select_one($pre_name.'[thumbnail_type]',$data_values['thumbnail_type'], array(
                    'full-width'=>__('Full with','smooththemes'),
                    'medium-left'=>__('Medium left','smooththemes'),
                    'medium-right'=>__('Medium right','smooththemes'),
                )
                ); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Thumbnail Type','smooththemes') ?></strong>
            <span><?php _e('Select thumbnail type for list post','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[exclude]',$data_values['exclude']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Exclude','smooththemes') ?></strong>
            <span><?php _e('Define a comma-separated list of post IDs to be Exclude from the list, (example: 3,7,31 )','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[include]',$data_values['include']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Include','smooththemes') ?></strong>
            <span><?php _e('Define a comma-separated list of post IDs to be Include from the list, (example: 3,7,31 )','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[offset]',$data_values['offset']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Offset','smooththemes') ?></strong>
            <span><?php _e('The number of Posts to pass over (or displace) before collecting the set of Posts.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php
            if($data_values['excerpt_length']==='' ||  empty($data_values['excerpt_length']) || !is_numeric($data_values['excerpt_length']) ){
                $data_values['excerpt_length'] = apply_filters('stpb_bog_excerpt_length',17 );
            }else{
                $data_values['excerpt_length'] = intval($data_values['excerpt_length']);
            }
            stpb_input_text($pre_name.'[excerpt_length]',$data_values['excerpt_length']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Excerpt Length','smooththemes') ?></strong>
            <span><?php _e('The number of words you wish to display in the excerpt','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[pagination]',$data_values['pagination'], array(
                'no'=>__('No','smooththemes'),
                'yes'=>__('Yes','smooththemes'),
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Pagination','smooththemes') ?></strong>
            <span><?php _e('Should a pagination be displayed?.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[order_by]',$data_values['order_by'], array(
                'post_date'=>__('Sort by creation time','smooththemes'),
                'post_title'=>__('Sort Posts alphabetically (by title) ','smooththemes'),
                'rand'=>__('Random','smooththemes'),
                'ID'=>__('Sort by numeric Page ID','smooththemes'),
                'date_start'=>__('Date Start','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Sort By','smooththemes') ?></strong>
            <span><?php _e('Sorts the list of Post in a number of different ways.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[order]',$data_values['order'], array(
                'desc'=>__('Descending','smooththemes'),
                'asc'=>__('Ascending','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Sort Order ','smooththemes') ?></strong>
            <span><?php _e('Change the sort order of the list of Post.','smooththemes'); ?></span>
        </div>
    </div>
<?php
}
/**
 * Start Custom Builder Item Image
 */
function stpb_custom_image($pre_name ='', $data_values=  array(), $post= false, $no_value = false, $interface= false){
    ?>
    <div class="item">
        <div class="left width-50">
            <?php stpb_input_media($pre_name.'[image]',$data_values['image'],'image', __('Insert Image','smooththemes') ); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Choose Image','smooththemes') ?></strong>
            <span><?php _e('Either upload a new, or choose an existing image from your media library','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php
            stpb_input_select_one($pre_name.'[size]',$data_values['size'], $interface->list_thumbnail_sizes()); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Preview Image Size','smooththemes') ?></strong>
            <span><?php _e('Choose image size for the preview thumbnails.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[position]',$data_values['position'], array(
                'center'=>__('Center','smooththemes'),
                'left'=>__('Left','smooththemes'),
                'right'=>__('Right','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Image Position','smooththemes') ?></strong>
            <span><?php _e('Choose the alignment of your Image here.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[link_type]',$data_values['link_type'], array(
                'lightbox'=>__('Lightbox','smooththemes'),
                'link'=>__('Link','smooththemes')
            ),'.image_link_type'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Use Lightbox or Link?','smooththemes') ?></strong>
            <span><?php _e('Choose Lightbox or static link?','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item show-on-select-change image_link_type" show-on="link">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[link]',$data_values['link']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Image Link?','smooththemes') ?></strong>
            <span><?php _e('Where should your image link to?','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item show-on-select-change image_link_type" show-on="link">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[link_target]',$data_values['link_target'], array(
                '_self'=>__('No, open in same window','smooththemes'),
                '_blank'=>__('Yes, open in new window','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Open Link in new Window?','smooththemes') ?></strong>
            <span><?php _e('Select here if you want to open the linked page in a new window.','smooththemes'); ?></span>
        </div>
    </div>
    
    
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[caption]',$data_values['caption']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Caption','smooththemes') ?></strong>
            <span><?php _e('Enter Caption','smooththemes'); ?></span>
        </div>
    </div>
    
    
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_text($pre_name.'[custom_class]',$data_values['custom_class']); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Custom Class','smooththemes') ?></strong>
            <span><?php _e('Set class "main-img" to image featured full content','smooththemes'); ?></span>
        </div>
    </div>
<?php
}
/**
 * Custom Builder Item Staff
 */
function stpb_custom_staff($pre_name ='', $data_values=  array(), $post= false, $no_value = false, $interface= false){
    ?>
    <div class="item">
        <div class="left width-50">
            <?php
            stpb_input_ui($pre_name.'[staff]', $data_values['staff'], array(
                'title'=>true,
                'content'=>true,
                'image'=>true,
                'icon'=>false
            ), array(
                'title'=>__('Staff:','smooththemes'),
                'image'=>__('Image:','smooththemes')
            ),array(
                array(
                    'title'=>__('Caption','smooththemes'),
                    'type'=>'text',
                    'name'=>'caption'
                ),
                array(
                    'title'=>__('Link','smooththemes'),
                    'type'=>'text',
                    'name'=>'link'
                ),
                array(
                    'title'=>__('Phone','smooththemes'),
                    'type'=>'text',
                    'name'=>'phone'
                ),
                array(
                    'title'=>__('Email','smooththemes'),
                    'type'=>'text',
                    'name'=>'email'
                ),
                array(
                    'title'=>__('Skype','smooththemes'),
                    'type'=>'text',
                    'name'=>'skype'
                ),
                array(
                    'title'=>__('Linkedin','smooththemes'),
                    'type'=>'text',
                    'name'=>'linkedin'
                )
            ));
            ?>
        </div>
        <div class="right width-50">
            <strong><?php _e('Add/Edit Staffs','smooththemes'); ?></strong>
            <span><?php _e('Here you can add, remove and edit the Staff you want to display.','smooththemes') ?></span>
        </div>
    </div>
    
    
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[container_show]',$data_values['container_show'], array(
                'content'=>__('Content','smooththemes'),
                'menu'=>__('Megamenu','smooththemes')
            ),'.sl-sr-icontypes'); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Container Show','smooththemes') ?></strong>
            <span><?php _e('You can choose Megamenu or Content.','smooththemes'); ?></span>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php
            if(!isset($data_values['num_cols']) || $data_values['num_cols'] ==''){
                $data_values['num_cols'] = 5;
            }
            stpb_input_select_one($pre_name.'[num_cols]',$data_values['num_cols'], array(1=>1, 2=>2, 3=>3, 4=>4, 6=>6)); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Number items per row','smooththemes') ?></strong>
        </div>
    </div>
    <div class="item">
        <div class="left width-50">
            <?php  stpb_input_select_one($pre_name.'[link_target]',$data_values['link_target'], array(
                '_self'=>__('No, open in same window','smooththemes'),
                '_blank'=>__('Yes, open in new window','smooththemes')
            )); ?>
        </div>
        <div class="right  width-50">
            <strong><?php _e('Open Link in new Window?','smooththemes') ?></strong>
            <span><?php _e('Select here if you want to open the linked page in a new window.','smooththemes'); ?></span>
        </div>
    </div>
    
<?php
}