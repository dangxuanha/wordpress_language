<?php
function st_theme_thumb_size(){
    return 'blog-large';
}
// change default excerpt length in page builder - Blog item
function stpb_blog_item_excerpt_length(){
    return 40;
}
add_filter('stpb_bog_excerpt_length','stpb_blog_item_excerpt_length');
function st_theme_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'st_theme_excerpt_more');
add_filter('st_slider_size','st_theme_thumb_size'); // change image size for slider
add_filter('st_simple_slider_size','st_theme_thumb_size'); // change image size for  simple slider
add_filter('st_carousel_size','st_theme_thumb_size'); // change image size for carousel
add_filter('st_post_thumbnail_size','st_theme_thumb_size'); // change default image size for post thumbnail
// not support Thumbnail Type
function st_theme_post_not_support_gallery($items){
    unset($items['gallery']);
    return $items;
}
add_filter('st_post_thumb_settings', 'st_theme_post_not_support_gallery',10,1);
function st_theme_suport_builder_for_product($post_types){
    $post_types[] = 'product';
    return $post_types;
}
add_filter('st_page_builder_support','st_theme_suport_builder_for_product',30,1); // change image size for carousel
/**
 * Custom logo login
 */
add_action("login_head", "st_login_head");
function st_login_head() {
    if (($logo = st_get_setting('login_logo', '')) != '') {
        $w = st_get_setting('width_login_logo', '326') ? st_get_setting('width_login_logo', '326') : '326';
        $h = st_get_setting('height_login_logo', '67') ? st_get_setting('height_login_logo', '67') : '67';
        echo "
    	<style type='text/css'>
            body.login #login h1 {
                text-align: center;
            }
        	body.login #login h1 a {
        		background: url('". $logo ."') no-repeat scroll center top transparent;
        		width: ". $w ."px;
        		height: ". $h ."px;
                display: inline-block;
        	}
    	</style>
    	";    
    }
}
/*  add body class */
function st_theme_layout_mod($classes, $class=''){
    $mod = st_get_setting('page_mod','full-width');
    if($mod==''){
        $mod ='full-width';
    }
    $classes[] = 'layout-'.$mod.'-mod';
    return $classes;
}
add_filter('body_class','st_theme_layout_mod',30,2);
/* titlebar background */
function st_theme_titlebar_bg($list_bg){
   return array(
        'pattern1' => array('img'=>ST_FRAMEWORK_IMG . 'patterns/pattern1.png', 'color'=>'', 'position'=>'','repeat'=>'', 'attachment'=>''),
        'pattern2' => array('img'=>ST_FRAMEWORK_IMG . 'patterns/pattern2.png', 'color'=>'', 'position'=>'','repeat'=>'', 'attachment'=>''),
        'pattern3' => array('img'=>ST_FRAMEWORK_IMG . 'patterns/pattern3.png', 'color'=>'', 'position'=>'','repeat'=>'', 'attachment'=>''),
        'pattern4' => array('img'=>ST_FRAMEWORK_IMG . 'patterns/pattern4.png', 'color'=>'', 'position'=>'','repeat'=>'', 'attachment'=>''),
        'pattern5' => array('img'=>ST_FRAMEWORK_IMG . 'patterns/pattern5.png', 'color'=>'', 'position'=>'','repeat'=>'', 'attachment'=>''),
        'pattern6' => array('img'=>ST_FRAMEWORK_IMG . 'patterns/pattern6.png', 'color'=>'', 'position'=>'','repeat'=>'', 'attachment'=>''),
        'pattern7' => array('img'=>ST_FRAMEWORK_IMG . 'patterns/pattern7.png', 'color'=>'', 'position'=>'','repeat'=>'', 'attachment'=>''),
    );
}
add_filter('st_titlebar_list_bg','st_theme_titlebar_bg');
function st_search_form( $form ) {
    $form = '<form class="form-inline form-search" role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '" >
    <div class="form-group">
    <input class="form-control" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for posts', 'smooththemes' ) . '" />
    </div>
    <input class="btn btn-default" type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'st_search_form' );
if (st_is_woocommerce()) {
    function st_product_search_form( $form ) {
        $form = '<form class="form-inline form-search" role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '" >
        <div class="form-group">
        <input class="form-control" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'smooththemes' ) . '" />
        </div>
        <input class="btn btn-default" type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
        <input type="hidden" name="post_type" value="product" />
        </form>';
    
        return $form;
    }
    
    add_filter( 'get_product_search_form', 'st_product_search_form' );
}
add_filter('stpb_check_template', 'st_test', 30);
function st_test() {
    return true;
}
function st_add_query_vars_filter( $vars ){
  $vars[] = "sidebar";
  return $vars;
}
add_filter( 'query_vars', 'st_add_query_vars_filter' );
// unregister all widgets
function st_unregister_default_widgets() {
    unregister_widget('STRecentPosts');
}
add_action('widgets_init', 'st_unregister_default_widgets', 11);