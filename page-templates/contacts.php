<?php
/**
 * Template Name: Contacts
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



    <section class="contact-page">
        <div class="container">
            <div class="mob-show mob-contact-info">
              <?php the_content();?>
            </div>
            <div class="form-wrap">
				<div class="mob-hide">
                    <?php the_content();?>
                </div>
                <div class="custom-form">
                   <?php echo do_shortcode('[contact-form-7 id="212" title="Contact page form"]');?>
                </div>
            </div>
            <div class="map-wrap">
                <?php echo get_field('maps');?>
                
            </div>
        </div>
    </section>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>