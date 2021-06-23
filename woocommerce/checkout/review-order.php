<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<table class="shop_table woocommerce-checkout-review-order-table">
    <tr>
    <td class="text_total_cart">סה”כ כולל מע”מ</td>
        <td>
            <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
            <div class="order-total">
                <?php wc_cart_totals_order_total_html(); ?>
            </div>
            <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>


        </td>

            <td class="hidden">

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                    <?php wc_cart_totals_shipping_html(); ?>

                    <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

                <?php endif; ?>


        </td>
    </tr>

</table>

