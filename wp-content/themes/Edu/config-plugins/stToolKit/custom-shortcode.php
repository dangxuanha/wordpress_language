<?php
/**
 * Custom Builder Item Table
 */
if (!class_exists('ST_Table_Shortcode')) {
    /**
     * PB Item Table
     */
    class ST_Table_Shortcode {
        static $shortcode_data;
        static $shortcode_data_col;
        static $shortcode_data_row;
        static $shortcode_count_col;
        static $shortcode_count_row;
        static $row_style;
        /**
         * init function.
         *
         * @access public
         * @static
         * @return void
         */
        static function init() {
            add_shortcode( 'st_col', array(__CLASS__, 'st_col' ) );
            add_shortcode( 'st_row', array(__CLASS__, 'st_row' ) );
            add_shortcode( 'st_table', array(__CLASS__, 'st_table' ) );
            self::$shortcode_count_col = 0;
            self::$shortcode_count_row = 0;
        }
        /**
         * st_col function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static  function st_col( $atts, $content ) {
            $atts = shortcode_atts(array(
                'col_style'             => 'default',
                'content'               => $content
            ), $atts);
            self::$shortcode_count_col++;
            self::$shortcode_data[self::$shortcode_count_row][self::$shortcode_count_col] = $atts;
            extract($atts);
            $out = '';
            $class = ($content != '') ? '' : ' blank';
            if (self::$row_style == 'heading') {
                $out.= '<th class="'. $col_style . $class .'">'. do_shortcode(balanceTags($content), TRUE) .'</th>';
            }
            else {
                $out.= '<td class="'. $col_style . $class .'">'. do_shortcode(balanceTags($content), TRUE) .'</td>';
            }
            $out = apply_filters('st_col', $out, $atts);
            return $out;
        }
        /**
         * st_row function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static function st_row( $atts, $content ) {
            $atts = shortcode_atts(array(
                'row_style'  => 'default'
            ), $atts);
            self::$shortcode_count_row++;
            extract($atts);
            self::$shortcode_count_col = 0;
            self::$row_style = $row_style;
            $out = $out_content = '';
            $out_content .= do_shortcode( $content );
            self::$shortcode_data_row[self::$shortcode_count_row] = $atts;
            $out .= '<tr class="'. $row_style .'">';
            $out .= $out_content;
            $out .= '</tr>';
            $out = apply_filters('st_row', $out, $atts);
            return $out;
        }
        /**
         * st_table function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static function st_table( $atts, $content ) {
            $atts = shortcode_atts(array(
                'table_style'    => '',
                'display_type'   => '',
                'caption_table'  => ''
            ), $atts);
            extract($atts);
            self::$shortcode_count_col = 0;
            self::$shortcode_count_row = 0;
            self::$shortcode_data_row = array();
            self::$shortcode_data = array();
            $out = $out_content = '';
            $out_content .= do_shortcode( $content );
            if ($display_type == 'tabular' && $caption_table != '') {
                $out .= '<div class="table-caption">'. balanceTags($caption_table) .'</div>';
            }
            $out .= '<table class="table '. $display_type .' '. $table_style .'">';
            $out .= $out_content;
            $out .= '</table>';
            $out = apply_filters('st_table', $out, $atts);
            return $out;
        }
    }
    ST_Table_Shortcode::init();
}
/**
 * Start Custom Builder Item Service
 */
if (!function_exists('st_custom_service_func')) {
    /**
     * PB Item Custom Service
     */
    function st_custom_service_func($atts, $content='') {
        $atts = shortcode_atts( array(
            'title'                 => '',
            'icon_type'             => '#',
            'icon'                  => '',
            'image'                 => '',
            'size'                  => 'thumbnail',
            'icon_position'         => 'top',
            'link'                  => '#',
            'hover'                 => '',
            'custom_class'          => ''
        ), $atts );
        extract($atts);
        $html = '';
        $class = '';
        $htitle = ($title != '') ? '<h3 class="service-title">'. $title .'</h3>' :  '';
        $icon = ($icon_type == 'icon' && $icon != '') ? '<div class="icon-service"><i class="color-icon '. esc_attr($icon) .'"></i></div>' : '';
        if ($icon_type == 'image' && $image != '') {
            $thumb = wp_get_attachment_image( (int)$image, $size, $attr = array('alt'=>esc_attr($title)) );
            $icon = ($thumb != '') ? $thumb : $icon;
        }
        $content = ($content != '') ? '<div class="service-inner">'. $htitle. '<div class="service-content">'. $content .'</div>  </div>' : '';
        $html .= '<div class="st-service box-style-2 '. esc_attr($hover) .' '. $custom_class .'">';
        $html .= ($link != '') ? '<a href="'. $link .'" title="'. esc_attr($title) .'">' : '';
        $html .= '<div class="st-service-container icon-align-'. esc_attr($icon_position) .' clearfix">';
        $html .= $icon . $content;
        $html .= '</div>';
        $html .= ($link != '') ? '</a>' : '';
        $html .= '</div>';
        $html = apply_filters('st_custom_service_func', $html , $atts);
        return $html;
    }
    add_shortcode('st_custom_service', 'st_custom_service_func');
}
/**
 * Start Custom Builder Item Icons Box
 */
if (!class_exists('ST_Custom_Icon_List_Shortcode')) {
    /**
     * PB Item Custom Icon List
     */
    class ST_Custom_Icon_List_Shortcode {
        static $shortcode_count;
        /**
         * init function.
         *
         * @access public
         * @static
         * @return void
         */
        static function init() {
            add_shortcode( 'st_custom_icon_list', array(__CLASS__, 'st_custom_icon_list' ) );
            add_shortcode( 'st_custom_icon_lists', array(__CLASS__, 'st_custom_icon_lists' ) );
            self::$shortcode_count = 0;
        }
        /**
         * st_icon_list function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static  function st_custom_icon_list( $atts, $content ) {
            $atts = shortcode_atts(array(
                'title'             => '',
                'icon'              => '',
                'index'=>'',
                'color_type'        => '',
                'color'=>''
            ), $atts);
            extract($atts);
            $out = '';
            $class = '';

            if($color_type=='custom' && $color!=''){
                $icon = ($icon != '') ? '<span class="il-icon" style="color: '.esc_attr($color).';"><i class="'. esc_attr($icon) .'" style="color: '.esc_attr($color).';"></i> </span>' : '';
            }else{
                $icon = ($icon != '') ? '<span class="il-icon color-icon"><i class="'. esc_attr($icon) .'"></i> </span>' : '';
            }



            $title = esc_html($title);
            $class .= 'feat icon-item  icl-'.($index+1);
            if ($index == 0){
                $class .= ' first';
            }
            if ($index == self::$shortcode_count-1){
                $class .= ' last';
            }
            if ($content != '') {
                $content = '<div class="st-il-content">'. do_shortcode(balanceTags($content), true) .'</div>';
                $class .= ' st-il-des';
            }
            if($title!=''){
                $title = '<h3  class="il-title">'.$title.'</h3>';
            }
            $out .= '<div class="'. esc_attr($class) .'">'. $icon . '<div class="il-inner">'. $title . $content .' </div></div>';
            
            if ($index != self::$shortcode_count-1){
                $out .= '<hr class="double">';
            }
            
            $out = apply_filters('st_custom_icon_list', $out, $atts);
            return $out;
        }
        /**
         * st_icon_lists function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static function st_custom_icon_lists( $atts, $content ) {
            $atts = shortcode_atts(array(
                'number_items' => ''
            ), $atts);
            extract($atts);
            self::$shortcode_count = intval($number_items);
            $id = uniqid();
            $out = '';
            $out = '<div class="st-custom-icon-list box-style-1 ribbon borders">';
            $out .= do_shortcode($content);
            $out.= '</div>';
            $out = apply_filters('st_custom_icon_lists', $out, $atts);
            return $out;
        }
    }
    ST_Custom_Icon_List_Shortcode::init();
}
/**
 * Start Custom Builder Item Icons Link
 */
if (!class_exists('ST_Custom_Icons_Link_Shortcode')) {
    /**
     * PB Item Custom Icons Link
     */
    class ST_Custom_Icons_Link_Shortcode {
        static $shortcode_count;
        static $per_row;
        /**
         * init function.
         *
         * @access public
         * @static
         * @return void
         */
        static function init() {
            add_shortcode( 'st_icons_link', array(__CLASS__, 'st_custom_icons_link' ) );
            add_shortcode( 'st_icons_links', array(__CLASS__, 'st_custom_icons_links' ) );
            self::$shortcode_count = 0;
        }
        /**
         * st_custom_icons_link function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static  function st_custom_icons_link( $atts, $content ) {
            $atts = shortcode_atts(array(
                'title'             => '',
                'icon'              => '',
                'index'             => '',
                // for link settings
                'id' =>'',
                'slug' =>'',
                'item_type' =>'',
                'type' =>'',
                'url' =>''
            ), $atts);
            extract($atts);
            $link = st_create_link($atts);
            if (self::$per_row != 0) {
                $count = self::$per_row;
            }
            else {
                $count = 4;   
            }
            $per_row = 12/(int)self::$per_row;
            $out = '';
            $class = '';
            $icon = ($icon != '') ? '<i class="'. esc_attr($icon) .' icon-3x"></i>' : '';
            $title = esc_html($title);
            $class .= 'box-icon-link  icl-'.($index+1).' col-lg-'.(int)$per_row.' col-md-4 col-sm-6';
            if ($index == 0){
                $class .= ' first';
            }
            if ($index == self::$shortcode_count-1){
                $class .= ' last';
            }
            $out .= '<div class="'. esc_attr($class) .'"><a href="'. esc_url($link) .'" title="'. esc_attr($title) .'">'. $icon . $title .'</a></div>';
            
            if ((self::$shortcode_count+1)%$count == 0) {
                $out .= '';
            }
            
            self::$shortcode_count++;
            
            $out = apply_filters('st_custom_icons_link', $out, $atts);
            return $out;
        }
        /**
         * st_custom_icons_links function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static function st_custom_icons_links( $atts, $content ) {
            $atts = shortcode_atts(array(
                'number_items' => '',
                'per_row'      => 4
            ), $atts);
            extract($atts);
            self::$shortcode_count = intval($number_items);
            self::$per_row = intval($per_row);
            $id = uniqid();
            $out = '';
            $out = '<div class="st-icons-link icon-menu">';
            $out .= '<div class="row-wrapper row">';
            $out .= do_shortcode($content);
            $out.= '</div>';
            $out.= '</div>';
            $out = apply_filters('st_custom_icons_links', $out, $atts);
            return $out;
        }
    }
    ST_Custom_Icons_Link_Shortcode::init();
}
/**
 * Start Custom Builder Item Lessons
 */
if (!function_exists('st_custom_lessons_func')) {
    /**
     * PB Item Custom Lessons
     */
    function st_custom_lessons_func($atts, $content='') {
        $atts = shortcode_atts( array(
            'title'                 => '',
            'caption'               => '',
            'icon_type'             => '#',
            'icon'                  => '',
            'image'                 => '',
            'size'                  => 'st_medium',
            'duration'              => 'duration',
            'link_video'            => '#',
            'link_download'         => '#',
            'icon_position'        => 'left'
        ), $atts );
        extract($atts);
        $html = '';
        $class = '';
        $htitle = ($title != '') ? '<h4 class="lessons-title">'. $title .'</h4>' :  '';
        $icon = ($icon_type == 'icon' && $icon != '') ? '<div class="icon-lessons"><i class="color-icon '. esc_attr($icon) .'"></i></div>' : '';
        if ($icon_type == 'image' && $image != '') {
            $thumb = wp_get_attachment_image( (int)$image, $size, $attr = array('alt'=>esc_attr($title)) );
            $icon = ($thumb != '') ? $thumb : $icon;
        }
        $content = ($content != '') ? '<div class="lessons-inner">'. $htitle. '<div class="lessons-content">'. $content .'</div>  </div>' : '';
        $html .= '<div class="st-lessons strip-lessons">';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-3 col-sm-3 col-md-3 column">';
        $html .= '<div class="box-style-one borders">';
        $html .= $icon;
        $html .= ($caption != '') ? '<h5>'. $caption .'</h5>' :  '';
        $html .= '</div>';
        $html .= '</div>';
        
        $html .= '<div class="col-lg-9 col-sm-9 col-md-9 column">';
        $html .= '<div class="st-lessons-container icon-align-'. esc_attr($icon_position) .' clearfix">';
        $html .= $content;
        $html .= '</div>';
        $html .= '<ul class="data-lessons">';
        $html .= ($duration != '') ? '<li><i class="iconentypo-clock"></i>'. __('Duration:', 'smooththemes') . $duration .'</li>' : '';
        $html .= ($link_video != '') ? '<li><i class="iconentypo-video"></i><a class="magnific-media" href="'. $link_video .'" title="'. esc_attr($title) .'">'. __('Play video', 'smooththemes') .'</a></li>' : '';
        $html .= ($link_download != '') ? '<li><i class="iconentypo-download"></i><a href="'. $link_download .'" title="'. esc_attr($title) .'">'. __('Donwload prospect', 'smooththemes') .'</a></li>' : '';
        $html .= '</ul>';
        $html .= '</div>';
        
        $html .= '</div>';
        $html .= '</div>';
        $html = apply_filters('st_custom_lessons_func', $html , $atts);
        return $html;
    }
    add_shortcode('st_lessons', 'st_custom_lessons_func');
}
/**
 * Custom Page Builder Item Course
 */
/**
 *
 * Items Cource Elements
 *
 */
if (!function_exists('st_course_func')) {
    /**
     * BP Item Course
     */
    function st_course_func($atts, $content='') {
        $atts = shortcode_atts( array(
            'number'          => -1,
            'cats'            => array(),
            'exclude'         => array(),
            'include'         => array(),
            'offset'          => 0,
            'thumbnail_type'  =>'',
            'columns'         =>1,
            'display_style'=> 'list',
            'container_show'   => 'content',
            'excerpt_length'  => 70,
            'pagination'      => 'no',
            'order_by'        => 'ID',
            'order'           => 'desc'
        ), $atts );
        extract($atts);
        global $post, $paged;
        $current_post_options =  ST_Page_Builder::get_page_options($post->ID);

        $html = '';

        if(is_string($cats)){
            $cats = explode(',',$cats);
        }

        if (is_array($cats) && count($cats)>0) {
            if (in_array(0, $cats)) $cats = array();
        }

        $exclude = ($exclude != '') ? explode(',', $exclude) : $exclude;
        $include = ($include != '') ? explode(',', $include) : $include;
        $number = ($number != '') ? $number : get_option('posts_per_page', 10);
        $args = array(
            'post_type'         => 'course',
            'posts_per_page'    => (int)$number,
            'post__not_in'      => $exclude,
            'post__in'          => $include,
            'offset'            => $offset,
            'order'             => $order
        );

        if (!empty($cats)) {
            $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'course_category',
                        'field' => 'id',
                        'terms' => (array)$cats
                    )
                );
        }
        
        if ($order_by == 'date_start') {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = '_date_start';
        }
        else {
            $args['orderby'] = $order_by;
        }
        
        if($paged > 0){
            $args['paged'] =  $paged;
        } else {
            $paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;
        }
        if(st_is_wpml()) {
            $args['sippress_filters'] = true;
            $args['language'] = get_bloginfo('language');
        }
        $wp_query = new WP_Query( $args );
        $myposts =  $wp_query->posts;
 

        $func = st_excerpt_length( $excerpt_length );
        $columns = intval($columns);
        // support display type list or gird only
        if(!in_array($display_style, array('list','gird') ) ){
            $display_style ='list';
        }
        /*
         blog loop templates:
            Gird:
            1 -loop-post-gird-{$columns}.php // (optional) template for each column
            2 -loop-post-gird.php  // (optional) if number columns larger than 1 if have not any templates above
            List:
            3 -loop-post-list.php          // (optional) for display style as list
            Default:
            4 -loop-post.php                // (requested) if have not any templates above
         */
        $file_template = st_get_template('loop/loop-post.php');
        $thumb_size = 'large';
        if($display_style=='gird'){
            if ($container_show == 'menu') {
                // display gird
                if(is_file(st_get_template('loop/loop-course-gird-'.$columns.'-menu.php'))){
                    $file_template = st_get_template('loop/loop-course-gird-'.$columns.'-menu.php') ;
                }elseif(is_file(st_get_template('loop/loop-course-list-menu.php')) ){
                    $file_template = st_get_template('loop/loop-course-list-menu.php') ;
                }
            }
            else {
                // display gird
                if(is_file(st_get_template('loop/loop-course-gird-'.$columns.'.php'))){
                    $file_template = st_get_template('loop/loop-course-gird-'.$columns.'.php') ;
                }elseif(is_file(st_get_template('loop/loop-course-list.php')) ){
                    $file_template = st_get_template('loop/loop-course-list.php') ;
                }
            }
            if(isset($thumbnail_type) && $thumbnail_type!=''){
                if($columns<2){
                    if($current_post_options['layout']=='no-sidebar'){
                        $thumb_size ='blog-full';
                    }else{
                        $thumb_size ='blog-large';
                    }
                }elseif($columns>3){
                    $thumb_size ='blog-medium';
                }else{
                    $thumb_size ='blog-large';
                }
            }
        }else{ // display list
            if(is_file(st_get_template('loop/loop-course-list.php'))){
                $file_template = st_get_template('loop/loop-course-list.php') ;
            }
            if(isset($thumbnail_type) && $thumbnail_type!=''){
                if($thumbnail_type=='full-width'){
                    if($current_post_options['layout']=='no-sidebar'){
                        $thumb_size ='blog-full';
                    }else{
                        $thumb_size ='blog-large';
                    }
                }else{
                    if($current_post_options['layout']=='no-sidebar'){
                        $thumb_size ='blog-large';
                    }else{
                        $thumb_size ='blog-medium';
                    }
                }
            }
        }
        if($display_style!='gird'){ // list display
            foreach( $myposts as $i => $post ) { 
                if (get_post_meta($post->ID, '_st_current_editor', true) == 'builder') {
                    $post->post_content = $post->post_excerpt;  $post->post_excerpt = '';
                }
                setup_postdata($post);
                $html .= st_get_content_from_file($file_template, array('thumbnail_type'=>$thumbnail_type,'thumb_size'=>$thumb_size,  'index'=> $i));
            }
        }else{  // gird display
            $j = 0;
            $c=1;
            $groups=  array();
            $col_num = intval(12/$columns);
            foreach( $myposts as $i => $post ) {
                if (get_post_meta($post->ID, '_st_current_editor', true) == 'builder') {
                    $post->post_content = $post->post_excerpt;  $post->post_excerpt = '';
                }
                setup_postdata($post);
                $groups[$j][] = '<div class="course-item '.stpb_number_to_words($col_num).'">'.st_get_content_from_file($file_template, array('item_index'=> $i, 'thumbnail_type'=>$thumbnail_type, 'thumb_size'=>$thumb_size )).'</div>';
                if($c==$columns){
                    $c=1; $j++;
                }else{
                    $c++;
                }
            }
            $n = count($groups);
            foreach($groups as $i => $g){
                $html.= join(' ',$g);
                if($i<$n-1){
                    $html .='<div class="clearfix item-sp item-index-'.$i.'"></div>';
                }else{
                    $html .='<div class="clearfix item-sp item-index-'.$i.' last"></div>';
                }
            }
        }
        $p = '';
       // if(!is_home() && !is_front_page()) { // only true if not is home page or front page
            if($pagination == 'yes'){
                $p =  st_post_pagination($wp_query->max_num_pages,2, false);
                if($p != ''){
                    $p = '<div class="st-pagination-wrap">'. $p .'</div>';
                }
            }
       // }
        wp_reset_query();
        remove_filter('excerpt_length', $func);
        $html = '<div class="list-post '.( ($display_style=='gird') ? 'gird row' : 'list').'">'.$html.'</div>';
        $html = apply_filters('st_course_func', $html . $p, $atts);
        return $html;
    }
    add_shortcode('st_course', 'st_course_func');
}
/**
 * Custom Page Builder Item Event
 */
/**
 *
 * Items Event Elements
 *
 */
if (!function_exists('st_event_func')) {
    /**
     * BP Item Course
     */
    function st_event_func($atts, $content='') {
        $atts = shortcode_atts( array(
            'number'          => -1,
            'exclude'         => array(),
            'include'         => array(),
            'offset'          => 0,
            'thumbnail_type'  =>'',
            'columns'         =>1,
            'display_style'=> 'list',
            'container_show'   => 'content',
            'excerpt_length'  => 70,
            'pagination'      => 'no',
            'order_by'        => 'ID',
            'order'           => 'desc'
        ), $atts );
        extract($atts);
        global $post, $paged;
        $current_post_options =  ST_Page_Builder::get_page_options($post->ID);
        $html = '';
        $exclude = ($exclude != '') ? explode(',', $exclude) : $exclude;
        $include = ($include != '') ? explode(',', $include) : $include;
        $number = ($number != '') ? $number : get_option('posts_per_page', 10);
        $args = array(
            'post_type'         => 'event',
            'posts_per_page'    => (int)$number,
            'post__not_in'      => $exclude,
            'post__in'          => $include,
            'offset'            => $offset,
            'order'             => $order
        );
        
        if ($order_by == 'date_start') {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = '_date_start';
        }
        else {
            $args['orderby'] = $order_by;
        }
        if ($pagination == 'yes') {
            if($paged > 0){
                $args['paged'] =  $paged;
            } else {
                $paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;
            }    
        }
        if(st_is_wpml()) {
            $args['sippress_filters'] = true;
            $args['language'] = get_bloginfo('language');
        }
        $wp_query = new WP_Query( $args );
        $myposts =  $wp_query->posts;
        $func = st_excerpt_length( $excerpt_length );
        $columns = intval($columns);
        // support display type list or gird only
        if(!in_array($display_style, array('list','gird') ) ){
            $display_style ='list';
        }
        /*
         blog loop templates:
            Gird:
            1 -loop-post-gird-{$columns}.php // (optional) template for each column
            2 -loop-post-gird.php  // (optional) if number columns larger than 1 if have not any templates above
            List:
            3 -loop-post-list.php          // (optional) for display style as list
            Default:
            4 -loop-post.php                // (requested) if have not any templates above
         */
        $file_template = st_get_template('loop/loop-post.php');
        $thumb_size = 'large';
        if($display_style=='gird'){
            if ($container_show == 'box') {
                // display gird
                if(is_file(st_get_template('loop/loop-event-gird-'.$columns.'-box.php'))){
                    $file_template = st_get_template('loop/loop-event-gird-'.$columns.'-box.php') ;
                }elseif(is_file(st_get_template('loop/loop-event-list-box.php')) ){
                    $file_template = st_get_template('loop/loop-event-list-box.php') ;
                }
            }
            else {
                // display gird
                if(is_file(st_get_template('loop/loop-event-gird-'.$columns.'.php'))){
                    $file_template = st_get_template('loop/loop-event-gird-'.$columns.'.php') ;
                }elseif(is_file(st_get_template('loop/loop-event-list.php')) ){
                    $file_template = st_get_template('loop/loop-event-list.php') ;
                }
            }
            if(isset($thumbnail_type) && $thumbnail_type!=''){
                if($columns<2){
                    if($current_post_options['layout']=='no-sidebar'){
                        $thumb_size ='blog-full';
                    }else{
                        $thumb_size ='blog-large';
                    }
                }elseif($columns>3){
                    $thumb_size ='blog-medium';
                }else{
                    $thumb_size ='blog-large';
                }
            }
        }else{ // display list
            if ($container_show == 'box') {
                if(is_file(st_get_template('loop/loop-event-list-box.php'))){
                    $file_template = st_get_template('loop/loop-event-list-box.php') ;
                }
            }
            else {
                if(is_file(st_get_template('loop/loop-event-list.php'))){
                    $file_template = st_get_template('loop/loop-event-list.php') ;
                }
            }
            if(isset($thumbnail_type) && $thumbnail_type!=''){
                if($thumbnail_type=='full-width'){
                    if($current_post_options['layout']=='no-sidebar'){
                        $thumb_size ='blog-full';
                    }else{
                        $thumb_size ='blog-large';
                    }
                }else{
                    if($current_post_options['layout']=='no-sidebar'){
                        $thumb_size ='blog-large';
                    }else{
                        $thumb_size ='blog-medium';
                    }
                }
            }
        }
        if($display_style!='gird'){ // list display
            foreach( $myposts as $i => $post ) {
                setup_postdata($post);
                $html .= st_get_content_from_file($file_template, array('thumbnail_type'=>$thumbnail_type,'thumb_size'=>$thumb_size,  'index'=> $i));
            }
        }else{  // gird display
            $j = 0;
            $c=1;
            $groups=  array();
            $col_num = intval(12/$columns);
            foreach( $myposts as $i => $post ) {
                setup_postdata($post);
                $groups[$j][] = '<div class="blog-style '.stpb_number_to_words($col_num).'">'.st_get_content_from_file($file_template, array('item_index'=> $i, 'thumbnail_type'=>$thumbnail_type, 'thumb_size'=>$thumb_size )).'</div>';
                if($c==$columns){
                    $c=1; $j++;
                }else{
                    $c++;
                }
            }
            $n = count($groups);
            foreach($groups as $i => $g){
                $html.= join(' ',$g);
                if($i<$n-1){
                    $html .='<div class="clearfix item-sp item-index-'.$i.'"></div>';
                }else{
                    $html .='<div class="clearfix item-sp item-index-'.$i.' last"></div>';
                }
            }
        }
        $p = '';
       // if(!is_home() && !is_front_page()) { // only true if not is home page or front page
            if($pagination == 'yes'){
                $p =  st_post_pagination($wp_query->max_num_pages,2, false);
                if($p != ''){
                    $p = '<div class="st-pagination-wrap">'. $p .'</div>';
                }
            }
       // }
        wp_reset_query();
        remove_filter('excerpt_length', $func);
        
        if ($container_show == 'box') {
            $custom_class = '';
        }
        else {
            $custom_class = 'news-strip';
        }
        
        $html = '<div class="'. $custom_class .' '.( ($display_style=='gird') ? 'gird row' : 'list').'"><ul>'.$html.'</ul></div>';
        $html = apply_filters('st_event_func', $html . $p, $atts);
        return $html;
    }
    add_shortcode('st_event', 'st_event_func');
}
/**
 * Start Custom Builder Item Image
 */
if (!function_exists('st_custom_image_func')) {
    /**
     * PB Item Custom Image
     */
    function st_custom_image_func($atts, $content='') {
        $atts = shortcode_atts( array(
            'image'                 => 0,
            'size'                  => 'thumbnail',
            'position'              => '',
            'link_type'             => 'lightbox',
            'link'                  => '#',
            'link_target'           => '_self',
            'caption'               => '',
            'custom_class'          => ''
        ), $atts );
        extract($atts);
        if($link_type==''){
            $link_type='lightbox';
        }
        $image = intval($image);
        $html = '';
        $html .= '<div class="st-custom-image st-custom-image-'. $position .' '. $custom_class .'">';
        $image_infor = get_post( $image);
        $thumb = wp_get_attachment_image($image, $size, $attr = array('alt' => esc_attr(@$image_infor->post_title)) );
        $a_class= 'image-normal';
        if($link_type=='lightbox'){
            $full = wp_get_attachment_image_src( $image, 'full' );
            $link =$full[0];
            $a_class = 'single-lightbox';
        }
        $html .= ($link != '') ? '<a class="'.$a_class.'" href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'" title="'. esc_attr($image_infor->post_title) .'">' : '';
        $html .= ($thumb != '') ? $thumb : '';
        $html .= ($link != '') ? '</a>' : '';
        if ($caption) $html .= '<p class="lead">'. $caption .'</p>';
        $html .= '</div>';
        $html = apply_filters('st_image_func', $html , $atts);
        return $html;
    }
    add_shortcode('st_custom_image', 'st_custom_image_func');
}
/**
 * Custom Builder Item Staff
 */
if (!class_exists('ST_Custom_Staff_Shortcode')) {
    /**
     * PB Item Staff
     */
    class ST_Custom_Staff_Shortcode {
        static $shortcode_count;
        static $link_target;
        static $num_cols;
        static $container_show;
        /**
         * init function.
         *
         * @access public
         * @static
         * @return void
         */
        static function init() {
            add_shortcode( 'st_staff', array(__CLASS__, 'st_staff' ) );
            add_shortcode( 'st_staffs', array(__CLASS__, 'st_staffs' ) );
            self::$shortcode_count = 0;
            self::$link_target = '';
            self::$num_cols = 0;
        }
        /**
         * st_staff function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static  function st_staff( $atts, $content ) {
            $atts = shortcode_atts(array(
                'title'             => '',
                'link'              => '',
                'image'             => '',
                'image_id'          => '',
                'index'             => '',
                'caption'           => '',
                'phone'             => '',
                'email'             => '',
                'skype'             => '',
                'linkedin'          => '',
                'class_title'       => '',
                'class_content'     => ''
            ), $atts);
            extract($atts);
            $out = '';
            $class = '';
            $class .= 'columns '. stpb_number_to_words(12/self::$num_cols) .' staff-item ';
            $class .= ($index == 0) ? ' first ' : '';
            $class .= 'st-staff-item-'. $index .' ';
            $class .=($index == self::$shortcode_count-1) ? ' last ' : '';
            if (self::$container_show == 'content') {
                $image = ($image_id != '') ? '<div class="borders">'. wp_get_attachment_image($image_id, 'st_medium', false, array('class'=>'img-rounded', 'alt'=>esc_attr($title))) .'</div>' : '';

                $title = ($title != '') ? '<h5 class="staff-title"><span class="staff-title '. esc_attr($class_title) .'">'. esc_html($title) .'</span><em>'. $caption .'</em></h5>' : '';
                $class .= ($image_id != '') ? 'have-img' : 'no-img';
                $content = '<div class="staff-content '. esc_attr($class_content) .'"><div class="txt-content">'. do_shortcode(balanceTags($content)) .'</div></div>';
                
                $out .= '<div class="'. esc_attr(trim($class)) .'">';
                $out .= '<div class="strip-staff">';
                $out .= '<div class="columns col-lg-3 col-md-3 col-sm-3 pic-teacher">';
                $out .= $image;
                $out .= '</div>';
                $out .= '<div class="columns col-lg-9 col-md-9 col-sm-9">';
                $out .= $title . $content;

                $out .='<ul class="data-staff">';
                    if ($phone && strlen($phone) > 0) $out .='<li><i class="iconentypo-phone"></i> '. $phone .'</li>';
                    if ($email && strlen($email) > 0) $out .='<li><a href="mailto:'. esc_attr($email) .'"><i class="iconentypo-mail"></i></a></li>';
                    if ($skype && strlen($skype) > 0) $out .='<li><a href="'. esc_url($skype) .'"><i class="iconentypo-skype"></i></a></li>';
                    if ($linkedin && strlen($linkedin) > 0) $out .='<li><a href="'. esc_url($linkedin) .'#"><i class="iconentypo-linkedin"></i></a></li>';
                    if ($link!='') $out .='<li> <a class="staff-read-more" href="'. esc_url($link) .'" target="'. self::$link_target .'" title="'. esc_attr($title) .'">'. __('Read more', 'smooththemes') .'</a></li>';

                $out .='</ul>';
                $out .=$read_more;
                $out .= '</div>';
                $out .= '<div class="clear"></div></div>';

                $out .= '</div>';
            }
            else {
                $image = ($image_id != '') ? '<p>'. wp_get_attachment_image($image_id, 'st_medium', false, array('class'=>'img-rounded', 'alt'=>esc_attr($title))) .'</p>' : '';
                $read_more = '<p><a class="staff-read-more btn btn-sm btn-color" href="'. esc_url($link) .'" target="'. self::$link_target .'" title="'. esc_attr($title) .'">'. __('Read more', 'smooththemes') .'</a></p>';
                $title = ($title != '') ? '<h5 class="staff-title"><span class="staff-title '. esc_attr($class_title) .'">'. esc_html($title) .'</span><em>'. $caption .'</em></h5>' : '';
                $class .= ($image_id != '') ? 'have-img' : 'no-img';
                $content = '<div class="staff-content '. esc_attr($class_content) .'"><div class="txt-content">'. do_shortcode(balanceTags($content)) .'</div></div>';
                
                $out .= '<div class="'. esc_attr(trim($class)) .'">'. $image  . $title . $content . $read_more .'</div>';
            }
            $out .= (($index + 1)%self::$num_cols == 0) ? '<div class="clear"></div>' : '';
            $out = apply_filters('st_staff', $out, $atts);
            return $out;
        }
        /**
         * st_staffs function.
         *
         * @access public
         * @static
         * @param mixed $atts
         * @param mixed $content
         * @return void
         */
        public static function st_staffs( $atts, $content ) {
            $atts = shortcode_atts(array(
                'link_target'   => '_self',
                'num_cols'      => 5,
                'number_items'  => 0,
                'container_show' => 'content'
            ), $atts);
            extract($atts);
            self::$shortcode_count = intval($number_items);
            self::$link_target = $link_target;
            self::$num_cols = $num_cols;
            self::$container_show = $container_show;
            $id = uniqid();
            $out = '';
            $out = '<div class="st-clients row">';
            $out .= do_shortcode($content);
            $out .= '<div class="clear"></div>';
            $out .= '</div>';
            $out = apply_filters('st_staffs', $out, $atts);
            return $out;
        }
    }
    ST_Custom_Staff_Shortcode::init();
}