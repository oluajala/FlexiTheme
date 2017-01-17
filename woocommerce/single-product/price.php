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

global $product;
$regular_price = get_post_meta(get_the_id(), '_regular_price', true );
/*  only for simple product with regular_price not with variable price  */
/*if($regular_price==''){
    $available_variations = $product->get_available_variations();
    $variation_id=$available_variations[2]['variation_id'];
    $variable_product1= new WC_Product_Variation( $variation_id );
    $regular_price = $variable_product1 ->regular_price;
}*/

?>
<?php echo do_shortcode('[woocs]'); ?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

    <?php
        /* check for price */
        $noPrice = $product->get_price_html();
    ?>
    <?php if(!empty($noPrice) && $regular_price<>''): ?>
        <p class="price heading_font">
            <label class="h6 stm_price_label"><?php _e('Price', STM_DOMAIN); ?></label>

            <strong>
            <?php echo $product->get_price_html(); ?>
                <?php //echo esc_attr(get_woocommerce_currency_symbol().$regular_price); ?>
            </strong>
        </p>
    <?php endif; ?>

    <meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
    <meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
    <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
