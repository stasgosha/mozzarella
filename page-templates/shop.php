<?php
/**
 * Template Name: Shop
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

    <section class="page-wrapper">
        <?php if(get_field('top_background')['url']){
            $image=get_field('top_background')['url'];
        }else{
            $image= get_template_directory_uri().'/img/banner-category.jpg';
        }
        ?>
        <section class="top-banner" style="background-image: url(<?php echo $image; ?>);">
            <div class="breadcrumbs">
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>

            <div class="container">
                <h1><?php echo get_field('text_background');?></h1>
            </div>

        </section>


        <section class="categories-section fixed-categories">
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
                        <a href="#cat_<?php echo $term->term_id;?>" class="item">
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


<?php endwhile; // end of the loop. ?>
        <?php
        $terms = get_terms( array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
            'exclude' => array(15,29,42),
        ) );
        foreach ($terms as $value){ ?>
            <section class="products-sec"  id="cat_<?php echo $value->term_id;?>" >
                <div class="container">
                    <h2><?php echo $value->name;?></h2>
                    <div class="product-list">
                        <?php
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order title',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'id',
                                    'terms' => $value->term_id, // Where term_id of Term 1 is "1".
                                    'include_children' => false
                                )
                            )
                        );

                        $loop = new WP_Query( $args );

                        while ( $loop->have_posts() ) : $loop->the_post();
                            global $product;
                          ?>
                            <div class="item  <?php if (get_field('type_product')=='Recommend'){ echo 'recommend';}  if (get_field('type_product')=='Vegan'){ echo 'vegan';} ?>">
                                <a href="<?php echo get_permalink();?>" class="img-wrap">
                                    <?php
                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'product', true);
                                    $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
                                    ?>
                                    <img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo $image_alt; ?>">
                                </a>
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
                        endwhile;

                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </section>

        <?php }
        ?>

    </section>

<?php get_footer(); ?>