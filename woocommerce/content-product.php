<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<div class="item  <?php if (get_field('type_product')=='Recommend'){ echo 'recommend';}  if (get_field('type_product')=='Vegan'){ echo 'vegan';} ?>">
    <div class="img-wrap">
        <a href="<?php echo get_permalink();?>" class="name">
            <?php
            $thumb_id = get_post_thumbnail_id($product);
            $thumb_url = wp_get_attachment_image_src($thumb_id,'product', true);
            $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
            ?>
            <img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo $image_alt; ?>">
        </a>
    </div>
    <form action="">
        <a href="<?php echo get_permalink();?>" class="name"><?php the_title();?></a>
        <p>   <?php if(get_field('amount_per_serving')){  echo get_field('amount_per_serving'); ?> - <?php } ?> <?php echo $product->get_price_html(); ?>   </p>
        <div class="number-input">
            <div class="reduce-number-input control-btn">
                <i class="fal fa-minus"></i>
            </div>
            <input max="10000" value="1" min="1" type="number">
            <div class="increase-number-input control-btn">
                <i class="fal fa-plus"></i>
            </div>
        </div>
        <a href="<?php echo get_home_url();?>/?add-to-cart=<?php echo get_the_ID();?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart" data-product_id="<?php echo get_the_ID();?>" data-product_sku="" rel="nofollow">הוסף להזמנה</a>
    </form>

</div>