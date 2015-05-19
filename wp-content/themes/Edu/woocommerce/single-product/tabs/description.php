<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

$heading = esc_html( apply_filters('woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );
?>

<h2><?php echo $heading; ?></h2>

<?php
if(function_exists('st_the_builder_content')){
    if(!st_the_builder_content($post->ID)){
        the_content();
    }
}else{
    the_content();
}
?>