<?php
/**
 * Template Name: Home
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <section class="page-wrapper">
        <section class="main-slider">
            <?php if( have_rows('slider_copy') ): ?>
                <?php
                $i=0;
                while( have_rows('slider_copy') ): the_row(); ?>
                    <div class="slide">
                        <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>" class="mob-hide">
                        <img src="<?php echo get_sub_field('image_mobile')['url'];?>" alt="<?php echo get_sub_field('image_mobile')['alt'];?>" class="mob-show">
                        <div class="description">
                            <div>
                                <?php echo get_sub_field('text_slider');?>
                                <a href="<?php echo get_sub_field('link_button_slider');?>" class="button"><?php echo get_sub_field('text_button_slider');?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>

        <section class="hp-about">
            <div class="container">
                <h2><?php echo get_field('title_about');?></h2>
                <?php echo get_field('about_text');?>

                <a href="<?php echo get_field('about_link_button');?>" class="button"><?php echo get_field('about_text_button');?></a>
            </div>
        </section>

        <?php if(!get_field('hide_section_how_to_buy')){ ?>
        <section class="hp-steps">
            <div class="container">
                <h2><?php echo get_field('how_to_buy__title');?></h2>
                <?php echo get_field('how_to_buy_text');?>
                <div class="steps-list">

                    <?php if( have_rows('how_to_buy') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('how_to_buy') ): the_row();  $i++;?>
                            <div class="item">
                                <a href="<?php echo get_sub_field('link');?>">
                                    <div class="number"><?php echo $i;?></div>
                                    <div class="icon-wrap">
                                        <img src="<?php echo get_sub_field('icon')['url'];?>" alt="<?php echo get_sub_field('icon')['alt'];?>">
                                    </div>
                                    <div class="caption">
                                        <h4><?php echo get_sub_field('title');?></h4>
                                        <?php echo get_sub_field('text');?>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php } ?>
        <section class="hp-paralax" style="  background-image: url(<?php echo get_field('parallax_image')['url'];?>);">
            <div class="container">
                <h2><?php echo get_field('title_parallax');?></h2>
                <p><?php echo get_field('subtitle_parallax_block');?></p>
                <a href="<?php echo get_term_link(get_field('parallax_block_link'), 'product_cat');?>" class="button"><?php echo get_field('parallax_block_text_button');?></a>
            </div>
        </section>

        <section class="hp-gallery">
            <h2><?php echo get_field('title_events');?></h2>
            <p><?php echo get_field('subtitle_events');?></p>
            <div class="hp-gallery-slider">
                <?php if( have_rows('events') ): ?>
                    <?php
                    $i=0;
                    while( have_rows('events') ): the_row(); ?>
                        <div class="slide">
                            <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>" class="mob-hide">
                            <img src="<?php echo get_sub_field('image__mobile')['url'];?>" alt="<?php echo get_sub_field('image__mobile')['alt'];?>" class="mob-show">
                            <div class="description"><?php echo get_sub_field('title');?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
        <?php if(!get_field('hide_section_catalog')){ ?>
        <section class="hp-pattern">
            <div class="container">
                <h2><?php echo get_field('title_catalog');?></h2>
                <a href="<?php echo get_field('catalog')['url'];?>" download="" class="button"><?php echo get_field('catalog_text_button');?></a>
            </div>
        </section>
        <?php } ?>


        <section class="quotes-section">
            <div class="container">
                <h2><?php echo get_field('title_reviews');?></h2>
                <div class="subtitle"><?php echo get_field('subtitle_reviews');?></div>
                <div class="quotes-slider-wrap">
                    <div class="quotes-slider">

                        <?php if( have_rows('reviews') ): ?>
                            <?php
                            $i=0;
                            while( have_rows('reviews') ): the_row(); ?>
                                <div class="slide">
                                    <div class="content">
                                       <?php echo get_sub_field('review');?>
                                    </div>
                                    <div class="caption">
                                        <div class="logo-wrap">
                                            <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                        </div>
                                        <div><?php echo get_sub_field('author');?> </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

    <?php get_template_part( 'instagram', '' ); ?>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>