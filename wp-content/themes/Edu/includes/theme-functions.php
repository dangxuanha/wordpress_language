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
if(!function_exists('st_get_post_options')){
    /**
     * Get Page/Post Option from page builder
     * A alias function of ST_Page_Builder::get_page_options in plugin ST Page Builder
     * @see ST_Page_Builder::get_page_options
     * @param $post_id
     * @param array $default
     */
    function st_get_post_options($post_id,  $default = array()){
        if (is_array($default) && count($default) == 0) {
            $default = array(
                'layout'    => '',
                'left_sidebar' => '',
                'right_sidebar' => ''
            );
        }
        if(class_exists('ST_Page_Builder')){
            $default = ST_Page_Builder::get_page_options($post_id, $default);
        }
        return  $default;
    }
}
if (!function_exists('st_js')) {
    /**
    * Get full url of js file
    */
    function st_js($file, $echo = false) {
        $js = ST_THEME_URL .'assets/js/'.$file;
        if($echo){
            echo   $js;
        }else{
            return $js;
        }
    }
}
if (!function_exists('st_css')) {
    /**
    * Get full url of css file
    */
    function st_css($file, $echo = false) {
        $css = ST_THEME_URL .'assets/css/'. $file;
        if($echo){
            echo   $css;
        }else{
            return $css;
        }
    }
}
if (!function_exists('st_img')) {
    /**
    * Get full url of image file
    */
    function st_img($file, $echo = false) {
        $img = ST_THEME_URL .'assets/images/'. $file;
        if($echo){
            echo   $img;
        }else{
            return $img;
        }
    }
}
if (!function_exists('st_post_pagination')) {
    function st_post_pagination($pages = '', $range = 2, $echo = true) {
        $showitems = ($range * 2)+1;
        global $paged;
        if(empty($paged)) $paged = 1;
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        $html ='';
        if(1 != $pages)
        {
            $html .= "<ul class='st-pagination pagination'>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages)
                $html .= "<li><a href='".get_pagenum_link(1)."'>«</a></li>";
            if($paged > 1 && $showitems < $pages)
                $html .= "<li><a href='".get_pagenum_link($paged - 1)."'>‹</a></li>";
            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    $html .= ($paged == $i)? "<li  class=\"active\" ><a href=\"#\" class='page-current'>".$i."</a></li>" : "<li><a href='".get_pagenum_link($i)."'  >".$i."</a></li>";
                }
            }
            if ($paged < $pages && $showitems < $pages)
                $html .= "<li><a href='".get_pagenum_link($paged + 1)."'>›</a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages)
                $html .= "<li><a href='".get_pagenum_link($pages)."'>»</a></li>";
            $html .= "</ul>\n";
        }
        if($echo){
            echo $html;
        }
        return $html;
    }
}
/**
 * Display or retrieve list of pages with optional home link.
 *
 * The arguments are listed below and part of the arguments are for {@link
 * wp_list_pages()} function. Check that function for more info on those
 * arguments.
 *
 * <ul>
 * <li><strong>sort_column</strong> - How to sort the list of pages. Defaults
 * to page title. Use column for posts table.</li>
 * <li><strong>menu_class</strong> - Class to use for the div ID which contains
 * the page list. Defaults to 'menu'.</li>
 * <li><strong>echo</strong> - Whether to echo list or return it. Defaults to
 * echo.</li>
 * <li><strong>link_before</strong> - Text before show_home argument text.</li>
 * <li><strong>link_after</strong> - Text after show_home argument text.</li>
 * <li><strong>show_home</strong> - If you set this argument, then it will
 * display the link to the home page. The show_home argument really just needs
 * to be set to the value of the text of the link.</li>
 * </ul>
 *
 * @since 2.7.0
 *
 * @param array|string $args
 * @return string html menu
 */
function st_wp_page_menu( $args = array() ) {
    $defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true,
        'link_before' => '', 'link_after' => '', 'container_id'=>'',
        'menu_id'=>'',
        'menu_class'=>''
    );
    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'wp_page_menu_args', $args );
   // echo var_dump($args);
    $menu = '';
    $list_args = $args;
    // Show Home in the menu
    if ( ! empty($args['show_home']) ) {
        if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
            $text = __('Home', 'smooththemes');
        else
            $text = $args['show_home'];
        $class = '';
        if ( is_front_page() && !is_paged() )
            $class = 'class="current_page_item"';
        $menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
        // If the front page is a page, add it to the exclude list
        if (get_option('show_on_front') == 'page') {
            if ( !empty( $list_args['exclude'] ) ) {
                $list_args['exclude'] .= ',';
            } else {
                $list_args['exclude'] = '';
            }
            $list_args['exclude'] .= get_option('page_on_front');
        }
    }
    $list_args['echo'] = false;
    $list_args['title_li'] = '';
    $menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
    $menu = '<div id="'.esc_attr($args['container_id']).'" class="'.esc_attr($args['container_class']).'"><ul id="'.esc_attr($args['menu_id']).'" class="' . esc_attr($args['menu_class']) . '">' . $menu . "</ul></di>\n";
    $menu = apply_filters( 'st_wp_page_menu', $menu, $args );
    if ( $args['echo'] )
        echo $menu;
    else
        return $menu;
}
// this is call back for comments
function st_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class('comment'); ?> id="comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-item">
        <div class="comment-header">
            <?php echo get_avatar($comment->comment_author_email,$size='60',$default='' ); ?>
            <div class="comment-header-right">
                <p class="comment-date"><?php printf('%1$s', get_comment_date()); ?></p>
                <a href="#" class="comment-author"><?php printf('<b class="author_name">%s</b>', get_comment_author_link()) ?></a>
                <?php edit_comment_link(__('(Edit)','smooththemes'),'  ','') ?>
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class='comment-content'>
            <?php comment_text() ?>
            <?php if ($comment->comment_approved == '0') : ?>
                <br /> <em><?php _e('Your comment is awaiting moderation.','smooththemes') ?></em>
            <?php endif; ?>
        </div>
    </div>
<?php
}
/**
 * Get Page layout title
 * @return bool|null|return|string|void
 */
function st_layout_title(){
    $title   ='';
    if(is_singular()){
        if(is_singular('post')){
             $title = get_the_title();
        }elseif(is_page()){
            global  $post;
            $title= '';
            // show_page_el
            $page_options = st_get_post_options($post->ID, array());
            $page_options = wp_parse_args($page_options, array(
                'show_page_el'=>'',
                'show_p_title'=>'',
                'tagline'=>''
            ));
            if($page_options['show_page_el'] =='' || $page_options['show_page_el']=='yes' ) {
                if( $page_options['show_p_title']=='' || $page_options['show_p_title']=='yes' ){
                    $title =  get_the_title();
                }
            }
            if( $page_options['tagline']!=''){
                $tagline = $page_options['tagline'];
            }else{
                $tagline= '';
            }
        }else{
            $title =  get_the_title();
        }
    }elseif(is_author()){
        global $authordata;
        the_post();
        $title = $authordata->display_name!='' ? $authordata->display_name : $authordata->nicename;
        $title = sprintf( __( 'Author Archives: %s', 'smooththemes' ), $title );
        /* Since we called the_post() above, we need to
         * rewind the loop back to the beginning that way
         * we can run the loop properly, in full.
         */
        rewind_posts();
    }elseif(is_tax() || is_category() || is_tag()){
        $title = single_term_title('',false);
        if(is_category() &&  !is_tax() ){
            $title = sprintf(__('Category Archives: %s','smooththemes'), $title);
        }elseif(is_tag()){
            $title = sprintf(__('Tag Archives: %s','smooththemes'), $title);
        }elseif(is_tax()){
            $the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
            $title = sprintf(__('%1$s Archives: %2$s','smooththemes'),  $the_tax->labels->singular_name, $title);
        }
    }elseif(is_search()){
       // $title = sprintf(__('Search for: %s','smooththemes'), get_search_query() );
       $title = __('Search result','smooththemes');
    }elseif( (is_archive() || is_day() || is_date() || is_month() || is_year() || is_time()) && !is_category() ){
        if ( is_day() ) :
            $title =	sprintf( __( 'Daily Archives: %s', 'smooththemes' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
            $title =	 sprintf( __( 'Monthly Archives: %s', 'smooththemes' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'smooththemes' ) ) . '</span>' );
        elseif ( is_year() ) :
            $title =	 sprintf( __( 'Yearly Archives: %s', 'smooththemes'), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'smooththemes' ) ) . '</span>' );
        else :
            $title =__( 'Blog Archives', 'smooththemes' );
        endif;
    }elseif(is_404()){
        $title =__('404','smooththemes');
    }elseif((is_home() || is_front_page()) && !is_page()){  // default if user do not select static page
        if(st_get_setting('show_blog_toptitle','y')!='n'){
            $title  =   st_get_setting('blog_top_title','');
            $tagline  =   st_get_setting('blog_top_tagline','');
        }
    }
    if(st_is_woocommerce()){
        if(is_woocommerce()){
            $post_id = st_get_shop_page();
            $title ='';
            //$page_options = ST_Page_Builder::get_page_options($post_id, array());
            
            // show_page_el
            $page_options = st_get_post_options($post_id, array());
            $page_options = wp_parse_args($page_options, array(
                'show_page_el'=>'',
                'show_p_title'=>''
            ));
            
            if($page_options['show_page_el'] =='' || $page_options['show_page_el']=='yes' ) {
                if( $page_options['show_p_title']=='' || $page_options['show_p_title']=='yes' ){
                    $title =  get_the_title($post_id);
                }
            }
        }
    }
    return $title;
}
if (!function_exists('st_theme_post_thumbnail')) {
    /**
     * @param $post_id, $size = thumbnail | medium | large ..., $args = array('columns'=>, 'thumb_type'='gallery | slider', 'size')
     * @return show image featured | gallery | slider | video
     */
    function st_theme_post_thumbnail($post_id=0, $args=array(), $echo=true) {
        if(intval($post_id)<=0){
            global $post;
            $post_id = $post->ID;
        }
        $size = (isset($args['size'])) ? $args['size'] : 'medium';
        if($size=='' ||  empty($size)){
            $size  = apply_filters('st_post_thumbnail_size','thumbnail');
        }
        if(function_exists('st_post_thumbnail')){
            $out = st_post_thumbnail($post_id, $args, false);
        }else{
            $out = get_the_post_thumbnail($post_id, $size);
        }
        if ($echo == true) echo $out;
        else return $out;
    }
}
if (!function_exists('st_theme_post_snall_thumbnail')) {
    /**
     * Just get a small thumbnail of this post id
     * @param $post_id, $size = thumbnail | medium | large ..., $args = array('columns'=>, 'thumb_type'='gallery | slider', 'size')
     * @return show image featured | gallery | slider | video
     */
    function st_theme_post_snall_thumbnail($post_id=0, $echo=true) {
        if(intval($post_id)<=0){
            global $post;
            $post_id =  $post->ID;
        }
        $size ='thumbnail';
        if(function_exists('st_get_post_options')){
            $page_options = st_get_post_options($post_id); // this function from plugin
            $out = '';
            switch ($page_options['thumb_type']){
                case 'slider':  case 'gallery':
                if (isset($page_options['gallery']) && $page_options['gallery'] != '') {
                    $page_options['gallery'] = explode(',',$page_options['gallery']);
                    $image_id = $page_options['gallery'][0];
                    $out = wp_get_attachment_image($image_id, $size );
                }
                break;
                case 'video':
                    $video = st_get_video($page_options['video'],'16:9',$data);
                    $out ='<span class="video-thumb" video="'.$data['type'].'" size='.$size.' video-id="'.$data['video_id'].'"></span>';
                    break;
                default :
                    if (has_post_thumbnail($post_id)) {
                        $out = get_the_post_thumbnail($post_id, $size);
                    }
            }
        }else{
            if (has_post_thumbnail($post_id)) {
                $out = get_the_post_thumbnail($post_id, $size);
            }
        }
        if ($echo == true) echo $out;
        else return $out;
    }
}
function st_theme_author_template($author_id, $show_link_posts =  true, $class=''){
    global $post;
    ?>
    <div class="media entry-author <?php echo esc_attr($class); ?>">
            <span  class="pull-left">
                <?php echo get_avatar( $post->post_author, 80 ); ?>
            </span>
        <div class="media-body">
            <h4 class="media-heading"><?php printf( esc_attr__( 'About %s', 'smooththemes' ), '<span class="a-name">'.get_the_author_meta( 'display_name', $author_id ).'</span>' ); ?></h4>
            <div class="profile-desc">
                <?php the_author_meta('description'); ?>
            </div>
            <?php if($show_link_posts){ ?>
            <div class="profile-link">
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ); ?>">
                    <?php printf( __( 'View all posts by %s', 'smooththemes' ), get_the_author_meta( 'display_name', $author_id ) ); ?>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
}
function st_theme_breadcrumb(){
}
