<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>


<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <table class="order-table total-table">
        <tr class="shipping">
            <td>
                <div class="shipping-select">
                    <div class="img-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/shiping-img.jpg" alt="">
                    </div>
                    <div class="selects-wrap">


                        <select class="select" id="billing_shipping_my">

                        </select>
                        <input id="date_order" type="text" value="<?php echo date('d-m-Y', strtotime($Date. ' + 1 day'));?>" class="date-input">
                            <select id="time_order" class="select">
                                <?php if( have_rows('delivery_time_cart','option') ): ?>
                                    <?php
                                    $i=0;
                                    while( have_rows('delivery_time_cart','option') ): the_row(); ?>
                                        <option value="<?php echo get_sub_field('time');?>"><?php echo get_sub_field('time');?></option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>





                    </div>
                </div>
            </td>
            <td class="shipping-price">
                <div class="shipping-price-wrap">80 ₪</div>
            </td>
        </tr>

    </table>
    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

    <div id="order_review" class="woocommerce-checkout-review-order">
        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
    </div>


    <div class="order-table btn-wrap">
        <div class="order-table btn-wrap">
<!--            <a href="#"  id="sup_product"  class="button brown-l big">המשך</a>-->
            <a href="#"  id="popup_order"  class="button brown-l big">השלם הזמנה</a>
        </div>
        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
    </div>



    <div class="modal_wrap_white" id="order_modal">
        <div class="wrap_modal_order">
            <a href="" class="Close_modal_order"><i class="fal fa-times"></i></a>
            <?php do_action( 'woocommerce_checkout_billing' ); ?>
            <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

            <div class="modal_wrap-footer">
                <div class="text_after_order">
                    <?php echo get_field('text_popup_order','option');?>
                </div>
                <div>
                    <?php
                    $btn='סיימתי! בצע הזמנה';
                    echo '<button type="submit" class="button alt brown" name="woocommerce_checkout_place_order" id="place_order" >'.$btn.'</button>'; // @codingStandardsIgnoreLine ?>

                    <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden_product" id="hidden_product">
        <section class="offers">
            <div class="container">
                <h2><?php echo get_field('title_cart_produt','option');?></h2>
                <div class="offers-list">

                    <?php $special=get_field('product_cart','option');?>
                    <?php if($special){?>
                        <?php $i = 0;?>
                        <?php foreach($special as $value){
                            $product = wc_get_product( $value );
                            $postid = url_to_postid( get_the_permalink($value) );
                            ?>
                            <div class="item">
                                <div class="img-wrap">
                                    <?php
                                    $thumb_id = get_post_thumbnail_id($value);
                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'product_support', true);
                                    $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
                                    ?>
                                    <img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo $image_alt; ?>">
                                </div>
                                <div class="description">
                                    <?php echo get_field('short_description',$value->ID);?>
                                    <a href="<?php echo get_permalink($value->ID);?>" data-quantity="1" class="button brown-l product_type_simple add_to_cart_button" data-product_id="<?php echo $value->ID;?>" tabindex="1" > קרא עוד ></a>
                                    <!--                                    <a href="--><?php //echo get_home_url();?><!--/?add-to-cart=--><?php //echo $value->ID;?><!--" data-quantity="1" class="button brown-l product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart cart_product" data-product_id="--><?php //echo $value->ID;?><!--" tabindex="1" >הוסף להזמנה</a>-->
                                </div>
                            </div>
                        <?php  } ?>
                    <?php  } ?>
                </div>
            </div>
        </section>


        <a href="#"  id="popup_order"  class="button brown-l big">השלם הזמנה</a>
    </div>


</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
