<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<!--// Meta Specific //-->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <!--// Mobile Specific //-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />
    <!--// Title Tags //-->
    <title>
    <?php
        /*
         * Print the <title> tag based on what is being viewed.
         */
        global $page, $paged;
        wp_title( '|', true, 'right' );
        // Add the blog name.
        bloginfo( 'name' );
        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', 'smooththemes' ), max( $paged, $page ) );
    ?>
    </title>
    <!--// Browser Specical Files //-->
     
    <!--// Browser Specical CSS //-->
    <!--[if IE 8]><link href="<?php echo st_css('ie8.css'); ?>" rel="stylesheet" type="text/css" /><![endif]-->
    <!--// Site Favicon //-->
    <?php if(''!=st_get_setting('site_favicon','')): ?>
        <link rel="shortcut icon" href="<?php echo esc_attr(st_get_setting('site_favicon')); ?>" />
    <?php endif; ?>
    
    <!--// WP HEAD //-->
    <?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo st_js('html5shiv.js'); ?>"></script>
      <script src="<?php echo st_js('respond.min.js'); ?>"></script>
    <![endif]-->
</head>
<body <?php body_class(); ?>>
	
<div class="page-outer-wrapper">
	<header class="header-outer-container">
    <script>
    (function($) {
        $(window).scroll(function () {
            var topPage = $(window).scrollTop();
            if(topPage > 5) {
                $('.main-nav-outer-wrapper').css({'position': 'fixed', 'top': '0px', 'z-index': '69'});
            }else{
                $('.main-nav-outer-wrapper').removeAttr('style');
            }
        });
    }(jQuery));
    </script>
        <?php if (st_get_setting('show_topbar_left_widget', 'y') != 'n' || st_get_setting('show_topbar_right_widget', 'y') != 'n' ){ ?>
		<div class="topbar-outer-wrapper sidebar">
			<div class="container">
				<div class="row">
                    <div class="topbar-wrapper clearfix col-lg-12 col-md-12">
                        <?php  if (st_get_setting('show_topbar_left_widget', 'y') != 'n') { ?>
    					<div class="topbar-left topbar pull-left  column max-width">
    						<?php
                            dynamic_sidebar('topbar_left_widget');
                            ?>
    					</div> <!-- /.topbar-left -->
                        <?php } ?>
                        <?php  if (st_get_setting('show_topbar_right_widget', 'y') != 'n') { ?>
    					<div class="topbar-right topbar text-right pull-right column max-width">
                            <?php
                            dynamic_sidebar('topbar_right_widget');
                            ?>
    					</div> <!-- /.topbar-right -->
                        <?php } ?>
    				</div> <!-- /.topbar-wrapper-->
                </div>
			</div>
		</div> <!-- /.topbar-outer-wrapper -->
        <?php } ?>
        <div class="header-wrapper clearfix">
            <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 clearfix">
                            <div class="header-left pull-left max-width">
    
                                <div class="site-logo">
                                    <a href="<?php echo site_url(); ?>">
                                        <?php if(st_get_setting("site_logo")!=''): ?>
                                        <img src="<?php echo esc_attr(st_get_setting("site_logo")); ?>" alt="<?php  bloginfo('name'); ?>"/></a>
                                    <?php else: ?>
                                        <span class="no-logo"><?php bloginfo('name'); ?></span>
                                    <?php  endif; ?>
                                    </a>
                                </div>
    
                            </div><!-- /.header-left -->
    
                            <div class="header-right pull-right max-width">
                            
                                <?php
                                wp_nav_menu( array(
                                        'theme_location' => 'Top_Navigation',
                                        'menu_class' => 'nav-menu menu' ,
                                        'menu_id' =>'nav-menu',  //This is Menu Primary ID
                                        'container_id'=>'menu-top',  //This is Mega Menu Container
                                        'fallback_cb'     => '',
                                        'container_class'=>'pull-left'
                                    ) );
                                ?>
                                
                                <?php 
                                $hphone_number = st_get_setting('phone_number');
                                $hdescription = st_get_setting('hdescription');
                                if ( $hphone_number || $hdescription ) { ?>
                                <div id="phone" class="hidden-sm hidden-xs"><strong><?php echo $hphone_number; ?> </strong><?php echo $hdescription; ?></div>
                                <?php } ?>
    
                            </div> <!-- /.header-right -->
                        </div>
                    </div>
            </div> <!-- /.container -->
        </div> <!-- /.header-wrapper -->
		<div class="main-nav-outer-wrapper">
        
			<div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="man-nav-wrapper clearfix">
                                <div class="">
                                <?php
                                if (st_is_megamenu_active()) {
                                    wp_nav_menu( array(
                                        'theme_location' => 'Primary_Navigation',
                                        'menu_class' => 'main-menu' ,
                                        'menu_id' =>'megaST', // This is Mega Menu ID
                                        'container_id'=>'megaMenu', // This is Mega Menu Container,
                                        'fallback_cb'     => 'st_wp_page_menu',
                                        'walker'=> new st_responsive_mega_menu()
                                    ) );
                                }
                                else {
                                    ?>
                                    <a href="#" id="primary-nav-mobile-a" class="primary-nav-close">
                                        <span></span>
                                        <?php _e('Main Navigation', 'smooththemes'); ?>
                                    </a>
                                    <nav id="primary-nav-mobile"></nav>
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'Primary_Navigation',
                                        'menu_class' => 'nav-menu menu' ,
                                        'menu_id' =>'nav-menu',  //This is Menu Primary ID
                                        'container_id'=>'primary-nav-id',  //This is Mega Menu Container
                                        'fallback_cb'     => '',
                                        'container_class'=>'pull-left primary-nav slideMenu'
                                    ) );
                                } 
    
                                ?>
                                </div>
    
                                <?php if(st_is_woocommerce()){ ?>
                                <div class="pull-right woocommerce-cart hide">
                                    <?php if(function_exists('st_wc_cart_icon')){ st_wc_cart_icon(); }  ?>
                                </div>
                                <?php } ?>
    
                            </div>
                        </div>
                    </div>
			</div>
		</div><!--// #END main-nav -->
	</header> <!--// #END header-outer-container //-->