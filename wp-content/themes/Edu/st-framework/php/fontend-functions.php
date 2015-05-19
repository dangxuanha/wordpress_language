<?php
/**
 * stFramework
 *
 * This is description
 *
 * @author		SmoothThemes
 * @copyright	Copyright (c) SmoothThemes
 * @link		http://www.SmoothThemes.com
 * @since		Version 1.0
 * @package 	stFramework
 * @version 	1.0
*/ 
if (!function_exists('st_is_megamenu_active')) {
    function st_is_megamenu_active() {
        return is_plugin_active('stMegaMenu/stmenu.php');    
    }
} 
if (!function_exists('st_get_setting')) {
    /**
     * @param $name key theme option
     * @return return value of key
     */ 
    function st_get_setting($name, $default= false){
        global $st_options;
        return (isset($st_options[$name])  && !empty($st_options[$name])) ?  $st_options[$name] :  $default;
    }
}
if(!function_exists('st_hex2rgb')){
    /**
     * Conver Hex color to RGB
     * @param unknown $hex
     * @return multitype:number
     */
    function st_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);
        $r=  $g=  $b= 255;
        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
}
if(!function_exists('st_hex2rgba')){
    /**
     * Hex color to rgba
     * @param color $hex
     * @param number $alpha 0-1;
     * @return string;
     */
    function st_hex2rgba($hex, $alpha=1){
        $rgb =  hex2rgb($hex);
        $rgb[] = $alpha;
        return  join(', ',$rgb);
    }
}
if(!function_exists('st_hex2argb')){
    /**
     * Hex color to rgba
     * @param unknown $hex
     * @param number $alpha 0-1;
     * @return string;
     */
    function st_hex2argb($hex, $alpha=1){
        $hex = str_replace("#", "", $hex);
        $alpha = dechex($alpha*255);
        return $alpha.$hex;
    }
}
if (!function_exists('st_parse_font')) {
    /**
     * parse Font
     * @return array
    */
    function st_parse_font($font_url){
        $font_url  = urldecode($font_url);
        $args =  parse_url($font_url);
        $return = array('is_g_font'=> false, 'name'=>$font_url,'link'=>'');

        $args = wp_parse_args($args, array(
            'host'=>'',
            'query'=>''
        ));

        $font_data = wp_parse_args($args['query'], array('family'=>'','subset'=>''));

        if(($args['host']=='fonts.googleapis.com' || strpos($args['path'],'fonts.googleapis')!==false ) && $font_data['family']!='' ){
            //  echo var_dump($args) ; die();

            if(strpos($font_data['family'],':')!==false){
                $font_data['family'] = explode(':',$font_data['family']);
                $font_data['family'] =  (isset($font_data['family'][0])  && $font_data['family'][0]!='') ? $font_data['family'][0]  : '';
            }else{

            }

            if($font_data['family']!=''){
                $return['name'] = $font_data['family'];
                $return['is_g_font'] = true;
                $return['link'] = $font_url;
            }
        }

        return $return;
    }
}
if (!function_exists('st_make_font_style')) {
    /**
     * make font style
     * Only use for header.php file
    */
    function st_make_font_style($font,$css_selector,$show_font_size= true){
        if($font['font-family']!=''){
            $font_data = st_parse_font($font['font-family']);
        ?>
        <?php if($font_data['is_g_font']==true) : ?>
        <link href='<?php echo  $font_data['link'] ?>' rel='stylesheet' type='text/css'>
        <?php endif; ?>
        
        <style type="text/css">
        <?php echo $css_selector; ?>{
            font-family: '<?php echo $font_data['name']; ?>'; 
            <?php if(isset($font['font-style']) && $font['font-style']): ?>
            font-style: <?php echo $font['font-style']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-style']) && $font['font-style']): ?>
            font-style: <?php echo $font['font-style']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-weight']) && $font['font-weight']): ?>
            font-weight: <?php echo $font['font-weight']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-size']) && $font['font-size']): ?>
            font-size: <?php echo intval($font['font-size']); ?>px;
            <?php endif; ?>
            <?php if(isset($font['line-height']) && $font['line-height']): ?>
            line-height: <?php echo intval($font['line-height']); ?>px;
            <?php endif; ?>
            <?php if(isset($font['color'])  && $font['color']): ?>
            color: #<?php echo $font['color']; ?>;
            <?php endif; ?>
            
        }
        </style>
        <?php
        }
    }
}
if(!function_exists('st_is_color')){
    function st_is_color($hex_color){
        return  (preg_match('/^#[a-f0-9]{6}$/i', $hex_color) || preg_match('/^[a-f0-9]{6}$/i', $hex_color));
    }
}
if(!function_exists('st_bg')){
    /**
     * Create background style
     * @param array $args
     *      img
     *      color
     *      position : tl|tc|tr|cc|bl|bc|br
     *      repeat
     *      attachment
     * @return string style
     */
    function st_bg($args){
        $args = wp_parse_args($args, array(
            'img'=>'',
            'color'=>'',
            'position'=>'',
            'repeat'=>'',
            'attachment'=>''
        ));
        $style  ='';
        extract($args);
        if(st_is_color($color)){
            if(strpos($color,'#')===false){
                $color ='#'.$color;
            }
            $style .= $color;
        }
        if($img!=''){
            $style  .= ' url('.esc_url($img).') ';
            switch(strtolower($position)){
                case 'tl':
                    $style.=' top left ';
                    break;
                case 'tr':
                    $style.=' top right ';
                    break;
                case 'tc':
                    $style.=' top center ';
                    break;
                case 'cc':
                    $style.=' center center';
                    break;
                case 'bl':
                    $style.=' bottom left ';
                    break;
                case 'br':
                    $style.=' bottom right ';
                    break;
                case 'bc':
                    $style.=' bottom center ';
                    break;
                default:
                    $style.=' top left ';
                    break;
            }
            if($repeat!=''){
                $style .=' '.$repeat;
            }
            if($attachment!=''){
                $style .=' '.$attachment;
            }
        }
        return ($style!='') ? "background: $style; " : '';
    }
}
if (!function_exists('st_theme_body_bg')) {
    /**
     * Set back ground for body
     * hook  wp_head
    */
    function st_theme_body_bg(){
    // For background settings
        $bg_type  = st_get_setting("bg_type",'d');
        if($bg_type=='d'){
              $bg = st_get_setting("defined_bg",'background1.jpg');
              // large image with fixed
              if(in_array($bg,array('background1.jpg'))){
                  $bg = ST_FRAMEWORK_IMG .'patterns/'.$bg;
                   $style ='background: url("'.$bg.'") no-repeat fixed center center / cover  transparent;';
              }else{
                  $bg = ST_FRAMEWORK_IMG .'patterns/'.$bg;
                  $style ='background: url("'.$bg.'") repeat  center center ';
              }
              
              echo '<style type="text/css">body {'.$style.' }</style>';
             return ;
        }elseif($bg_type=='c'){
             $bg = st_get_setting("defined_bg_color");
             if($bg!=''){
                 echo '<style type="text/css">body {background: #'.$bg.'; }</style>';
             }
             return ;
        }
        
        // if is custom background
        $options = array(
            'img'=>'',
            'color'=>'',
            'position'=>'',
            'repeat'=>'',
            'attachment'=>''
        );
    
        $bd_style=  false;
        $args =  array();
        foreach($options as $k => $v){
            $args[$k] =  st_get_setting('bg_'.$k);
        }
        $bd_style =  st_bg($args);
        
        if($bd_style){
            echo '<style type="text/css">body { '.$bd_style.'; }</style>';
        }
    }
}
if (!function_exists('st_theme_head_bg')) {
    /**
     * Set back ground for body
     * hook  wp_head
    */
    function st_theme_head_bg(){
    // For background settings
        $bg_type  = st_get_setting("hbg_type",'d');
        if($bg_type=='d'){
              $bg = st_get_setting("hdefined_bg",'background1.jpg');
              // large image with fixed
              if(in_array($bg,array('background1.jpg'))){
                  $bg = ST_FRAMEWORK_IMG .'patterns/'.$bg;
                   $style ='background: url("'.$bg.'") no-repeat fixed center center / cover  transparent;';
              }else{
                  $bg = ST_FRAMEWORK_IMG .'patterns/'.$bg;
                  $style ='background: url("'.$bg.'") repeat  center center ';
              }
              
              echo '<style type="text/css"> #megaMenu #menuMobile .no-megamenu ul, #megaMenu #megaST .no-megamenu ul, .header-wrapper, .main-nav-outer-wrapper .slideMenu .menu ul, #primary-nav-mobile-id > li > ul.sub-menu, #megaMenu #megaST li.menu-item-depth-0 .nav-dd, body .st-cart-icon .cart-content .widget_shopping_cart_content, #megaMenu #menuMobile .nav-dd, #megaMenu #megaST li.menu-item-language ul, #menu-top li.menu-item-language ul {'.$style.' }</style>';
             return ;
        }elseif($bg_type=='c'){
             $bg = st_get_setting("hdefined_bg_color");
             if($bg!=''){
                 echo '<style type="text/css"> #megaMenu #menuMobile .no-megamenu ul, #megaMenu #megaST .no-megamenu ul, .header-wrapper, .main-nav-outer-wrapper .slideMenu .menu ul, #primary-nav-mobile-id > li > ul.sub-menu, #megaMenu #megaST li.menu-item-depth-0 .nav-dd, body .st-cart-icon .cart-content .widget_shopping_cart_content, #megaMenu #menuMobile .nav-dd , #megaMenu #megaST li.menu-item-language ul, #menu-top li.menu-item-language ul{background: #'.$bg.'; }</style>';
             }
             return ;
        }
        
        // if is custom background
        $options = array(
            'img'=>'',
            'color'=>'',
            'position'=>'',
            'repeat'=>'',
            'attachment'=>''
        );
    
        $bd_style=  false;
        $args =  array();
        foreach($options as $k => $v){
            $args[$k] =  st_get_setting('hbg_'.$k);
        }
        $bd_style =  st_bg($args);
        if($bd_style){
            echo '<style type="text/css">#megaMenu #menuMobile .no-megamenu ul, #megaMenu #megaST .no-megamenu ul, .header-wrapper, .main-nav-outer-wrapper .slideMenu .menu ul, #primary-nav-mobile-id > li > ul.sub-menu, #megaMenu #megaST li.menu-item-depth-0 .nav-dd, body .st-cart-icon .cart-content .widget_shopping_cart_content, #megaMenu #menuMobile .nav-dd, #megaMenu #megaST li.menu-item-language ul, #menu-top li.menu-item-language ul { '.$bd_style.'; }</style>';
        }
    }
}
if (!function_exists('st_theme_style')) {
    function st_theme_style(){
        $font_body = st_get_setting("body_font",array('font-family'=>'Roboto'));
        $heading_font = st_get_setting("headings_font",array('font-family'=>'Roboto'));
        st_make_font_style($font_body,'body');
        st_make_font_style($heading_font,'h1,h2,h3,h4,h5,h6');
        // Predefined Colors (pc) - Custom Color (cc)
        $pc   = st_get_setting("predefined_colors");
        $e_cc = st_get_setting("enable_custom_global_skin");
        $skin_type   =  st_get_setting("skin_type",'c');
        $skin_color   =  st_get_setting("skin_color",'006e92');
        $cc   =  st_get_setting("custom_global_skin",'006e92');
        $e_cc= 'y';
        $skin ='';
        if($e_cc=='y'){
            $skin = ($cc!='') ?  $cc : $pc;
        }elseif($pc!=''){
            $skin = $pc;
        }
        
        if ($skin_type == 'custom') {
            $skin = $skin_color;
        }
        
        $skin = str_replace('#','',esc_attr($skin));
        $skin = ($skin!='') ? $skin : '006e92'; // default skin
        $skin = apply_filters('st_theme_style_skin', $skin);
        $skin ='#'.$skin;
        $link =  st_get_setting('link');
        $link_hover = st_get_setting('link_hover');
        $link_style ='';
        if($link!=''){
            $link_style.="  
                /* Accodion + Toogle */
                .panel-default .panel-heading .acc-title a.collapsed,
                .panel-default .panel-heading .acc-title a.collapsed i,
                a{ color: #{$link}; } 
            ";
        }
        if($link_hover!=''){
            $link_style.="
                .sidebar .menu li.current-menu-item > a, a:hover { color: #{$link_hover}; } 
            ";
        }
?>    
<style type="text/css">
    <?php echo $link_style;  ?>
        
        /* Main Menu */
        .main-nav-outer-wrapper {
            background:<?php echo $skin; ?>;
        	/* Old browsers */
        	background:<?php echo $skin; ?> -moz-linear-gradient(top,rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%);
        	/* FF3.6+*/
        	background:<?php echo $skin; ?> -webkit-gradient(linear,left top,left bottom,color-stop(0%,rgba(255,255,255,.2)),color-stop(100%,rgba(0,0,0,.2)));
        	/* Chrome,Safari4+*/
        	background:<?php echo $skin; ?> -webkit-linear-gradient(top,rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%);
        	/* Chrome10+,Safari5.1+*/
        	background:<?php echo $skin; ?> -o-linear-gradient(top,rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%);
        	/* Opera11.10+*/
        	background:<?php echo $skin; ?> -ms-linear-gradient(top,rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%);
        	/* IE10+*/
        	background:<?php echo $skin; ?> linear-gradient(top,rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%);
        }
        
        /* Box Icon in Megamenu */
        #megaMenu #menuMobile li.menu-item-depth-0 .nav-dd .icon-menu a:hover, 
        #megaMenu #megaST li.menu-item-depth-0 .nav-dd .icon-menu a:hover,
        /* Item Title Tab in Megamenu */
        #megaMenu #menuMobile .nav-dd ul.nav-tabs li.active a,
        #megaMenu #megaST .nav-dd ul.nav-tabs li.active a,
        /* Pagination */
        .pagination > .active > a, 
        .pagination > .active > span, 
        .pagination > .active > a:hover, 
        .pagination > .active > span:hover, 
        .pagination > .active > a:focus, 
        .pagination > .active > span:focus,
        /* Box Service */
        .box-style-2 a,
        /* Widget Tag Clound */
        .widget_tag_cloud a:hover,
        /* Button Color */
        .btn-color:hover,
        #megaMenu #megaST li.menu-item-depth-0 .nav-dd a.btn-color:hover,
        /* Button Default */
        .btn-default,
        a.btn-default,
        #megaMenu #megaST li.menu-item-depth-0 .nav-dd a.btn-default,
        /* Button Control */
        #respond #submit,
        #commentform #submit,
        
        /* Accodion + Toogle */
        .panel-default .panel-heading .acc-title a,
        .panel-default .panel-heading .acc-title a:hover,
        
        /**/
        .st-testimonial-slider.carousel .carousel-indicators li.active,
        .carousel-indicators .active,
        ul.submenu-col li.active a
        {
            background-color: <?php echo $skin; ?>;
        }
        
        /* Price Filter Handle */
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
        .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle
        {
            background: <?php echo $skin; ?> !important;
        }
        
        /* Start Rating */
        .woocommerce .products .star-rating, 
        .woocommerce-page .products .star-rating,
        .color-icon,  .text-color,
        
        /* */
        .carousel-control .icon-prev, .carousel-control .icon-next
        { 
            color: <?php echo $skin; ?>; 
        }
        
        /* Pagination */
        .pagination>.active>a, 
        .pagination>.active>span, 
        .pagination>.active>a:hover, 
        .pagination>.active>span:hover, 
        .pagination>.active>a:focus, 
        .pagination>.active>span:focus
        {
            border-color: <?php echo $skin; ?>;
        }
        
        .bg-color:hover, 
        .bg-parent-hover:hover .bg-color, 
        .opened .bg-color , 
        .st-carousel-w .prev, 
        .st-carousel-w .next, 
        .caro-pagination a
        {
    
        }
    
    <?php
    // for logo settings
    $lg_pdt=  st_get_setting('site_logo_pd_top','');
    $lg_pdb=  st_get_setting('site_logo_pd_bot','');
    $logo_style='';
    if($lg_pdt!=''){
        $lg_pdt = intval($lg_pdt);
        $logo_style.= ' padding-top: '.$lg_pdt.'px; ';
    }
    if($lg_pdb!=''){
        $lg_pdb = intval($lg_pdb);
        $logo_style.= ' padding-bottom: '.$lg_pdb.'px;';
    }
    if($logo_style!=''){
        echo " .site-logo { {$logo_style} } ";
    }
     ?>
    <?php
    for($i=1; $i<=6; $i++){
         $h = st_get_setting("heading_".$i,array());
         if(intval($h['font-size'])>0){
            echo "h{$i}{ font-size: ".intval($h['font-size'])."px;} \n";
         }
    }
    ?>
</style>
<?php
    }
}
// add to wp_head
add_action('wp_head','st_theme_style',90);
add_action('wp_head','st_theme_body_bg',91);
add_action('wp_head','st_theme_head_bg',92);
if (!function_exists('st_header_tracking_code')) {
    function st_header_tracking_code(){
        $code = st_get_setting('headder_tracking_code','');
        $code = stripslashes($code);
        if(is_string($code)){
             echo $code;
        }
    }
}
if (!function_exists('st_footer_tracking_code')) {
    function st_footer_tracking_code(){
        $code = st_get_setting('footer_tracking_code','');
        $code = stripslashes($code);
        if(is_string($code)){
             echo $code;
        }
    }
}
add_action('wp_head','st_header_tracking_code',123);
add_action('wp_footer','st_footer_tracking_code',123);