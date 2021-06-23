<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    ?>

    <section class="page-wrapper">
        <?php if(get_field('top_background','product_cat_'.$term_id)['url']){
            $image=get_field('top_background','product_cat_'.$term_id)['url'];
        }else{
            $image= get_template_directory_uri().'/img/banner-category.jpg';
        }
        ?>
        <section class="top-banner" style="background-image: url(<?php echo $image; ?>);">
            <div class="breadcrumbs">
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>

            <div class="container">
                <h1><?php echo get_field('text_background','product_cat_'.$term_id);?></h1>

            </div>

        </section>
		<?php if(get_field('hide_menu',$term_id)){?>
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
                                <?php if($term_id!=$term->term_id){
                                    $image=get_sub_field('image')['url'];
                                }else{
                                    $image=get_sub_field('active_image')['url'];
                                }?>

                                <img src="<?php echo $image;?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                            </div>
                            <div><?php echo $term->name;?></div>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
		<?php }?>


        <section class="products-sec"  id="cat-1" >
            <div class="container">
                <h2><?php single_term_title( ); ?> </h2>
                <div class="item text-r" style="width: 100%;">
                    <?php echo  term_description();?>
                </div>

                <div class="product-list">
                    <?php
                    if ( woocommerce_product_loop() ) {
                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();
                                global $product;
                                ?>
                                <div class="item  <?php if (get_field('type_product')=='Recommend'){ echo 'recommend';}  if (get_field('type_product')=='Vegan'){ echo 'vegan';} ?>">
                                    <div class="img-wrap">
                                        <a href="<?php echo get_permalink();?>" class="name">
                                            <?php
                                            $thumb_id = get_post_thumbnail_id();
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
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php if( term_description()){?>

        <?php } ?>
    </section>


<?php
get_footer( 'shop' );
