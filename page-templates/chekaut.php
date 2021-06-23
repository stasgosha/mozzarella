<?php
/**
 * Template Name: Chekaut
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

    <section class="page-wrapper">
        <?php if(get_field('top_background')['url']){
            $image=get_field('top_background')['url'];
        }else{
            $image= get_template_directory_uri().'/img/banner-order.jpg';
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






        <section class="order-page">
            <div class="container">
                <h2><?php the_title();?></h2>
                <?php echo do_shortcode('[woocommerce_cart]');?>
                <?php the_content();?>

            </div>
        </section>

    </section>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>