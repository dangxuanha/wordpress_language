<?php  if ( ! defined('ST_STMENU_ACTIVE')) exit('No direct script access allowed');
/**
 * This file holds various classes and methods necessary to hijack the wordpress menu and improve it with mega menu capabilities
 *
 *
 * @author		MichaleKing
 * @copyright	Copyright (c) MichaleKing
 * @link		http://smooththemes.com
 * @link		* @link		http://smooththemes.com
 * @since		Version 1.0
 * @package 	stMenu
 */

if( !class_exists( 'st_megamenu' ) )
{	

	/**
	 * The st megamenu class contains various methods necessary to create mega menus out of the admin backend
	 */
	class st_megamenu
	{
		
		/**
		 * st_megamenu constructor
		 * The constructor uses wordpress hooks and filters provided and 
		 * replaces the default menu with custom functions and classes within this file
		 */
		function st_megamenu()
		{
		
			//exchange arguments and tell menu to use the st walker for front end rendering
			add_filter('wp_nav_menu_args', array(&$this,'modify_arguments'), 100);
			
			//exchange argument for backend menu walker
			add_filter('wp_edit_nav_menu_walker', array(&$this,'modify_backend_walker') , 100);
			
			//save st options:
			add_action('wp_update_nav_menu_item', array(&$this,'update_menu'), 100, 3);
            
            
            add_filter('wp_setup_nav_menu_item', array(&$this,'setup_menu'), 100 );
            
            
            add_filter('manage_nav-menus_columns', array(&$this,'menu_manage_columns'), 9999);
  	
		}
	
	
		/**
		 * Replaces the default arguments for the front end menu creation with new ones
		 */
		function modify_arguments($args){
		    $nav_menus = (array)get_option('_st-menu-nav_use', '');
            if (in_array($args['theme_location'], $nav_menus) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args['theme_location'] ] )) {
                $walker = apply_filters("st_mega_menu_walker", "st_responsive_mega_menu");
                // Call Custom Menu Walker
                $args['walker']             = new $walker();
				$args['menu_id'] 		    = 'megaST';
        		$args['container_id'] 	    = 'megaMenu';
                $args['menu_class']         = 'main-menu';
            }
			return $args;
		}
		
		
		/**
		 * Tells wordpress to use our backend walker instead of the default one
		 */
		function modify_backend_walker($name)
		{
			return 'st_backend_walker';
		}

		
		/**
		 * Save and Update the Custom Navigation Menu Item Properties by checking all $_POST vars with the name of $check
		 * @param int $menu_id
		 * @param int $menu_item_db
		 */
		function update_menu($menu_id, $menu_item_db)
		{
			$check = array(
                'megamenu',
                'title-megamenu',
                'disable-text',
                'caption-megamenu',
                'wrapcolumn-megamenu',
                'division-megamenu',
                'autop-megamenu'
            );
			
			foreach ( $check as $key )
			{
				if(!isset($_POST['menu-item-st-'.$key][$menu_item_db]))
				{
					$_POST['menu-item-st-'.$key][$menu_item_db] = "";
				}
				if ($key === '') {
				    $value = balanceTags($_POST['menu-item-st-'.$key][$menu_item_db]);
				}
                else
                {
                    $value = $_POST['menu-item-st-'.$key][$menu_item_db];    
                }
				update_post_meta( $menu_item_db, '_menu-item-st-'.$key, $value );
			}
		}
        
        /**
         * Adds value of new field to $item object that will be passed to Walker_Nav_Menu_Edit_Custom
         * @param menu item $menu_item
         * @param menu item $menu_item
         */
        function setup_menu($menu_item)
        {
            $menu_item->st_megamenu = get_post_meta( $menu_item->ID, '_menu-item-st-megamenu', true );
            $menu_item->st_title_megamenu = get_post_meta( $menu_item->ID, '_menu-item-st-title-megamenu', true );
            $menu_item->st_disable_text = get_post_meta( $menu_item->ID, '_menu-item-st-disable-text', true );
            $menu_item->st_caption_megamenu = get_post_meta( $menu_item->ID, '_menu-item-st-caption-megamenu', true );
            $menu_item->st_wrapcolumn_megamenu = ($v = get_post_meta( $menu_item->ID, '_menu-item-st-wrapcolumn-megamenu', true )) ? $v : 0;
            $menu_item->st_division_megamenu = get_post_meta( $menu_item->ID, '_menu-item-st-division-megamenu', true );
            $menu_item->st_autop_megamenu = get_post_meta( $menu_item->ID, '_menu-item-st-autop-megamenu', true );
            $menu_item->st_align_submenu_megamenu = get_post_meta( $menu_item->ID, '_menu-item-st-align-submenu-megamenu', true );
            return $menu_item;
        }
        
        /**
         * Returns the columns for the nav menus page.
         *
         * @since 3.0.0
         *
         * @return string|WP_Error $output The menu formatted to edit or error object on failure.
         */
        function menu_manage_columns() {
        	return array(
        		'_title' => __('Show advanced menu properties'),
        		'cb' => '<input type="checkbox" />',
        		'link-target' => __('Link Target'),
        		'css-classes' => __('CSS Classes'),
        		'xfn' => __('Link Relationship (XFN)')
        	);
        }
        
	}
    
    new st_megamenu();
}


if( !class_exists( 'st_backend_walker' ) )
{
/**
 * Create HTML list of nav menu input items. 
 * This walker is a clone of the wordpress edit menu walker with some options appended, so the user can choose to create mega menus
 *
 * @package stFramework
 * @since 1.0
 * @uses Walker_Nav_Menu
 */
	class st_backend_walker extends Walker_Nav_Menu  
	{
		/**
		 * @see Walker_Nav_Menu::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int $depth Depth of page.
		 */
		function start_lvl(&$output, $depth = 0, $args = array()) {}
	
		/**
		 * @see Walker_Nav_Menu::end_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int $depth Depth of page.
		 */
		function end_lvl(&$output, $depth = 0, $args = array()) {
		}
	
		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);
	
			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = $original_object->post_title;
			}
	
			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);
	
			$title = $item->title;
	
			if ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( __('%s (Pending)'), $item->title );
			}
            
            if (($depth === 1 || $depth === 2) && $item->st_title_megamenu === 'active') {
                $classes[] = 'st-use-title-active';
            }
	
			$title = empty( $item->label ) ? $title : $item->label;
			
			$itemValue = "";
			if($depth == 0)
			{
				if($item->st_megamenu != "") $itemValue = 'st-mega-active ';
			}
			?>
			
			<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo $itemValue; echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><?php echo esc_html( $title ); ?></span>
						<span class="item-controls">
							<span class="item-type item-type-default"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-type item-type-st"><?php _e('Column'); ?></span>
							<span class="item-type item-type-megafied"><?php _e('(Mega Menu)'); ?></span>
							<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php _e('Edit Menu Item'); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php _e( 'Edit Menu Item' ); ?></a>
						</span>
                        
                        <?php if (ST_STMENU_STATUS===0) : ?>
                        <a style="color: red;" class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php _e('Remove'); ?></a>
                        <?php endif; ?>
                        
					</dt>
				</dl>
	
				<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php _e( 'URL' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin description-label st_label_desc_on_active">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<span class='st_default_label'><?php _e( 'Navigation Label' ); ?></span>						
							<br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin description-title">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php _e( 'Title Attribute' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description description-thin">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<?php _e( 'Link Target' ); ?><br />
							<select id="edit-menu-item-target-<?php echo $item_id; ?>" class="widefat edit-menu-item-target" name="menu-item-target[<?php echo $item_id; ?>]">
								<option value="" <?php selected( $item->target, ''); ?>><?php _e('Same window or tab'); ?></option>
								<option value="_blank" <?php selected( $item->target, '_blank'); ?>><?php _e('New window or tab'); ?></option>
							</select>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
							<?php _e( 'CSS Classes (optional)' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
							<?php _e( 'Link Relationship (XFN)' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
                    
                    <!-- ST custom code here -->
                    <p class="field-st-caption-megamenu st-caption-megamenu description-wide">
						<label for="edit-menu-item-st-caption-megamenu-<?php echo $item_id; ?>">
							<?php _e( 'Caption' ); ?><br />
							<input type="text" id="edit-menu-item-st-caption-megamenu-<?php echo $item_id; ?>" class="widefat code edit-menu-item-st-caption-megamenu" name="menu-item-st-caption-megamenu[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->st_caption_megamenu ); ?>" />
						</label>
					</p>
                    <!-- end ST custom code here -->
                    
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php _e( 'Description' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->post_content ); ?></textarea>
						</label>
                        <p class="field-st-autop-megamenu st-autop-megamenu description-wide">
							<label for="edit-menu-item-st-autop-megamenu-<?php echo $item_id; ?>">
								<input type="checkbox" value="active" id="edit-menu-item-st-autop-megamenu-<?php echo $item_id; ?>" class="code menu-item-st-autop-megamenu edit-menu-item-st-autop-megamenu" name="menu-item-st-autop-megamenu[<?php echo $item_id; ?>]" <?php echo ($item->st_autop_megamenu != "") ? 'checked="checked"' : ''; ?> />
                                <?php _e( 'Auto add paragraph' ); ?>
							</label>
						</p>
						<!-- ***************  end item *************** -->
					</p>
					
                    <!-- ST custom code here -->
					<div class="st-megamenu-options">
						<?php
						if($item->st_megamenu != "" && $depth === 0) $value = "checked='checked'";
						?>
						<p class="field-st-megamenu st-checkbox st-megamenu description-wide">
							<label for="edit-menu-item-st-megamenu-<?php echo $item_id; ?>">
								<input type="checkbox" value="active" id="edit-menu-item-st-megamenu-<?php echo $item_id; ?>" class="code menu-item-st-megamenu edit-menu-item-st-megamenu" name="menu-item-st-megamenu[<?php echo $item_id; ?>]" <?php echo ($item->st_megamenu==='active') ? 'checked="checked"' : ''; ?> />
                                <?php _e( 'Use as Mega Menu' ); ?>
							</label>
						</p>
						<!-- ***************  end item *************** -->
                        
                        <?php
						if($item->st_title_megamenu != "" && $depth !== 0) $value = "checked='checked'";
						?>
						<p class="field-st-title-megamenu st-title-megamenu description-wide">
							<label for="edit-menu-item-st-title-megamenu-<?php echo $item_id; ?>">
								<input type="checkbox" value="active" id="edit-menu-item-st-title-megamenu-<?php echo $item_id; ?>" class="code menu-item-st-title-megamenu edit-menu-item-st-title-megamenu" name="menu-item-st-title-megamenu[<?php echo $item_id; ?>]" <?php echo ($item->st_title_megamenu==='active') ? 'checked="checked"' : ''; ?> />
                                <?php _e( 'Use as Title Menu' ); ?>
							</label>
						</p>
						<!-- ***************  end item *************** -->
                        
                        <?php
						if($item->st_disable_text!= "" && $depth !== 0) $value = "checked='checked'";
						?>
						<p class="field-st-title-megamenu st-title-megamenu description-wide">
							<label for="edit-menu-item-st-disable-text-<?php echo $item_id; ?>">
								<input type="checkbox" value="active" id="edit-menu-item-st-disable-text-<?php echo $item_id; ?>" class="code menu-item-st-disable-text edit-menu-item-st-disable-text" name="menu-item-st-disable-text[<?php echo $item_id; ?>]" <?php echo ($item->st_disable_text==='active') ? 'checked="checked"' : ''; ?> />
                                <?php _e( 'Disable Label' ); ?>
							</label>
						</p>
						<!-- ***************  end item *************** -->
                        
                        <p class="field-st-wrapcolumn-megamenu wrapcolumn-megamenu description-wrapcolumn-megamenu description-wide">
							<label for="wrapcolum-<?php echo $key.'-'.$item_id; ?>">
                                <?php _e(' Wrap Columns ') ?>
                                <br />
                                <select id="edit-menu-item-st-wrapcolumn-megamenu-<?php echo $item_id; ?>" class="widefat code edit-menu-item-st-wrapcolumn-megamenu" name="menu-item-st-wrapcolumn-megamenu[<?php echo $item_id; ?>]">
                                    <?php
                                        /* if use 6 columns 
                                        $wrapcolum = array(
                                                '0' => 'Default'
                                        );
                                        
                                        for($i=1;$i<=6;$i++) { $wrapcolum[''.$i.''] = $i; } 
                                        */
                                        $wrapcolum = array(
                                                '0' => 'Default'
                                        );
                                        
                                        for($i=1;$i<=12;$i++) { $wrapcolum[''.$i.''] = $i; } 
                                        
                                        foreach($wrapcolum as $k => $v) {
                                            if ($k==$item->st_wrapcolumn_megamenu) echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
                                            else echo '<option value="'.$k.'">'.$v.'</option>';
                                        }
                                    ?>
                                </select>
							</label>
						</p>
                        <!-- ***************  end item *************** -->
					
						<p class="field-st-division-megamenu st-division-megamenu description-wide">
							<label for="edit-menu-item-st-division-megamenu-<?php echo $item_id; ?>">
								<input type="checkbox" value="active" id="edit-menu-item-st-division-megamenu-<?php echo $item_id; ?>" class="code menu-item-st-division-megamenu edit-menu-item-st-division-megamenu" name="menu-item-st-division-megamenu[<?php echo $item_id; ?>]" <?php echo ($item->st_division_megamenu==='active') ? 'checked="checked"' : ''; ?> />
                                <?php _e( 'This column should start a new row' ); ?>
							</label>
						</p>
						<!-- ***************  end item *************** -->
					
					</div>
					<!-- end ST custom code here -->
				
					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type ) : ?>
							<p class="link-to-original">
								<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php _e('Remove'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php	echo add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo $item_id; ?>">Cancel</a>
					</div>
	
					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}
	}


}



if( !class_exists( 'st_responsive_mega_menu' ) )
{

	/**
	 * The st walker is the frontend walker and necessary to display the menu, this is a advanced version of the wordpress menu walker
	 * @package WordPress
	 * @since 1.0.0
	 * @uses Walker
	 */
	class st_responsive_mega_menu extends Walker {
		/**
		 * @see Walker::$tree_type
		 * @var string
		 */
		var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	
		/**
		 * @see Walker::$db_fields
		 * @todo Decouple this.
		 * @var array
		 */
		var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	
		/**
		 * @var int $columns 
		 */
		var $columns = 0;
		
		/**
		 * @var int $max_columns maximum number of columns within one mega menu 
		 */
		var $max_columns = 0;
		
		/**
		 * @var int $rows holds the number of rows within the mega menu 
		 */
		var $rows = 1;
		
		/**
		 * @var array $rowsCounter holds the number of columns for each row within a multidimensional array
		 */
		var $rowsCounter = array();
		
		/**
		 * @var string $mega_active hold information whetever we are currently rendering a mega menu or not
		 */
		var $mega_active = 0;
        
        
        var $auto_column = 'auto-col';
		
		
		/**
		*
		* Constructor that sets the grid variables
		*
		*/
		function st_responsive_mega_menu() {}
        
        
        
        /**
    	 * Traverse elements to create list from elements.
    	 *
    	 * Calls parent function in wp-includes/class-wp-walker.php
    	 */
    	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    
    		if ( !$element )
    			return;
    
    		//Add indicators for top level menu items with submenus
    		$id_field = $this->db_fields['id'];
    		if ( $depth == 0 && !empty( $children_elements[ $element->$id_field ] ) ) {
    			$element->classes[] = 'mega-with-sub';
    		}
            
            if (!empty( $children_elements[ $element->$id_field ] )) {
                $element->classes[] = 'item-parent';
            }
    		
    		Walker::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    	}
	
	
		/**
		 * @see Walker::start_lvl()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		function start_lvl(&$output, $depth = 0, $args = array()) {
			$indent = str_repeat("\t", $depth);
			if($depth === 0) $output .= "\n{replace_one}\n";
			$output .= "\n$indent<ul class=\"menu-row sub-menu sub-menu-$depth clearfix\">\n";
		}
	
		/**
		 * @see Walker::end_lvl()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		function end_lvl(&$output, $depth = 0, $args = array()) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
			
			if($depth === 0) 
			{
				if($this->mega_active)
				{

					$output .= "\n<div class='clear'></div></div>\n";
					$output = str_replace("{replace_one}", "<div class='nav-dd ". $this->auto_column ." st-mega-div st-mega".$this->max_columns."'>", $output);
					$output = str_replace("{last_item}", "st-mega-menu-columns-last", $output);
					
					foreach($this->rowsCounter as $row => $columns)
					{
						$output = str_replace("{current_row_".$row."}", "st-mega-menu-columns-".$columns, $output);
					}
					
					$this->columns = 0;
					$this->max_columns = 0;
					$this->rowsCounter = array();
					
				}
				else
				{
					$output = str_replace("{replace_one}", "", $output);
				}
			}
		}
	
		/**
		 * @see Walker::start_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
			global $wp_query;
			//set maxcolumns
			//if(!isset($args->max_columns) && gettype($args->max_columns) !== NULL) $args->max_columns = 6;
            // when use 6 columns : $max_columns = 6;
            $max_columns = 12;
			$item_output = $li_text_block_class = $column_class = "";
            $class_names = $class_link = $value = '';
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
            
            $classes_link = array();
            
            $classes[] = 'menu-item-depth-'. $depth;
			if($depth === 0)
			{
                $this->mega_active = $item->st_megamenu;
                if($this->mega_active === 'active') $classes[] = 'with-megamenu';
                else $classes[] = 'no-megamenu';
                $classes_link[] = 'link-depth-0';
                if ($item->st_wrapcolumn_megamenu !== 0) $this->auto_column = 'col'. $item->st_wrapcolumn_megamenu;
                else $this->auto_column = 'auto-col';
			}
            else {
                //If item depth > 0, with wrap column = 0 then set default = 1
                if ($item->st_wrapcolumn_megamenu === 0) $item->st_wrapcolumn_megamenu = 1; 
            }
			
			if($depth === 1 && $this->mega_active)
			{
				//$this->columns ++;
                $this->columns += (int)$item->st_wrapcolumn_megamenu;
				
				//check if we have more than $args['max_columns'] columns or if the user wants to start a new row
				if($this->columns > $max_columns || ($item->st_division_megamenu && $this->columns != 1))
				{
					$this->columns = 1;
					$this->rows ++;
					$output .= "\n</ul><ul class=\"menu-row sub-menu sub-menu-0 st-mega-hr clearfix\">\n";
					$output = str_replace("{last_item}", "st-mega-menu-columns-last", $output);
				}
				else
				{
					$output = str_replace("{last_item}", "", $output);
				}
				
				$this->rowsCounter[$this->rows] = $this->columns;
				
				if($this->max_columns < $this->columns) $this->max_columns = $this->columns;

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				$column_class  = ' {current_row_'.$this->rows.'} {last_item}';
				
				if($this->columns == 1)
				{
					$column_class  .= " st-mega-menu-columns-first";
				}
                
                $classes_link[] = 'header-column';
			}
            
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';			
			$item_output .= $args->before;
            
            
            
            $start_wrap = $end_wrap = $wrap_text = $caption = $icon_arrow = '';
            
            
            // check if not disable text
            if ($item->st_disable_text != 'active' || $this->mega_active != 'active') {
                if ($depth !== 0 && $item->st_title_megamenu === 'active' && $this->mega_active === 'active') {
                    $classes[] = 'is-title-megamenu';
                    $classes_link[] = 'megamenu-title';
                    $start_wrap = '<h3 class="'. esc_attr(join(' ', array_filter($classes_link))) .'">';
                    $end_wrap = '</h3>';
                }
                else {
                    $start_wrap = '<a'. $attributes .' class="'. esc_attr(join(' ', array_filter($classes_link))) .'">';
                    $end_wrap = '</a>';    
                }
                $wrap_text = $args->link_before .'<span class="menu-title">'. apply_filters( 'the_title', $item->title, $item->ID ) .'</span>'. $args->link_after;
                if($depth === 0) $icon_arrow = '<span class="st-icon-arrow icon-chevron-down"></span>';
            }
            else {
                $classes[] = 'is-disable-text';
            }
            if ($item->st_title_megamenu === 'active') {
                $classes[] = 'is-title-megamenu';
            }
            if (($depth == 1 || $depth === 2) && trim($item->st_caption_megamenu) && $item->st_title_megamenu === 'active') $caption = '<span class="menu-caption">'. $item->st_caption_megamenu .'</span>';
            
            $item_output .= $start_wrap . $wrap_text . $icon_arrow . $caption . $end_wrap;
			 
            if (($depth === 1 || $depth === 2) && trim($item->post_content) && $this->mega_active) $item_output .= '<div class="menu-content">'. apply_filters( 'st_megamenu_content', $item->post_content, $item ) .'</div>';
			$item_output .= $args->after;
            
            $cols = '';
            if ($depth === 1) {
                $classes[] = 'col';
                $classes[] = 'col'. esc_attr($item->st_wrapcolumn_megamenu);
                $cols = 'col="'. esc_attr($item->st_wrapcolumn_megamenu) .'"';
            }
	
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'.$li_text_block_class. esc_attr( $class_names ) . $column_class.'"';
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .' '. $cols .'>';
            if ($depth === 1 && $this->mega_active === 'active') {
                $output .= '<div class="menu-wrap">';
            }
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	
		/**
		 * @see Walker::end_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Page data object. Not used.
		 * @param int $depth Depth of page. Not Used.
		 */
		function end_el(&$output, $item, $depth = 0, $args = array()) {
            if ($depth === 1 && $this->mega_active === 'active') {
                $output .= '<div class="clear"></div></div>';
            }
			$output .= "</li>\n";
		}
	}
    
    
}


/**
 * This function is a clone of the admin-ajax.php files case:"add-menu-item" with modified walker. We call this function by hooking into wordpress generic "wp_".$_POST['action'] hook. To execute this script rather than the default add-menu-items a javascript overwrites default request with the request for this script
 */
if(!function_exists('st_ajax_switch_menu_walker'))
{
	function st_ajax_switch_menu_walker()
	{	
		if ( ! current_user_can( 'edit_theme_options' ) )
		die('-1');

		check_ajax_referer( 'add-menu_item', 'menu-settings-column-nonce' );
	
		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
	
		$item_ids = wp_save_nav_menu_items( 0, $_POST['menu-item'] );
		if ( is_wp_error( $item_ids ) )
			die('-1');
	
		foreach ( (array) $item_ids as $menu_item_id ) {
			$menu_obj = get_post( $menu_item_id );
			if ( ! empty( $menu_obj->ID ) ) {
				$menu_obj = wp_setup_nav_menu_item( $menu_obj );
				$menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
				$menu_items[] = $menu_obj;
			}
		}
	
		if ( ! empty( $menu_items ) ) {
			$args = array(
				'after' => '',
				'before' => '',
				'link_after' => '',
				'link_before' => '',
				'walker' => new st_backend_walker,
			);
			echo walk_nav_menu_tree( $menu_items, 0, (object) $args );
		}
		
		die('end');
	}
	
	//hook into wordpress admin.php
	add_action('wp_ajax_st_ajax_switch_menu_walker', 'st_ajax_switch_menu_walker');
}


if( !function_exists( 'st_fallback_menu' ) )
{
	/**
	 * Create a navigation out of pages if the user didnt create a menu in the backend
	 *
	 */
	function st_fallback_menu()
	{
		$current = "";
		$exclude = st_get_option('frontpage');
		if (is_front_page()){$current = "class='current-menu-item'";} 
		if ($exclude) $exclude ="&exclude=".$exclude;
		
		echo "<div class='fallback_menu'>";
		echo "<ul class='st-mega-menu'>";
		echo "<li $current><a href='".get_bloginfo('url')."'>Home</a></li>";
		wp_list_pages('title_li=&sort_column=menu_order'.$exclude);
		echo "</ul></div>";
	}
}


add_filter('st_megamenu_content', 'st_megamenu_content', 10, 2);

function st_megamenu_content($content, $item) {
    if ($item->st_autop_megamenu === 'active') {
        return do_shortcode(wpautop($content));
    }
    else {
        return do_shortcode($content);    
    }
}