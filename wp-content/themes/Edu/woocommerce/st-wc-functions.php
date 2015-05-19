<?php
/**
 *@todo  DO NOT LOAD DEFAULT WOOCOMMERCE CSS
 */
define('WOOCOMMERCE_USE_CSS', false);
#-----------------------------------------------------------------
# Enqueue Style
#-----------------------------------------------------------------
if( !function_exists('st_wc_enqueue_styles')) {
    function st_wc_enqueue_styles() {
        if(!is_admin()) {
            if(is_file(ST_THEME_DIR.'woocommerce/assets/css/woocommerce.css')){
                wp_dequeue_style('woocommerce_frontend_styles');
                wp_enqueue_style('woocommerce_frontend_styles', ST_THEME_URL.'woocommerce/assets/css/woocommerce.css'  );
            }
        }
    }
}
#-----------------------------------------------------------------
# Enqueue Scripts
#-----------------------------------------------------------------
if(!function_exists('st_wc_enqueue_scripts')) {
    function st_wc_enqueue_scripts() {
        if(!is_admin()) {
            wp_enqueue_script('st-wc-cart',ST_THEME_URL.'woocommerce/assets/js/st-cart.js', array('jquery'), '1.0',  true );
        }
    }
}
add_action('wp_print_styles','st_wc_enqueue_styles',100);
add_action('wp_print_scripts','st_wc_enqueue_scripts',100);
/**
 * Display Icon cart with number items and dropdown list item in cart
 */
function st_wc_cart_icon(){
?>
   <div class="st-cart-icon bg-parent-hover">
       <span class="cart-icon bg-color"><span class="number"></span><i class="iconentypo-basket"></i></span>
       <div class="cart-content"></div>
   </div>
<?php
}
/**
 * Change Number product per page to show
 * @return int
 */
function st_wc_numb_pro_per_page(){
    $page_options = st_get_post_options(st_get_shop_page());
    if(!isset($page_options['number_product']) || intval($page_options['number_product'])<=0){
        $page_options['number_product'] = 9;
    }
    return $page_options['number_product'];
}
add_filter( 'loop_shop_per_page', 'st_wc_numb_pro_per_page');
if(!function_exists('st_woocommerce_related_products')){
        /**
         *
         * Change number of related products on product page
         * Set your own value for 'posts_per_page'
         *
         */
        function st_woocommerce_related_products() {
            $page_options = st_get_post_options(st_get_shop_page());
            if($page_options['show_relative_prod']!='no'){
                $number = intval($page_options['number_relative_prod']) > 0 ? intval($page_options['number_relative_prod']) : 3;
                $col = intval($page_options['relative_prod_num_col']) > 0 ? intval($page_options['relative_prod_num_col']) : 3;
                woocommerce_related_products( $number, $col );
            }else{
               // do nothing
            }
        }
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product_summary', 'st_woocommerce_related_products', 20 );
/**
 * Chanege upsells product (You may like)
 *
 */
if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
    function st_woocommerce_output_upsells() {
        $page_options = st_get_post_options(st_get_shop_page());
        if($page_options['show_upsells_prod']!='no'){
            $number = intval($page_options['number_upsells_prod']) > 0 ? intval($page_options['number_upsells_prod']) : 3;
            $col = intval($page_options['upsells_prod_num_col']) > 0 ? intval($page_options['upsells_prod_num_col']) : 3;
            woocommerce_upsell_display( $number, $col );
        }else{
            // do nothing
        }
    }
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'st_woocommerce_output_upsells', 15 );
/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
    add_action( 'init', 'st_woocommerce_image_dimensions', 1 );
}
/**
 * Define image sizes
 */
function st_woocommerce_image_dimensions() {
    $catalog = array(
        'width' => '600',	   // px
        'height'	=> '600',	// px
        'crop'	=> 1 // true
    );
    $single = array(
        'width' => '600',	// px
        'height'	=> '600',	// px
        'crop'	=> 0 // true
    );
    $thumbnail = array(
        'width' => '120',	// px
        'height'	=> '120',	// px
        'crop'	=> 0 // false
    );
    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
    update_option( 'shop_single_image_size', $single ); // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}
if(!function_exists('st_get_shop_page')){
    /**
     * Get WC shop page id
     * @return page id
     */
    function st_get_shop_page(){
        $post_id  = get_option('woocommerce_shop_page_id');
        if(st_is_wpml()){
            $post_id=   icl_object_id($post_id, 'page', true);
        }
        $post_id = intval($post_id);
        if($post_id<=0){
            $post_id =-999999;
        }
        return $post_id;
    }
}
if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
    /**
     * Output the WooCommerce Breadcrumb
     *
     * @access public
     * @return void
     */
    function woocommerce_breadcrumb( $args = array() ) {
        $defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
            'delimiter'   => ' &#47; ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        ) );
        $args = wp_parse_args( $args, $defaults );
        woocommerce_get_template( 'shop/breadcrumb.php', $args );
    }
}
/**
 *
 * Remove WC default breadcrumb
 *
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
if ( ! function_exists( 'woocommerce_content' ) ) {
    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     * @access public
     * @return void
     */
    function woocommerce_content() {
       // remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
        //remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
       // remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
       // remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        if ( is_singular( 'product' ) ) {
			while ( have_posts() ) : the_post();
				woocommerce_get_template_part( 'content', 'single-product' );
			endwhile;
		} else {
            ?>
			<?php do_action( 'woocommerce_archive_description' ); ?>
			<?php if ( have_posts() ) : ?>
				<?php do_action('woocommerce_before_shop_loop'); ?>
				<?php woocommerce_product_loop_start(); ?>
					<?php woocommerce_product_subcategories(); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php woocommerce_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
				<?php woocommerce_product_loop_end(); ?>
				<?php do_action('woocommerce_after_shop_loop'); ?>
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
				<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
			<?php endif;
		}
    }
}
/** Forms ****************************************************************/
if ( ! function_exists( 'woocommerce_form_field' ) ) {
    /**
     * Outputs a checkout/address form field.
     *
     * @access public
     * @subpackage	Forms
     * @param mixed $key
     * @param mixed $args
     * @param string $value (default: null)
     * @return void
     */
    function woocommerce_form_field( $key, $args, $value = null ) {
        global $woocommerce;
        $defaults = array(
            'type'              => 'text',
            'label'             => '',
            'placeholder'       => '',
            'maxlength'         => false,
            'required'          => false,
            'class'             => array(),
            'label_class'       => array(),
            'return'            => false,
            'options'           => array(),
            'custom_attributes' => array(),
            'validate'          => array(),
            'default'		    => '',
        );
        $args = wp_parse_args( $args, $defaults  );
        if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
        if ( $args['required'] ) {
            $args['class'][] = 'validate-required';
            $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
        } else {
            $required = '';
        }
        $args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';
        if ( is_null( $value ) )
            $value = $args['default'];
        // Custom attribute handling
        $custom_attributes = array();
        if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) )
            foreach ( $args['custom_attributes'] as $attribute => $attribute_value )
                $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
        if ( ! empty( $args['validate'] ) )
            foreach( $args['validate'] as $validate )
                $args['class'][] = 'validate-' . $validate;
        switch ( $args['type'] ) {
            case "country" :
                if ( sizeof( $woocommerce->countries->get_allowed_countries() ) == 1 ) {
                    $field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
                    if ( $args['label'] )
                        $field .= '<label class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']  . '</label>';
                    $field .= '<strong>' . current( array_values( $woocommerce->countries->get_allowed_countries() ) ) . '</strong>';
                    $field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" value="' . current( array_keys( $woocommerce->countries->get_allowed_countries() ) ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
                    $field .= '</p>' . $after;
                } else {
                    $field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">
						<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required  . '</label>
						<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="country_to_state country_select" ' . implode( ' ', $custom_attributes ) . '>
							<option value="">'.__( 'Select a country&hellip;', 'woocommerce' ) .'</option>';
                    foreach ( $woocommerce->countries->get_allowed_countries() as $ckey => $cvalue )
                        $field .= '<option value="' . $ckey . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';
                    $field .= '</select>';
                    $field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . __( 'Update country', 'woocommerce' ) . '" /></noscript>';
                    $field .= '</p>' . $after;
                }
                break;
            case "state" :
                /* Get Country */
                $country_key = $key == 'billing_state'? 'billing_country' : 'shipping_country';
                if ( isset( $_POST[ $country_key ] ) ) {
                    $current_cc = woocommerce_clean( $_POST[ $country_key ] );
                } elseif ( is_user_logged_in() ) {
                    $current_cc = get_user_meta( get_current_user_id() , $country_key, true );
                    if ( ! $current_cc) {
                        $current_cc = apply_filters('default_checkout_country', ($woocommerce->customer->get_country()) ? $woocommerce->customer->get_country() : $woocommerce->countries->get_base_country());
                    }
                } elseif ( $country_key == 'billing_country' ) {
                    $current_cc = apply_filters('default_checkout_country', ($woocommerce->customer->get_country()) ? $woocommerce->customer->get_country() : $woocommerce->countries->get_base_country());
                } else {
                    $current_cc = apply_filters('default_checkout_country', ($woocommerce->customer->get_shipping_country()) ? $woocommerce->customer->get_shipping_country() : $woocommerce->countries->get_base_country());
                }
                $states = $woocommerce->countries->get_states( $current_cc );
                if ( is_array( $states ) && empty( $states ) ) {
                    $field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field" style="display: none">';
                    if ( $args['label'] )
                        $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';
                    $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $key ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . $args['placeholder'] . '" />';
                    $field .= '</p>' . $after;
                } elseif ( is_array( $states ) ) {
                    $field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
                    if ( $args['label'] )
                        $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="state_select" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . $args['placeholder'] . '">
					<option value="">'.__( 'Select a state&hellip;', 'woocommerce' ) .'</option>';
                    foreach ( $states as $ckey => $cvalue )
                        $field .= '<option value="' . $ckey . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';
                    $field .= '</select>';
                    $field .= '</p>' . $after;
                } else {
                    $field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
                    if ( $args['label'] )
                        $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
                    $field .= '<input type="text" class="input-text form-control" value="' . $value . '"  placeholder="' . $args['placeholder'] . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
                    $field .= '</p>' . $after;
                }
                break;
            case "textarea" :
                $field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
                if ( $args['label'] )
                    $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required  . '</label>';
                $field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text form-control" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" cols="5" rows="2" ' . implode( ' ', $custom_attributes ) . '>'. esc_textarea( $value  ) .'</textarea>
				</p>' . $after;
                break;
            case "checkbox" :
                $field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">
					<input type="' . $args['type'] . '" class="input-checkbox" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" value="1" '.checked( $value, 1, false ) .' />
					<label for="' . esc_attr( $key ) . '" class="checkbox ' . implode( ' ', $args['label_class'] ) .'" ' . implode( ' ', $custom_attributes ) . '>' . $args['label'] . $required . '</label>
				</p>' . $after;
                break;
            case "password" :
                $field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
                if ( $args['label'] )
                    $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
                $field .= '<input type="password" class="input-text form-control" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />
				</p>' . $after;
                break;
            case "text" :
                $field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
                if ( $args['label'] )
                    $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';
                $field .= '<input type="text" class="input-text form-control" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />
				</p>' . $after;
                break;
            case "select" :
                $options = '';
                if ( ! empty( $args['options'] ) )
                    foreach ( $args['options'] as $option_key => $option_text )
                        $options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';
                $field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
                if ( $args['label'] )
                    $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
                $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="select" ' . implode( ' ', $custom_attributes ) . '>
						' . $options . '
					</select>
				</p>' . $after;
                break;
            default :
                $field = apply_filters( 'woocommerce_form_field_' . $args['type'], '', $key, $args, $value );
                break;
        }
        if ( $args['return'] ) return $field; else echo $field;
    }
}
