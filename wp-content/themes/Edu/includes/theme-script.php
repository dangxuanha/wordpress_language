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
#-----------------------------------------------------------------
# Enqueue Style
#-----------------------------------------------------------------
if( !function_exists('st_enqueue_styles')) {
	function st_enqueue_styles() {
		if(!is_admin()) {
		    $enqueue_style_ar = array(
                'bootstrap'     => array(
                                            'src'   => st_css('bootstrap.css'),
                                            'deps'  => false,
                                            'ver'   => '3.0',
                                            'media' => 'all'
                                    ),
                'st_menu'      => array(
                                            'src'   => st_css('stmenu.css'),
                                            'deps'  => false,
                                            'ver'   => '1.0',
                                            'media' => 'all'
                                    ),
                'jquery-ui'     => array(
                                            'src'   => ST_FRAMEWORK_CSS."smoothness/jquery-ui-1.7.3.custom.css",
                                            'deps'  => false,
                                            'ver'   => '1.7.3',
                                            'media' => 'all'
                                    ),
                'st_style'      => array(
                                            'src'   => get_bloginfo( 'stylesheet_url' ),
                                            'deps'  => false,
                                            'ver'   => '1.0',
                                            'media' => 'all'
                                    ),
                'st_toolkit'   => array(
                                            'src'   => st_css('sttoolkit.css'),
                                            'deps'  => false,
                                            'ver'   => '1.0',
                                            'media' => 'all'
                                    ),
                'magnific-popup' => array(
                                            'src'   => st_css('magnific-popup.css'),
                                            'deps'  => false,
                                            'ver'   => '1.0',
                                            'media' => 'all'
                                    )
            );
            
			foreach($enqueue_style_ar as $handle => $enqueue) {
                wp_enqueue_style($handle, $enqueue['src'], $enqueue['deps'], $enqueue['ver'], $enqueue['media'] );
			}
            
			if(st_is_woocommerce()){
                if(is_file(ST_THEME_DIR.'woocommerce/assets/css/woocommerce.css')){
                    wp_dequeue_style('woocommerce_frontend_styles');
                    wp_enqueue_style('woocommerce_frontend_styles', ST_THEME_URL.'woocommerce/assets/css/woocommerce.css'  );
                }
			}
			 
		}
	}
}
#-----------------------------------------------------------------
# Enqueue Scripts
#-----------------------------------------------------------------
if(!function_exists('st_enqueue_scripts')) {
	function st_enqueue_scripts() {
		if(!is_admin()) {
            wp_enqueue_script('jquery');
            $enqueue_scripts = array(
                'bootstrap'         => array(
                                                'src'       => st_js('bootstrap.min.js'),
                                                'deps'      => array(),
                                                'ver'       => '3.0',
                                                'in_footer' => true,
                                       ),
                'ddsmoothmenu'      => array(
                                                'src'       => st_js('ddsmoothmenu.js'),
                                                'deps'      => array(),
                                                'ver'       => '1.5',
                                                'in_footer' => true,
                                       ),
                'edu-custom'       => array(
                                                'src'       => st_js('custom.js'),
                                                'deps'      => array(),
                                                'ver'       => '1.0',
                                                'in_footer' => true,
                                       )
            );
            wp_enqueue_script('jquery-ui-datepicker');
            
            foreach($enqueue_scripts as $handle => $enqueue) {
                wp_enqueue_script($handle, $enqueue['src'], $enqueue['deps'], $enqueue['ver'], $enqueue['in_footer'] );
			}
            if ( is_singular() && get_option( 'thread_comments' ) ){
                wp_enqueue_script( 'comment-reply' );
            }
		}
	}
}
add_action('wp_print_styles','st_enqueue_styles',99);
add_action('wp_print_scripts','st_enqueue_scripts',99);
