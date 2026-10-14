<?php
/**
 * The template for displaying all single pages
 *
 * @package Amannisa
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        $content = trim( get_the_content() );
        if ( empty( $content ) || is_front_page() ) :
            get_template_part( 'template-parts/content', 'platform' );
        else :
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'wrap' ); ?> style="padding: 60px 24px;">
                <header class="page-header" style="margin-bottom: 30px;">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </header>
                <div class="page-content" style="line-height: 1.8;">
                    <?php
                    the_content();
                    wp_link_pages();
                    ?>
                </div>
            </article>
            <?php
        endif;
    endwhile;
endif;

get_footer();
