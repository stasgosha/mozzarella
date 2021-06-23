<?php
/**
 * Template Name: Events
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
                <h1><?php the_title();?></h1>
            </div>

        </section>



        <section class="events-page">
            <div class="container">
				<?php the_content();?>
                <div>

                    <?php if( have_rows('events') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('events') ): the_row(); ?>
                            <div class="item">
                                <div class="slider-wrap">
                                    <div class="event-slider">
                                            <?php if( get_sub_field('slider') ): ?>
                                                <?php while( has_sub_field('slider') ): ?>
                                                    <div>
                                                            <img src="<?php print_R(get_sub_field('image')['url']);?>" alt="<?php print_R(get_sub_field('image')['alt']);?>" class="mob-hide">
                                                        <img src="<?php print_R(get_sub_field('image_mobile')['url']);?>" alt="<?php print_R(get_sub_field('image_mobile')['alt']);?>"  class="mob-show">
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <div class="caption">
                                   <?php echo get_sub_field('description');?>
                                </div>

                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php get_template_part( 'instagram', '' ); ?>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>