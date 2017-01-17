<?php
/**
 * IMPORTANT NOTICE
 * ==================================================================
 * This template has been updated by Olumide Ajala for the Flexi Theme
 *
 * STANDARD WOOCOMMERCE NOTICE
 * ==================================================================
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  FlexiTheme
 * @package Flexi/WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();


$shop_sidebar_position = stm_option( 'shop_sidebar_position', 'none' );
if(isset($_GET['sidebar_position']) and $_GET['sidebar_position'] == 'none') {
	$shop_sidebar_position = 'none';
}

if($shop_sidebar_position == 'none') {
	$classes[] = 'col-md-3 col-sm-4 col-xs-6 course-col';
} else {
	$classes[] = 'col-md-4 col-sm-4 col-xs-6 course-col';
}

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>

<!-- Custom Meta -->
<?php


$expert = get_post_meta(get_the_id(), 'course_expert', true);
$stock = get_post_meta(get_the_id(), '_stock', true );
$regular_price = get_post_meta(get_the_id(), '_regular_price', true );
$sale_price = get_post_meta(get_the_id(), '_sale_price', true );
//print"<pre>";
//print_r($product);
if($regular_price=='' && $product->product_type!='simple'){
	$available_variations = $product->get_available_variations();
	$variation_id=$available_variations[2]['variation_id'];
	$variable_product1= new WC_Product_Variation( $variation_id );
	$regular_price = $variable_product1 ->regular_price;
}
?>


<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="stm_archive_product_inner_unit heading_font">
		<div class="stm_archive_product_inner_unit_centered">

			<div class="stm_featured_product_image">

				<div class="stm_featured_product_price">
				<?php if($product->product_type!='simple'){


					?>

					<?php if(!empty($sale_price) and $sale_price != 0){ ?>
						<div class="price">
							<?php echo esc_attr(get_woocommerce_currency_symbol().$sale_price); ?>
						</div>
					<?php }elseif(!empty($regular_price) and $regular_price != 0){ ?>
						<div class="price">
							<h5><?php echo esc_attr(get_woocommerce_currency_symbol().$regular_price); ?></h5>
						</div>
					<?php }else{ ?>
						<div class="price price_free">
							<h5><?php _e('Free', STM_DOMAIN); ?></h5>
						</div>
					<?php } ?>

					<?php }else{

						?>
						<div class="price price_free">
							<h5><?php _e('Free', STM_DOMAIN); ?></h5>
						</div>

					<?php } ?>
				</div>



				<?php if(has_post_thumbnail()): ?>
					<a href="<?php the_permalink() ?>" title="<?php _e('View course', STM_DOMAIN) ?> - <?php the_title(); ?>">
						<?php the_post_thumbnail('img-270-283', array('class'=>'img-responsive')); ?>
					</a>
				<?php else: ?>
					<div class="no_image_holder"></div>
				<?php endif; ?>

			</div>



			<div class="stm_featured_product_body">
				<a href="<?php the_permalink() ?>"  title="<?php _e('View course', STM_DOMAIN) ?> - <?php the_title(); ?>">
					<div class="title"><?php the_title(); ?></div>
				</a>

				<?php if(!empty($expert) and $expert != 'no_teacher'): ?>
					<div class="expert"><?php echo esc_attr(get_the_title($expert)); ?></div>
				<?php else: ?>
					<div class="expert">&nbsp;</div>
				<?php endif; ?>
			</div>

			<div class="stm_featured_product_footer">
				<div class="clearfix">
					<div class="pull-left">

						<?php $comments_num = get_comments_number(get_the_id()); ?>
						<?php if($comments_num): ?>
							<div class="stm_featured_product_comments">
								<i class="fa-icon-stm_icon_comment_o"></i><span><?php echo esc_attr($comments_num); ?></span>
							</div>
						<?php else: ?>
							<div class="stm_featured_product_comments">
								<i class="fa-icon-stm_icon_comment_o"></i><span>0</span>
							</div>
						<?php endif; ?>


						<?php if(!empty($stock)): ?>
							<div class="stm_featured_product_stock">
								<i class="fa-icon-stm_icon_user"></i><span><?php echo esc_attr(floatval($stock)); ?></span>
							</div>
						<?php else: ?>
							<div class="stm_featured_product_stock">
								<i class="fa-icon-stm_icon_user"></i><span>0</span>
							</div>
						<?php endif; ?>

					</div>
					<div class="pull-right">
						<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
					</div>
				</div>

				<div class="stm_featured_product_show_more">
					<a class="btn btn-default" href="<?php the_permalink() ?>" title="<?php _e('View more', STM_DOMAIN) ?>"><?php _e('View more', STM_DOMAIN); ?></a>
				</div>
			</div>

		</div> <!-- stm_archive_product_inner_unit_centered -->
	</div> <!-- stm_archive_product_inner_unit -->
</li>
