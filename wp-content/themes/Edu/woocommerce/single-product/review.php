<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>

<li itemprop="reviews"  itemtype="http://schema.org/Review"  <?php comment_class('comment'); ?> id="comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-item comment-item">
        <div class="comment-header">
            <?php echo get_avatar($comment->comment_author_email,$size='60',$default='' ); ?>
            <div class="comment-header-right">
                <p class="comment-date"><?php printf('%1$s', get_comment_date()); ?></p>
                <a href="#" class="comment-author"><?php printf('<b class="author_name">%s</b>', get_comment_author_link()) ?></a>
                <?php edit_comment_link(__('(Edit)','smooththemes'),'  ','') ?>
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

                <?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>
                    <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating text-color" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>">
                        <span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
                    </div>
                <?php endif; ?>

            </div>

            <div class="clear"></div>
        </div>

        <div class="clear"></div>

        <div itemprop="description" class='comment-content description'>
            <?php comment_text() ?>
            <?php if ($comment->comment_approved == '0') : ?>
                <br /> <em><?php _e('Your comment is awaiting moderation.','smooththemes') ?></em>
            <?php endif; ?>
        </div>
    </div>
<?php /*

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
		<?php echo get_avatar( $GLOBALS['comment'], $size='60' ); ?>
		<div class="comment-text">
			<?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>
				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating text-color" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>">
					<span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
			<?php else : ?>
				<p class="meta">
					<strong itemprop="author"><?php comment_author(); ?></strong> <?php

						if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
							if ( woocommerce_customer_bought_product( $GLOBALS['comment']->comment_author_email, $GLOBALS['comment']->user_id, $post->ID ) )
								echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';

					?>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(__( get_option('date_format'), 'woocommerce' )); ?></time>:
				</p>
			<?php endif; ?>

				<div itemprop="description" class="description"><?php comment_text(); ?></div>
				<div class="clear"></div>
			</div>
		<div class="clear"></div>
	</div>
 */ ?>
