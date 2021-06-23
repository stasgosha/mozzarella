<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
global $product;
?>

    <section class="page-wrapper">
        <?php if(get_field('top_background')['url']){
            $image=get_field('top_background')['url'];
        }else{
            $image= get_field('default_product_banner','option')['url'];
        }
        ?>
        <section class="top-banner" style="background-image: url(<?php echo $image; ?>);">
            <div class="breadcrumbs">
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>

        </section>


    <div class="mob-show">
        <section class="categories-section">
            <h2><?php echo get_field('title_category','option');?></h2>
            <div class="show-category-list">
                <span>הקטגוריות שלנו</span>
                <i class="fal fa-angle-down"></i>
            </div>
            <div class="categories-list">
                <?php if( have_rows('categories','option') ): ?>
                    <?php
                    $i=0;
                    while( have_rows('categories','option') ): the_row();
                        $term = get_term( get_sub_field('category'), 'product_cat' );
                        ?>
                        <a href="<?php echo get_term_link($term->term_id,'product_cat');?>" class="item">
                            <div class="icon-wrap">
                                <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>" class="image_show">
                                <img src="<?php echo get_sub_field('active_image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>" class="image_hover">
                            </div>
                            <div><?php echo $term->name;?></div>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <section class="product-page">
        <div class="container">
            <h1><?php the_title();?></h1>
            <div class="product-img-slider">
                <?php $slider=get_field('gallery');
                if($slider){
                    $i=0;
                    foreach ($slider as  $value){ $i++;?>
                        <div class="slide">
                            <img src="<?php print_R($value['sizes']['product_gallery']);?>" alt="<?php print_R($value['alt']);?>">
                        </div>
                    <?php } } ?>

            </div>
            <?php if($i==1){ ?>
                <style>
                    .slick-dots {
                        display: none;
                    }
                    .slick-list {
                        margin-bottom: 20px;
                    }
                </style>
            <?php } ?>
            <div class="after-slider">
                <div>
                    <?php $terms = wp_get_post_terms( get_the_ID(), 'product_cat' );
                    if(!empty($terms[1]->term_id)){
                    ?>
                    <a href="<?php echo get_term_link($terms[1]->term_id,'product_cat');?>" class="back-to-cat-btn">חזרה לקטגוריות</a>
                        <br>
                    <?php } ?>
                    <a href="<?php echo get_permalink(121);?>" class="back-to-cat-btn">חזרה למגשי אירוח</a>
                </div>
                <div class="share">
                    שתף ב
                    <a href="<?php echo get_field('facebook','option');?>" target="_blank" class="item" style="background-color: #365f9f;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatssapp','option');?>" class="item" style="background-color: #1ac131;"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="about-product">
                <div class="col">
                    <?php the_content();?>
                    <p class="mob-hide">*הטעמים עלולים להשתנות בהתאם לעונה וזמינות המוצרים</p>
                </div>
                <div class="col form-wrap">
                    <form action="" class="cart">
                        <table>
                            <tr>
                                <td><?php echo get_field('text_serving');?></td>
                                <td>
                                 <?php echo get_field('amount_per_serving');?>
                                </td>
                            </tr>
                            <tr>
                                <td>מחיר כולל מע”מ</td>
                                <td class="price_product"> <?php echo $product->get_price_html(); ?>  </td>
                            </tr>
                            <tr>
                                <td colspan="2">


                                   <?php
                                    if($product->is_type( 'variable' )){ ?>
                                        <div class="variable">
                                        <?php
                                        do_action( 'woocommerce_single_product_summary' );?>
                                        </div>
                                            <?php
                                    }else{ ?>
<!--                                        <a href="--><?php //echo get_home_url();?><!--/?add-to-cart=--><?php //echo get_the_ID();?><!--" data-quantity="1" class="button brown-l product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart" data-product_id="--><?php //echo get_the_ID();?><!--" data-product_sku="" rel="nofollow">הוסף להזמנה</a>-->

                                     <?php
                                        if ( $product->is_in_stock() ) : ?>

                                            <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

                                            <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                                                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>


                                                <table class="quantity"  cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td class="label">בחירת כמות


                                                        </td>
                                                        <td class="value">
                                                            <?php
                                                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                                                            ?>
                                                            <div class="dib">
                                                            <div class="number-input">
                                                                <div class="reduce-number-input control-btn">
                                                                    <i class="fal fa-minus"></i>
                                                                </div>


                                                                <?php
                                                                woocommerce_quantity_input( array(
                                                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                                                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                                                ) );
                                                                ?>

                                                                <div class="increase-number-input control-btn">
                                                                    <i class="fal fa-plus"></i>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <?php
                                                            do_action( 'woocommerce_after_add_to_cart_quantity' );
                                                            ?>



                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>





                                                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="button brown-l product_type_simple single_add_to_cart_button button alt">הוסף להזמנה</button>

                                                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                                            </form>

                                            <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

                                        <?php endif; ?>


                                    <?php }

                                    ?>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
        <?php $special=get_field('recommendation_product');?>
        <?php if($special){?>
            <section class="related-products">
                <div class="container">
                    <h2>אולי יעניין אותך גם</h2>
                    <div class="related-products-slider">


                            <?php $i = 0;?>
                            <?php foreach($special as $value){ $i++;
                                $product = wc_get_product( $value );
                                $postid = url_to_postid( get_the_permalink($value) );
                                ?>
                                <div class="item">
                                    <div class="img-wrap">
                                        <?php
                                        $thumb_id = get_post_thumbnail_id($value);
                                        $thumb_url = wp_get_attachment_image_src($thumb_id,'full ', true);
                                        $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
                                        ?>
                                        <img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo $image_alt; ?>">
                                    </div>
                                    <div class="description">
                                        <?php echo get_field('short_description',$value);?>
                                        <p><a href="<?php the_permalink();?>" class="link"> קרא עוד ></a></p>
                                        <a href="<?php echo get_home_url();?>/?add-to-cart=<?php echo $value->ID;?>" data-quantity="1" class="button brown-l product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart" data-product_id="<?php echo $value->ID;?>" data-product_sku="" rel="nofollow">הוסף להזמנה</a>
                                    </div>
                                </div>
                            <?php  } ?>

                    </div>
                </div>
            </section>
        <?php  } ?>
    <div class="mob-hide">
        <section class="categories-section">
            <h2><?php echo get_field('title_category','option');?></h2>
            <div class="show-category-list">
                <span>הקטגוריות שלנו</span>
                <i class="fal fa-angle-down"></i>
            </div>
            <div class="categories-list">
                <?php if( have_rows('categories','option') ): ?>
                    <?php
                    $i=0;
                    while( have_rows('categories','option') ): the_row();
                        $term = get_term( get_sub_field('category'), 'product_cat' );
                        ?>
                        <a href="<?php echo get_term_link($term->term_id,'product_cat');?>" class="item">
                            <div class="icon-wrap">
                                <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>" class="image_show">
                                <img src="<?php echo get_sub_field('active_image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>" class="image_hover">
                            </div>
                            <div><?php echo $term->name;?></div>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>


</section>



<?php do_action( 'woocommerce_after_single_product' ); ?>
