<?php
/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Twenty Eleven 1.0
 */
function st_menu_setting_add_page() {
	$theme_page = add_theme_page(
		__( 'STMenu Settings', 'smooththemes' ),   // Name of page
		__( 'STMenu Settings', 'smooththemes' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'stsettings',                         // Menu slug, used to uniquely identify the page
		'st_menu_setting_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;

	add_action( "load-$theme_page", 'st_menu_setting_help' );
}
add_action( 'admin_menu', 'st_menu_setting_add_page' );

function st_menu_setting_help() {

	$help = '<p>' . __( 'Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, Twenty Eleven, provides the following Theme Options:', 'twentyeleven' ) . '</p>' .
			'<ol>' .
				'<li>' . __( '<strong>Color Scheme</strong>: You can choose a color palette of "Light" (light background with dark text) or "Dark" (dark background with light text) for your site.', 'twentyeleven' ) . '</li>' .
				'<li>' . __( '<strong>Link Color</strong>: You can choose the color used for text links on your site. You can enter the HTML color or hex code, or you can choose visually by clicking the "Select a Color" button to pick from a color wheel.', 'twentyeleven' ) . '</li>' .
				'<li>' . __( '<strong>Default Layout</strong>: You can choose if you want your site&#8217;s default layout to have a sidebar on the left, the right, or not at all.', 'twentyeleven' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 'twentyeleven' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 'twentyeleven' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://codex.wordpress.org/Appearance_Theme_Options_Screen" target="_blank">Documentation on Theme Options</a>', 'twentyeleven' ) . '</p>' .
		'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'twentyeleven' ) . '</p>';

	$screen = get_current_screen();

	if ( method_exists( $screen, 'add_help_tab' ) ) {
		// WordPress 3.3
		$screen->add_help_tab( array(
			'title' => __( 'Overview', 'twentyeleven' ),
			'id' => 'theme-options-help',
			'content' => $help,
			)
		);

		$screen->set_help_sidebar( $sidebar );
	} else {
		// WordPress 3.2
		add_contextual_help( $screen, $help . $sidebar );
	}
}


/**
 * Returns the settings array
 *
 * Show from settings
 */
function st_menu_setting_render_page() {
	?>
	<div id="stmenusettings" class="wrap">
		<?php screen_icon('options-general'); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( 'stMenu Settings', 'smooththemes' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>
        
        <?php 
            if (isset($_POST['submit']) && isset($_POST['st_menu'])) {
                $data = array();
                foreach($_POST['st_menu'] as $k => $v) {
                    $data['_st-menu-'. $k] = $v;
                }
                if (!isset($_POST['st_menu']['nav_use'])) $data['_st-menu-nav_use'] = '';
                st_menu_update_settings($data);
        ?>
                <div class="updated">
                    <p><strong><?php _e('stMenu Settings Updated', 'smooththemes'); ?></strong></p>
                </div>
        <?php
            }
            
            $st_menu_settings = st_menu_get_settings(); 
            $st_menu_settings['nav_use'] = (isset($st_menu_settings['nav_use']) && $st_menu_settings['nav_use'] != '') ? $st_menu_settings['nav_use'] : array();
        ?>

		<form method="post" action="">
        
            <div id="" class="item-st-menu-setting">
                <h2 class="st-menu-box-title"><?php _e('Show Sub Menu When', 'smooththemes'); ?></h2>
                <div class="item-st-menu-content">
                    <input type="radio" name="st_menu[type]" value="hover" <?php checked( $st_menu_settings['type'], 'hover' ); ?> /> <?php _e('Hover', 'smooththemes'); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="st_menu[type]" value="click" <?php checked( $st_menu_settings['type'], 'click' ); ?> /> <?php _e('Click', 'smooththemes'); ?>
                </div>
            </div>
            
            <div id="" class="item-st-menu-setting">
                <h2 class="st-menu-box-title"><?php _e('Animation', 'smooththemes'); ?></h2>
                <div class="item-st-menu-content">
                    <input type="radio" name="st_menu[effect]" value="slide" <?php checked( $st_menu_settings['effect'], 'slide' ); ?> /> <?php _e('Slide', 'smooththemes'); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="st_menu[effect]" value="fade" <?php checked( $st_menu_settings['effect'], 'fade' ); ?> /> <?php _e('Fade', 'smooththemes'); ?>
                </div>
            </div>
            
            <div id="" class="item-st-menu-setting">
                <h2 class="st-menu-box-title"><?php _e('Animation Speed', 'smooththemes'); ?></h2>
                <div class="item-st-menu-content">
                    <input type="text" name="st_menu[speed]" value="<?php echo (int)$st_menu_settings['speed']; ?>" />&nbsp;&nbsp;<span class="st-menu-item-desc">(Second Mini)</span>
                </div>
            </div>
            
            <div id="" class="item-st-menu-setting">
                <h2 class="st-menu-box-title"><?php _e('Auto Algin Item', 'smooththemes'); ?></h2>
                <div class="item-st-menu-content">
                    <input type="radio" name="st_menu[align]" value="yes" <?php checked( $st_menu_settings['align'], 'yes' ); ?> /> <?php _e('Yes', 'smooththemes'); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="st_menu[align]" value="no" <?php checked( $st_menu_settings['align'], 'no' ); ?> /> <?php _e('No', 'smooththemes'); ?>
                </div>
            </div>
            
            <div id="" class="item-st-menu-setting">
                <h2 class="st-menu-box-title"><?php _e('Load Style Default', 'smooththemes'); ?></h2>
                <div class="item-st-menu-content">
                    <input type="radio" name="st_menu[style]" value="yes" <?php checked( $st_menu_settings['style'], 'yes' ); ?> /> <?php _e('Yes', 'smooththemes'); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="st_menu[style]" value="no" <?php checked( $st_menu_settings['style'], 'no' ); ?> /> <?php _e('No', 'smooththemes'); ?>
                </div>
            </div>
            
            <div id="" class="item-st-menu-setting">
                <h2 class="st-menu-box-title"><?php _e('Nav Menu With Megamenu', 'smooththemes'); ?></h2>
                <div class="item-st-menu-content">
                    <?php
                        $nav_menu = get_registered_nav_menus();
                        foreach($nav_menu as $k => $v) {
                            echo '<input type="checkbox" name="st_menu[nav_use][]" value="'. $k .'" '. checked( in_array($k, $st_menu_settings['nav_use']), true, false ) .' />&nbsp;&nbsp;'. $v .'&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                    ?>
                </div>
            </div>
            
			<?php
				//settings_fields( 'twentyeleven_options' );
//				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


/**
 * @return settings array
 */
function st_menu_get_settings() {
    $key = array(
        'type' => '_st-menu-type',
        'effect' => '_st-menu-effect',
        'speed' => '_st-menu-speed',
        'align' => '_st-menu-align',
        'style' => '_st-menu-style',
        'nav_use' => '_st-menu-nav_use'
    );
    
    $default = array(
        'type' => 'hover',
        'effect' => 'slide',
        'speed' => 600,
        'align' => 'no',
        'style' => 'yes',
        'nav_use' => ''
    );
    
    $value = array();
    
    foreach($key as $k => $v) {
        $value[$k] = get_option($v, $default[$k]);
    }
    
    return $value;
}

/**
 * 
 */
function st_menu_update_settings($data) {
    foreach($data as $k => $v) {
        update_option($k, $v);
    }
    return true;
}

// check









