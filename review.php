<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating   = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

?>


<div itemprop="itemReviewed" itemscope itemtype="http://schema.org/Place">
<span itemprop="name" style="display:none">Tour</span>
<div itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   

	<div id="comment-<?php comment_ID(); ?>"  class="tour-reviews__item margin-left margin-right padding-top padding-bottom" >
    	<div class="tour-reviews__item__container">
	    	<div class="tour-reviews__item__info">
		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>

		<div class="comment-text">
  <div class="tour-reviews__item__name" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php comment_author(); ?></span></div>

					<div class="tour-reviews__item__content">
			<div class="tour-reviews__item__content__top">
				<?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>
				<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
					<?php adventure_tours_renders_stars_rating( $rating, array(
						'before' => '<div class="tour-reviews__item__rating">',
						'after' => '</div>',
					) ); ?>
					<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<meta itemprop="ratingValue" content="<?php echo esc_html( $rating ); ?>">
					</span>
				<?php endif; ?>
				<div class="tour-reviews__item__date"><?php echo get_comment_date( wc_date_format() ); ?></div>
			</div>
			<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
			<div class="tour-reviews__item__text" itemprop="reviewBody"><?php comment_text(); ?></div>
			<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
		</div>
	</div>
	
		
	</div>
	</div>	
	
	
</div>	


	
