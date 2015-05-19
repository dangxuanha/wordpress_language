<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;
?>
<nav class="st-pagination-wrap">
	<?php
		$links =  paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;',
			'type'			=> 'array',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) ) );
	?>

    <ul class="pagination st-pagination">
        <?php foreach($links as $k=> $l){
             if(strpos($l,'<span')!==false && strpos($l,'current')!==false){
                 echo "<li class='active'>$l</li>";
             }else{
                 echo "<li>$l</li>";
             }

        } ?>
    </ul>

</nav>